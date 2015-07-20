<?php

require_once "base/dbaseEalternativa.php";

class dbEalternativa extends dbaseEalternativa {
// <editor-fold defaultstate="collapsed" desc="Inserir, Update, Deletar">       
    public static function Inserir($Conexao, $quiz, $pergunta, $descricao, $imagem, $ordem, $die = false) {
        
        return parent::Inserir($Conexao, $quiz, $pergunta, $descricao, $imagem, $ordem, $die);
    }
    
    public static function Update($Conexao, $cod, $quiz, $pergunta, $descricao, $imagem, $ordem, $die = false) {
        
        return parent::Update($Conexao, $cod, $quiz, $pergunta, $descricao, $imagem, $ordem, $die);
    }
    
    public static function Deletar($Conexao, $cod) {
        $obj = new objEalternativa($Conexao);
        $obj->loadByCod($cod);

        $exec = parent::Deletar($Conexao, $cod); 

        if ($obj->getImagem() !== null) {
            $obj->objImagem()->Delete();
        }
        //$obj->objPergunta()->Delete();
        //$obj->objQuiz()->Delete();
        
        return $exec;
        
        
        return parent::Deletar($Conexao, $cod);
    }
// </editor-fold>

    
    
}
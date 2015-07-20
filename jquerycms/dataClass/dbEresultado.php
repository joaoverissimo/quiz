<?php

require_once "base/dbaseEresultado.php";

class dbEresultado extends dbaseEresultado {
// <editor-fold defaultstate="collapsed" desc="Inserir, Update, Deletar">       
    public static function Inserir($Conexao, $quiz, $descricao, $texto, $imagem, $die = false) {
        
        return parent::Inserir($Conexao, $quiz, $descricao, $texto, $imagem, $die);
    }
    
    public static function Update($Conexao, $cod, $quiz, $descricao, $texto, $imagem, $die = false) {
        
        return parent::Update($Conexao, $cod, $quiz, $descricao, $texto, $imagem, $die);
    }
    
    public static function Deletar($Conexao, $cod) {
        $obj = new objEresultado($Conexao);
        $obj->loadByCod($cod);

        $exec = parent::Deletar($Conexao, $cod); 

        if ($obj->getImagem() !== null) {
            $obj->objImagem()->Delete();
        }
        //$obj->objQuiz()->Delete();
        
        return $exec;
        
        
        return parent::Deletar($Conexao, $cod);
    }
// </editor-fold>

    
    
}
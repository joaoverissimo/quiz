<?php

require_once "base/dbaseEpergunta.php";

class dbEpergunta extends dbaseEpergunta {

// <editor-fold defaultstate="collapsed" desc="Inserir, Update, Deletar">       
    public static function Inserir($Conexao, $quiz, $descricao, $imagem, $ordem, $die = false) {

        return parent::Inserir($Conexao, $quiz, $descricao, $imagem, $ordem, $die);
    }

    public static function Update($Conexao, $cod, $quiz, $descricao, $imagem, $ordem, $die = false) {

        return parent::Update($Conexao, $cod, $quiz, $descricao, $imagem, $ordem, $die);
    }

    public static function Deletar($Conexao, $cod) {
        $obj = new objEpergunta($Conexao);
        $obj->loadByCod($cod);

        $exec = parent::Deletar($Conexao, $cod);

        if ($obj->getImagem() !== null) {
            $obj->objImagem()->Delete();
        }

        return $exec;


        return parent::Deletar($Conexao, $cod);
    }

// </editor-fold>
}

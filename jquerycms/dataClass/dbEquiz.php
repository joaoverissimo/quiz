<?php

require_once "base/dbaseEquiz.php";

class dbEquiz extends dbaseEquiz {

// <editor-fold defaultstate="collapsed" desc="Inserir, Update, Deletar">       
    public static function Inserir($Conexao, $usuario, $seo, $titulo, $data, $imagem, $flaprovado, $votos, $die = false) {

        return parent::Inserir($Conexao, $usuario, $seo, $titulo, $data, $imagem, $flaprovado, $votos, $die);
    }

    public static function Update($Conexao, $cod, $usuario, $seo, $titulo, $data, $imagem, $flaprovado, $votos, $die = false) {

        return parent::Update($Conexao, $cod, $usuario, $seo, $titulo, $data, $imagem, $flaprovado, $votos, $die);
    }

    public static function Deletar($Conexao, $cod) {
        $obj = new objEquiz($Conexao);
        $obj->loadByCod($cod);

        $exec = parent::Deletar($Conexao, $cod);

        if ($obj->getImagem() !== null) {
            $obj->objImagem()->Delete();
        }
        $obj->objSeo()->Delete();
        //$obj->objUsuario()->Delete();

        return $exec;


        return parent::Deletar($Conexao, $cod);
    }

// </editor-fold>
}

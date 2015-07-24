<?php

require_once "base/dbaseEpubliquev1.php";

class dbEpubliquev1 extends dbaseEpubliquev1 {
// <editor-fold defaultstate="collapsed" desc="Inserir, Update, Deletar">       
    public static function Inserir($Conexao, $perguntas, $respostas, $email, $die = false) {
        
        return parent::Inserir($Conexao, $perguntas, $respostas, $email, $die);
    }
    
    public static function Update($Conexao, $cod, $perguntas, $respostas, $email, $die = false) {
        
        return parent::Update($Conexao, $cod, $perguntas, $respostas, $email, $die);
    }
    
    public static function Deletar($Conexao, $cod) {
        /* $obj = new objEpubliquev1($Conexao);
        $obj->loadByCod($cod);

        $exec = parent::Deletar($Conexao, $cod); 

         
         return $exec;
         */
        
        return parent::Deletar($Conexao, $cod);
    }
// </editor-fold>

    
    
}
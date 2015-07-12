<?php

require_once "base/dbaseJqueryadmingrupo2menu.php";

class dbJqueryadmingrupo2menu extends dbaseJqueryadmingrupo2menu {
// <editor-fold defaultstate="collapsed" desc="Inserir, Update, Deletar">       
    public static function Inserir($Conexao, $jqueryadmingrupo, $jqueryadminmenu, $die = false) {
        
        return parent::Inserir($Conexao, $jqueryadmingrupo, $jqueryadminmenu, $die);
    }
    
    public static function Update($Conexao, $cod, $jqueryadmingrupo, $jqueryadminmenu, $die = false) {
        
        return parent::Update($Conexao, $cod, $jqueryadmingrupo, $jqueryadminmenu, $die);
    }
    
    public static function Deletar($Conexao, $cod) {
        /* $obj = new objJqueryadmingrupo2menu($Conexao);
        $obj->loadByCod($cod);

        $exec = parent::Deletar($Conexao, $cod); 

        //$obj->objJqueryadmingrupo()->Delete();
        //$obj->objJqueryadminmenu()->Delete();
         
         return $exec;
         */
        
        return parent::Deletar($Conexao, $cod);
    }
// </editor-fold>

    
    
}
<?php

require_once "base/fbaseJqueryadmingrupo.php";

class objJqueryadmingrupo extends fbaseJqueryadmingrupo {
// <editor-fold defaultstate="collapsed" desc="Relacoes Inversas">    
    /**
    * Relacao jqueryadmingrupo2menu.jqueryadmingrupo -> jqueryadmingrupo.cod
    * @return objJqueryadmingrupo2menu[]
    */
    /*public function obtemJqueryadmingrupo2menuRel ($orderByField = "", $orderByOrientation = "", $limit = "") {
        $orderBy = new dataOrder($orderByField, $orderByOrientation);
        $where = new dataFilter("jqueryadmingrupo2menu.jqueryadmingrupo", $this->getCod());
        $dados = dbJqueryadmingrupo2menu::ObjsList($this->Conexao, $where, $orderBy, $limit);
        return $dados;
    }*/

    /**
    * Relacao jqueryadminuser.grupo -> jqueryadmingrupo.cod
    * @return objJqueryadminuser[]
    */
    /*public function obtemJqueryadminuserRel ($orderByField = "", $orderByOrientation = "", $limit = "") {
        $orderBy = new dataOrder($orderByField, $orderByOrientation);
        $where = new dataFilter("jqueryadminuser.grupo", $this->getCod());
        $dados = dbJqueryadminuser::ObjsList($this->Conexao, $where, $orderBy, $limit);
        return $dados;
    }*/


// </editor-fold>

    /*public function getRewriteUrl($fullUrl = false) {
        $cod = $this->getCod();
        $titulo = toRewriteString($this->getTitulo());

        $link = "jqueryadmingrupo/$titulo/$cod/";

        $lang = internacionalizacao::getCurrentLang();
        if ($lang != "pt-br") {
            $url = $lang . "/" . $url;
        }
        
        if ($fullUrl)
            return ___siteUrl . $link;
        else
            return "/" . $link;
    }*/
   
}
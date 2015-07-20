<?php

require_once "base/fbaseEresultado.php";

class objEresultado extends fbaseEresultado {
// <editor-fold defaultstate="collapsed" desc="Relacoes Inversas">    
    /**
    * Relacao ealternativaresultado.resultado -> eresultado.cod
    * @return objEalternativaresultado[]
    */
    /*public function obtemEalternativaresultadoRel ($orderByField = "", $orderByOrientation = "", $limit = "") {
        $orderBy = new dataOrder($orderByField, $orderByOrientation);
        $where = new dataFilter("ealternativaresultado.resultado", $this->getCod());
        $dados = dbEalternativaresultado::ObjsList($this->Conexao, $where, $orderBy, $limit);
        return $dados;
    }*/


// </editor-fold>

    /*public function getRewriteUrl($fullUrl = false) {
        $cod = $this->getCod();
        $titulo = toRewriteString($this->getTitulo());

        $link = "eresultado/$titulo/$cod/";

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
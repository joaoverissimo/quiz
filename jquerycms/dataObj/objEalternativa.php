<?php

require_once "base/fbaseEalternativa.php";

class objEalternativa extends fbaseEalternativa {
// <editor-fold defaultstate="collapsed" desc="Relacoes Inversas">    
    /**
    * Relacao ealternativaresultado.alternativa -> ealternativa.cod
    * @return objEalternativaresultado[]
    */
    /*public function obtemEalternativaresultadoRel ($orderByField = "", $orderByOrientation = "", $limit = "") {
        $orderBy = new dataOrder($orderByField, $orderByOrientation);
        $where = new dataFilter("ealternativaresultado.alternativa", $this->getCod());
        $dados = dbEalternativaresultado::ObjsList($this->Conexao, $where, $orderBy, $limit);
        return $dados;
    }*/


// </editor-fold>

    /*public function getRewriteUrl($fullUrl = false) {
        $cod = $this->getCod();
        $titulo = toRewriteString($this->getTitulo());

        $link = "ealternativa/$titulo/$cod/";

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
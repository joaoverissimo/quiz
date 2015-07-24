<?php

require_once "base/fbaseEpubliquev1.php";

class objEpubliquev1 extends fbaseEpubliquev1 {
// <editor-fold defaultstate="collapsed" desc="Relacoes Inversas">    

// </editor-fold>

    /*public function getRewriteUrl($fullUrl = false) {
        $cod = $this->getCod();
        $titulo = toRewriteString($this->getTitulo());

        $link = "epubliquev1/$titulo/$cod/";

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
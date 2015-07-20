<?php

require_once "base/fbaseEpergunta.php";

class objEpergunta extends fbaseEpergunta {

// <editor-fold defaultstate="collapsed" desc="Relacoes Inversas">    
    /**
     * Relacao ealternativa.pergunta -> epergunta.cod
     * @return objEalternativa[]
     */
    public function obtemEalternativaRel($orderByField = "", $orderByOrientation = "", $limit = "") {
        $orderBy = new dataOrder(dbEalternativa::_ordem, "ASC");
        $where = new dataFilter("ealternativa.pergunta", $this->getCod());
        $dados = dbEalternativa::ObjsList($this->Conexao, $where, $orderBy, $limit);
        return $dados;
    }

    /**
     * Relacao ealternativaresultado.pergunta -> epergunta.cod
     * @return objEalternativaresultado[]
     */
    /* public function obtemEalternativaresultadoRel ($orderByField = "", $orderByOrientation = "", $limit = "") {
      $orderBy = new dataOrder($orderByField, $orderByOrientation);
      $where = new dataFilter("ealternativaresultado.pergunta", $this->getCod());
      $dados = dbEalternativaresultado::ObjsList($this->Conexao, $where, $orderBy, $limit);
      return $dados;
      } */


// </editor-fold>

    /* public function getRewriteUrl($fullUrl = false) {
      $cod = $this->getCod();
      $titulo = toRewriteString($this->getTitulo());

      $link = "epergunta/$titulo/$cod/";

      $lang = internacionalizacao::getCurrentLang();
      if ($lang != "pt-br") {
      $url = $lang . "/" . $url;
      }

      if ($fullUrl)
      return ___siteUrl . $link;
      else
      return "/" . $link;
      } */
}

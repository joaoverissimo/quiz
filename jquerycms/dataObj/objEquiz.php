<?php

require_once "base/fbaseEquiz.php";

class objEquiz extends fbaseEquiz {
// <editor-fold defaultstate="collapsed" desc="Relacoes Inversas">    
    /**
     * Relacao ealternativa.quiz -> equiz.cod
     * @return objEalternativa[]
     */
    /* public function obtemEalternativaRel ($orderByField = "", $orderByOrientation = "", $limit = "") {
      $orderBy = new dataOrder($orderByField, $orderByOrientation);
      $where = new dataFilter("ealternativa.quiz", $this->getCod());
      $dados = dbEalternativa::ObjsList($this->Conexao, $where, $orderBy, $limit);
      return $dados;
      } */

    /**
     * Relacao ealternativaresultado.quiz -> equiz.cod
     * @return objEalternativaresultado[]
     */
    /* public function obtemEalternativaresultadoRel ($orderByField = "", $orderByOrientation = "", $limit = "") {
      $orderBy = new dataOrder($orderByField, $orderByOrientation);
      $where = new dataFilter("ealternativaresultado.quiz", $this->getCod());
      $dados = dbEalternativaresultado::ObjsList($this->Conexao, $where, $orderBy, $limit);
      return $dados;
      } */

    /**
     * Relacao epergunta.quiz -> equiz.cod
     * @return objEpergunta[]
     */
    public function obtemEperguntaRel($orderByField = "", $orderByOrientation = "", $limit = "") {
        $orderBy = new dataOrder(dbEpergunta::_ordem, "ASC");
        $where = new dataFilter("epergunta.quiz", $this->getCod());
        $dados = dbEpergunta::ObjsList($this->Conexao, $where, $orderBy, $limit);
        return $dados;
    }

    /**
     * Relacao eresultado.quiz -> equiz.cod
     * @return objEresultado[]
     */
    /* public function obtemEresultadoRel ($orderByField = "", $orderByOrientation = "", $limit = "") {
      $orderBy = new dataOrder($orderByField, $orderByOrientation);
      $where = new dataFilter("eresultado.quiz", $this->getCod());
      $dados = dbEresultado::ObjsList($this->Conexao, $where, $orderBy, $limit);
      return $dados;
      } */


// </editor-fold>

    public function getRewriteUrl($fullUrl = false) {
        $cod = $this->getCod();
        $titulo = toRewriteString($this->getTitulo());

        $link = "quiz/$titulo/$cod.html";

        $lang = internacionalizacao::getCurrentLang();
        if ($lang != "pt-br") {
            $url = $lang . "/" . $url;
        }

        if ($fullUrl) {
            return ___siteUrl . $link;
        } else {
            return "/" . $link;
        }
    }

    public function getRewriteUrlResultado($fullUrl = false) {
        $cod = $this->getCod();
        $titulo = toRewriteString($this->getTitulo());

        $link = "quiz/$titulo/$cod-resultado.html";

        $lang = internacionalizacao::getCurrentLang();
        if ($lang != "pt-br") {
            $url = $lang . "/" . $url;
        }

        if ($fullUrl) {
            return ___siteUrl . $link;
        } else {
            return "/" . $link;
        }
    }

}

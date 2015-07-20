<?php

require_once "base/dbaseEalternativaresultado.php";

class dbEalternativaresultado extends dbaseEalternativaresultado {

// <editor-fold defaultstate="collapsed" desc="Inserir, Update, Deletar">       
    public static function Inserir($Conexao, $quiz, $pergunta, $alternativa, $resultado, $die = false) {
        if ($pergunta === null) {
            $objAlternativa = objEalternativa::init($alternativa);
            $pergunta = $objAlternativa->getPergunta();
        }

        return parent::Inserir($Conexao, $quiz, $pergunta, $alternativa, $resultado, $die);
    }

    public static function Update($Conexao, $cod, $quiz, $pergunta, $alternativa, $resultado, $die = false) {

        return parent::Update($Conexao, $cod, $quiz, $pergunta, $alternativa, $resultado, $die);
    }

    public static function Deletar($Conexao, $cod) {
        /* $obj = new objEalternativaresultado($Conexao);
          $obj->loadByCod($cod);

          $exec = parent::Deletar($Conexao, $cod);

          //$obj->objResultado()->Delete();
          //$obj->objAlternativa()->Delete();
          //$obj->objPergunta()->Delete();
          //$obj->objQuiz()->Delete();

          return $exec;
         */

        return parent::Deletar($Conexao, $cod);
    }

// </editor-fold>
}

<?php

class dbaseEalternativaresultado {
    
    const tabela = "ealternativaresultado";
    const primaryKey = "cod";
    
    const _cod = "ealternativaresultado.cod";
    const _quiz = "ealternativaresultado.quiz";
    const _pergunta = "ealternativaresultado.pergunta";
    const _alternativa = "ealternativaresultado.alternativa";
    const _resultado = "ealternativaresultado.resultado";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'ealternativaresultado', $campo, $valor);
        $dados = dbEalternativaresultado::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("ealternativaresultado.$campo", $valor);
        $dados = dbEalternativaresultado::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbEalternativaresultado::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from ealternativaresultado";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $quiz, $pergunta, $alternativa, $resultado) {
        try {
            $sql = "INSERT INTO `ealternativaresultado`
                    (`quiz`, `pergunta`, `alternativa`, `resultado`)
                    VALUES
                    (:quiz, :pergunta, :alternativa, :resultado)";

            $statement = $Conexao->prepare($sql);

            //$quiz - allow db null: NO 
             if (!isset($quiz) && 'YES' == 'NO') 
                 $statement->bindValue(":quiz", null); 
            elseif (!isset($quiz)) 
                 $statement->bindValue(":quiz", "");
            else 
                 $statement->bindValue(":quiz", $quiz);

            //$pergunta - allow db null: NO 
             if (!isset($pergunta) && 'YES' == 'NO') 
                 $statement->bindValue(":pergunta", null); 
            elseif (!isset($pergunta)) 
                 $statement->bindValue(":pergunta", "");
            else 
                 $statement->bindValue(":pergunta", $pergunta);

            //$alternativa - allow db null: NO 
             if (!isset($alternativa) && 'YES' == 'NO') 
                 $statement->bindValue(":alternativa", null); 
            elseif (!isset($alternativa)) 
                 $statement->bindValue(":alternativa", "");
            else 
                 $statement->bindValue(":alternativa", $alternativa);

            //$resultado - allow db null: NO 
             if (!isset($resultado) && 'YES' == 'NO') 
                 $statement->bindValue(":resultado", null); 
            elseif (!isset($resultado)) 
                 $statement->bindValue(":resultado", "");
            else 
                 $statement->bindValue(":resultado", $resultado);

            

            $retorno = $statement->execute();

            if ($retorno && ($statement->rowCount() == 1))
                return $Conexao->lastInsertid(); 
            else {
                $erroInfo = $statement->errorInfo();
                if (isset($erroInfo[2])) {
                    throw new jquerycmsException("Problema para inserir. {$erroInfo[2]}. ");
                } else {
                    throw new jquerycmsException("Problema para inserir. O registro nao foi inserido, será necessario debugar o codigo. ");
                }
            }

        } catch (Exception $exc) {
            throw new jquerycmsException("Problema para inserir. {$exc->getMessage()}. ");
        }
    }

    public static function Update($Conexao, $cod, $quiz, $pergunta, $alternativa, $resultado) {
        try {
            $sql = "UPDATE `ealternativaresultado` SET
                   `quiz` = :quiz,
                    `pergunta` = :pergunta,
                    `alternativa` = :alternativa,
                    `resultado` = :resultado

                   WHERE  `cod` = :cod;";

            $statement = $Conexao->prepare($sql);

            //$cod - allow db null: NO 
             if (!isset($cod) && 'YES' == 'NO') 
                 $statement->bindValue(":cod", null); 
            elseif (!isset($cod)) 
                 $statement->bindValue(":cod", "");
            else 
                 $statement->bindValue(":cod", $cod);

            //$quiz - allow db null: NO 
             if (!isset($quiz) && 'YES' == 'NO') 
                 $statement->bindValue(":quiz", null); 
            elseif (!isset($quiz)) 
                 $statement->bindValue(":quiz", "");
            else 
                 $statement->bindValue(":quiz", $quiz);

            //$pergunta - allow db null: NO 
             if (!isset($pergunta) && 'YES' == 'NO') 
                 $statement->bindValue(":pergunta", null); 
            elseif (!isset($pergunta)) 
                 $statement->bindValue(":pergunta", "");
            else 
                 $statement->bindValue(":pergunta", $pergunta);

            //$alternativa - allow db null: NO 
             if (!isset($alternativa) && 'YES' == 'NO') 
                 $statement->bindValue(":alternativa", null); 
            elseif (!isset($alternativa)) 
                 $statement->bindValue(":alternativa", "");
            else 
                 $statement->bindValue(":alternativa", $alternativa);

            //$resultado - allow db null: NO 
             if (!isset($resultado) && 'YES' == 'NO') 
                 $statement->bindValue(":resultado", null); 
            elseif (!isset($resultado)) 
                 $statement->bindValue(":resultado", "");
            else 
                 $statement->bindValue(":resultado", $resultado);

            

            $retorno = $statement->execute();
            
            if ($retorno)
                return true;
            else {
                $erroInfo = $statement->errorInfo();
                if (isset($erroInfo[2])) {
                    throw new jquerycmsException("Problema para update. {$erroInfo[2]}. ");
                } else {
                    throw new jquerycmsException("Problema para update. O registro nao foi editado, será necessario debugar o codigo. ");
                }
            }

        } catch (Exception $exc) {
            throw new jquerycmsException("Problema para update. {$exc->getMessage()} ");
        }
    }

    public static function Deletar($Conexao, $cod) {
        return dataDeletar($Conexao, "ealternativaresultado", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbEalternativaresultado::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbEalternativaresultado::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("ealternativaresultado.cod, ealternativaresultado.quiz, ealternativaresultado.pergunta, ealternativaresultado.alternativa, ealternativaresultado.resultado");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("ealternativaresultado.cod, ealternativaresultado.quiz, ealternativaresultado.pergunta, ealternativaresultado.alternativa, ealternativaresultado.resultado");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'ealternativaresultado', $where, $orderBy, $limit);
        $dados = dbEalternativaresultado::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("ealternativaresultado.cod, ealternativaresultado.quiz, ealternativaresultado.pergunta, ealternativaresultado.alternativa, ealternativaresultado.resultado , quiz_rel.cod , quiz_rel.usuario , quiz_rel.seo , quiz_rel.titulo , quiz_rel.data , quiz_rel.imagem , quiz_rel.flaprovado , pergunta_rel.cod , pergunta_rel.quiz , pergunta_rel.descricao , pergunta_rel.imagem , pergunta_rel.ordem , alternativa_rel.cod , alternativa_rel.quiz , alternativa_rel.pergunta , alternativa_rel.descricao , alternativa_rel.imagem , alternativa_rel.ordem , resultado_rel.cod , resultado_rel.quiz , resultado_rel.descricao , resultado_rel.texto , resultado_rel.imagem ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("ealternativaresultado.cod, ealternativaresultado.quiz, ealternativaresultado.pergunta, ealternativaresultado.alternativa, ealternativaresultado.resultado , quiz_rel.cod , quiz_rel.usuario , quiz_rel.seo , quiz_rel.titulo , quiz_rel.data , quiz_rel.imagem , quiz_rel.flaprovado , pergunta_rel.cod , pergunta_rel.quiz , pergunta_rel.descricao , pergunta_rel.imagem , pergunta_rel.ordem , alternativa_rel.cod , alternativa_rel.quiz , alternativa_rel.pergunta , alternativa_rel.descricao , alternativa_rel.imagem , alternativa_rel.ordem , resultado_rel.cod , resultado_rel.quiz , resultado_rel.descricao , resultado_rel.texto , resultado_rel.imagem ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "ealternativaresultado.* ,
                 quiz_rel.cod as quiz_cod,
                 quiz_rel.usuario as quiz_usuario,
                 quiz_rel.seo as quiz_seo,
                 quiz_rel.titulo as quiz_titulo,
                 quiz_rel.data as quiz_data,
                 quiz_rel.imagem as quiz_imagem,
                 quiz_rel.flaprovado as quiz_flaprovado ,
                 pergunta_rel.cod as pergunta_cod,
                 pergunta_rel.quiz as pergunta_quiz,
                 pergunta_rel.descricao as pergunta_descricao,
                 pergunta_rel.imagem as pergunta_imagem,
                 pergunta_rel.ordem as pergunta_ordem ,
                 alternativa_rel.cod as alternativa_cod,
                 alternativa_rel.quiz as alternativa_quiz,
                 alternativa_rel.pergunta as alternativa_pergunta,
                 alternativa_rel.descricao as alternativa_descricao,
                 alternativa_rel.imagem as alternativa_imagem,
                 alternativa_rel.ordem as alternativa_ordem ,
                 resultado_rel.cod as resultado_cod,
                 resultado_rel.quiz as resultado_quiz,
                 resultado_rel.descricao as resultado_descricao,
                 resultado_rel.texto as resultado_texto,
                 resultado_rel.imagem as resultado_imagem  ";
        
        $leftjoin = "LEFT JOIN equiz quiz_rel ON ealternativaresultado.quiz = quiz_rel.cod 
                LEFT JOIN epergunta pergunta_rel ON ealternativaresultado.pergunta = pergunta_rel.cod 
                LEFT JOIN ealternativa alternativa_rel ON ealternativaresultado.alternativa = alternativa_rel.cod 
                LEFT JOIN eresultado resultado_rel ON ealternativaresultado.resultado = resultado_rel.cod 
                ";
            
        $dados = dataListar($Conexao, 'ealternativaresultado', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbEalternativaresultado::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objEalternativaresultado[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbEalternativaresultado::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objEalternativaresultado($Conexao);
                $obj->loadByArray($registro);

                $objs[] = $obj;
            }
        }

        if (issetArray($objs)) {
            return $objs;
        } else {
            return false;
        }
    }
    
    /**
     * @return objEalternativaresultado[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbEalternativaresultado::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objEalternativaresultado($Conexao);
                $obj->loadLeftByArray($registro);

                $objs[] = $obj;
            }
        }

        if (issetArray($objs)) {
            return $objs;
        } else {
            return false;
        }
    }

    public static function template($ObjsList, $filename, $filefolder = '') {
        if ($filefolder == '')
            $filefolder = ___AppRoot . "adm/ealternativaresultado/templates/";

        if (!arquivos::existe($filefolder . $filename)) {
            return "Arquivo <b>$filefolder/$filename</b> nao existe.";
        }
            
        $str = arquivos::ler($filefolder . $filename);
        if (!$str) {
            return "";
        } elseif (!str_contains($str, "<repeat>")) {
            throw new jquerycmsException("$filefolder/$filename nao contem <repeat>");
        }
        
        if (!issetArray($ObjsList)) {
            return $str;
        }

        
        $repeats = explode("<repeat>", $str);
        $retorno = "";
        foreach ($repeats as $block) {
            $posJqueryBlock = strpos($block, "</repeat>");
            if ($posJqueryBlock === false)
                $retorno .= internacionalizacao::TraduzirString($block);
            else {
                $subblock = explode("</repeat>", $block);
                if (isset($subblock[0])) {
                    foreach ($ObjsList as $obj) {
                        if ($obj instanceof objEalternativaresultado) {                        
                            $retorno .= $obj->getHtmlTemplateString($subblock[0]);
                        }
                    }
                }
                if (isset($subblock[1]))
                    $retorno .= internacionalizacao::TraduzirString($subblock[1]);
            }
        }

        return $retorno;
    }
            
    private static function CorrigeValoresSimples($dados) {
        
        return $dados;
    }
    
    private static function CorrigeValoresSimplesAll($dados) {
        if ((! isset($dados)) || (!is_array($dados)))
            return ""; 
        
        foreach ($dados as $key => $value) {
            
        }
        
        return $dados;
    }
}
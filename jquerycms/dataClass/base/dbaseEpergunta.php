<?php

class dbaseEpergunta {
    
    const tabela = "epergunta";
    const primaryKey = "cod";
    
    const _cod = "epergunta.cod";
    const _quiz = "epergunta.quiz";
    const _descricao = "epergunta.descricao";
    const _imagem = "epergunta.imagem";
    const _ordem = "epergunta.ordem";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'epergunta', $campo, $valor);
        $dados = dbEpergunta::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("epergunta.$campo", $valor);
        $dados = dbEpergunta::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbEpergunta::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from epergunta";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $quiz, $descricao, $imagem, $ordem) {
        try {
            $sql = "INSERT INTO `epergunta`
                    (`quiz`, `descricao`, `imagem`, `ordem`)
                    VALUES
                    (:quiz, :descricao, :imagem, :ordem)";

            $statement = $Conexao->prepare($sql);

            //$quiz - allow db null: NO 
             if (!isset($quiz) && 'YES' == 'NO') 
                 $statement->bindValue(":quiz", null); 
            elseif (!isset($quiz)) 
                 $statement->bindValue(":quiz", "");
            else 
                 $statement->bindValue(":quiz", $quiz);

            //$descricao - allow db null: NO 
             if (!isset($descricao) && 'YES' == 'NO') 
                 $statement->bindValue(":descricao", null); 
            elseif (!isset($descricao)) 
                 $statement->bindValue(":descricao", "");
            else 
                 $statement->bindValue(":descricao", $descricao);

            //$imagem - allow db null: YES 
             if (!isset($imagem) && 'YES' == 'YES') 
                 $statement->bindValue(":imagem", null); 
            elseif (!isset($imagem)) 
                 $statement->bindValue(":imagem", "");
            else 
                 $statement->bindValue(":imagem", $imagem);

            //$ordem - allow db null: NO 
             if (!isset($ordem) && 'YES' == 'NO') 
                 $statement->bindValue(":ordem", null); 
            elseif (!isset($ordem)) 
                 $statement->bindValue(":ordem", "");
            else 
                 $statement->bindValue(":ordem", $ordem);

            

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

    public static function Update($Conexao, $cod, $quiz, $descricao, $imagem, $ordem) {
        try {
            $sql = "UPDATE `epergunta` SET
                   `quiz` = :quiz,
                    `descricao` = :descricao,
                    `imagem` = :imagem,
                    `ordem` = :ordem

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

            //$descricao - allow db null: NO 
             if (!isset($descricao) && 'YES' == 'NO') 
                 $statement->bindValue(":descricao", null); 
            elseif (!isset($descricao)) 
                 $statement->bindValue(":descricao", "");
            else 
                 $statement->bindValue(":descricao", $descricao);

            //$imagem - allow db null: YES 
             if (!isset($imagem) && 'YES' == 'YES') 
                 $statement->bindValue(":imagem", null); 
            elseif (!isset($imagem)) 
                 $statement->bindValue(":imagem", "");
            else 
                 $statement->bindValue(":imagem", $imagem);

            //$ordem - allow db null: NO 
             if (!isset($ordem) && 'YES' == 'NO') 
                 $statement->bindValue(":ordem", null); 
            elseif (!isset($ordem)) 
                 $statement->bindValue(":ordem", "");
            else 
                 $statement->bindValue(":ordem", $ordem);

            

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
        return dataDeletar($Conexao, "epergunta", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbEpergunta::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbEpergunta::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("epergunta.cod, epergunta.quiz, epergunta.descricao, epergunta.imagem, epergunta.ordem");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("epergunta.cod, epergunta.quiz, epergunta.descricao, epergunta.imagem, epergunta.ordem");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'epergunta', $where, $orderBy, $limit);
        $dados = dbEpergunta::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("epergunta.cod, epergunta.quiz, epergunta.descricao, epergunta.imagem, epergunta.ordem , quiz_rel.cod , quiz_rel.usuario , quiz_rel.seo , quiz_rel.titulo , quiz_rel.data , quiz_rel.imagem , quiz_rel.flaprovado , imagem_rel.cod , imagem_rel.valor ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("epergunta.cod, epergunta.quiz, epergunta.descricao, epergunta.imagem, epergunta.ordem , quiz_rel.cod , quiz_rel.usuario , quiz_rel.seo , quiz_rel.titulo , quiz_rel.data , quiz_rel.imagem , quiz_rel.flaprovado , imagem_rel.cod , imagem_rel.valor ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "epergunta.* ,
                 quiz_rel.cod as quiz_cod,
                 quiz_rel.usuario as quiz_usuario,
                 quiz_rel.seo as quiz_seo,
                 quiz_rel.titulo as quiz_titulo,
                 quiz_rel.data as quiz_data,
                 quiz_rel.imagem as quiz_imagem,
                 quiz_rel.flaprovado as quiz_flaprovado ,
                 imagem_rel.cod as imagem_cod,
                 imagem_rel.valor as imagem_valor  ";
        
        $leftjoin = "LEFT JOIN equiz quiz_rel ON epergunta.quiz = quiz_rel.cod 
                LEFT JOIN jqueryimage imagem_rel ON epergunta.imagem = imagem_rel.cod 
                ";
            
        $dados = dataListar($Conexao, 'epergunta', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbEpergunta::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objEpergunta[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbEpergunta::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objEpergunta($Conexao);
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
     * @return objEpergunta[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbEpergunta::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objEpergunta($Conexao);
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
            $filefolder = ___AppRoot . "adm/epergunta/templates/";

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
                        if ($obj instanceof objEpergunta) {                        
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
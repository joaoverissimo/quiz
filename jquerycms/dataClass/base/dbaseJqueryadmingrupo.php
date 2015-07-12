<?php

class dbaseJqueryadmingrupo {
    
    const tabela = "jqueryadmingrupo";
    const primaryKey = "cod";
    
    const _cod = "jqueryadmingrupo.cod";
    const _titulo = "jqueryadmingrupo.titulo";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'jqueryadmingrupo', $campo, $valor);
        $dados = dbJqueryadmingrupo::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("jqueryadmingrupo.$campo", $valor);
        $dados = dbJqueryadmingrupo::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbJqueryadmingrupo::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from jqueryadmingrupo";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $titulo) {
        try {
            $sql = "INSERT INTO `jqueryadmingrupo`
                    (`titulo`)
                    VALUES
                    (:titulo)";

            $statement = $Conexao->prepare($sql);

            //$titulo - allow db null: NO 
             if (!isset($titulo) && 'YES' == 'NO') 
                 $statement->bindValue(":titulo", null); 
            elseif (!isset($titulo)) 
                 $statement->bindValue(":titulo", "");
            else 
                 $statement->bindValue(":titulo", $titulo);

            

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

    public static function Update($Conexao, $cod, $titulo) {
        try {
            $sql = "UPDATE `jqueryadmingrupo` SET
                   `titulo` = :titulo

                   WHERE  `cod` = :cod;";

            $statement = $Conexao->prepare($sql);

            //$cod - allow db null: NO 
             if (!isset($cod) && 'YES' == 'NO') 
                 $statement->bindValue(":cod", null); 
            elseif (!isset($cod)) 
                 $statement->bindValue(":cod", "");
            else 
                 $statement->bindValue(":cod", $cod);

            //$titulo - allow db null: NO 
             if (!isset($titulo) && 'YES' == 'NO') 
                 $statement->bindValue(":titulo", null); 
            elseif (!isset($titulo)) 
                 $statement->bindValue(":titulo", "");
            else 
                 $statement->bindValue(":titulo", $titulo);

            

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
        return dataDeletar($Conexao, "jqueryadmingrupo", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbJqueryadmingrupo::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbJqueryadmingrupo::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryadmingrupo.cod, jqueryadmingrupo.titulo");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryadmingrupo.cod, jqueryadmingrupo.titulo");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'jqueryadmingrupo', $where, $orderBy, $limit);
        $dados = dbJqueryadmingrupo::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryadmingrupo.cod, jqueryadmingrupo.titulo ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryadmingrupo.cod, jqueryadmingrupo.titulo ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "jqueryadmingrupo.*  ";
        
        $leftjoin = "";
            
        $dados = dataListar($Conexao, 'jqueryadmingrupo', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbJqueryadmingrupo::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objJqueryadmingrupo[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryadmingrupo::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryadmingrupo($Conexao);
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
     * @return objJqueryadmingrupo[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryadmingrupo::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryadmingrupo($Conexao);
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
            $filefolder = ___AppRoot . "adm/jqueryadmingrupo/templates/";

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
                        if ($obj instanceof objJqueryadmingrupo) {                        
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
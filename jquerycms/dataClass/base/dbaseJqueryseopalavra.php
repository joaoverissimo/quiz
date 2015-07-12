<?php

class dbaseJqueryseopalavra {
    
    const tabela = "jqueryseopalavra";
    const primaryKey = "cod";
    
    const _cod = "jqueryseopalavra.cod";
    const _palavra = "jqueryseopalavra.palavra";
    const _url = "jqueryseopalavra.url";
    const _count = "jqueryseopalavra.count";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'jqueryseopalavra', $campo, $valor);
        $dados = dbJqueryseopalavra::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("jqueryseopalavra.$campo", $valor);
        $dados = dbJqueryseopalavra::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbJqueryseopalavra::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from jqueryseopalavra";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $palavra, $url, $count) {
        try {
            $sql = "INSERT INTO `jqueryseopalavra`
                    (`palavra`, `url`, `count`)
                    VALUES
                    (:palavra, :url, :count)";

            $statement = $Conexao->prepare($sql);

            //$palavra - allow db null: NO 
             if (!isset($palavra) && 'YES' == 'NO') 
                 $statement->bindValue(":palavra", null); 
            elseif (!isset($palavra)) 
                 $statement->bindValue(":palavra", "");
            else 
                 $statement->bindValue(":palavra", $palavra);

            //$url - allow db null: NO 
             if (!isset($url) && 'YES' == 'NO') 
                 $statement->bindValue(":url", null); 
            elseif (!isset($url)) 
                 $statement->bindValue(":url", "");
            else 
                 $statement->bindValue(":url", $url);

            //$count - allow db null: NO 
             if (!isset($count) && 'YES' == 'NO') 
                 $statement->bindValue(":count", null); 
            elseif (!isset($count)) 
                 $statement->bindValue(":count", "");
            else 
                 $statement->bindValue(":count", $count);

            

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

    public static function Update($Conexao, $cod, $palavra, $url, $count) {
        try {
            $sql = "UPDATE `jqueryseopalavra` SET
                   `palavra` = :palavra,
                    `url` = :url,
                    `count` = :count

                   WHERE  `cod` = :cod;";

            $statement = $Conexao->prepare($sql);

            //$cod - allow db null: NO 
             if (!isset($cod) && 'YES' == 'NO') 
                 $statement->bindValue(":cod", null); 
            elseif (!isset($cod)) 
                 $statement->bindValue(":cod", "");
            else 
                 $statement->bindValue(":cod", $cod);

            //$palavra - allow db null: NO 
             if (!isset($palavra) && 'YES' == 'NO') 
                 $statement->bindValue(":palavra", null); 
            elseif (!isset($palavra)) 
                 $statement->bindValue(":palavra", "");
            else 
                 $statement->bindValue(":palavra", $palavra);

            //$url - allow db null: NO 
             if (!isset($url) && 'YES' == 'NO') 
                 $statement->bindValue(":url", null); 
            elseif (!isset($url)) 
                 $statement->bindValue(":url", "");
            else 
                 $statement->bindValue(":url", $url);

            //$count - allow db null: NO 
             if (!isset($count) && 'YES' == 'NO') 
                 $statement->bindValue(":count", null); 
            elseif (!isset($count)) 
                 $statement->bindValue(":count", "");
            else 
                 $statement->bindValue(":count", $count);

            

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
        return dataDeletar($Conexao, "jqueryseopalavra", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbJqueryseopalavra::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbJqueryseopalavra::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryseopalavra.cod, jqueryseopalavra.palavra, jqueryseopalavra.url, jqueryseopalavra.count");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryseopalavra.cod, jqueryseopalavra.palavra, jqueryseopalavra.url, jqueryseopalavra.count");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'jqueryseopalavra', $where, $orderBy, $limit);
        $dados = dbJqueryseopalavra::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryseopalavra.cod, jqueryseopalavra.palavra, jqueryseopalavra.url, jqueryseopalavra.count ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryseopalavra.cod, jqueryseopalavra.palavra, jqueryseopalavra.url, jqueryseopalavra.count ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "jqueryseopalavra.*  ";
        
        $leftjoin = "";
            
        $dados = dataListar($Conexao, 'jqueryseopalavra', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbJqueryseopalavra::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objJqueryseopalavra[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryseopalavra::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryseopalavra($Conexao);
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
     * @return objJqueryseopalavra[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryseopalavra::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryseopalavra($Conexao);
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
            $filefolder = ___AppRoot . "adm/jqueryseopalavra/templates/";

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
                        if ($obj instanceof objJqueryseopalavra) {                        
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
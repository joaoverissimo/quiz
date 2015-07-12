<?php

class dbaseJqueryseorel {
    
    const tabela = "jqueryseorel";
    const primaryKey = "cod";
    
    const _cod = "jqueryseorel.cod";
    const _seo = "jqueryseorel.seo";
    const _palavra = "jqueryseorel.palavra";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'jqueryseorel', $campo, $valor);
        $dados = dbJqueryseorel::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("jqueryseorel.$campo", $valor);
        $dados = dbJqueryseorel::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbJqueryseorel::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from jqueryseorel";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $seo, $palavra) {
        try {
            $sql = "INSERT INTO `jqueryseorel`
                    (`seo`, `palavra`)
                    VALUES
                    (:seo, :palavra)";

            $statement = $Conexao->prepare($sql);

            //$seo - allow db null: NO 
             if (!isset($seo) && 'YES' == 'NO') 
                 $statement->bindValue(":seo", null); 
            elseif (!isset($seo)) 
                 $statement->bindValue(":seo", "");
            else 
                 $statement->bindValue(":seo", $seo);

            //$palavra - allow db null: NO 
             if (!isset($palavra) && 'YES' == 'NO') 
                 $statement->bindValue(":palavra", null); 
            elseif (!isset($palavra)) 
                 $statement->bindValue(":palavra", "");
            else 
                 $statement->bindValue(":palavra", $palavra);

            

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

    public static function Update($Conexao, $cod, $seo, $palavra) {
        try {
            $sql = "UPDATE `jqueryseorel` SET
                   `seo` = :seo,
                    `palavra` = :palavra

                   WHERE  `cod` = :cod;";

            $statement = $Conexao->prepare($sql);

            //$cod - allow db null: NO 
             if (!isset($cod) && 'YES' == 'NO') 
                 $statement->bindValue(":cod", null); 
            elseif (!isset($cod)) 
                 $statement->bindValue(":cod", "");
            else 
                 $statement->bindValue(":cod", $cod);

            //$seo - allow db null: NO 
             if (!isset($seo) && 'YES' == 'NO') 
                 $statement->bindValue(":seo", null); 
            elseif (!isset($seo)) 
                 $statement->bindValue(":seo", "");
            else 
                 $statement->bindValue(":seo", $seo);

            //$palavra - allow db null: NO 
             if (!isset($palavra) && 'YES' == 'NO') 
                 $statement->bindValue(":palavra", null); 
            elseif (!isset($palavra)) 
                 $statement->bindValue(":palavra", "");
            else 
                 $statement->bindValue(":palavra", $palavra);

            

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
        return dataDeletar($Conexao, "jqueryseorel", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbJqueryseorel::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbJqueryseorel::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryseorel.cod, jqueryseorel.seo, jqueryseorel.palavra");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryseorel.cod, jqueryseorel.seo, jqueryseorel.palavra");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'jqueryseorel', $where, $orderBy, $limit);
        $dados = dbJqueryseorel::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryseorel.cod, jqueryseorel.seo, jqueryseorel.palavra , seo_rel.cod , seo_rel.titulo , seo_rel.descricao , palavra_rel.cod , palavra_rel.palavra , palavra_rel.url , palavra_rel.count ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryseorel.cod, jqueryseorel.seo, jqueryseorel.palavra , seo_rel.cod , seo_rel.titulo , seo_rel.descricao , palavra_rel.cod , palavra_rel.palavra , palavra_rel.url , palavra_rel.count ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "jqueryseorel.* ,
                 seo_rel.cod as seo_cod,
                 seo_rel.titulo as seo_titulo,
                 seo_rel.descricao as seo_descricao ,
                 palavra_rel.cod as palavra_cod,
                 palavra_rel.palavra as palavra_palavra,
                 palavra_rel.url as palavra_url,
                 palavra_rel.count as palavra_count  ";
        
        $leftjoin = "LEFT JOIN jqueryseo seo_rel ON jqueryseorel.seo = seo_rel.cod 
                LEFT JOIN jqueryseopalavra palavra_rel ON jqueryseorel.palavra = palavra_rel.cod 
                ";
            
        $dados = dataListar($Conexao, 'jqueryseorel', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbJqueryseorel::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objJqueryseorel[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryseorel::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryseorel($Conexao);
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
     * @return objJqueryseorel[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryseorel::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryseorel($Conexao);
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
            $filefolder = ___AppRoot . "adm/jqueryseorel/templates/";

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
                        if ($obj instanceof objJqueryseorel) {                        
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
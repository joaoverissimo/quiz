<?php

class dbaseJqueryseo {
    
    const tabela = "jqueryseo";
    const primaryKey = "cod";
    
    const _cod = "jqueryseo.cod";
    const _titulo = "jqueryseo.titulo";
    const _descricao = "jqueryseo.descricao";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'jqueryseo', $campo, $valor);
        $dados = dbJqueryseo::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("jqueryseo.$campo", $valor);
        $dados = dbJqueryseo::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbJqueryseo::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from jqueryseo";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $titulo, $descricao) {
        try {
            $sql = "INSERT INTO `jqueryseo`
                    (`titulo`, `descricao`)
                    VALUES
                    (:titulo, :descricao)";

            $statement = $Conexao->prepare($sql);

            //$titulo - allow db null: NO 
             if (!isset($titulo) && 'YES' == 'NO') 
                 $statement->bindValue(":titulo", null); 
            elseif (!isset($titulo)) 
                 $statement->bindValue(":titulo", "");
            else 
                 $statement->bindValue(":titulo", $titulo);

            //$descricao - allow db null: NO 
             if (!isset($descricao) && 'YES' == 'NO') 
                 $statement->bindValue(":descricao", null); 
            elseif (!isset($descricao)) 
                 $statement->bindValue(":descricao", "");
            else 
                 $statement->bindValue(":descricao", $descricao);

            

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

    public static function Update($Conexao, $cod, $titulo, $descricao) {
        try {
            $sql = "UPDATE `jqueryseo` SET
                   `titulo` = :titulo,
                    `descricao` = :descricao

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

            //$descricao - allow db null: NO 
             if (!isset($descricao) && 'YES' == 'NO') 
                 $statement->bindValue(":descricao", null); 
            elseif (!isset($descricao)) 
                 $statement->bindValue(":descricao", "");
            else 
                 $statement->bindValue(":descricao", $descricao);

            

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
        return dataDeletar($Conexao, "jqueryseo", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbJqueryseo::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbJqueryseo::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryseo.cod, jqueryseo.titulo, jqueryseo.descricao");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryseo.cod, jqueryseo.titulo, jqueryseo.descricao");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'jqueryseo', $where, $orderBy, $limit);
        $dados = dbJqueryseo::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryseo.cod, jqueryseo.titulo, jqueryseo.descricao ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryseo.cod, jqueryseo.titulo, jqueryseo.descricao ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "jqueryseo.*  ";
        
        $leftjoin = "";
            
        $dados = dataListar($Conexao, 'jqueryseo', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbJqueryseo::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objJqueryseo[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryseo::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryseo($Conexao);
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
     * @return objJqueryseo[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryseo::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryseo($Conexao);
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
            $filefolder = ___AppRoot . "adm/jqueryseo/templates/";

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
                        if ($obj instanceof objJqueryseo) {                        
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
<?php

class dbaseJqueryseotabela {
    
    const tabela = "jqueryseotabela";
    const primaryKey = "cod";
    
    const _cod = "jqueryseotabela.cod";
    const _tabela = "jqueryseotabela.tabela";
    const _titulo = "jqueryseotabela.titulo";
    const _ordem = "jqueryseotabela.ordem";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'jqueryseotabela', $campo, $valor);
        $dados = dbJqueryseotabela::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("jqueryseotabela.$campo", $valor);
        $dados = dbJqueryseotabela::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbJqueryseotabela::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from jqueryseotabela";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $tabela, $titulo, $ordem) {
        try {
            $sql = "INSERT INTO `jqueryseotabela`
                    (`tabela`, `titulo`, `ordem`)
                    VALUES
                    (:tabela, :titulo, :ordem)";

            $statement = $Conexao->prepare($sql);

            //$tabela - allow db null: NO 
             if (!isset($tabela) && 'YES' == 'NO') 
                 $statement->bindValue(":tabela", null); 
            elseif (!isset($tabela)) 
                 $statement->bindValue(":tabela", "");
            else 
                 $statement->bindValue(":tabela", $tabela);

            //$titulo - allow db null: NO 
             if (!isset($titulo) && 'YES' == 'NO') 
                 $statement->bindValue(":titulo", null); 
            elseif (!isset($titulo)) 
                 $statement->bindValue(":titulo", "");
            else 
                 $statement->bindValue(":titulo", $titulo);

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

    public static function Update($Conexao, $cod, $tabela, $titulo, $ordem) {
        try {
            $sql = "UPDATE `jqueryseotabela` SET
                   `tabela` = :tabela,
                    `titulo` = :titulo,
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

            //$tabela - allow db null: NO 
             if (!isset($tabela) && 'YES' == 'NO') 
                 $statement->bindValue(":tabela", null); 
            elseif (!isset($tabela)) 
                 $statement->bindValue(":tabela", "");
            else 
                 $statement->bindValue(":tabela", $tabela);

            //$titulo - allow db null: NO 
             if (!isset($titulo) && 'YES' == 'NO') 
                 $statement->bindValue(":titulo", null); 
            elseif (!isset($titulo)) 
                 $statement->bindValue(":titulo", "");
            else 
                 $statement->bindValue(":titulo", $titulo);

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
        return dataDeletar($Conexao, "jqueryseotabela", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbJqueryseotabela::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbJqueryseotabela::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryseotabela.cod, jqueryseotabela.tabela, jqueryseotabela.titulo, jqueryseotabela.ordem");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryseotabela.cod, jqueryseotabela.tabela, jqueryseotabela.titulo, jqueryseotabela.ordem");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'jqueryseotabela', $where, $orderBy, $limit);
        $dados = dbJqueryseotabela::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryseotabela.cod, jqueryseotabela.tabela, jqueryseotabela.titulo, jqueryseotabela.ordem ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryseotabela.cod, jqueryseotabela.tabela, jqueryseotabela.titulo, jqueryseotabela.ordem ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "jqueryseotabela.*  ";
        
        $leftjoin = "";
            
        $dados = dataListar($Conexao, 'jqueryseotabela', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbJqueryseotabela::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objJqueryseotabela[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryseotabela::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryseotabela($Conexao);
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
     * @return objJqueryseotabela[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryseotabela::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryseotabela($Conexao);
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
            $filefolder = ___AppRoot . "adm/jqueryseotabela/templates/";

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
                        if ($obj instanceof objJqueryseotabela) {                        
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
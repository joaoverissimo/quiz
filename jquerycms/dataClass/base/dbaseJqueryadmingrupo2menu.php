<?php

class dbaseJqueryadmingrupo2menu {
    
    const tabela = "jqueryadmingrupo2menu";
    const primaryKey = "cod";
    
    const _cod = "jqueryadmingrupo2menu.cod";
    const _jqueryadmingrupo = "jqueryadmingrupo2menu.jqueryadmingrupo";
    const _jqueryadminmenu = "jqueryadmingrupo2menu.jqueryadminmenu";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'jqueryadmingrupo2menu', $campo, $valor);
        $dados = dbJqueryadmingrupo2menu::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("jqueryadmingrupo2menu.$campo", $valor);
        $dados = dbJqueryadmingrupo2menu::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbJqueryadmingrupo2menu::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from jqueryadmingrupo2menu";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $jqueryadmingrupo, $jqueryadminmenu) {
        try {
            $sql = "INSERT INTO `jqueryadmingrupo2menu`
                    (`jqueryadmingrupo`, `jqueryadminmenu`)
                    VALUES
                    (:jqueryadmingrupo, :jqueryadminmenu)";

            $statement = $Conexao->prepare($sql);

            //$jqueryadmingrupo - allow db null: NO 
             if (!isset($jqueryadmingrupo) && 'YES' == 'NO') 
                 $statement->bindValue(":jqueryadmingrupo", null); 
            elseif (!isset($jqueryadmingrupo)) 
                 $statement->bindValue(":jqueryadmingrupo", "");
            else 
                 $statement->bindValue(":jqueryadmingrupo", $jqueryadmingrupo);

            //$jqueryadminmenu - allow db null: NO 
             if (!isset($jqueryadminmenu) && 'YES' == 'NO') 
                 $statement->bindValue(":jqueryadminmenu", null); 
            elseif (!isset($jqueryadminmenu)) 
                 $statement->bindValue(":jqueryadminmenu", "");
            else 
                 $statement->bindValue(":jqueryadminmenu", $jqueryadminmenu);

            

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

    public static function Update($Conexao, $cod, $jqueryadmingrupo, $jqueryadminmenu) {
        try {
            $sql = "UPDATE `jqueryadmingrupo2menu` SET
                   `jqueryadmingrupo` = :jqueryadmingrupo,
                    `jqueryadminmenu` = :jqueryadminmenu

                   WHERE  `cod` = :cod;";

            $statement = $Conexao->prepare($sql);

            //$cod - allow db null: NO 
             if (!isset($cod) && 'YES' == 'NO') 
                 $statement->bindValue(":cod", null); 
            elseif (!isset($cod)) 
                 $statement->bindValue(":cod", "");
            else 
                 $statement->bindValue(":cod", $cod);

            //$jqueryadmingrupo - allow db null: NO 
             if (!isset($jqueryadmingrupo) && 'YES' == 'NO') 
                 $statement->bindValue(":jqueryadmingrupo", null); 
            elseif (!isset($jqueryadmingrupo)) 
                 $statement->bindValue(":jqueryadmingrupo", "");
            else 
                 $statement->bindValue(":jqueryadmingrupo", $jqueryadmingrupo);

            //$jqueryadminmenu - allow db null: NO 
             if (!isset($jqueryadminmenu) && 'YES' == 'NO') 
                 $statement->bindValue(":jqueryadminmenu", null); 
            elseif (!isset($jqueryadminmenu)) 
                 $statement->bindValue(":jqueryadminmenu", "");
            else 
                 $statement->bindValue(":jqueryadminmenu", $jqueryadminmenu);

            

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
        return dataDeletar($Conexao, "jqueryadmingrupo2menu", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbJqueryadmingrupo2menu::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbJqueryadmingrupo2menu::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryadmingrupo2menu.cod, jqueryadmingrupo2menu.jqueryadmingrupo, jqueryadmingrupo2menu.jqueryadminmenu");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryadmingrupo2menu.cod, jqueryadmingrupo2menu.jqueryadmingrupo, jqueryadmingrupo2menu.jqueryadminmenu");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'jqueryadmingrupo2menu', $where, $orderBy, $limit);
        $dados = dbJqueryadmingrupo2menu::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryadmingrupo2menu.cod, jqueryadmingrupo2menu.jqueryadmingrupo, jqueryadmingrupo2menu.jqueryadminmenu , jqueryadmingrupo_rel.cod , jqueryadmingrupo_rel.titulo , jqueryadminmenu_rel.cod , jqueryadminmenu_rel.codmenu , jqueryadminmenu_rel.titulo , jqueryadminmenu_rel.patch , jqueryadminmenu_rel.icon , jqueryadminmenu_rel.addhtml , jqueryadminmenu_rel.ordem ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryadmingrupo2menu.cod, jqueryadmingrupo2menu.jqueryadmingrupo, jqueryadmingrupo2menu.jqueryadminmenu , jqueryadmingrupo_rel.cod , jqueryadmingrupo_rel.titulo , jqueryadminmenu_rel.cod , jqueryadminmenu_rel.codmenu , jqueryadminmenu_rel.titulo , jqueryadminmenu_rel.patch , jqueryadminmenu_rel.icon , jqueryadminmenu_rel.addhtml , jqueryadminmenu_rel.ordem ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "jqueryadmingrupo2menu.* ,
                 jqueryadmingrupo_rel.cod as jqueryadmingrupo_cod,
                 jqueryadmingrupo_rel.titulo as jqueryadmingrupo_titulo ,
                 jqueryadminmenu_rel.cod as jqueryadminmenu_cod,
                 jqueryadminmenu_rel.codmenu as jqueryadminmenu_codmenu,
                 jqueryadminmenu_rel.titulo as jqueryadminmenu_titulo,
                 jqueryadminmenu_rel.patch as jqueryadminmenu_patch,
                 jqueryadminmenu_rel.icon as jqueryadminmenu_icon,
                 jqueryadminmenu_rel.addhtml as jqueryadminmenu_addhtml,
                 jqueryadminmenu_rel.ordem as jqueryadminmenu_ordem  ";
        
        $leftjoin = "LEFT JOIN jqueryadmingrupo jqueryadmingrupo_rel ON jqueryadmingrupo2menu.jqueryadmingrupo = jqueryadmingrupo_rel.cod 
                LEFT JOIN jqueryadminmenu jqueryadminmenu_rel ON jqueryadmingrupo2menu.jqueryadminmenu = jqueryadminmenu_rel.cod 
                ";
            
        $dados = dataListar($Conexao, 'jqueryadmingrupo2menu', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbJqueryadmingrupo2menu::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objJqueryadmingrupo2menu[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryadmingrupo2menu::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryadmingrupo2menu($Conexao);
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
     * @return objJqueryadmingrupo2menu[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryadmingrupo2menu::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryadmingrupo2menu($Conexao);
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
            $filefolder = ___AppRoot . "adm/jqueryadmingrupo2menu/templates/";

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
                        if ($obj instanceof objJqueryadmingrupo2menu) {                        
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
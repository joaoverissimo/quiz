<?php

class dbaseJqueryadminmenu {
    
    const tabela = "jqueryadminmenu";
    const primaryKey = "cod";
    
    const _cod = "jqueryadminmenu.cod";
    const _codmenu = "jqueryadminmenu.codmenu";
    const _titulo = "jqueryadminmenu.titulo";
    const _patch = "jqueryadminmenu.patch";
    const _icon = "jqueryadminmenu.icon";
    const _addhtml = "jqueryadminmenu.addhtml";
    const _ordem = "jqueryadminmenu.ordem";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'jqueryadminmenu', $campo, $valor);
        $dados = dbJqueryadminmenu::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("jqueryadminmenu.$campo", $valor);
        $dados = dbJqueryadminmenu::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbJqueryadminmenu::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from jqueryadminmenu";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $codmenu, $titulo, $patch, $icon, $addhtml, $ordem) {
        try {
            $sql = "INSERT INTO `jqueryadminmenu`
                    (`codmenu`, `titulo`, `patch`, `icon`, `addhtml`, `ordem`)
                    VALUES
                    (:codmenu, :titulo, :patch, :icon, :addhtml, :ordem)";

            $statement = $Conexao->prepare($sql);

            //$codmenu - allow db null: NO 
             if (!isset($codmenu) && 'YES' == 'NO') 
                 $statement->bindValue(":codmenu", null); 
            elseif (!isset($codmenu)) 
                 $statement->bindValue(":codmenu", "");
            else 
                 $statement->bindValue(":codmenu", $codmenu);

            //$titulo - allow db null: NO 
             if (!isset($titulo) && 'YES' == 'NO') 
                 $statement->bindValue(":titulo", null); 
            elseif (!isset($titulo)) 
                 $statement->bindValue(":titulo", "");
            else 
                 $statement->bindValue(":titulo", $titulo);

            //$patch - allow db null: NO 
             if (!isset($patch) && 'YES' == 'NO') 
                 $statement->bindValue(":patch", null); 
            elseif (!isset($patch)) 
                 $statement->bindValue(":patch", "");
            else 
                 $statement->bindValue(":patch", $patch);

            //$icon - allow db null: NO 
             if (!isset($icon) && 'YES' == 'NO') 
                 $statement->bindValue(":icon", null); 
            elseif (!isset($icon)) 
                 $statement->bindValue(":icon", "");
            else 
                 $statement->bindValue(":icon", $icon);

            //$addhtml - allow db null: NO 
             if (!isset($addhtml) && 'YES' == 'NO') 
                 $statement->bindValue(":addhtml", null); 
            elseif (!isset($addhtml)) 
                 $statement->bindValue(":addhtml", "");
            else 
                 $statement->bindValue(":addhtml", $addhtml);

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

    public static function Update($Conexao, $cod, $codmenu, $titulo, $patch, $icon, $addhtml, $ordem) {
        try {
            $sql = "UPDATE `jqueryadminmenu` SET
                   `codmenu` = :codmenu,
                    `titulo` = :titulo,
                    `patch` = :patch,
                    `icon` = :icon,
                    `addhtml` = :addhtml,
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

            //$codmenu - allow db null: NO 
             if (!isset($codmenu) && 'YES' == 'NO') 
                 $statement->bindValue(":codmenu", null); 
            elseif (!isset($codmenu)) 
                 $statement->bindValue(":codmenu", "");
            else 
                 $statement->bindValue(":codmenu", $codmenu);

            //$titulo - allow db null: NO 
             if (!isset($titulo) && 'YES' == 'NO') 
                 $statement->bindValue(":titulo", null); 
            elseif (!isset($titulo)) 
                 $statement->bindValue(":titulo", "");
            else 
                 $statement->bindValue(":titulo", $titulo);

            //$patch - allow db null: NO 
             if (!isset($patch) && 'YES' == 'NO') 
                 $statement->bindValue(":patch", null); 
            elseif (!isset($patch)) 
                 $statement->bindValue(":patch", "");
            else 
                 $statement->bindValue(":patch", $patch);

            //$icon - allow db null: NO 
             if (!isset($icon) && 'YES' == 'NO') 
                 $statement->bindValue(":icon", null); 
            elseif (!isset($icon)) 
                 $statement->bindValue(":icon", "");
            else 
                 $statement->bindValue(":icon", $icon);

            //$addhtml - allow db null: NO 
             if (!isset($addhtml) && 'YES' == 'NO') 
                 $statement->bindValue(":addhtml", null); 
            elseif (!isset($addhtml)) 
                 $statement->bindValue(":addhtml", "");
            else 
                 $statement->bindValue(":addhtml", $addhtml);

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
        return dataDeletar($Conexao, "jqueryadminmenu", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbJqueryadminmenu::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbJqueryadminmenu::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryadminmenu.cod, jqueryadminmenu.codmenu, jqueryadminmenu.titulo, jqueryadminmenu.patch, jqueryadminmenu.icon, jqueryadminmenu.addhtml, jqueryadminmenu.ordem");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryadminmenu.cod, jqueryadminmenu.codmenu, jqueryadminmenu.titulo, jqueryadminmenu.patch, jqueryadminmenu.icon, jqueryadminmenu.addhtml, jqueryadminmenu.ordem");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'jqueryadminmenu', $where, $orderBy, $limit);
        $dados = dbJqueryadminmenu::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryadminmenu.cod, jqueryadminmenu.codmenu, jqueryadminmenu.titulo, jqueryadminmenu.patch, jqueryadminmenu.icon, jqueryadminmenu.addhtml, jqueryadminmenu.ordem , codmenu_rel.cod , codmenu_rel.codmenu , codmenu_rel.titulo , codmenu_rel.patch , codmenu_rel.icon , codmenu_rel.addhtml , codmenu_rel.ordem , icon_rel.cod , icon_rel.valor ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryadminmenu.cod, jqueryadminmenu.codmenu, jqueryadminmenu.titulo, jqueryadminmenu.patch, jqueryadminmenu.icon, jqueryadminmenu.addhtml, jqueryadminmenu.ordem , codmenu_rel.cod , codmenu_rel.codmenu , codmenu_rel.titulo , codmenu_rel.patch , codmenu_rel.icon , codmenu_rel.addhtml , codmenu_rel.ordem , icon_rel.cod , icon_rel.valor ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "jqueryadminmenu.* ,
                 codmenu_rel.cod as codmenu_cod,
                 codmenu_rel.codmenu as codmenu_codmenu,
                 codmenu_rel.titulo as codmenu_titulo,
                 codmenu_rel.patch as codmenu_patch,
                 codmenu_rel.icon as codmenu_icon,
                 codmenu_rel.addhtml as codmenu_addhtml,
                 codmenu_rel.ordem as codmenu_ordem ,
                 icon_rel.cod as icon_cod,
                 icon_rel.valor as icon_valor  ";
        
        $leftjoin = "LEFT JOIN jqueryadminmenu codmenu_rel ON jqueryadminmenu.codmenu = codmenu_rel.cod 
                LEFT JOIN jqueryimage icon_rel ON jqueryadminmenu.icon = icon_rel.cod 
                ";
            
        $dados = dataListar($Conexao, 'jqueryadminmenu', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbJqueryadminmenu::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objJqueryadminmenu[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryadminmenu::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryadminmenu($Conexao);
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
     * @return objJqueryadminmenu[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryadminmenu::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryadminmenu($Conexao);
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
            $filefolder = ___AppRoot . "adm/jqueryadminmenu/templates/";

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
                        if ($obj instanceof objJqueryadminmenu) {                        
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
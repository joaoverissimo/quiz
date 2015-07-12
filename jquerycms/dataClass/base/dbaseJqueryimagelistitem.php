<?php

class dbaseJqueryimagelistitem {
    
    const tabela = "jqueryimagelistitem";
    const primaryKey = "cod";
    
    const _cod = "jqueryimagelistitem.cod";
    const _jqueryimagelist = "jqueryimagelistitem.jqueryimagelist";
    const _jqueryimage = "jqueryimagelistitem.jqueryimage";
    const _titulo = "jqueryimagelistitem.titulo";
    const _link = "jqueryimagelistitem.link";
    const _target = "jqueryimagelistitem.target";
    const _descricao = "jqueryimagelistitem.descricao";
    const _ordem = "jqueryimagelistitem.ordem";
    const _principal = "jqueryimagelistitem.principal";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'jqueryimagelistitem', $campo, $valor);
        $dados = dbJqueryimagelistitem::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("jqueryimagelistitem.$campo", $valor);
        $dados = dbJqueryimagelistitem::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbJqueryimagelistitem::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from jqueryimagelistitem";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $jqueryimagelist, $jqueryimage, $titulo, $link, $target, $descricao, $ordem, $principal) {
        try {
            $sql = "INSERT INTO `jqueryimagelistitem`
                    (`jqueryimagelist`, `jqueryimage`, `titulo`, `link`, `target`, `descricao`, `ordem`, `principal`)
                    VALUES
                    (:jqueryimagelist, :jqueryimage, :titulo, :link, :target, :descricao, :ordem, :principal)";

            $statement = $Conexao->prepare($sql);

            //$jqueryimagelist - allow db null: NO 
             if (!isset($jqueryimagelist) && 'YES' == 'NO') 
                 $statement->bindValue(":jqueryimagelist", null); 
            elseif (!isset($jqueryimagelist)) 
                 $statement->bindValue(":jqueryimagelist", "");
            else 
                 $statement->bindValue(":jqueryimagelist", $jqueryimagelist);

            //$jqueryimage - allow db null: NO 
             if (!isset($jqueryimage) && 'YES' == 'NO') 
                 $statement->bindValue(":jqueryimage", null); 
            elseif (!isset($jqueryimage)) 
                 $statement->bindValue(":jqueryimage", "");
            else 
                 $statement->bindValue(":jqueryimage", $jqueryimage);

            //$titulo - allow db null: NO 
             if (!isset($titulo) && 'YES' == 'NO') 
                 $statement->bindValue(":titulo", null); 
            elseif (!isset($titulo)) 
                 $statement->bindValue(":titulo", "");
            else 
                 $statement->bindValue(":titulo", $titulo);

            //$link - allow db null: NO 
             if (!isset($link) && 'YES' == 'NO') 
                 $statement->bindValue(":link", null); 
            elseif (!isset($link)) 
                 $statement->bindValue(":link", "");
            else 
                 $statement->bindValue(":link", $link);

            //$target - allow db null: NO 
             if (!isset($target) && 'YES' == 'NO') 
                 $statement->bindValue(":target", null); 
            elseif (!isset($target)) 
                 $statement->bindValue(":target", "");
            else 
                 $statement->bindValue(":target", $target);

            //$descricao - allow db null: NO 
             if (!isset($descricao) && 'YES' == 'NO') 
                 $statement->bindValue(":descricao", null); 
            elseif (!isset($descricao)) 
                 $statement->bindValue(":descricao", "");
            else 
                 $statement->bindValue(":descricao", $descricao);

            //$ordem - allow db null: NO 
             if (!isset($ordem) && 'YES' == 'NO') 
                 $statement->bindValue(":ordem", null); 
            elseif (!isset($ordem)) 
                 $statement->bindValue(":ordem", "");
            else 
                 $statement->bindValue(":ordem", $ordem);

            //$principal - allow db null: NO 
             if (!isset($principal) && 'YES' == 'NO') 
                 $statement->bindValue(":principal", null); 
            elseif (!isset($principal)) 
                 $statement->bindValue(":principal", "");
            else 
                 $statement->bindValue(":principal", $principal);

            

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

    public static function Update($Conexao, $cod, $jqueryimagelist, $jqueryimage, $titulo, $link, $target, $descricao, $ordem, $principal) {
        try {
            $sql = "UPDATE `jqueryimagelistitem` SET
                   `jqueryimagelist` = :jqueryimagelist,
                    `jqueryimage` = :jqueryimage,
                    `titulo` = :titulo,
                    `link` = :link,
                    `target` = :target,
                    `descricao` = :descricao,
                    `ordem` = :ordem,
                    `principal` = :principal

                   WHERE  `cod` = :cod;";

            $statement = $Conexao->prepare($sql);

            //$cod - allow db null: NO 
             if (!isset($cod) && 'YES' == 'NO') 
                 $statement->bindValue(":cod", null); 
            elseif (!isset($cod)) 
                 $statement->bindValue(":cod", "");
            else 
                 $statement->bindValue(":cod", $cod);

            //$jqueryimagelist - allow db null: NO 
             if (!isset($jqueryimagelist) && 'YES' == 'NO') 
                 $statement->bindValue(":jqueryimagelist", null); 
            elseif (!isset($jqueryimagelist)) 
                 $statement->bindValue(":jqueryimagelist", "");
            else 
                 $statement->bindValue(":jqueryimagelist", $jqueryimagelist);

            //$jqueryimage - allow db null: NO 
             if (!isset($jqueryimage) && 'YES' == 'NO') 
                 $statement->bindValue(":jqueryimage", null); 
            elseif (!isset($jqueryimage)) 
                 $statement->bindValue(":jqueryimage", "");
            else 
                 $statement->bindValue(":jqueryimage", $jqueryimage);

            //$titulo - allow db null: NO 
             if (!isset($titulo) && 'YES' == 'NO') 
                 $statement->bindValue(":titulo", null); 
            elseif (!isset($titulo)) 
                 $statement->bindValue(":titulo", "");
            else 
                 $statement->bindValue(":titulo", $titulo);

            //$link - allow db null: NO 
             if (!isset($link) && 'YES' == 'NO') 
                 $statement->bindValue(":link", null); 
            elseif (!isset($link)) 
                 $statement->bindValue(":link", "");
            else 
                 $statement->bindValue(":link", $link);

            //$target - allow db null: NO 
             if (!isset($target) && 'YES' == 'NO') 
                 $statement->bindValue(":target", null); 
            elseif (!isset($target)) 
                 $statement->bindValue(":target", "");
            else 
                 $statement->bindValue(":target", $target);

            //$descricao - allow db null: NO 
             if (!isset($descricao) && 'YES' == 'NO') 
                 $statement->bindValue(":descricao", null); 
            elseif (!isset($descricao)) 
                 $statement->bindValue(":descricao", "");
            else 
                 $statement->bindValue(":descricao", $descricao);

            //$ordem - allow db null: NO 
             if (!isset($ordem) && 'YES' == 'NO') 
                 $statement->bindValue(":ordem", null); 
            elseif (!isset($ordem)) 
                 $statement->bindValue(":ordem", "");
            else 
                 $statement->bindValue(":ordem", $ordem);

            //$principal - allow db null: NO 
             if (!isset($principal) && 'YES' == 'NO') 
                 $statement->bindValue(":principal", null); 
            elseif (!isset($principal)) 
                 $statement->bindValue(":principal", "");
            else 
                 $statement->bindValue(":principal", $principal);

            

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
        return dataDeletar($Conexao, "jqueryimagelistitem", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbJqueryimagelistitem::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbJqueryimagelistitem::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryimagelistitem.cod, jqueryimagelistitem.jqueryimagelist, jqueryimagelistitem.jqueryimage, jqueryimagelistitem.titulo, jqueryimagelistitem.link, jqueryimagelistitem.target, jqueryimagelistitem.descricao, jqueryimagelistitem.ordem, jqueryimagelistitem.principal");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryimagelistitem.cod, jqueryimagelistitem.jqueryimagelist, jqueryimagelistitem.jqueryimage, jqueryimagelistitem.titulo, jqueryimagelistitem.link, jqueryimagelistitem.target, jqueryimagelistitem.descricao, jqueryimagelistitem.ordem, jqueryimagelistitem.principal");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'jqueryimagelistitem', $where, $orderBy, $limit);
        $dados = dbJqueryimagelistitem::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryimagelistitem.cod, jqueryimagelistitem.jqueryimagelist, jqueryimagelistitem.jqueryimage, jqueryimagelistitem.titulo, jqueryimagelistitem.link, jqueryimagelistitem.target, jqueryimagelistitem.descricao, jqueryimagelistitem.ordem, jqueryimagelistitem.principal , jqueryimagelist_rel.cod , jqueryimagelist_rel.info , jqueryimage_rel.cod , jqueryimage_rel.valor ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryimagelistitem.cod, jqueryimagelistitem.jqueryimagelist, jqueryimagelistitem.jqueryimage, jqueryimagelistitem.titulo, jqueryimagelistitem.link, jqueryimagelistitem.target, jqueryimagelistitem.descricao, jqueryimagelistitem.ordem, jqueryimagelistitem.principal , jqueryimagelist_rel.cod , jqueryimagelist_rel.info , jqueryimage_rel.cod , jqueryimage_rel.valor ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "jqueryimagelistitem.* ,
                 jqueryimagelist_rel.cod as jqueryimagelist_cod,
                 jqueryimagelist_rel.info as jqueryimagelist_info ,
                 jqueryimage_rel.cod as jqueryimage_cod,
                 jqueryimage_rel.valor as jqueryimage_valor  ";
        
        $leftjoin = "LEFT JOIN jqueryimagelist jqueryimagelist_rel ON jqueryimagelistitem.jqueryimagelist = jqueryimagelist_rel.cod 
                LEFT JOIN jqueryimage jqueryimage_rel ON jqueryimagelistitem.jqueryimage = jqueryimage_rel.cod 
                ";
            
        $dados = dataListar($Conexao, 'jqueryimagelistitem', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbJqueryimagelistitem::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objJqueryimagelistitem[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryimagelistitem::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryimagelistitem($Conexao);
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
     * @return objJqueryimagelistitem[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryimagelistitem::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryimagelistitem($Conexao);
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
            $filefolder = ___AppRoot . "adm/jqueryimagelistitem/templates/";

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
                        if ($obj instanceof objJqueryimagelistitem) {                        
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
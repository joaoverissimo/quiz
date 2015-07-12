<?php

class dbaseLocmapaponto {
    
    const tabela = "locmapaponto";
    const primaryKey = "cod";
    
    const _cod = "locmapaponto.cod";
    const _lat = "locmapaponto.lat";
    const _lng = "locmapaponto.lng";
    const _heading = "locmapaponto.heading";
    const _pitch = "locmapaponto.pitch";
    const _zoom = "locmapaponto.zoom";
    const _comportamento = "locmapaponto.comportamento";
    const _suportaview = "locmapaponto.suportaview";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'locmapaponto', $campo, $valor);
        $dados = dbLocmapaponto::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("locmapaponto.$campo", $valor);
        $dados = dbLocmapaponto::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbLocmapaponto::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from locmapaponto";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $lat, $lng, $heading, $pitch, $zoom, $comportamento, $suportaview) {
        try {
            $sql = "INSERT INTO `locmapaponto`
                    (`lat`, `lng`, `heading`, `pitch`, `zoom`, `comportamento`, `suportaview`)
                    VALUES
                    (:lat, :lng, :heading, :pitch, :zoom, :comportamento, :suportaview)";

            $statement = $Conexao->prepare($sql);

            //$lat - allow db null: NO 
             if (!isset($lat) && 'YES' == 'NO') 
                 $statement->bindValue(":lat", null); 
            elseif (!isset($lat)) 
                 $statement->bindValue(":lat", "");
            else 
                 $statement->bindValue(":lat", $lat);

            //$lng - allow db null: NO 
             if (!isset($lng) && 'YES' == 'NO') 
                 $statement->bindValue(":lng", null); 
            elseif (!isset($lng)) 
                 $statement->bindValue(":lng", "");
            else 
                 $statement->bindValue(":lng", $lng);

            //$heading - allow db null: NO 
             if (!isset($heading) && 'YES' == 'NO') 
                 $statement->bindValue(":heading", null); 
            elseif (!isset($heading)) 
                 $statement->bindValue(":heading", "");
            else 
                 $statement->bindValue(":heading", $heading);

            //$pitch - allow db null: NO 
             if (!isset($pitch) && 'YES' == 'NO') 
                 $statement->bindValue(":pitch", null); 
            elseif (!isset($pitch)) 
                 $statement->bindValue(":pitch", "");
            else 
                 $statement->bindValue(":pitch", $pitch);

            //$zoom - allow db null: NO 
             if (!isset($zoom) && 'YES' == 'NO') 
                 $statement->bindValue(":zoom", null); 
            elseif (!isset($zoom)) 
                 $statement->bindValue(":zoom", "");
            else 
                 $statement->bindValue(":zoom", $zoom);

            //$comportamento - allow db null: NO 
             if (!isset($comportamento) && 'YES' == 'NO') 
                 $statement->bindValue(":comportamento", null); 
            elseif (!isset($comportamento)) 
                 $statement->bindValue(":comportamento", "");
            else 
                 $statement->bindValue(":comportamento", $comportamento);

            //$suportaview - allow db null: NO 
             if (!isset($suportaview) && 'YES' == 'NO') 
                 $statement->bindValue(":suportaview", null); 
            elseif (!isset($suportaview)) 
                 $statement->bindValue(":suportaview", "");
            else 
                 $statement->bindValue(":suportaview", $suportaview);

            

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

    public static function Update($Conexao, $cod, $lat, $lng, $heading, $pitch, $zoom, $comportamento, $suportaview) {
        try {
            $sql = "UPDATE `locmapaponto` SET
                   `lat` = :lat,
                    `lng` = :lng,
                    `heading` = :heading,
                    `pitch` = :pitch,
                    `zoom` = :zoom,
                    `comportamento` = :comportamento,
                    `suportaview` = :suportaview

                   WHERE  `cod` = :cod;";

            $statement = $Conexao->prepare($sql);

            //$cod - allow db null: NO 
             if (!isset($cod) && 'YES' == 'NO') 
                 $statement->bindValue(":cod", null); 
            elseif (!isset($cod)) 
                 $statement->bindValue(":cod", "");
            else 
                 $statement->bindValue(":cod", $cod);

            //$lat - allow db null: NO 
             if (!isset($lat) && 'YES' == 'NO') 
                 $statement->bindValue(":lat", null); 
            elseif (!isset($lat)) 
                 $statement->bindValue(":lat", "");
            else 
                 $statement->bindValue(":lat", $lat);

            //$lng - allow db null: NO 
             if (!isset($lng) && 'YES' == 'NO') 
                 $statement->bindValue(":lng", null); 
            elseif (!isset($lng)) 
                 $statement->bindValue(":lng", "");
            else 
                 $statement->bindValue(":lng", $lng);

            //$heading - allow db null: NO 
             if (!isset($heading) && 'YES' == 'NO') 
                 $statement->bindValue(":heading", null); 
            elseif (!isset($heading)) 
                 $statement->bindValue(":heading", "");
            else 
                 $statement->bindValue(":heading", $heading);

            //$pitch - allow db null: NO 
             if (!isset($pitch) && 'YES' == 'NO') 
                 $statement->bindValue(":pitch", null); 
            elseif (!isset($pitch)) 
                 $statement->bindValue(":pitch", "");
            else 
                 $statement->bindValue(":pitch", $pitch);

            //$zoom - allow db null: NO 
             if (!isset($zoom) && 'YES' == 'NO') 
                 $statement->bindValue(":zoom", null); 
            elseif (!isset($zoom)) 
                 $statement->bindValue(":zoom", "");
            else 
                 $statement->bindValue(":zoom", $zoom);

            //$comportamento - allow db null: NO 
             if (!isset($comportamento) && 'YES' == 'NO') 
                 $statement->bindValue(":comportamento", null); 
            elseif (!isset($comportamento)) 
                 $statement->bindValue(":comportamento", "");
            else 
                 $statement->bindValue(":comportamento", $comportamento);

            //$suportaview - allow db null: NO 
             if (!isset($suportaview) && 'YES' == 'NO') 
                 $statement->bindValue(":suportaview", null); 
            elseif (!isset($suportaview)) 
                 $statement->bindValue(":suportaview", "");
            else 
                 $statement->bindValue(":suportaview", $suportaview);

            

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
        return dataDeletar($Conexao, "locmapaponto", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbLocmapaponto::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbLocmapaponto::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("locmapaponto.cod, locmapaponto.lat, locmapaponto.lng, locmapaponto.heading, locmapaponto.pitch, locmapaponto.zoom, locmapaponto.comportamento, locmapaponto.suportaview");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("locmapaponto.cod, locmapaponto.lat, locmapaponto.lng, locmapaponto.heading, locmapaponto.pitch, locmapaponto.zoom, locmapaponto.comportamento, locmapaponto.suportaview");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'locmapaponto', $where, $orderBy, $limit);
        $dados = dbLocmapaponto::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("locmapaponto.cod, locmapaponto.lat, locmapaponto.lng, locmapaponto.heading, locmapaponto.pitch, locmapaponto.zoom, locmapaponto.comportamento, locmapaponto.suportaview ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("locmapaponto.cod, locmapaponto.lat, locmapaponto.lng, locmapaponto.heading, locmapaponto.pitch, locmapaponto.zoom, locmapaponto.comportamento, locmapaponto.suportaview ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "locmapaponto.*  ";
        
        $leftjoin = "";
            
        $dados = dataListar($Conexao, 'locmapaponto', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbLocmapaponto::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objLocmapaponto[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbLocmapaponto::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objLocmapaponto($Conexao);
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
     * @return objLocmapaponto[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbLocmapaponto::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objLocmapaponto($Conexao);
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
            $filefolder = ___AppRoot . "adm/locmapaponto/templates/";

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
                        if ($obj instanceof objLocmapaponto) {                        
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
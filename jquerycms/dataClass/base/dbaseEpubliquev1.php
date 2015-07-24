<?php

class dbaseEpubliquev1 {
    
    const tabela = "epubliquev1";
    const primaryKey = "cod";
    
    const _cod = "epubliquev1.cod";
    const _perguntas = "epubliquev1.perguntas";
    const _respostas = "epubliquev1.respostas";
    const _email = "epubliquev1.email";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'epubliquev1', $campo, $valor);
        $dados = dbEpubliquev1::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("epubliquev1.$campo", $valor);
        $dados = dbEpubliquev1::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbEpubliquev1::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from epubliquev1";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $perguntas, $respostas, $email) {
        try {
            $sql = "INSERT INTO `epubliquev1`
                    (`perguntas`, `respostas`, `email`)
                    VALUES
                    (:perguntas, :respostas, :email)";

            $statement = $Conexao->prepare($sql);

            //$perguntas - allow db null: NO 
             if (!isset($perguntas) && 'YES' == 'NO') 
                 $statement->bindValue(":perguntas", null); 
            elseif (!isset($perguntas)) 
                 $statement->bindValue(":perguntas", "");
            else 
                 $statement->bindValue(":perguntas", $perguntas);

            //$respostas - allow db null: NO 
             if (!isset($respostas) && 'YES' == 'NO') 
                 $statement->bindValue(":respostas", null); 
            elseif (!isset($respostas)) 
                 $statement->bindValue(":respostas", "");
            else 
                 $statement->bindValue(":respostas", $respostas);

            //$email - allow db null: NO 
             if (!isset($email) && 'YES' == 'NO') 
                 $statement->bindValue(":email", null); 
            elseif (!isset($email)) 
                 $statement->bindValue(":email", "");
            else 
                 $statement->bindValue(":email", $email);

            

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

    public static function Update($Conexao, $cod, $perguntas, $respostas, $email) {
        try {
            $sql = "UPDATE `epubliquev1` SET
                   `perguntas` = :perguntas,
                    `respostas` = :respostas,
                    `email` = :email

                   WHERE  `cod` = :cod;";

            $statement = $Conexao->prepare($sql);

            //$cod - allow db null: NO 
             if (!isset($cod) && 'YES' == 'NO') 
                 $statement->bindValue(":cod", null); 
            elseif (!isset($cod)) 
                 $statement->bindValue(":cod", "");
            else 
                 $statement->bindValue(":cod", $cod);

            //$perguntas - allow db null: NO 
             if (!isset($perguntas) && 'YES' == 'NO') 
                 $statement->bindValue(":perguntas", null); 
            elseif (!isset($perguntas)) 
                 $statement->bindValue(":perguntas", "");
            else 
                 $statement->bindValue(":perguntas", $perguntas);

            //$respostas - allow db null: NO 
             if (!isset($respostas) && 'YES' == 'NO') 
                 $statement->bindValue(":respostas", null); 
            elseif (!isset($respostas)) 
                 $statement->bindValue(":respostas", "");
            else 
                 $statement->bindValue(":respostas", $respostas);

            //$email - allow db null: NO 
             if (!isset($email) && 'YES' == 'NO') 
                 $statement->bindValue(":email", null); 
            elseif (!isset($email)) 
                 $statement->bindValue(":email", "");
            else 
                 $statement->bindValue(":email", $email);

            

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
        return dataDeletar($Conexao, "epubliquev1", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbEpubliquev1::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbEpubliquev1::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("epubliquev1.cod, epubliquev1.perguntas, epubliquev1.respostas, epubliquev1.email");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("epubliquev1.cod, epubliquev1.perguntas, epubliquev1.respostas, epubliquev1.email");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'epubliquev1', $where, $orderBy, $limit);
        $dados = dbEpubliquev1::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("epubliquev1.cod, epubliquev1.perguntas, epubliquev1.respostas, epubliquev1.email ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("epubliquev1.cod, epubliquev1.perguntas, epubliquev1.respostas, epubliquev1.email ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "epubliquev1.*  ";
        
        $leftjoin = "";
            
        $dados = dataListar($Conexao, 'epubliquev1', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbEpubliquev1::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objEpubliquev1[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbEpubliquev1::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objEpubliquev1($Conexao);
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
     * @return objEpubliquev1[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbEpubliquev1::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objEpubliquev1($Conexao);
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
            $filefolder = ___AppRoot . "adm/epubliquev1/templates/";

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
                        if ($obj instanceof objEpubliquev1) {                        
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
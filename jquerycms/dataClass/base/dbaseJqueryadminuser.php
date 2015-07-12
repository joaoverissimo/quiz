<?php

class dbaseJqueryadminuser {
    
    const tabela = "jqueryadminuser";
    const primaryKey = "cod";
    
    const _cod = "jqueryadminuser.cod";
    const _nome = "jqueryadminuser.nome";
    const _mail = "jqueryadminuser.mail";
    const _senha = "jqueryadminuser.senha";
    const _grupo = "jqueryadminuser.grupo";
    
    
    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'jqueryadminuser', $campo, $valor);
        $dados = dbJqueryadminuser::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("jqueryadminuser.$campo", $valor);
        $dados = dbJqueryadminuser::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }        
    }
    
    public static function getMax($Conexao, $increment1 = false){
        $primaryKey = dbJqueryadminuser::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from jqueryadminuser";
        $dados = dataExecSqlDireto($Conexao, $sql, false);
        
        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }
    
    public static function Inserir($Conexao, $nome, $mail, $senha, $grupo) {
        try {
            $sql = "INSERT INTO `jqueryadminuser`
                    (`nome`, `mail`, `senha`, `grupo`)
                    VALUES
                    (:nome, :mail, :senha, :grupo)";

            $statement = $Conexao->prepare($sql);

            //$nome - allow db null: NO 
             if (!isset($nome) && 'YES' == 'NO') 
                 $statement->bindValue(":nome", null); 
            elseif (!isset($nome)) 
                 $statement->bindValue(":nome", "");
            else 
                 $statement->bindValue(":nome", $nome);

            //$mail - allow db null: NO 
             if (!isset($mail) && 'YES' == 'NO') 
                 $statement->bindValue(":mail", null); 
            elseif (!isset($mail)) 
                 $statement->bindValue(":mail", "");
            else 
                 $statement->bindValue(":mail", $mail);

            //$senha - allow db null: NO 
             if (!isset($senha) && 'YES' == 'NO') 
                 $statement->bindValue(":senha", null); 
            elseif (!isset($senha)) 
                 $statement->bindValue(":senha", "");
            else 
                 $statement->bindValue(":senha", $senha);

            //$grupo - allow db null: NO 
             if (!isset($grupo) && 'YES' == 'NO') 
                 $statement->bindValue(":grupo", null); 
            elseif (!isset($grupo)) 
                 $statement->bindValue(":grupo", "");
            else 
                 $statement->bindValue(":grupo", $grupo);

            

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

    public static function Update($Conexao, $cod, $nome, $mail, $senha, $grupo) {
        try {
            $sql = "UPDATE `jqueryadminuser` SET
                   `nome` = :nome,
                    `mail` = :mail,
                    `senha` = :senha,
                    `grupo` = :grupo

                   WHERE  `cod` = :cod;";

            $statement = $Conexao->prepare($sql);

            //$cod - allow db null: NO 
             if (!isset($cod) && 'YES' == 'NO') 
                 $statement->bindValue(":cod", null); 
            elseif (!isset($cod)) 
                 $statement->bindValue(":cod", "");
            else 
                 $statement->bindValue(":cod", $cod);

            //$nome - allow db null: NO 
             if (!isset($nome) && 'YES' == 'NO') 
                 $statement->bindValue(":nome", null); 
            elseif (!isset($nome)) 
                 $statement->bindValue(":nome", "");
            else 
                 $statement->bindValue(":nome", $nome);

            //$mail - allow db null: NO 
             if (!isset($mail) && 'YES' == 'NO') 
                 $statement->bindValue(":mail", null); 
            elseif (!isset($mail)) 
                 $statement->bindValue(":mail", "");
            else 
                 $statement->bindValue(":mail", $mail);

            //$senha - allow db null: NO 
             if (!isset($senha) && 'YES' == 'NO') 
                 $statement->bindValue(":senha", null); 
            elseif (!isset($senha)) 
                 $statement->bindValue(":senha", "");
            else 
                 $statement->bindValue(":senha", $senha);

            //$grupo - allow db null: NO 
             if (!isset($grupo) && 'YES' == 'NO') 
                 $statement->bindValue(":grupo", null); 
            elseif (!isset($grupo)) 
                 $statement->bindValue(":grupo", "");
            else 
                 $statement->bindValue(":grupo", $grupo);

            

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
        return dataDeletar($Conexao, "jqueryadminuser", "cod", $cod);
    }
    
    public static function DeletarWhere($Conexao, $where) {
        $dados = dbJqueryadminuser::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbJqueryadminuser::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryadminuser.cod, jqueryadminuser.nome, jqueryadminuser.mail, jqueryadminuser.senha, jqueryadminuser.grupo");
        }         
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryadminuser.cod, jqueryadminuser.nome, jqueryadminuser.mail, jqueryadminuser.senha, jqueryadminuser.grupo");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'jqueryadminuser', $where, $orderBy, $limit);
        $dados = dbJqueryadminuser::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;        
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("jqueryadminuser.cod, jqueryadminuser.nome, jqueryadminuser.mail, jqueryadminuser.senha, jqueryadminuser.grupo , grupo_rel.cod , grupo_rel.titulo ");
        } 
        
        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("jqueryadminuser.cod, jqueryadminuser.nome, jqueryadminuser.mail, jqueryadminuser.senha, jqueryadminuser.grupo , grupo_rel.cod , grupo_rel.titulo ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "jqueryadminuser.* ,
                 grupo_rel.cod as grupo_cod,
                 grupo_rel.titulo as grupo_titulo  ";
        
        $leftjoin = "LEFT JOIN jqueryadmingrupo grupo_rel ON jqueryadminuser.grupo = grupo_rel.cod 
                ";
            
        $dados = dataListar($Conexao, 'jqueryadminuser', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbJqueryadminuser::CorrigeValoresSimplesAll($dados);
        
        if (! issetArray($dados)) {
            return false;
        } 
        
        return $dados;
    }
    
    /**
     * @return objJqueryadminuser[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryadminuser::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryadminuser($Conexao);
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
     * @return objJqueryadminuser[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbJqueryadminuser::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objJqueryadminuser($Conexao);
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
            $filefolder = ___AppRoot . "adm/jqueryadminuser/templates/";

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
                        if ($obj instanceof objJqueryadminuser) {                        
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
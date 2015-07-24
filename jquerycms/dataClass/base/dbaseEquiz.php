<?php

class dbaseEquiz {

    const tabela = "equiz";
    const primaryKey = "cod";
    const _cod = "equiz.cod";
    const _usuario = "equiz.usuario";
    const _seo = "equiz.seo";
    const _titulo = "equiz.titulo";
    const _data = "equiz.data";
    const _imagem = "equiz.imagem";
    const _flaprovado = "equiz.flaprovado";
    const _votos = "equiz.votos";

    public static function Carregar($Conexao, $valor, $campo = 'cod') {
        $dados = dataCarregar($Conexao, 'equiz', $campo, $valor);
        $dados = dbEquiz::CorrigeValoresSimples($dados);
        return $dados;
    }

    public static function CarregarLeft($Conexao, $valor, $campo = 'cod') {
        $where = new dataFilter("equiz.$campo", $valor);
        $dados = dbEquiz::ListarLeft($Conexao, $where, "", "0,1");

        if (issetArray($dados[0]) && isset($dados[0][$campo])) {
            return $dados[0];
        } else {
            return false;
        }
    }

    public static function getMax($Conexao, $increment1 = false) {
        $primaryKey = dbEquiz::primaryKey;
        $sql = "select MAX($primaryKey) AS getmax from equiz";
        $dados = dataExecSqlDireto($Conexao, $sql, false);

        if (is_numeric($dados["getmax"]) && $increment1) {
            return intval($dados["getmax"]) + 1;
        } elseif (is_numeric($dados["getmax"])) {
            return $dados["getmax"];
        } else {
            return 0;
        }
    }

    public static function Inserir($Conexao, $usuario, $seo, $titulo, $data, $imagem, $flaprovado, $votos) {
        try {
            $sql = "INSERT INTO `equiz`
                    (`usuario`, `seo`, `titulo`, `data`, `imagem`, `flaprovado`, `votos`)
                    VALUES
                    (:usuario, :seo, :titulo, STR_TO_DATE(:data,'%d/%m/%Y %H:%i:%s'), :imagem, :flaprovado, :votos)";

            $statement = $Conexao->prepare($sql);

            //$usuario - allow db null: NO 
            if (!isset($usuario) && 'YES' == 'NO')
                $statement->bindValue(":usuario", null);
            elseif (!isset($usuario))
                $statement->bindValue(":usuario", "");
            else
                $statement->bindValue(":usuario", $usuario);

            //$seo - allow db null: NO 
            if (!isset($seo) && 'YES' == 'NO')
                $statement->bindValue(":seo", null);
            elseif (!isset($seo))
                $statement->bindValue(":seo", "");
            else
                $statement->bindValue(":seo", $seo);

            //$titulo - allow db null: NO 
            if (!isset($titulo) && 'YES' == 'NO')
                $statement->bindValue(":titulo", null);
            elseif (!isset($titulo))
                $statement->bindValue(":titulo", "");
            else
                $statement->bindValue(":titulo", $titulo);

            //$data - allow db null: NO 
            if (!isset($data) && 'YES' == 'NO')
                $statement->bindValue(":data", null);
            elseif (!isset($data))
                $statement->bindValue(":data", "");
            else
                $statement->bindValue(":data", $data);

            //$imagem - allow db null: YES 
            if (!isset($imagem) && 'YES' == 'YES')
                $statement->bindValue(":imagem", null);
            elseif (!isset($imagem))
                $statement->bindValue(":imagem", "");
            else
                $statement->bindValue(":imagem", $imagem);

            //$flaprovado - allow db null: NO 
            if (!isset($flaprovado) && 'YES' == 'NO')
                $statement->bindValue(":flaprovado", null);
            elseif (!isset($flaprovado))
                $statement->bindValue(":flaprovado", "");
            else
                $statement->bindValue(":flaprovado", $flaprovado);

            //$votos - allow db null: NO 
            if (!isset($votos) && 'YES' == 'NO')
                $statement->bindValue(":votos", null);
            elseif (!isset($votos))
                $statement->bindValue(":votos", "");
            else
                $statement->bindValue(":votos", $votos);



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

    public static function Update($Conexao, $cod, $usuario, $seo, $titulo, $data, $imagem, $flaprovado, $votos) {
        try {
            $sql = "UPDATE `equiz` SET
                   `usuario` = :usuario,
                    `seo` = :seo,
                    `titulo` = :titulo,
                    `data` = STR_TO_DATE(:data,'%d/%m/%Y %H:%i:%s'),
                    `imagem` = :imagem,
                    `flaprovado` = :flaprovado,
                    `votos` = :votos

                   WHERE  `cod` = :cod;";

            $statement = $Conexao->prepare($sql);

            //$cod - allow db null: NO 
            if (!isset($cod) && 'YES' == 'NO')
                $statement->bindValue(":cod", null);
            elseif (!isset($cod))
                $statement->bindValue(":cod", "");
            else
                $statement->bindValue(":cod", $cod);

            //$usuario - allow db null: NO 
            if (!isset($usuario) && 'YES' == 'NO')
                $statement->bindValue(":usuario", null);
            elseif (!isset($usuario))
                $statement->bindValue(":usuario", "");
            else
                $statement->bindValue(":usuario", $usuario);

            //$seo - allow db null: NO 
            if (!isset($seo) && 'YES' == 'NO')
                $statement->bindValue(":seo", null);
            elseif (!isset($seo))
                $statement->bindValue(":seo", "");
            else
                $statement->bindValue(":seo", $seo);

            //$titulo - allow db null: NO 
            if (!isset($titulo) && 'YES' == 'NO')
                $statement->bindValue(":titulo", null);
            elseif (!isset($titulo))
                $statement->bindValue(":titulo", "");
            else
                $statement->bindValue(":titulo", $titulo);

            //$data - allow db null: NO 
            if (!isset($data) && 'YES' == 'NO')
                $statement->bindValue(":data", null);
            elseif (!isset($data))
                $statement->bindValue(":data", "");
            else
                $statement->bindValue(":data", $data);

            //$imagem - allow db null: YES 
            if (!isset($imagem) && 'YES' == 'YES')
                $statement->bindValue(":imagem", null);
            elseif (!isset($imagem))
                $statement->bindValue(":imagem", "");
            else
                $statement->bindValue(":imagem", $imagem);

            //$flaprovado - allow db null: NO 
            if (!isset($flaprovado) && 'YES' == 'NO')
                $statement->bindValue(":flaprovado", null);
            elseif (!isset($flaprovado))
                $statement->bindValue(":flaprovado", "");
            else
                $statement->bindValue(":flaprovado", $flaprovado);

            //$votos - allow db null: NO 
            if (!isset($votos) && 'YES' == 'NO')
                $statement->bindValue(":votos", null);
            elseif (!isset($votos))
                $statement->bindValue(":votos", "");
            else
                $statement->bindValue(":votos", $votos);



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
        return dataDeletar($Conexao, "equiz", "cod", $cod);
    }

    public static function DeletarWhere($Conexao, $where) {
        $dados = dbEquiz::Listar($Conexao, $where);
        if ($dados !== false) {
            foreach ($dados as $registro) {
                dbEquiz::Deletar($Conexao, $registro['cod']);
            }
        }
    }

    public static function Listar($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("equiz.cod, equiz.usuario, equiz.seo, equiz.titulo, equiz.data, equiz.imagem, equiz.flaprovado, equiz.votos");
        }

        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("equiz.cod, equiz.usuario, equiz.seo, equiz.titulo, equiz.data, equiz.imagem, equiz.flaprovado, equiz.votos");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $dados = dataListar($Conexao, 'equiz', $where, $orderBy, $limit);
        $dados = dbEquiz::CorrigeValoresSimplesAll($dados);

        if (!issetArray($dados)) {
            return false;
        }

        return $dados;
    }

    public static function ListarLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        if ($where instanceof dataFilter) {
            $where->setValidFields("equiz.cod, equiz.usuario, equiz.seo, equiz.titulo, equiz.data, equiz.imagem, equiz.flaprovado, equiz.votos , usuario_rel.cod , usuario_rel.nome , usuario_rel.mail , usuario_rel.senha , usuario_rel.grupo , seo_rel.cod , seo_rel.titulo , seo_rel.descricao , imagem_rel.cod , imagem_rel.valor ");
        }

        if ($orderBy instanceof dataOrder) {
            $orderBy->setValidFields("equiz.cod, equiz.usuario, equiz.seo, equiz.titulo, equiz.data, equiz.imagem, equiz.flaprovado, equiz.votos , usuario_rel.cod , usuario_rel.nome , usuario_rel.mail , usuario_rel.senha , usuario_rel.grupo , seo_rel.cod , seo_rel.titulo , seo_rel.descricao , imagem_rel.cod , imagem_rel.valor ");
        } elseif (!$orderBy) {
            $orderBy = "cod desc";
        }

        $select = "equiz.* ,
                 usuario_rel.cod as usuario_cod,
                 usuario_rel.nome as usuario_nome,
                 usuario_rel.mail as usuario_mail,
                 usuario_rel.senha as usuario_senha,
                 usuario_rel.grupo as usuario_grupo ,
                 seo_rel.cod as seo_cod,
                 seo_rel.titulo as seo_titulo,
                 seo_rel.descricao as seo_descricao ,
                 imagem_rel.cod as imagem_cod,
                 imagem_rel.valor as imagem_valor  ";

        $leftjoin = "LEFT JOIN jqueryadminuser usuario_rel ON equiz.usuario = usuario_rel.cod 
                LEFT JOIN jqueryseo seo_rel ON equiz.seo = seo_rel.cod 
                LEFT JOIN jqueryimage imagem_rel ON equiz.imagem = imagem_rel.cod 
                ";

        $dados = dataListar($Conexao, 'equiz', $where, $orderBy, $limit, $select, $leftjoin);
        $dados = dbEquiz::CorrigeValoresSimplesAll($dados);

        if (!issetArray($dados)) {
            return false;
        }

        return $dados;
    }

    /**
     * @return objEquiz[]
     */
    public static function ObjsList($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbEquiz::Listar($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objEquiz($Conexao);
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
     * @return objEquiz[]
     */
    public static function ObjsListLeft($Conexao, $where = "", $orderBy = "", $limit = "") {
        $dados = dbEquiz::ListarLeft($Conexao, $where, $orderBy, $limit);
        $objs = array();
        if (issetArray($dados)) {
            foreach ($dados as $registro) {
                $obj = new objEquiz($Conexao);
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
            $filefolder = ___AppRoot . "adm/equiz/templates/";

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
                        if ($obj instanceof objEquiz) {
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
        if ($dados['data'])
            $dados['data'] = Fncs_LerDataTime($dados['data']);

        return $dados;
    }

    private static function CorrigeValoresSimplesAll($dados) {
        if ((!isset($dados)) || (!is_array($dados)))
            return "";

        foreach ($dados as $key => $value) {
            if ($dados[$key]['data'])
                $dados[$key]['data'] = Fncs_LerDataTime($value['data']);
        }

        return $dados;
    }

}

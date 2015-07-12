<?php

/**
 * @property objJqueryadmingrupo $_objJqueryadmingrupo
 * 
 */
class fbaseJqueryadminuser {
    
// <editor-fold defaultstate="collapsed" desc="Propriedades">
    
    protected $Conexao;
    protected $die;
        
    protected $cod;
    protected $nome;
    protected $mail;
    protected $senha;
    protected $grupo;
    
    
    protected $_objGrupo;
    
    
// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets And Sets">
    
    public function getCod() { 
         return $this->cod; 
    } 

    public function setCod($cod) { 
         $this->cod = $cod; 
         return $this; 
    }

    public function getNome() { 
         return $this->nome; 
    } 

    public function setNome($nome) { 
         $this->nome = $nome; 
         return $this; 
    }

    public function getMail() { 
         return $this->mail; 
    } 

    public function setMail($mail) { 
         $this->mail = $mail; 
         return $this; 
    }

    public function getSenha() { 
         return $this->senha; 
    } 

    public function setSenha($senha) { 
         $this->senha = $senha; 
         return $this; 
    }

    public function getGrupo() { 
         return $this->grupo; 
    } 

    public function setGrupo($grupo) { 
         $this->grupo = $grupo; 
         return $this; 
    }

    

// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets Especiais">
    
    

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Objetos Associados">

    
    /**
     * Obtem a associacao entre jqueryadminuser.grupo => jqueryadmingrupo.cod
     * @return objJqueryadmingrupo
     */
    public function objGrupo(){
        if (! isset($this->_objGrupo)) { 
            $obj = new objJqueryadmingrupo($this->Conexao, false); 
            $obj->loadByCod($this->grupo); 
            $this->_objGrupo = $obj; 
        } 
        
        return $this->_objGrupo; 
    }
         
        
            
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Load And Save">

    public function loadByArray($registro, $prefixArr = '') {
        $load = false;
        if (isset($registro[$prefixArr . 'cod'])) {
            $this->setCod($registro[$prefixArr . 'cod']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'nome'])) {
            $this->setNome($registro[$prefixArr . 'nome']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'mail'])) {
            $this->setMail($registro[$prefixArr . 'mail']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'senha'])) {
            $this->setSenha($registro[$prefixArr . 'senha']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'grupo'])) {
            $this->setGrupo($registro[$prefixArr . 'grupo']); 
            $load = true;
        } 

        
        
        if (!$load && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro, não existe ou incopativel.");
        }
        
        return $load;
    }
    
    public function loadByCod($valor, $campo = 'cod') {
        $registro = dbJqueryadminuser::Carregar($this->Conexao, $valor, $campo);
        
        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByArray($registro) {
        
        $obj = new objJqueryadmingrupo($this->Conexao, false);
        $obj->loadByArray($registro, 'grupo_');
        $this->_objGrupo = $obj;                
                
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByCod($valor, $campo = 'cod') {
        $registro = dbJqueryadminuser::CarregarLeft($this->Conexao, $valor, $campo);

        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadLeftByArray($registro);
    }
    
    public function Save() {
        if (isset($this->cod) && is_numeric($this->cod)) {
            return dbJqueryadminuser::Update($this->Conexao, $this->getcod(),$this->getnome(),$this->getmail(),$this->getsenha(),$this->getgrupo());
        } else {    
            $this->cod = dbJqueryadminuser::Inserir($this->Conexao, $this->getnome(),$this->getmail(),$this->getsenha(),$this->getgrupo());
            return $this->cod != 0;
        }      
    }
    
    public function Delete() {
        return dbJqueryadminuser::Deletar($this->Conexao, $this->cod);
    }

    
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Stringuize">

    public function getHtmlTemplateString($html, $prefix = '') {
        $methods = @get_class_methods($this);
        if (!issetArray($methods))
            return $html;

        //Caso Vazia
        if ($html == "") {
            $this->die = false;
            echo "\nMetodo Permitidos para objJqueryadminuser: [";
            foreach ($methods as $method) {
                if (strpos($method, "get") !== false && strpos($method, "get") == 0) {
                    echo "\n\t[$method]";
                } elseif (strpos($method, "obj") !== false && strpos($method, "obj") == 0) {
                    $obj = call_user_func(array($this, $method));
                    echo "\n\n" . $method . "->";
                    $obj->getHtmlTemplateString($html);
                }
            }
            echo "\n]";

            if ($this->die)
                die("<h1>Valor para html nao pode ser nulo</h1>");
        }

        //Objs
        $methodsArr = array();
        foreach ($methods as $method) {
            if (strpos($method, "obj") !== false && strpos($method, "obj") == 0) {
                if (strpos($html, $method . "->") !== false) {
                    $methodsArr[] = $method;
                }
            }
        }
        
        if (issetArray($methodsArr)) {
            usort($methodsArr, "stringuizeCmp");

            foreach ($methodsArr as $method) {
                try {
                    $obj = call_user_func(array($this, $method));
                    if (is_object($obj)) {
                        $html = $obj->getHtmlTemplateString($html, $method . "->");
                    }
                } catch (Exception $exc) {
                    unset($exc);
                }

                $html = str_replace($prefix . $method . "->", "", $html);
            }
        }
                
        //Gets
        $methodsArr = array();
        foreach ($methods as $method) {
            if (strpos($method, "get") !== false && strpos($method, "get") == 0 && strpos($html, $method)) {
                $methodsArr[] = $method;
            }
        }
        
        if (issetArray($methodsArr)) {
            usort($methodsArr, "stringuizeCmp");

            foreach ($methodsArr as $method) {
                if (preg_match_all("/$method\((.*)\)/", $html, $matches)) {
                    for ($index = 0; $index < count($matches[0]); $index++) {
                        $params = explode(",", $matches[1][$index]);
                        $params = array_map('trim', $params);
                        $params = array_filter($params);
                        
                        $valor = @call_user_func_array(array($this, $method), $params);
                        if (isset($valor) && $valor !== false) {
                            $html = str_replace($prefix . $matches[0][$index], $valor, $html);
                        } else {
                            $html = str_replace($prefix . $matches[0][$index], '', $html);
                        }
                    }
                } else {
                    $valor = @call_user_func(array($this, $method));
                    if (isset($valor) && $valor !== false) {
                        $html = str_replace($prefix . $method, $valor, $html);
                    } else {
                        $html = str_replace($prefix . $method, '', $html);
                    }
                }
            }
        }
        
        //Traduz e retorna        
        $html = internacionalizacao::TraduzirString($html);
        $html = Fncs_TemplateHtml($html);
        return $html;
    }

    public function getHtmlTemplateFile($file, $folder = "~/adm/jqueryadminuser/templates/") {
        if (!$file) {
            $file = "__reference.html";
        }
        
        $folder = str_replace("~/", ___AppRoot, $folder);
        $html = arquivos::ler($folder . $file);
        return $this->getHtmlTemplateString($html);
    }
    
// </editor-fold>

    function __construct($Conexao, $die = true) {
        $this->Conexao = $Conexao;
        
        $this->die = $die;
    }
    
    public static function init($valor, $campo = 'cod', $die = true, $Conexao = null) {
        if (!isset($Conexao)) {
            global $Conexao;
        }
        
        $obj = new objJqueryadminuser($Conexao, $die);
        $obj->loadByCod($valor, $campo);

        return $obj;
    }
    
}
<?php

/**
 * @property objJqueryadmingrupo $_objJqueryadmingrupo
 * @property objJqueryadminmenu $_objJqueryadminmenu
 * 
 */
class fbaseJqueryadmingrupo2menu {
    
// <editor-fold defaultstate="collapsed" desc="Propriedades">
    
    protected $Conexao;
    protected $die;
        
    protected $cod;
    protected $jqueryadmingrupo;
    protected $jqueryadminmenu;
    
    
    protected $_objJqueryadmingrupo;
    protected $_objJqueryadminmenu;
    
    
// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets And Sets">
    
    public function getCod() { 
         return $this->cod; 
    } 

    public function setCod($cod) { 
         $this->cod = $cod; 
         return $this; 
    }

    public function getJqueryadmingrupo() { 
         return $this->jqueryadmingrupo; 
    } 

    public function setJqueryadmingrupo($jqueryadmingrupo) { 
         $this->jqueryadmingrupo = $jqueryadmingrupo; 
         return $this; 
    }

    public function getJqueryadminmenu() { 
         return $this->jqueryadminmenu; 
    } 

    public function setJqueryadminmenu($jqueryadminmenu) { 
         $this->jqueryadminmenu = $jqueryadminmenu; 
         return $this; 
    }

    

// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets Especiais">
    
    

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Objetos Associados">

    
    /**
     * Obtem a associacao entre jqueryadmingrupo2menu.jqueryadmingrupo => jqueryadmingrupo.cod
     * @return objJqueryadmingrupo
     */
    public function objJqueryadmingrupo(){
        if (! isset($this->_objJqueryadmingrupo)) { 
            $obj = new objJqueryadmingrupo($this->Conexao, false); 
            $obj->loadByCod($this->jqueryadmingrupo); 
            $this->_objJqueryadmingrupo = $obj; 
        } 
        
        return $this->_objJqueryadmingrupo; 
    }
         
        
    /**
     * Obtem a associacao entre jqueryadmingrupo2menu.jqueryadminmenu => jqueryadminmenu.cod
     * @return objJqueryadminmenu
     */
    public function objJqueryadminmenu(){
        if (! isset($this->_objJqueryadminmenu)) { 
            $obj = new objJqueryadminmenu($this->Conexao, false); 
            $obj->loadByCod($this->jqueryadminmenu); 
            $this->_objJqueryadminmenu = $obj; 
        } 
        
        return $this->_objJqueryadminmenu; 
    }
         
        
            
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Load And Save">

    public function loadByArray($registro, $prefixArr = '') {
        $load = false;
        if (isset($registro[$prefixArr . 'cod'])) {
            $this->setCod($registro[$prefixArr . 'cod']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'jqueryadmingrupo'])) {
            $this->setJqueryadmingrupo($registro[$prefixArr . 'jqueryadmingrupo']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'jqueryadminmenu'])) {
            $this->setJqueryadminmenu($registro[$prefixArr . 'jqueryadminmenu']); 
            $load = true;
        } 

        
        
        if (!$load && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro, não existe ou incopativel.");
        }
        
        return $load;
    }
    
    public function loadByCod($valor, $campo = 'cod') {
        $registro = dbJqueryadmingrupo2menu::Carregar($this->Conexao, $valor, $campo);
        
        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByArray($registro) {
        
        $obj = new objJqueryadmingrupo($this->Conexao, false);
        $obj->loadByArray($registro, 'jqueryadmingrupo_');
        $this->_objJqueryadmingrupo = $obj;                
        
        $obj = new objJqueryadminmenu($this->Conexao, false);
        $obj->loadByArray($registro, 'jqueryadminmenu_');
        $this->_objJqueryadminmenu = $obj;                
                
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByCod($valor, $campo = 'cod') {
        $registro = dbJqueryadmingrupo2menu::CarregarLeft($this->Conexao, $valor, $campo);

        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadLeftByArray($registro);
    }
    
    public function Save() {
        if (isset($this->cod) && is_numeric($this->cod)) {
            return dbJqueryadmingrupo2menu::Update($this->Conexao, $this->getcod(),$this->getjqueryadmingrupo(),$this->getjqueryadminmenu());
        } else {    
            $this->cod = dbJqueryadmingrupo2menu::Inserir($this->Conexao, $this->getjqueryadmingrupo(),$this->getjqueryadminmenu());
            return $this->cod != 0;
        }      
    }
    
    public function Delete() {
        return dbJqueryadmingrupo2menu::Deletar($this->Conexao, $this->cod);
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
            echo "\nMetodo Permitidos para objJqueryadmingrupo2menu: [";
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

    public function getHtmlTemplateFile($file, $folder = "~/adm/jqueryadmingrupo2menu/templates/") {
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
        
        $obj = new objJqueryadmingrupo2menu($Conexao, $die);
        $obj->loadByCod($valor, $campo);

        return $obj;
    }
    
}
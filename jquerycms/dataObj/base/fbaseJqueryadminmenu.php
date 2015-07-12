<?php

/**
 * @property objJqueryadminmenu $_objJqueryadminmenu
 * @property objJqueryimage $_objJqueryimage
 * 
 */
class fbaseJqueryadminmenu {
    
// <editor-fold defaultstate="collapsed" desc="Propriedades">
    
    protected $Conexao;
    protected $die;
        
    protected $cod;
    protected $codmenu;
    protected $titulo;
    protected $patch;
    protected $icon;
    protected $addhtml;
    protected $ordem;
    
    
    protected $_objCodmenu;
    protected $_objIcon;
    
    
// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets And Sets">
    
    public function getCod() { 
         return $this->cod; 
    } 

    public function setCod($cod) { 
         $this->cod = $cod; 
         return $this; 
    }

    public function getCodmenu() { 
         return $this->codmenu; 
    } 

    public function setCodmenu($codmenu) { 
         $this->codmenu = $codmenu; 
         return $this; 
    }

    public function getTitulo() { 
         return $this->titulo; 
    } 

    public function setTitulo($titulo) { 
         $this->titulo = $titulo; 
         return $this; 
    }

    public function getPatch() { 
         return $this->patch; 
    } 

    public function setPatch($patch) { 
         $this->patch = $patch; 
         return $this; 
    }

    public function getIcon() { 
         return $this->icon; 
    } 

    public function setIcon($icon) { 
         $this->icon = $icon; 
         return $this; 
    }

    public function getAddhtml() { 
         return $this->addhtml; 
    } 

    public function setAddhtml($addhtml) { 
         $this->addhtml = $addhtml; 
         return $this; 
    }

    public function getOrdem() { 
         return $this->ordem; 
    } 

    public function setOrdem($ordem) { 
         $this->ordem = $ordem; 
         return $this; 
    }

    

// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets Especiais">
    
    

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Objetos Associados">

    
    /**
     * Obtem a associacao entre jqueryadminmenu.codmenu => jqueryadminmenu.cod
     * @return objJqueryadminmenu
     */
    public function objCodmenu(){
        if (! isset($this->_objCodmenu)) { 
            $obj = new objJqueryadminmenu($this->Conexao, false); 
            $obj->loadByCod($this->codmenu); 
            $this->_objCodmenu = $obj; 
        } 
        
        return $this->_objCodmenu; 
    }
         
        
    /**
     * Obtem a associacao entre jqueryadminmenu.icon => jqueryimage.cod
     * @return objJqueryimage
     */
    public function objIcon(){
        if (! isset($this->_objIcon)) { 
            $obj = new objJqueryimage($this->Conexao, false); 
            $obj->loadByCod($this->icon); 
            $this->_objIcon = $obj; 
        } 
        
        return $this->_objIcon; 
    }
         
        
            
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Load And Save">

    public function loadByArray($registro, $prefixArr = '') {
        $load = false;
        if (isset($registro[$prefixArr . 'cod'])) {
            $this->setCod($registro[$prefixArr . 'cod']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'codmenu'])) {
            $this->setCodmenu($registro[$prefixArr . 'codmenu']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'titulo'])) {
            $this->setTitulo($registro[$prefixArr . 'titulo']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'patch'])) {
            $this->setPatch($registro[$prefixArr . 'patch']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'icon'])) {
            $this->setIcon($registro[$prefixArr . 'icon']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'addhtml'])) {
            $this->setAddhtml($registro[$prefixArr . 'addhtml']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'ordem'])) {
            $this->setOrdem($registro[$prefixArr . 'ordem']); 
            $load = true;
        } 

        
        
        if (!$load && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro, não existe ou incopativel.");
        }
        
        return $load;
    }
    
    public function loadByCod($valor, $campo = 'cod') {
        $registro = dbJqueryadminmenu::Carregar($this->Conexao, $valor, $campo);
        
        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByArray($registro) {
        
        $obj = new objJqueryadminmenu($this->Conexao, false);
        $obj->loadByArray($registro, 'codmenu_');
        $this->_objCodmenu = $obj;                
        
        $obj = new objJqueryimage($this->Conexao, false);
        $obj->loadByArray($registro, 'icon_');
        $this->_objIcon = $obj;                
                
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByCod($valor, $campo = 'cod') {
        $registro = dbJqueryadminmenu::CarregarLeft($this->Conexao, $valor, $campo);

        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadLeftByArray($registro);
    }
    
    public function Save() {
        if (isset($this->cod) && is_numeric($this->cod)) {
            return dbJqueryadminmenu::Update($this->Conexao, $this->getcod(),$this->getcodmenu(),$this->gettitulo(),$this->getpatch(),$this->geticon(),$this->getaddhtml(),$this->getordem());
        } else {    
            $this->cod = dbJqueryadminmenu::Inserir($this->Conexao, $this->getcodmenu(),$this->gettitulo(),$this->getpatch(),$this->geticon(),$this->getaddhtml(),$this->getordem());
            return $this->cod != 0;
        }      
    }
    
    public function Delete() {
        return dbJqueryadminmenu::Deletar($this->Conexao, $this->cod);
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
            echo "\nMetodo Permitidos para objJqueryadminmenu: [";
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

    public function getHtmlTemplateFile($file, $folder = "~/adm/jqueryadminmenu/templates/") {
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
        
        $obj = new objJqueryadminmenu($Conexao, $die);
        $obj->loadByCod($valor, $campo);

        return $obj;
    }
    
}
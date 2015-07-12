<?php

/**
 * @property objJqueryimage $_objJqueryimage
 * @property objJqueryimagelist $_objJqueryimagelist
 * 
 */
class fbaseJqueryimagelistitem {
    
// <editor-fold defaultstate="collapsed" desc="Propriedades">
    
    protected $Conexao;
    protected $die;
        
    protected $cod;
    protected $jqueryimagelist;
    protected $jqueryimage;
    protected $titulo;
    protected $link;
    protected $target;
    protected $descricao;
    protected $ordem;
    protected $principal;
    
    
    protected $_objJqueryimage;
    protected $_objJqueryimagelist;
    
    
// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets And Sets">
    
    public function getCod() { 
         return $this->cod; 
    } 

    public function setCod($cod) { 
         $this->cod = $cod; 
         return $this; 
    }

    public function getJqueryimagelist() { 
         return $this->jqueryimagelist; 
    } 

    public function setJqueryimagelist($jqueryimagelist) { 
         $this->jqueryimagelist = $jqueryimagelist; 
         return $this; 
    }

    public function getJqueryimage() { 
         return $this->jqueryimage; 
    } 

    public function setJqueryimage($jqueryimage) { 
         $this->jqueryimage = $jqueryimage; 
         return $this; 
    }

    public function getTitulo() { 
         return $this->titulo; 
    } 

    public function setTitulo($titulo) { 
         $this->titulo = $titulo; 
         return $this; 
    }

    public function getLink() { 
         return $this->link; 
    } 

    public function setLink($link) { 
         $this->link = $link; 
         return $this; 
    }

    public function getTarget() { 
         return $this->target; 
    } 

    public function setTarget($target) { 
         $this->target = $target; 
         return $this; 
    }

    public function getDescricao() { 
         return $this->descricao; 
    } 

    public function setDescricao($descricao) { 
         $this->descricao = $descricao; 
         return $this; 
    }

    public function getOrdem() { 
         return $this->ordem; 
    } 

    public function setOrdem($ordem) { 
         $this->ordem = $ordem; 
         return $this; 
    }

    public function getPrincipal() { 
         return $this->principal; 
    } 

    public function setPrincipal($principal) { 
         $this->principal = $principal; 
         return $this; 
    }

    

// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets Especiais">
    
    

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Objetos Associados">

    
    /**
     * Obtem a associacao entre jqueryimagelistitem.jqueryimage => jqueryimage.cod
     * @return objJqueryimage
     */
    public function objJqueryimage(){
        if (! isset($this->_objJqueryimage)) { 
            $obj = new objJqueryimage($this->Conexao, false); 
            $obj->loadByCod($this->jqueryimage); 
            $this->_objJqueryimage = $obj; 
        } 
        
        return $this->_objJqueryimage; 
    }
         
        
    /**
     * Obtem a associacao entre jqueryimagelistitem.jqueryimagelist => jqueryimagelist.cod
     * @return objJqueryimagelist
     */
    public function objJqueryimagelist(){
        if (! isset($this->_objJqueryimagelist)) { 
            $obj = new objJqueryimagelist($this->Conexao, false); 
            $obj->loadByCod($this->jqueryimagelist); 
            $this->_objJqueryimagelist = $obj; 
        } 
        
        return $this->_objJqueryimagelist; 
    }
         
        
            
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Load And Save">

    public function loadByArray($registro, $prefixArr = '') {
        $load = false;
        if (isset($registro[$prefixArr . 'cod'])) {
            $this->setCod($registro[$prefixArr . 'cod']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'jqueryimagelist'])) {
            $this->setJqueryimagelist($registro[$prefixArr . 'jqueryimagelist']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'jqueryimage'])) {
            $this->setJqueryimage($registro[$prefixArr . 'jqueryimage']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'titulo'])) {
            $this->setTitulo($registro[$prefixArr . 'titulo']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'link'])) {
            $this->setLink($registro[$prefixArr . 'link']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'target'])) {
            $this->setTarget($registro[$prefixArr . 'target']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'descricao'])) {
            $this->setDescricao($registro[$prefixArr . 'descricao']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'ordem'])) {
            $this->setOrdem($registro[$prefixArr . 'ordem']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'principal'])) {
            $this->setPrincipal($registro[$prefixArr . 'principal']); 
            $load = true;
        } 

        
        
        if (!$load && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro, não existe ou incopativel.");
        }
        
        return $load;
    }
    
    public function loadByCod($valor, $campo = 'cod') {
        $registro = dbJqueryimagelistitem::Carregar($this->Conexao, $valor, $campo);
        
        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByArray($registro) {
        
        $obj = new objJqueryimage($this->Conexao, false);
        $obj->loadByArray($registro, 'jqueryimage_');
        $this->_objJqueryimage = $obj;                
        
        $obj = new objJqueryimagelist($this->Conexao, false);
        $obj->loadByArray($registro, 'jqueryimagelist_');
        $this->_objJqueryimagelist = $obj;                
                
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByCod($valor, $campo = 'cod') {
        $registro = dbJqueryimagelistitem::CarregarLeft($this->Conexao, $valor, $campo);

        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadLeftByArray($registro);
    }
    
    public function Save() {
        if (isset($this->cod) && is_numeric($this->cod)) {
            return dbJqueryimagelistitem::Update($this->Conexao, $this->getcod(),$this->getjqueryimagelist(),$this->getjqueryimage(),$this->gettitulo(),$this->getlink(),$this->gettarget(),$this->getdescricao(),$this->getordem(),$this->getprincipal());
        } else {    
            $this->cod = dbJqueryimagelistitem::Inserir($this->Conexao, $this->getjqueryimagelist(),$this->getjqueryimage(),$this->gettitulo(),$this->getlink(),$this->gettarget(),$this->getdescricao(),$this->getordem(),$this->getprincipal());
            return $this->cod != 0;
        }      
    }
    
    public function Delete() {
        return dbJqueryimagelistitem::Deletar($this->Conexao, $this->cod);
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
            echo "\nMetodo Permitidos para objJqueryimagelistitem: [";
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

    public function getHtmlTemplateFile($file, $folder = "~/adm/jqueryimagelistitem/templates/") {
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
        
        $obj = new objJqueryimagelistitem($Conexao, $die);
        $obj->loadByCod($valor, $campo);

        return $obj;
    }
    
}
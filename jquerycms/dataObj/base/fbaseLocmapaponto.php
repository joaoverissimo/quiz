<?php

/**

 * 
 */
class fbaseLocmapaponto {
    
// <editor-fold defaultstate="collapsed" desc="Propriedades">
    
    protected $Conexao;
    protected $die;
        
    protected $cod;
    protected $lat;
    protected $lng;
    protected $heading;
    protected $pitch;
    protected $zoom;
    protected $comportamento;
    protected $suportaview;
    
    
    
    
// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets And Sets">
    
    public function getCod() { 
         return $this->cod; 
    } 

    public function setCod($cod) { 
         $this->cod = $cod; 
         return $this; 
    }

    public function getLat() { 
         return $this->lat; 
    } 

    public function setLat($lat) { 
         $this->lat = $lat; 
         return $this; 
    }

    public function getLng() { 
         return $this->lng; 
    } 

    public function setLng($lng) { 
         $this->lng = $lng; 
         return $this; 
    }

    public function getHeading() { 
         return $this->heading; 
    } 

    public function setHeading($heading) { 
         $this->heading = $heading; 
         return $this; 
    }

    public function getPitch() { 
         return $this->pitch; 
    } 

    public function setPitch($pitch) { 
         $this->pitch = $pitch; 
         return $this; 
    }

    public function getZoom() { 
         return $this->zoom; 
    } 

    public function setZoom($zoom) { 
         $this->zoom = $zoom; 
         return $this; 
    }

    public function getComportamento() { 
         return $this->comportamento; 
    } 

    public function setComportamento($comportamento) { 
         $this->comportamento = $comportamento; 
         return $this; 
    }

    public function getSuportaview() { 
         return $this->suportaview; 
    } 

    public function setSuportaview($suportaview) { 
         $this->suportaview = $suportaview; 
         return $this; 
    }

    

// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets Especiais">
    
    

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Objetos Associados">

    
            
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Load And Save">

    public function loadByArray($registro, $prefixArr = '') {
        $load = false;
        if (isset($registro[$prefixArr . 'cod'])) {
            $this->setCod($registro[$prefixArr . 'cod']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'lat'])) {
            $this->setLat($registro[$prefixArr . 'lat']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'lng'])) {
            $this->setLng($registro[$prefixArr . 'lng']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'heading'])) {
            $this->setHeading($registro[$prefixArr . 'heading']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'pitch'])) {
            $this->setPitch($registro[$prefixArr . 'pitch']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'zoom'])) {
            $this->setZoom($registro[$prefixArr . 'zoom']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'comportamento'])) {
            $this->setComportamento($registro[$prefixArr . 'comportamento']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'suportaview'])) {
            $this->setSuportaview($registro[$prefixArr . 'suportaview']); 
            $load = true;
        } 

        
        
        if (!$load && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro, não existe ou incopativel.");
        }
        
        return $load;
    }
    
    public function loadByCod($valor, $campo = 'cod') {
        $registro = dbLocmapaponto::Carregar($this->Conexao, $valor, $campo);
        
        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByArray($registro) {
                
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByCod($valor, $campo = 'cod') {
        $registro = dbLocmapaponto::CarregarLeft($this->Conexao, $valor, $campo);

        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadLeftByArray($registro);
    }
    
    public function Save() {
        if (isset($this->cod) && is_numeric($this->cod)) {
            return dbLocmapaponto::Update($this->Conexao, $this->getcod(),$this->getlat(),$this->getlng(),$this->getheading(),$this->getpitch(),$this->getzoom(),$this->getcomportamento(),$this->getsuportaview());
        } else {    
            $this->cod = dbLocmapaponto::Inserir($this->Conexao, $this->getlat(),$this->getlng(),$this->getheading(),$this->getpitch(),$this->getzoom(),$this->getcomportamento(),$this->getsuportaview());
            return $this->cod != 0;
        }      
    }
    
    public function Delete() {
        return dbLocmapaponto::Deletar($this->Conexao, $this->cod);
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
            echo "\nMetodo Permitidos para objLocmapaponto: [";
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

    public function getHtmlTemplateFile($file, $folder = "~/adm/locmapaponto/templates/") {
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
        
        $obj = new objLocmapaponto($Conexao, $die);
        $obj->loadByCod($valor, $campo);

        return $obj;
    }
    
}
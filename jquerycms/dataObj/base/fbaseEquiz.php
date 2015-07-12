<?php

/**
 * @property objJqueryimage $_objJqueryimage
 * @property objJqueryseo $_objJqueryseo
 * @property objJqueryadminuser $_objJqueryadminuser
 * 
 */
class fbaseEquiz {
    
// <editor-fold defaultstate="collapsed" desc="Propriedades">
    
    protected $Conexao;
    protected $die;
        
    protected $cod;
    protected $usuario;
    protected $seo;
    protected $titulo;
    protected $data;
    protected $imagem;
    protected $flaprovado;
    
    
    protected $_objImagem;
    protected $_objSeo;
    protected $_objUsuario;
    
    
// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets And Sets">
    
    public function getCod() { 
         return $this->cod; 
    } 

    public function setCod($cod) { 
         $this->cod = $cod; 
         return $this; 
    }

    public function getUsuario() { 
         return $this->usuario; 
    } 

    public function setUsuario($usuario) { 
         $this->usuario = $usuario; 
         return $this; 
    }

    public function getSeo() { 
         return $this->seo; 
    } 

    public function setSeo($seo) { 
         $this->seo = $seo; 
         return $this; 
    }

    public function getTitulo() { 
         return $this->titulo; 
    } 

    public function setTitulo($titulo) { 
         $this->titulo = $titulo; 
         return $this; 
    }

    public function getData() { 
         return $this->data; 
    } 

    public function setData($data) { 
         $this->data = $data; 
         return $this; 
    }

    public function getImagem() { 
         return $this->imagem; 
    } 

    public function setImagem($imagem) { 
         $this->imagem = $imagem; 
         return $this; 
    }

    public function getFlaprovado() { 
         return $this->flaprovado; 
    } 

    public function setFlaprovado($flaprovado) { 
         $this->flaprovado = $flaprovado; 
         return $this; 
    }

    

// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets Especiais">
    
    

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Objetos Associados">

    
    /**
     * Obtem a associacao entre equiz.imagem => jqueryimage.cod
     * @return objJqueryimage
     */
    public function objImagem(){
        if (! isset($this->_objImagem)) { 
            $obj = new objJqueryimage($this->Conexao, false); 
            $obj->loadByCod($this->imagem); 
            $this->_objImagem = $obj; 
        } 
        
        return $this->_objImagem; 
    }
         
        
    /**
     * Obtem a associacao entre equiz.seo => jqueryseo.cod
     * @return objJqueryseo
     */
    public function objSeo(){
        if (! isset($this->_objSeo)) { 
            $obj = new objJqueryseo($this->Conexao, false); 
            $obj->loadByCod($this->seo); 
            $this->_objSeo = $obj; 
        } 
        
        return $this->_objSeo; 
    }
         
        
    /**
     * Obtem a associacao entre equiz.usuario => jqueryadminuser.cod
     * @return objJqueryadminuser
     */
    public function objUsuario(){
        if (! isset($this->_objUsuario)) { 
            $obj = new objJqueryadminuser($this->Conexao, false); 
            $obj->loadByCod($this->usuario); 
            $this->_objUsuario = $obj; 
        } 
        
        return $this->_objUsuario; 
    }
         
        
            
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Load And Save">

    public function loadByArray($registro, $prefixArr = '') {
        $load = false;
        if (isset($registro[$prefixArr . 'cod'])) {
            $this->setCod($registro[$prefixArr . 'cod']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'usuario'])) {
            $this->setUsuario($registro[$prefixArr . 'usuario']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'seo'])) {
            $this->setSeo($registro[$prefixArr . 'seo']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'titulo'])) {
            $this->setTitulo($registro[$prefixArr . 'titulo']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'data'])) {
            $this->setData($registro[$prefixArr . 'data']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'imagem'])) {
            $this->setImagem($registro[$prefixArr . 'imagem']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'flaprovado'])) {
            $this->setFlaprovado($registro[$prefixArr . 'flaprovado']); 
            $load = true;
        } 

        
        
        if (!$load && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro, não existe ou incopativel.");
        }
        
        return $load;
    }
    
    public function loadByCod($valor, $campo = 'cod') {
        $registro = dbEquiz::Carregar($this->Conexao, $valor, $campo);
        
        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByArray($registro) {
        
        $obj = new objJqueryimage($this->Conexao, false);
        $obj->loadByArray($registro, 'imagem_');
        $this->_objImagem = $obj;                
        
        $obj = new objJqueryseo($this->Conexao, false);
        $obj->loadByArray($registro, 'seo_');
        $this->_objSeo = $obj;                
        
        $obj = new objJqueryadminuser($this->Conexao, false);
        $obj->loadByArray($registro, 'usuario_');
        $this->_objUsuario = $obj;                
                
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByCod($valor, $campo = 'cod') {
        $registro = dbEquiz::CarregarLeft($this->Conexao, $valor, $campo);

        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadLeftByArray($registro);
    }
    
    public function Save() {
        if (isset($this->cod) && is_numeric($this->cod)) {
            return dbEquiz::Update($this->Conexao, $this->getcod(),$this->getusuario(),$this->getseo(),$this->gettitulo(),$this->getdata(),$this->getimagem(),$this->getflaprovado());
        } else {    
            $this->cod = dbEquiz::Inserir($this->Conexao, $this->getusuario(),$this->getseo(),$this->gettitulo(),$this->getdata(),$this->getimagem(),$this->getflaprovado());
            return $this->cod != 0;
        }      
    }
    
    public function Delete() {
        return dbEquiz::Deletar($this->Conexao, $this->cod);
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
            echo "\nMetodo Permitidos para objEquiz: [";
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

    public function getHtmlTemplateFile($file, $folder = "~/adm/equiz/templates/") {
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
        
        $obj = new objEquiz($Conexao, $die);
        $obj->loadByCod($valor, $campo);

        return $obj;
    }
    
}
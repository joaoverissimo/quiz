<?php

/**
 * @property objJqueryimage $_objJqueryimage
 * @property objEquiz $_objEquiz
 * 
 */
class fbaseEresultado {
    
// <editor-fold defaultstate="collapsed" desc="Propriedades">
    
    protected $Conexao;
    protected $die;
        
    protected $cod;
    protected $quiz;
    protected $descricao;
    protected $texto;
    protected $imagem;
    
    
    protected $_objImagem;
    protected $_objQuiz;
    
    
// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets And Sets">
    
    public function getCod() { 
         return $this->cod; 
    } 

    public function setCod($cod) { 
         $this->cod = $cod; 
         return $this; 
    }

    public function getQuiz() { 
         return $this->quiz; 
    } 

    public function setQuiz($quiz) { 
         $this->quiz = $quiz; 
         return $this; 
    }

    public function getDescricao() { 
         return $this->descricao; 
    } 

    public function setDescricao($descricao) { 
         $this->descricao = $descricao; 
         return $this; 
    }

    public function getTexto() { 
         return $this->texto; 
    } 

    public function setTexto($texto) { 
         $this->texto = $texto; 
         return $this; 
    }

    public function getImagem() { 
         return $this->imagem; 
    } 

    public function setImagem($imagem) { 
         $this->imagem = $imagem; 
         return $this; 
    }

    

// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Gets Especiais">
    
    

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Objetos Associados">

    
    /**
     * Obtem a associacao entre eresultado.imagem => jqueryimage.cod
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
     * Obtem a associacao entre eresultado.quiz => equiz.cod
     * @return objEquiz
     */
    public function objQuiz(){
        if (! isset($this->_objQuiz)) { 
            $obj = new objEquiz($this->Conexao, false); 
            $obj->loadByCod($this->quiz); 
            $this->_objQuiz = $obj; 
        } 
        
        return $this->_objQuiz; 
    }
         
        
            
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Load And Save">

    public function loadByArray($registro, $prefixArr = '') {
        $load = false;
        if (isset($registro[$prefixArr . 'cod'])) {
            $this->setCod($registro[$prefixArr . 'cod']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'quiz'])) {
            $this->setQuiz($registro[$prefixArr . 'quiz']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'descricao'])) {
            $this->setDescricao($registro[$prefixArr . 'descricao']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'texto'])) {
            $this->setTexto($registro[$prefixArr . 'texto']); 
            $load = true;
        } 

        if (isset($registro[$prefixArr . 'imagem'])) {
            $this->setImagem($registro[$prefixArr . 'imagem']); 
            $load = true;
        } 

        
        
        if (!$load && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro, não existe ou incopativel.");
        }
        
        return $load;
    }
    
    public function loadByCod($valor, $campo = 'cod') {
        $registro = dbEresultado::Carregar($this->Conexao, $valor, $campo);
        
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
        
        $obj = new objEquiz($this->Conexao, false);
        $obj->loadByArray($registro, 'quiz_');
        $this->_objQuiz = $obj;                
                
        return $this->loadByArray($registro);
    }
    
    public function loadLeftByCod($valor, $campo = 'cod') {
        $registro = dbEresultado::CarregarLeft($this->Conexao, $valor, $campo);

        if ($registro === false && $this->die) {
            throw new jquerycmsException("Problemas ao carregar o registro $valor, não existe.");
        } elseif ($registro === false) {
            return false;
        }
        
        return $this->loadLeftByArray($registro);
    }
    
    public function Save() {
        if (isset($this->cod) && is_numeric($this->cod)) {
            return dbEresultado::Update($this->Conexao, $this->getcod(),$this->getquiz(),$this->getdescricao(),$this->gettexto(),$this->getimagem());
        } else {    
            $this->cod = dbEresultado::Inserir($this->Conexao, $this->getquiz(),$this->getdescricao(),$this->gettexto(),$this->getimagem());
            return $this->cod != 0;
        }      
    }
    
    public function Delete() {
        return dbEresultado::Deletar($this->Conexao, $this->cod);
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
            echo "\nMetodo Permitidos para objEresultado: [";
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

    public function getHtmlTemplateFile($file, $folder = "~/adm/eresultado/templates/") {
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
        
        $obj = new objEresultado($Conexao, $die);
        $obj->loadByCod($valor, $campo);

        return $obj;
    }
    
}
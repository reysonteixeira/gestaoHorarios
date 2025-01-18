<?php

    use Rain\Tpl;


    class Page{
        private $tpl;
        private $options = [];
        private $defaults = [
            "data"=>[],
            "header"=>true,
            "footer"=>true
        ];
        public function __construct($opts=array(), $tpl_dir="/views/"){
           
            $this->options = array_merge($this->defaults, $opts);
            $config = array(
                "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
                "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
                "debug"         => false
               );

            Tpl::configure( $config );
            $this->tpl = new Tpl;
            $this->setData($this->options["data"]);
            if($this->options["header"] === true){
                if(isset($_SESSION["acessoCovid"]["permissao"])){
                    $this->tpl->assign("permissaoCovid", $_SESSION["acessoCovid"]["permissao"]);
                    $this->tpl->assign("permissaoMenu", 0);
                }else if (isset($_SESSION["tipoAcesso"])){
                    $this->tpl->assign("permissaoMenu",  $_SESSION["tipoAcesso"]);
                
                }
                $this->tpl->draw("header");

               
                
            }
         
            
        }

        public function setData($data=array()){
            foreach($data as $key => $value){
                $this->tpl->assign($key, $value);
            }
        }

        public function setTpl($name, $data=array(), $returnHtlm = false){
            $this->setData($data);
            return ($this->tpl->draw($name, $returnHtlm));
        }

        public function __destruct(){
            if($this->options["header"] === true){
                $this->tpl->draw("footer");
            }
            
        }
    }
?>
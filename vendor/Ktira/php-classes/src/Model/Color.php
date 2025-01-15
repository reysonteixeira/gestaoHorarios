<?php
  namespace Ktira\Model;

  use \Ktira\DB\Sql;

  class Color{
        private $id;
        private $name;
        private $valor;

        
        public static function listAll(){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tblProductsColor");
        }

        public function setDadosForm($post){
            $this->setName($post["txtName"]);
            $this->setValor($post["txtValor"]);
        }

        public function save(){
            $sql = new Sql();
            $sql->select("CALL spColorsSave(:name, :valor)", array(":name"=>$this->getName(), ":valor"=>$this->getValor()));
        }

        public function update(){
                $sql = new Sql();
                $sql->select("CALL spColorsUpdate(:id, :name, :valor)", 
                array(":id"=>$this->getId(),":name"=>$this->getName(), ":valor"=>$this->getValor()));
        }
    

       

        public function delete(){
            $sql = new Sql();
            $sql->query("DELETE FROM tblProductsColor WHERE idColor = :color", array(":color"=>$this->getId()));
        }


        public function get(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblProductsColor WHERE idColor = :id", array(":id"=>$this->getId()));
        }
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of valor
         */ 
        public function getValor()
        {
                return $this->valor;
        }

        /**
         * Set the value of valor
         *
         * @return  self
         */ 
        public function setValor($valor)
        {
                $this->valor = $valor;

                return $this;
        }
  }

?>
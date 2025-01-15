<?php

    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class Provider{
        private $id;
        private $name;
        private $cnpj;
        private $phone;

        public static function listAll(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblProvider");
        }
      
        public function setDados($post){
                $this->setName($post["txtName"]);
                $this->setCnpj($post["txtCnpj"]);
                $this->setPhone($post["txtPhone"]);
        }

        public function save(){
                $sql = new Sql();
                $sql->select("CALL spProvidersSave(:name, :cnpj, :phone)", array(":name"=>$this->getName(),
                ":cnpj"=>$this->getCnpj(), ":phone"=>$this->getPhone()));
        }
        
        public function update(){
                $sql = new Sql();
                $sql->select("CALL spProvidersUpdate(:id, :name, :cnpj, :phone)", array(":id"=>$this->getId(),
                ":name"=>$this->getName(),":cnpj"=>$this->getCnpj(), ":phone"=>$this->getPhone()));
        }

        public function delete(){
                $sql = new Sql();
                $sql->query("DELETE FROM tblProvider where idProvider =:id", array(":id"=>$this->getId()));
        }




        public function get(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblProvider WHERE idProvider = :id",
                array(":id"=>$this->getId()))[0];
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
         */ 
        public function setId($id)
        {
                $this->id = $id;
        }

        /**
         * Get the value of cnpj
         */ 
        public function getCnpj()
        {
                return $this->cnpj;
        }

        /**
         * Set the value of cnpj
         */ 
        public function setCnpj($cnpj)
        {
                $this->cnpj = $cnpj;
        }

        /**
         * Get the value of phone
         */ 
        public function getPhone()
        {
                return $this->phone;
        }

        /**
         * Set the value of phone
         */ 
        public function setPhone($phone)
        {
                $this->phone = $phone;
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
         */ 
        public function setName($name)
        {
                $this->name = $name;
        }
    }
?>
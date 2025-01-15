<?php

    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class Person{
        private $id;
        private $name;
        private $cpf;
        private $phoneNumber;



        public function getAddress(){
                $sql = new Sql();
                return $sql->select("SELECT * from tblAddress a inner join tblPersons p on a.fkPerson = p.idtblPerson where p.idtblPerson = :id;",
                array(":id"=>$this->getId()));
        }

        public function setDadosForm($post){
                $this->setName($post["txtName"]);
                $this->setCpf($post["txtCpf"]);
                $this->setPhoneNumber($post["txtPhone"]);
               
        }

        public function update(){
                $sql = new Sql();
                $sql->select("CALL sp_personsupdate_save(:pid, :ptxtName, :ptxtCPF, :ptxtPhoneNumber)",
                array(":pid"=>$this->getId(), ":ptxtName"=>$this->getName(), ":ptxtCPF"=>$this->getCpf(),
                ":ptxtPhoneNumber"=>$this->getPhoneNumber()));
        }

        public function delete(){
                $sql = new Sql();
                $sql->select("CALL sp_persons_delete(:pid)", array(":pid"=>$this->getId()));
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
         * Get the value of cpf
         */ 
        public function getCpf()
        {
                return $this->cpf;
        }

        /**
         * Set the value of cpf
         */ 
        public function setCpf($cpf)
        {
                $this->cpf = $cpf;

                return $this;
        }

        /**
         * Get the value of phoneNumber
         */ 
        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        /**
         * Set the value of phoneNumber
         */ 
        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;
        }
    }


?>
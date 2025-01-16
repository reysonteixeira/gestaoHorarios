<?php
    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class Category{

        private $id;
        private $name;
       
        static public function listAll(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblCategory;");
        }

        public function save(){
                $sql = new Sql();
                $sql->select("CALL spCategorySave(:name);", array(":name"=>$this->getName()));
        }


        public function update(){
                $sql = new Sql();
                $sql->select("CALL spCategoryUpdate(:id,:name);", 
                array(":id"=>$this->getId(), ":name"=>$this->getName()));
        }

        public function delete(){
                $sql = new Sql();
                $sql->query("DELETE FROM tblCategory WHERE idCategory=:id", array(":id"=>$this->getId()));
        }
   
        public function get(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblCategory WHERE idCategory = :category",
                array(":category"=>$this->getId()))[0];
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
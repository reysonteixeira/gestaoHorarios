<?php

    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class Brand{
        private $idBrand;
        private $brandName;


        /**
         * Get the value of brandName
         */ 
        public function getBrandName()
        {
            return $this->brandName;
        }

        /**
         * Set the value of brandName
         *
         */ 
        public function setBrandName($brandName)
        {
            $this->brandName = $brandName;
        }

        public function setDados($name, $id=0){
            $this->setBrandName($name);
            $this->setIdBrand($id);
        }

        public static function ListAll(){
            $sql = new Sql();
            return $sql->select("SELECT * from tblBrand order by txtBrandName");       
        }

        public function get($id){
            $sql = new Sql();
            return $sql->select("SELECT * from tblBrand WHERE idtblBrand = :idBrand",array(":idBrand"=>$id));   
        }

        public function save(){
            $sql = new Sql();
            $results = $sql->select("CALL sp_brands_save(:brandName)", 
                array(":brandName"=>$this->getBrandName()));
            $this->setIdBrand($results[0]["idtblBrand"]);
        }

        public function update(){
            $sql = new Sql();
            $sql->query("CALL sp_brandsupdate_save(:brandId, :brandName)",
            array(":brandId"=>$this->getIdBrand(),":brandName"=>$this->getBrandName()));
        }

        public function delete(){
            $sql = new Sql();
            $sql->query("DELETE FROM tblBrand WHERE idtblBrand = :idBrand", array(":idBrand"=>$this->getIdBrand()));
        }
        

        /**
         * Get the value of idBrand
         */ 
        public function getIdBrand()
        {
            return $this->idBrand;
        }

        /**
         * Set the value of idBrand
         *
         */ 
        public function setIdBrand($idBrand)
        {
            $this->idBrand = $idBrand;
        }
    }
?>
<?php

    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class Purchases{
        private $id;
        private $provider;
        private $date;
        private $invoice;


        public static function listAll(){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tblPurchases inner join tblProvider on fkProvider = idProvider
            ORDER BY dtPurchaseDate DESC");
    
        }


        public static function count(){
            $sql = new Sql();
            return $sql->select("SELECT count(*) as total FROM tblPurchases;");
        }

        public function setDadosForm($post){
            $this->setProvider($post["txtProvider"]);
            $this->setInvoice($post["txtInvoice"]);
            $this->setDate(Date($post["dtDate"]));

        }

        public function save(){
            $sql = new Sql();
            $results = $sql->select("CALL spPurchasesSave(:provider, :invoice, :purchaseDate);", 
            array(
                ":provider"=>$this->getProvider(),
                ":invoice"=>$this->getInvoice(),
                ":purchaseDate"=>$this->getDate()
            ));
            return $results[0];
        }

        public function update(){
            $sql = new Sql();
            $results = $sql->select("CALL sp_purchasesupdate_save(:id, :provider, :invoice, :purchaseDate);", array(
                ":id"=>$this->getId(),
                ":provider"=>$this->getProvider(),
                ":invoice"=>$this->getInvoice(),
                ":purchaseDate"=>$this->getDate()
            ));
           
        }
        

        public function get(){
            $sql = new Sql();
            $results = $sql->select("SELECT * from tblpurchases inner join tblProvider on fkProvider = idProvider
             WHERE idPurchases = :id",array(":id"=>$this->getId()));
            return $results[0];
        }

       

        public function delete(){
            $sql = new Sql();
            $sql->query("DELETE FROM tblPurchases WHERE idtblPurchases = :id", array(":id"=>$this->getId()));
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
        }

        /**
         * Get the value of provider
         */ 
        public function getProvider()
        {
                return $this->provider;
        }

        /**
         * Set the value of provider
         *
         * @return  self
         */ 
        public function setProvider($provider)
        {
                $this->provider = $provider;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
                $this->date = $date;
        }

        /**
         * Get the value of invoice
         */ 
        public function getInvoice()
        {
                return $this->invoice;
        }

        /**
         * Set the value of invoice
         *
         * @return  self
         */ 
        public function setInvoice($invoice)
        {
                $this->invoice = $invoice;

        }
    }
?>
<?php

    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class PurchaseProducts {
        private $id;
        private $purchase;
        private $product;
        private $quantity;
        private $costPrice;

    


        public function setDadosForm($form){
            $this->setProduct($form["cbProduct"]);
            $this->setQuantity($form["txtQuantity"]);
            $this->setCostPrice($form["txtCost"]);            
        }

        public function listAll(){
                $sql = new Sql();
                return $sql->select("SELECT * from tblPurchasesProductsList p inner join tblProducts s 
                on s.idProducts = p.fkProducts where fkPurchases = :id;", array(":id" => $this->getId()));
        }

        public function save(){
            $sql = new Sql();
            $results = $sql->select("CALL spPurchasesProductsSave(:purchase, :product, :quantity, :cost)", 
            array(":purchase"=>$this->getPurchase(),":product"=>$this->getProduct(),
            ":quantity"=>$this->getQuantity(), ":cost"=>$this->getCostPrice()));
        }

        public function delete(){
                $sql = new Sql();
              
                $sql->query("DELETE FROM tblPurchasesProductsList WHERE idtblPurchasesProductsList = :id;",
                array(":id" => $this->getId()));

        }

        public function get(){
                $sql = new Sql();
            
                return $sql->select("select * from tblPurchasesProductsList p inner join tblSmartphones s on s.idtblProducts = p.idtblProducts where p.idtblPurchasesProductsList=:id;",
                array(":id"=>$this->getId()));
                
        }

        public function update(){
                $sql = new Sql();
                $sql->select("CALL sp_purchasesproductsupdate_save(:id, :products, :imei, :costPrice, 
                :maintenancePrice)", array(":id"=>$this->getId(),":products"=>$this->getProduct(),
                ":imei"=>$this->getImei(),":costPrice"=>$this->getCostPrice(),
                ":maintenancePrice"=>$this->getMaintenance()));
        }

        /**
         * Get the value of id
         *
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
         * Get the value of purchase
         */ 
        public function getPurchase()
        {
                return $this->purchase;
        }

        /**
         * Set the value of purchase
         *
         * @return  self
         */ 
        public function setPurchase($purchase)
        {
                $this->purchase = $purchase;
        }

        /**
         * Get the value of product
         */ 
        public function getProduct()
        {
                return $this->product;
        }

        /**
         * Set the value of product
         *
         * @return  self
         */ 
        public function setProduct($product)
        {
                $this->product = $product;
        }

     

        /**
         * Get the value of costPrice
         */ 
        public function getCostPrice()
        {
                return $this->costPrice;
        }

        /**
         * Set the value of costPrice
         *
         * @return  self
         */ 
        public function setCostPrice($costPrice)
        {
                $this->costPrice = $costPrice;
        }

 

       
         

        /**
         * Get the value of quantity
         */ 
        public function getQuantity()
        {
                return $this->quantity;
        }

        /**
         * Set the value of quantity
         *
         * @return  self
         */ 
        public function setQuantity($quantity)
        {
                $this->quantity = $quantity;
        }

        /**
         * Get the value of costPrice
         */ 
    
    }

?>
<?php

    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class Products{
        private $id;
        private $brand;
        private $name;
        private $color;
        private $description;
        private $stock;
        private $salePrice;
        private $size;
        private $keywords;
        private $category;

        private $photoName;
        private $find;
        

        public static function listAll(){
                $sql = new Sql();
                return $sql->select("SELECT *, pp.txtName as photoName,  p.txtName as productName, c.txtName as color
                from tblProductsPhotos pp 
                inner join (tblProducts p inner join tblProductsColor c on numColor = idColor) on 
                p.idProducts = pp.fkProduct group by idProducts;");
        }

        public static function getAll(){
                $sql = new Sql();
                return $sql->select("SELECT *, pp.txtName as photoName,  p.txtName as productName
                from tblProductsPhotos pp inner join (tblProducts p inner join tblColor on numColor = idColor)on p.idProducts = pp.fkProduct where p.numStock >0 group by idProducts;");
        }

        public function find(){
                $sql = new Sql();
                $busca = $this->getFind();
                return $sql->select("SELECT *, pp.txtName as photoName,  p.txtName as productName from tblProductsPhotos pp inner join 
                tblProducts p on p.idProducts = pp.fkProduct where p.numStock >0 and (txtDescription like :busca or txtKeyWords 
                like :busca) group by idProducts;", array(":busca"=>"%$busca%"));
        }

        public function getSimilar(){
                $sql = new Sql();
                return $sql->select("SELECT *, pp.txtName as photoName,  p.txtName as productName from tblProductsPhotos pp inner join 
                tblProducts p on p.idProducts = pp.fkProduct where p.numStock >0 and p.fkCategory=:category
                and idProducts != :id group by idProducts limit 4;", array(":category"=>$this->getCategory(),
                ":id"=>$this->getId()));
        }
        
        public function setDados($post){
            $this->setBrand($post["txtBrand"]);
            $this->setName($post["txtName"]);
            $this->setColor($post["txtColor"]);
            $this->setDescription($post["txtDescription"]);
            $this->setStock($post["numStock"]);
            $this->setSalePrice($post["numSalePrice"]);
            $this->setSize($post["txtSize"]);
            $this->setKeywords($post["txtKeywords"]);
            $this->setCategory($post["numCategory"]);
        }

        public function setDadosUpdate($post){
                $this->setBrand($post["txtBrand"]);
                $this->setName($post["txtName"]);
                $this->setColor($post["txtColor"]);
                $this->setDescription($post["txtDescription"]);
                $this->setSalePrice($post["numSalePrice"]);
                $this->setSize($post["txtSize"]);
                $this->setKeywords($post["txtKeywords"]);
                $this->setCategory($post["numCategory"]);
        }
        

        public function save(){
            $sql = new Sql();
            return $sql->select("CALL spProductsSave(:brand, :name, :color, :description, :stock, 
            :pSalePrice, :size, :keyWords, :category)", array(":brand"=>$this->getBrand(), 
            ":name"=>$this->getName(), ":color"=>$this->getColor(), ":description"=>$this->getDescription(),
            ":stock"=>$this->getStock(), ":pSalePrice"=>$this->getSalePrice(), ":size"=>$this->getSize(), ":keyWords"=>$this->getKeywords(), ":category"=>$this->getCategory()))[0];
        }


        public function update(){
                $sql = new Sql();
                $sql->select("call spProductsUpdate(:id, :brand, :name, :color, :description, :salePrice,
                :size ,:keywords, :category)", array(":id"=>$this->getId(), ":brand"=>$this->getBrand(), 
                ":name"=>$this->getName(),  ":color"=>$this->getColor(), ":description"=>$this->getDescription(),
                ":salePrice"=>$this->getSalePrice(), ":size"=>$this->getSize(), ":keywords"=>$this->getKeywords(),
                ":category"=>$this->getCategory()));
        }

        public function get(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblProducts WHERE idProducts = :id", 
                array(":id"=>$this->getId()))[0];
        }

        public function getPhotos(){
                $sql = new Sql();
                return $sql->select("SELECT *, pp.txtName as photoName from tblProductsPhotos pp inner join tblProducts p 
                on p.idProducts = pp.fkProduct where p.idProducts = :id;", array(":id"=>$this->getId()));
        }

        public function getProductColors(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblProducts p inner join tblProductsColor c on
                p.numColor = c.idColor where p.txtName = :product;", array(":product"=>$this->getName()));
        }
        
        public function getProductsSize(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblProducts p  where p.txtName = :product and 
                p.numColor = :color", array(":product"=>$this->getName(), ":color"=>$this->getColor()));
        }

        public function delete(){
                $sql = new Sql();
                $sql->query("DELETE FROM tblProducts WHERE idProducts = :id", array(":id"=>$this->getId()));
        }


        public function photoSave(){
                $sql = new Sql();
                $sql->select("CALL spPhotosSave(:txtName,:fkProduct)", array(":txtName"=>$this->getPhotoName(),
                ":fkProduct"=>$this->getId()));
        }

        public function setOffer(){
                $sql = new Sql();
                $sql->select("CALL spOfferSave(:product, :price)", array(":product"=>$this->getId(),
                ":price"=>$this->getSalePrice()));
        }

        public function removeOffer(){
                $sql = new Sql();
                $sql->select("CALL spOfferRemove(:product)", array(":product"=>$this->getId()));
        }


        public static function listOffers(){
                $sql = new Sql();
                return $sql->select("SELECT *, pp.txtName as photoName,  p.txtName as productName
                from tblProductsPhotos pp inner join tblProducts p on p.idProducts = pp.fkProduct 
                WHERE numSaleOffer is not null  group by fkProduct");
        }

        public static function listHighlights(){
                $sql = new Sql();
                return $sql->select("SELECT *, pp.txtName as photoName,  p.txtName as productName
                from tblProductsPhotos pp inner join tblProducts p on p.idProducts = pp.fkProduct  
                WHERE highlights = 1  group by fkProduct");
        }
     
        public static function listRecents(){
                $sql = new Sql();
                return $sql->select("SELECT *, pp.txtName as photoName,  p.txtName as productName
                from tblProductsPhotos pp inner join tblProducts p on p.idProducts = pp.fkProduct group by fkProduct order by idProducts DESC LIMIT 7");
        }

        public function addHighlights(){
                $sql = new Sql();
                $sql->select("call spAddHighlights(:product)", array(":product"=>$this->getId()));  
        }

        public function removeHighlights(){
                $sql = new Sql();
                $sql->select("call spRemoveHighlights()");
        }


        public function updateStock(){
                $sql = new Sql();
                $sql->select("CALL spUpdateStock(:product, :quantity)", 
                array(":product"=>$this->getId(),":quantity"=>$this->getStock()));
        }

        public function addStock(){
                $sql = new Sql();
                $sql->select("CALL spAddStock(:product, :quantity)", 
                array(":product"=>$this->getId(),":quantity"=>$this->getStock()));
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
         * Get the value of brand
         */ 
        public function getBrand()
        {
                return $this->brand;
        }

        /**
         * Set the value of brand
         *
         * @return  self
         */ 
        public function setBrand($brand)
        {
                $this->brand = $brand;

                return $this;
        }

        /**
         * Get the value of color
         */ 
        public function getColor()
        {
                return $this->color;
        }

        /**
         * Set the value of color
         *
         * @return  self
         */ 
        public function setColor($color)
        {
                $this->color = $color;

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
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of stock
         */ 
        public function getStock()
        {
                return $this->stock;
        }

        /**
         * Set the value of stock
         *
         * @return  self
         */ 
        public function setStock($stock)
        {
                $this->stock = $stock;

                return $this;
        }

        /**
         * Get the value of salePrice
         */ 
        public function getSalePrice()
        {
                return $this->salePrice;
        }

        /**
         * Set the value of salePrice
         *
         * @return  self
         */ 
        public function setSalePrice($salePrice)
        {
                $this->salePrice = $salePrice;

                return $this;
        }

        /**
         * Get the value of size
         */ 
        public function getSize()
        {
                return $this->size;
        }

        /**
         * Set the value of size
         *
         * @return  self
         */ 
        public function setSize($size)
        {
                $this->size = $size;

                return $this;
        }

        /**
         * Get the value of category
         */ 
        public function getCategory()
        {
                return $this->category;
        }

        /**
         * Set the value of category
         *
         * @return  self
         */ 
        public function setCategory($category)
        {
                $this->category = $category;

                return $this;
        }

        /**
         * Get the value of category
         */ 
       

        /**
         * Get the value of keywords
         */ 
        public function getKeywords()
        {
                return $this->keywords;
        }

        /**
         * Set the value of keywords
         *
         * @return  self
         */ 
        public function setKeywords($keywords)
        {
                $this->keywords = $keywords;

                return $this;
        }


        public function getPhotoName()
        {
                return $this->photoName;
        }

        /**
         * Set the value of keywords
         *
         * @return  self
         */ 
        public function setPhotoName($photoName)
        {
                $this->photoName = $photoName;

                return $this;
        }

        

        /**
         * Get the value of find
         */ 
        public function getFind()
        {
                return $this->find;
        }

        /**
         * Set the value of find
         *
         * @return  self
         */ 
        public function setFind($find)
        {
                $this->find = $find;

                return $this;
        }
    }
?>
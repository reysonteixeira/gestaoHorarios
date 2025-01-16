<?php
    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class CartProduct extends Cart{
        private $idCartProduct;
        private $product;
        private $quantity;
        private $price;

        public function save(){
            $sql = new Sql();
            $results = $sql->select("CALL spCartProductsSave(:user, :product, :quantity, :price)",
            array(":user"=>$this->getUser(),":product"=>$this->getProduct(), ":quantity"=>$this->getQuantity(), ":price"=>$this->getPrice()));
        }

        public function getAll(){
             $sql = new Sql();
             $results = $sql->select("SELECT *, pp.txtName as photo, cc.txtName as color from tblCartProducts cp inner join (tblProducts p inner join 
             tblProductsPhotos pp on p.idProducts = pp.fkProduct inner join tblProductsColor cc on idColor = numColor) on cp.idProduct = p.idProducts inner join 
             (tblCart c inner join tblUsers u on c.idUser = u.idUsers) on c.idCart = cp.idCart where c.numStatus = 0 
             and u.idUsers = :idPerson group by p.idProducts;", array(":idPerson"=>$this->getUser()));
             return $results;
        }

        public function getProductsCart(){
        $sql = new Sql();
             $results = $sql->select( "SELECT *, pp.txtName as photo, p.txtName as productName from tblCartProducts cp
             inner join (tblProducts p inner join tblProductsPhotos pp on p.idProducts = pp.fkProduct) on cp.idProduct = p.idProducts 
             where cp.idCart = :cart group by p.idProducts;",array(":cart"=>$this->getId()));
             return $results;
        }

        public function addOne(){
                $sql = new Sql();
                $results = $sql->select("CALL spaddProductInCart(:product, :user, :quantity);",
                array(":product"=>$this->getProduct(), ":user"=> $this->getUser(), ":quantity"=>$this->getQuantity()));
        }

        public function removeOne(){
                $sql = new Sql();
                $results = $sql->select("CALL spMinProductInCart(:product, :idUser)", array(":product"=>$this->getProduct(),
                ":idUser"=>$this->getUser()));
        }

        public function deleteProduct(){
                $sql = new Sql();
                $results = $sql->select("CALL spDeleteProductCart(:pidUser, :pidProduct)", 
                array(":pidUser"=>$this->getUser(), ":pidProduct"=>$this->getProduct()));
        }

        public function deleteAllProducts()
        {
                $sql = new Sql();
                $results = $sql->select("CALL sp_deleteAllProducts(:idUser)", array(":idUser"=>$this->getUser()));
        }

        public function getQuantityProducts(){
                $sql = new Sql();
                $results = $sql->select("SELECT * from tblCartProducts inner join tblCart on idtblCart = idCart where idUser = :user 
                and numStatus = 0 and idProduct = :product;", array(":user"=>$this->getUser(), ":product"=>$this->getProduct()));
                return $results;
        }

        public function getCartInformation(){
                $sql = new Sql();
                return $sql->select("select sum(numQuantity * numPrice) as totalPrice, sum(numQuantity) as 
                totalproducts from tblCartProducts cp inner join tblCart c on c.idCart = cp.idCart 
                where c.idCart = :cart;", 
                array(":cart"=>$this->getId()))[0];
        }

        public function getCartResume(){
                $sql = new Sql();
                return $sql->select("select sum(numQuantity * numPrice) as totalPrice, sum(numQuantity) as totalproducts from tblCartProducts inner join tblCart c on idCart = idCart 
                where idUser = :user and c.numStatus = 0;", 
                array(":user"=>$this->getUser()));
        }
        /**
         * Get the value of idCartProduct
         */ 
        public function getIdCartProduct()
        {
                return $this->idCartProduct;
        }

        /**
         * Set the value of idCartProduct
         */ 
        public function setIdCartProduct($idCartProduct)
        {
                $this->idCartProduct = $idCartProduct;
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
         */ 
        public function setProduct($product)
        {
                $this->product = $product;

                return $this;
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
         */ 
        public function setQuantity($quantity)
        {
                $this->quantity = $quantity;
        }

        /**
         * Get the value of price
         */ 
        public function getPrice()
        {
                return $this->price;
        }

        /**
         * Set the value of price

         */ 
        public function setPrice($price)
        {
                $this->price = $price;
        }
    }

?>
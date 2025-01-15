<?php
    namespace Ktira\Model;

    use \Ktira\DB\Sql;
  
    class Order{
        private $id;
        private $status;
        private $orderDate;
        private $cart;
        private $nf;
        private $paymentType;
        private $paymentDate;
        private $client;
        private $boleto;
        private $parcelas;
        private $products;
        private $dateSend;
        private $sendCost;
        private $sendType;
        private $sendCode;
        private $cep;
        private $street;
        private $number;
        private $neighborhood;
        private $city;
        private $state;
        private $complement;
        private $totalCost;


        public static function listAll(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblOrder inner join tblUsers on numClient = idUsers 
                order by idOrder desc;");
        }


        public function saveCartao(){
            $sql = new Sql();
                $result = $sql->select("CALL spOrdersCartaoSave(:status, :cart, :client, :parcelas, :sendCost, 
                :sendType, :cep,:state,:city, :street,   :number, :neighborhood, :complement)", array(
                ":status"=>2, ":cart"=>$this->getCart(), ":client"=>$this->getClient(),
                ":parcelas"=>$this->getParcelas(), ":sendCost"=>$this->getSendCost(), 
                ":sendType"=>$this->getSendType(), ":cep"=>$this->getCep(), ":street"=>$this->getStreet(),
                ":number"=>$this->getNumber(), ":city"=>$this->getCity(), ":state"=>$this->getState(),
                ":neighborhood"=>$this->getNeighborhood(), ":complement"=>$this->getComplement()
            ));
            return $result[0]["orderId"];
        }

        public function saveBoleto(){
                $sql = new Sql();
                $result = $sql->select("CALL spOrdersBoletoSave(:status,:cart,:client,:sendCost,:boleto,
                :sendType, :cep,:state,:city, :street,   :number, :neighborhood, :complement)",array(
                ":status"=>1,":cart"=>$this->getCart(),":client"=>$this->getClient(),
                ":sendCost"=>$this->getSendCost(), ":boleto"=>$this->getBoleto(), 
                ":sendType"=>$this->getSendType(),
                ":cep"=>$this->getCep(), ":street"=>$this->getStreet(),
                ":number"=>$this->getNumber(), ":city"=>$this->getCity(), ":state"=>$this->getState(),
                ":neighborhood"=>$this->getNeighborhood(), ":complement"=>$this->getComplement()));
                return $result[0]["orderId"];
        }

        public function cancel(){
                $sql = new Sql();
                $sql->query("UPDATE tblOrder set numStatus = 5 where idOrder = :order",
                array(":order"=>$this->getId()));
        }
        

        public function updateNf(){
                $sql = new Sql();
                $sql->select("CALL spUpdateNF(:pidOrder, :pnf)", array(":pidOrder"=>$this->getId(), 
                ":pnf"=>$this->getNf()));
        }

       
        public function checkout(){
                $sql = new Sql();
                $sql->select("CALL  spCheckout(:pId)", array(":pId"=>$this->getId()));
        }

        public function getAllClient(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblOrder WHERE numClient = :client order by idOrder DESC", array(
                        ":client"=>$this->getClient()
                ));
        }

        public function getOrderResume(){
                $sql = new Sql();
                return $sql->select("SELECT *, o.numStatus as statusOrder, sum(numQuantity * numPrice) as totalPrice ,sum(numQuantity) as totalproducts 
                from tblOrder o inner join (tblCart inner join tblcartproducts on idtblCart = idcart 
                inner join tblPersons on idUser = idtblPerson) on 
                numIdCart = idtblCart group by idtblOrder;");
        }

    

        public function get(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblOrder inner join 
                (tblUsers inner join tblAddress on fkAddress = idAddress )on numClient = idUsers where 
                idOrder = :order", array(":order"=>$this->getId()))[0];
        }

        
        public function uploadFiles($file){
                $destino = "res/_pedidos/nf/".$file["flNf"]['name'];
                move_uploaded_file($file['flNf']["tmp_name"],$destino);     
        }

        public function removeFiles(){
                unlink("res/_pedidos/nf/".$this->getNf());
        }


        public function removeNF(){
                $sql = new Sql();
                $sql->select("CALL spRemoveNF(:pOrder)", array(":pOrder"=>$this->getId()));
        }

        public function updateSend(){
                $sql = new Sql();
                $sql->select("CALL spUpdateSend(:order,:dateSend, :sendCode)",array(
                ":order"=>$this->getId(),":dateSend"=>$this->getDateSend(), ":sendCode"=>$this->getSendCode()));
        }


        public function updatePayment(){
                $sql = new Sql();
                $sql->query("UPDATE tblOrder set datPaymentDate = Date(:paymentDate), numStatus = 2
                 where idOrder = :order", array(":paymentDate"=>$this->getPaymentDate(), ":order"=>$this->getId()));
        }


        public function setAddressDate($personAddress){
                $this->setCep($personAddress[0]["txtCEP"]);
                $this->setCity($personAddress[0]["txtCity"]);
                $this->setState($personAddress[0]["txtState"]);
                $this->setStreet($personAddress[0]["txtStreet"]);
                $this->setNumber($personAddress[0]["numNumber"]);
                $this->setNeighborhood($personAddress[0]["txtNeighboorhood"]);
                $this->setComplement($personAddress[0]["txtComplement"]);
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
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
        }

        /**
         * Set the value of status
         */ 
        public function setStatus($status)
        {
                $this->status = $status;
        }

        /**
         * Get the value of orderDate
         */ 
        public function getOrderDate()
        {
                return $this->orderDate;
        }

        /**
         * Set the value of orderDate
         */ 
        public function setOrderDate($orderDate)
        {
                $this->orderDate = $orderDate;
        }

        /**
         * Get the value of cart
         */ 
        public function getCart()
        {
                return $this->cart;
        }

        /**
         * Set the value of cart
         */ 
        public function setCart($cart)
        {
                $this->cart = $cart;
        }

        /**
         * Get the value of nf
         */ 
        public function getNf()
        {
                return $this->nf;
        }

        /**
         * Set the value of nf
         */ 
        public function setNf($nf)
        {
                $this->nf = $nf;
        }

        /**
         * Get the value of paymentType
         */ 
        public function getPaymentType()
        {
                return $this->paymentType;
        }

        /**
         * Set the value of paymentType
         */ 
        public function setPaymentType($paymentType)
        {
                $this->paymentType = $paymentType;
        }

        /**
         * Get the value of paymentDate
         */ 
        public function getPaymentDate()
        {
                return $this->paymentDate;
        }

        /**
         * Set the value of paymentDate
         */ 
        public function setPaymentDate($paymentDate)
        {
                $this->paymentDate = $paymentDate;
        }

        /**
         * Get the value of client
         */ 
        public function getClient()
        {
                return $this->client;
        }

        /**
         * Set the value of client
         */ 
        public function setClient($client)
        {
                $this->client = $client;
        }

        /**
         * Get the value of boleto
         */ 
        public function getBoleto()
        {
                return $this->boleto;
        }

        /**
         * Set the value of boleto
         */ 
        public function setBoleto($boleto)
        {
                $this->boleto = $boleto;
        }

        /**
         * Get the value of parcelas
         */ 
        public function getParcelas()
        {
                return $this->parcelas;
        }

        /**
         * Set the value of parcelas

         */ 
        public function setParcelas($parcelas)
        {
                $this->parcelas = $parcelas;
        }

        /**
         * Get the value of products
         */ 
        public function getProducts()
        {
                return $this->products;
        }

        /**
         * Set the value of products
         *
         * @return  self
         */ 
        public function setProducts($products)
        {
                $this->products = $products;

                return $this;
        }

        /**
         * Get the value of dateSend
         */ 
        public function getDateSend()
        {
                return $this->dateSend;
        }

        /**
         * Set the value of dateSend
      
         */ 
        public function setDateSend($dateSend)
        {
                $this->dateSend = $dateSend;
        }

        /**
         * Get the value of sendCost
         */ 
        public function getSendCost()
        {
                return $this->sendCost;
        }

        /**
         * Set the value of sendCost
         *
         * @return  self
         */ 
        public function setSendCost($sendCost)
        {
                $this->sendCost = $sendCost;
        }

        /**
         * Get the value of sendType
         */ 
        public function getSendType()
        {
                return $this->sendType;
        }

        /**
         * Set the value of sendType
        
         */ 
        public function setSendType($sendType)
        {
                $this->sendType = $sendType;
        }

        /**
         * Get the value of sendCode
         */ 
        public function getSendCode()
        {
                return $this->sendCode;
        }

        /**
         * Set the value of sendCode
         */ 
        public function setSendCode($sendCode)
        {
                $this->sendCode = $sendCode;
        }

        /**
         * Get the value of cep
         */ 
        public function getCep()
        {
                return $this->cep;
        }

        /**
         * Set the value of cep
      
         */ 
        public function setCep($cep)
        {
                $this->cep = $cep;
        }

        /**
         * Get the value of number
         */ 
        public function getNumber()
        {
                return $this->number;
        }

        /**
         * Set the value of number
         */ 
        public function setNumber($number)
        {
                $this->number = $number;
        }

        /**
         * Get the value of street
         */ 
        public function getStreet()
        {
                return $this->street;
        }

        /**
         * Set the value of street
         */ 
        public function setStreet($street)
        {
                $this->street = $street;
        }

        /**
         * Get the value of neighborhood
         */ 
        public function getNeighborhood()
        {
                return $this->neighborhood;
        }

        /**
         * Set the value of neighborhood
         */ 
        public function setNeighborhood($neighborhood)
        {
                $this->neighborhood = $neighborhood;
        }

        /**
         * Get the value of city
         */ 
        public function getCity()
        {
                return $this->city;
        }

        /**
         * Set the value of city
         */ 
        public function setCity($city)
        {
                $this->city = $city;
        }

        /**
         * Get the value of state
         */ 
        public function getState()
        {
                return $this->state;
        }

        /**
         * Set the value of state
         */ 
        public function setState($state)
        {
                $this->state = $state;
        }

        /**
         * Get the value of complement
         */ 
        public function getComplement()
        {
                return $this->complement;
        }

        /**
         * Set the value of complement
         */ 
        public function setComplement($complement)
        {
                $this->complement = $complement;
        }

        /**
         * Get the value of totalCost
         */ 
        public function getTotalCost()
        {
                return $this->totalCost;
        }

        /**
         * Set the value of totalCost
         *
         * @return  self
         */ 
        public function setTotalCost($totalCost)
        {
                $this->totalCost = $totalCost;

        }
    }
?>
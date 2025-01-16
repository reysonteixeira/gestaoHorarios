<?php
  namespace Ktira\Model;

  use \Ktira\DB\Sql;

  class Address{
      private $id;
      private $cep;
      private $city;
      private $state;
      private $number;
      private $neighborhood;
      private $complement;
      private $person;
      private $street;


      //FUNCAO setDadosForm
      //Obj.: Atribui dados a classe recebidos por formulário
      public function setDadosForm($post, $user=null){
          $this->setCep($post["txtCep"]);
          $this->setCity($post["txtCity"]);
          $this->setStreet($post["txtStreet"]);
          $this->setState($post["txtState"]);
          $this->setNumber($post["numNumber"]);
          $this->setNeighborhood($post["txtNeighborhood"]);
          $this->setComplement($post["txtComplement"]);
          $this->setPerson($user);
      }

     
      //FUNCAO save
      //Obj.: Faz conexão com banco de dados e chama Stored Procedure que salva as informacoes de endereço do usuario
      public function save(){
            $sql = new Sql();
            $sql->select("CALL spAddressSave(:street, :number, :complement, :neighborhood, :city, :state,
            :cep, :user)", array(":street"=>$this->getStreet(), ":number"=>$this->getNumber(), 
            ":complement"=>$this->getComplement(), ":neighborhood"=>$this->getNeighborhood(),
            ":city"=>$this->getCity(), ":state"=>$this->getState(),":cep"=>$this->getCep(), 
            ":user"=>$this->getPerson()));
      }
      

      //FUNCAO update
      //Obj.: Faz conexão com banco de dados e chama Stored Procedure que atualiza as informacoes de endereço do usuario
      public function update(){
            $sql = new Sql();
            $sql->select("CALL spAddressUpdate(:id, :street, :number, :complement, :neighborhood, :city, 
            :state,:cep)", array(":id"=>$this->getId(),":street"=>$this->getStreet(), 
            ":number"=>$this->getNumber(), ":complement"=>$this->getComplement(),
            ":neighborhood"=>$this->getNeighborhood(), ":city"=>$this->getCity(),":state"=>$this->getState(),
            ":cep"=>$this->getCep()));             
      }


      //FUNCAO get
      //Obj.: Faz conexão com banco de dados e busca informação de endereço de usuário específico
      public function get(){
            $sql = new Sql();
            return $sql->select("SELECT * from tblAddress WHERE idAddress = :id", array(":id"=> $this->getId()));
      }


      public function getPersonAddress(){
            $sql = new Sql();
            return $sql->select("SELECT * from tblAddress INNER JOIN tblUsers on fkAddress = idAddress WHERE 
            idUsers = :id", array(":id"=> $this->getPerson()));
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
       * Get the value of person
       */ 
      public function getPerson()
      {
            return $this->person;
      }

      /**
       * Set the value of person
       */ 
      public function setPerson($person)
      {
            $this->person = $person;
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
  }


?>
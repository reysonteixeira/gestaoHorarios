<?php
    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class Cart{
        private $id;
        private $user;
        private $dateRegister;
        private $status;

        public function calculaFrete($cep, $peso){
                $altura = 6;
                $largura = 24;
                $comprimento = 16;
                $peso = ($peso/1000);
                $origem = "37930000";
                $destino = $cep;

                $sedex = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCdAvisoRecebimento=n&sCdMaoPropria=n&nVlValorDeclarado=0&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3&nCdFormato=1&sCepOrigem=$origem&sCepDestino=$destino&nVlPeso=$peso&nVlComprimento=$comprimento&nVlAltura=$altura&nVlLargura=$largura&nCdServico=04014";
                $pac = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCdAvisoRecebimento=n&sCdMaoPropria=n&nVlValorDeclarado=0&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3&nCdFormato=1&sCepOrigem=$origem&sCepDestino=$destino&nVlPeso=$peso&nVlComprimento=$comprimento&nVlAltura=$altura&nVlLargura=$largura&nCdServico=04510";

                $unparsedResultSedex = file_get_contents($sedex);
                $parsedResultSedex = simplexml_load_string($unparsedResultSedex);

                $unparsedResultPac = file_get_contents($pac);
                $parsedResultPac = simplexml_load_string($unparsedResultPac);


                $retorno = array(
                        'precoSedex' => strval($parsedResultSedex->cServico->Valor),
                        'prazoSedex' => strval($parsedResultSedex->cServico->PrazoEntrega),
                        'precoPac' => strval($parsedResultPac->cServico->Valor),
                        'prazoPac' => strval($parsedResultPac->cServico->PrazoEntrega)
                );

                return $retorno;
        }

        public function somaPeso($produtos){
                $soma = 0;
                for($i=0;$i<count($produtos);$i++){
                    $soma+= ($produtos[0]["numWeight"] * $produtos[0]["numQuantity"]);    
                }
                return $soma;
        }

        public function getByUser(){
                $sql = new Sql();
                return $sql->select("SELECT * from tblCart where numStatus = 0 and idUser = :user",
                array(":user"=>$this->getUser()))[0];
        }

        public function getTotalCart(){
                $sql = new Sql();
                return $sql->select("SELECT sum(numPrice * numQuantity) as total from tblCart inner join tblCartProducts using (idCart)
                where numStatus = 0 and idUser = :id group by idCart;", array(":id"=>$this->getUser()));
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
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         */ 
        public function setUser($user)
        {
                $this->user = $user;;
        }

        /**
         * Get the value of dateRegister
         */ 
        public function getDateRegister()
        {
                return $this->dateRegister;
        }

        /**
         * Set the value of dateRegister
         */ 
        public function setDateRegister($dateRegister)
        {
                $this->dateRegister = $dateRegister;
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
    }
?>
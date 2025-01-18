<?php
    class Escola
    {
        // Idetificadores da Escola:
        private $idEscola = null;
        private $nomeEscola;
        private $registroInep;
        private $telefone;

        // Endereco da Escola:
        private $logradouro;
        private $numero;
        private $complemento;
        private $bairro;
        private $cidade;
        private $estado;
        private $cep;
        
        public function setDadosForm($post)
        {
            // Idetificadores da Escola:
            $this->idEscola     =$post['idEscola'];
            $this->nomeEscola   =$post['nomeEscola'];
            $this->registroInep =$post['registroInep'];
            $this->telefone     =$post['telefone'];

            // Endereco da Escola:
            $this->logradouro  =$post['logradouro'];
            $this->numero      =$post['numero'];
            $this->complemento =$post['complemento'];
            $this->bairro      =$post['bairro'];
            $this->cidade      =$post['cidade'];
            $this->estado      =$post['estado'];
            $this->cep         =$post['cep'];
        }

        //Função devolve um array com todos os dados do banco de dados da tabela Escola
        public static function  listAll()
        {
            try
            {
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblEscolas order by nomeEscola;");
            }
            
            catch (Exception $e)
            {
                return json_encode(Msg::arrayErros($e));
            }
        }

        //Função de busca um elemento pelo id na tabela:
        public function get($id)
        {
            try{
                $sql = new Sql();
                return ($sql->select(
                    "SELECT * FROM tblEscolas WHERE idEscola = :ID;",
                    array(":ID" => $id)
                )[0]);
            }
            
            catch (Exception $e)
            {
                return json_encode(Msg::arrayErros($e));
            }
        }

        //Deleta do banco de dados os dados referete ao id
        public function delete($id)
        {
            try{
                $sql = new Sql();

                return ($sql->query(
                    "DELETE FROM tblEscolas WHERE idEscola = :ID;",
                    array(":ID" => $id)
                ));
            }
            
            catch (Exception $e)
            {
                return json_encode(Msg::arrayErros($e));
            }
        }

        // Caso o id == 0 um insert sera feito
        // Caso o id != 0 um update acontece
        public function save($id=0)
        {
            try {
                $sql = new Sql();

                if ($id != 0)
                {
                    $this->idEscola = $id;
                }
                
                var_dump($this->return_array());
                $sql->select(
                    "CALL sp_insert_update_tblEscolas(:ATRIBUTO00,:ATRIBUTO01, :ATRIBUTO02, :ATRIBUTO03, :ATRIBUTO04, :ATRIBUTO05, :ATRIBUTO06, :ATRIBUTO07, :ATRIBUTO08, :ATRIBUTO09, :ATRIBUTO10)",
                    $this->return_array()
                );    
            }
            catch (Exception $e)
            {
                var_dump($e);
            }
        }
        public function return_array($type=0)
        {
            switch ($type) {
                case 0:
                    return array(
                        ":ATRIBUTO00" => $this->idEscola,
                        ":ATRIBUTO01" => $this->nomeEscola,
                        ":ATRIBUTO02" => $this->registroInep,
                        ":ATRIBUTO03" => $this->logradouro,
                        ":ATRIBUTO4"  => $this->numero,
                        ":ATRIBUTO05" => $this->complemento,
                        ":ATRIBUTO06" => $this->bairro,
                        ":ATRIBUTO07" => $this->cidade,
                        ":ATRIBUTO08" => $this->estado,
                        ":ATRIBUTO09" => $this->cep,
                        ":ATRIBUTO10" => $this->telefone,
                    );
                break;
            }
        }

        /**
         * Get the value of idEscola
         */
        public function getIdEscola()
        {
                return $this->idEscola;
        }

        /**
         * Set the value of idEscola
         */
        public function setIdEscola($idEscola): self
        {
                $this->idEscola = $idEscola;

                return $this;
        }

        /**
         * Get the value of nomeEscola
         */
        public function getNomeEscola()
        {
                return $this->nomeEscola;
        }

        /**
         * Set the value of nomeEscola
         */
        public function setNomeEscola($nomeEscola): self
        {
                $this->nomeEscola = $nomeEscola;

                return $this;
        }

        /**
         * Get the value of registroInep
         */
        public function getRegistroInep()
        {
                return $this->registroInep;
        }

        /**
         * Set the value of registroInep
         */
        public function setRegistroInep($registroInep): self
        {
                $this->registroInep = $registroInep;

                return $this;
        }

        /**
         * Get the value of telefone
         */
        public function getTelefone()
        {
                return $this->telefone;
        }

        /**
         * Set the value of telefone
         */
        public function setTelefone($telefone): self
        {
                $this->telefone = $telefone;

                return $this;
        }

        /**
         * Get the value of logradouro
         */
        public function getLogradouro()
        {
                return $this->logradouro;
        }

        /**
         * Set the value of logradouro
         */
        public function setLogradouro($logradouro): self
        {
                $this->logradouro = $logradouro;

                return $this;
        }

        /**
         * Get the value of numero
         */
        public function getNumero()
        {
                return $this->numero;
        }

        /**
         * Set the value of numero
         */
        public function setNumero($numero): self
        {
                $this->numero = $numero;

                return $this;
        }

        /**
         * Get the value of complemento
         */
        public function getComplemento()
        {
                return $this->complemento;
        }

        /**
         * Set the value of complemento
         */
        public function setComplemento($complemento): self
        {
                $this->complemento = $complemento;

                return $this;
        }

        /**
         * Get the value of bairro
         */
        public function getBairro()
        {
                return $this->bairro;
        }

        /**
         * Set the value of bairro
         */
        public function setBairro($bairro): self
        {
                $this->bairro = $bairro;

                return $this;
        }

        /**
         * Get the value of cidade
         */
        public function getCidade()
        {
                return $this->cidade;
        }

        /**
         * Set the value of cidade
         */
        public function setCidade($cidade): self
        {
                $this->cidade = $cidade;

                return $this;
        }

        /**
         * Get the value of estado
         */
        public function getEstado()
        {
                return $this->estado;
        }

        /**
         * Set the value of estado
         */
        public function setEstado($estado): self
        {
                $this->estado = $estado;

                return $this;
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
        public function setCep($cep): self
        {
                $this->cep = $cep;

                return $this;
        }
    }
?>
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
        public function listAll()
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
                    //
                    return ($sql->select(
                        "CALL sp_insert_update_tblEscolas(:ATRIBUTO00,:ATRIBUTO01, :ATRIBUTO02, :ATRIBUTO03, :ATRIBUTO04, :ATRIBUTO05, :ATRIBUTO06, :ATRIBUTO07, :ATRIBUTO08, :ATRIBUTO09, :ATRIBUTO10)",
                        $this->return_array()
                    ));
                }
                else {
                    return ($sql->select(
                        "CALL sp_insert_update_tblEscolas(:ATRIBUTO00,:ATRIBUTO01, :ATRIBUTO02, :ATRIBUTO03, :ATRIBUTO04, :ATRIBUTO05, :ATRIBUTO06, :ATRIBUTO07, :ATRIBUTO08, :ATRIBUTO09, :ATRIBUTO10)",
                        $this->return_array()
                    ));
                }      
            }
            catch (Exception $e)
            {
                return json_encode(Msg::arrayErros($e));
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
    }
?>
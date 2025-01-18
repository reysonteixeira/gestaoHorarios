<?php
    class Horarios{
        private $idHorario;
        private $fkEscola;
        private $nomeHorario;

        public function setDados($post)
        {
            $this->nomeHorario   =$post['nomeHorario'];
        }

        //Função devolve um array com todos os dados do banco de dados da tabela 
        public function listAll()
        {
            try
            {
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblHorarios where fkEscola = :ATRIBUTO1 order by nomeHorario;", array(":ATRIBUTO1"=>$this->getFkEscola()));
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
                    "SELECT * FROM tblHorarios WHERE idHorario = :ID and fkEscola = :FKESCOLA;",
                    array(":ID" => $id, ":FKESCOLA" => $this->getFkEscola())
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
                    "DELETE FROM tblHorarios WHERE idHorario = :ID;",
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
                    $this->idHorario = $id;
                }
                
                return ($sql->select(
                    "CALL sp_insert_update_tblHorarios(:ATRIBUTO00,:ATRIBUTO01, :ATRIBUTO02)",
                    $this->return_array()
                ));   
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
                        ":ATRIBUTO00" => $this->idHorario,
                        ":ATRIBUTO01" => $this->fkEscola,
                        ":ATRIBUTO02" => $this->nomeHorario,
                    );
                break;
            }
        }

        /**
         * Get the value of idHorario
         */
        public function getIdHorario()
        {
                return $this->idHorario;
        }

        /**
         * Set the value of idHorario
         */
        public function setIdHorario($idHorario): self
        {
                $this->idHorario = $idHorario;

                return $this;
        }

        /**
         * Get the value of fkEscola
         */
        public function getFkEscola()
        {
                return $this->fkEscola;
        }

        /**
         * Set the value of fkEscola
         */
        public function setFkEscola($fkEscola): self
        {
                $this->fkEscola = $fkEscola;

                return $this;
        }

        /**
         * Get the value of nomeHorario
         */
        public function getNomeHorario()
        {
                return $this->nomeHorario;
        }

        /**
         * Set the value of nomeHorario
         */
        public function setNomeHorario($nomeHorario): self
        {
                $this->nomeHorario = $nomeHorario;

                return $this;
        }
    }
?>
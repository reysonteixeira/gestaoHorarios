<?php

use ElementorPro\Modules\Forms\Fields\Date;

class Turma
    {
        // Variaveis pricipais:
        private $idTurma = null;
        private $nomeTurma;
        private $fkHorario;
        private $anoTurma;
        private $fkEscola;


        
        // Array de apoio:
       
        // Objetos relacionados:
        // private $obj_escola = new Escola()

        public function setDadosForm($post)
        {
            $this->nomeTurma       =$post['nomeTurma'];
           $this->fkHorario       =$post['fkHorario'];
           $this->anoTurma        =$post['anoTurma'];
        }

        //Função devolve um array com todos os dados do banco de dados da tabela 
        public function listAll()
        {
            try
            {
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblTurmas where fkEscola = :FKESCOLA order by nomeTurma;", array(":FKESCOLA"=>$this->getFkEscola()));
            }
            
            catch (Exception $e)
            {
                var_dump($e);
            }
        }

        //Função de busca um elemento pelo id na tabela:
        public function get($id)
        {
            try{
                $sql = new Sql();
                return ($sql->select(
                    "SELECT * FROM tblTurmas WHERE idTurma = :ID;",
                    array(":ID" => $id)
                )[0]);
            }
            
            catch (Exception $e)
            {
                var_dump($e);
            }
        }

        //Deleta do banco de dados os dados referete ao id
        public function delete($id)
        {
            try{
                $sql = new Sql();

                return ($sql->query(
                    "DELETE FROM tblTurmas WHERE idTurma = :ID;",
                    array(":ID" => $id)
                ));
            }
            
            catch (Exception $e)
            {
                var_dump($e);
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
                    $this->idTurma = $id;
                }
                
                $sql->select(
                    "CALL sp_insert_update_tblTurmas(:ATRIBUTO00,:ATRIBUTO01, :ATRIBUTO02, :ATRIBUTO03, :ATRIBUTO04)",
                    $this->return_array()
                );
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
                        ":ATRIBUTO00" => $this->idTurma,
                        ":ATRIBUTO01" => $this->nomeTurma,
                        ":ATRIBUTO02" => $this->fkHorario,
                        ":ATRIBUTO03" => $this->fkEscola,
                        ":ATRIBUTO04" => $this->anoTurma,
                    );
                break;
            }
        }

     

        /**
         * Get the value of idTurma
         */
        public function getIdTurma()
        {
                return $this->idTurma;
        }

        /**
         * Set the value of idTurma
         */
        public function setIdTurma($idTurma): self
        {
                $this->idTurma = $idTurma;

                return $this;
        }

        /**
         * Get the value of nomeTurma
         */
        public function getNomeTurma()
        {
                return $this->nomeTurma;
        }

        /**
         * Set the value of nomeTurma
         */
        public function setNomeTurma($nomeTurma): self
        {
                $this->nomeTurma = $nomeTurma;

                return $this;
        }

        /**
         * Get the value of fkHorario
         */
        public function getFkHorario()
        {
                return $this->fkHorario;
        }

        /**
         * Set the value of fkHorario
         */
        public function setFkHorario($fkHorario): self
        {
                $this->fkHorario = $fkHorario;

                return $this;
        }

        /**
         * Get the value of anoTurma
         */
        public function getAnoTurma()
        {
                return $this->anoTurma;
        }

        /**
         * Set the value of anoTurma
         */
        public function setAnoTurma($anoTurma): self
        {
                $this->anoTurma = $anoTurma;

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
         * Get the value of obj_escola
         */

    }
?>

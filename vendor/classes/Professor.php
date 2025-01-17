<?php
    class Professor
    {
        private $idProfessor;
        private $matricula;
        private $nomeProfessor;
        private $txtEmail;
        private $fkEscola;

        public function setDadosForm($post)
        {
            // Idetificadores da Escola:
            $this->idProfessor   =$post['idProfessor'];
            $this->matricula     =$post['matricula'];
            $this->nomeProfessor =$post['nomeProfessor'];
            $this->txtEmail      =$post['txtEmail'];
            $this->fkEscola      =$post['fkEscola'];
            
        }

        //Função devolve um array com todos os dados do banco de dados da tabela 
        public function listAll()
        {
            try
            {
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblProfessors order by nomeProfessor;");
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
                    "SELECT * FROM tblProfessores WHERE idProfessor = :ID;",
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
                    "DELETE FROM tblProfessores WHERE idProfessor = :ID;",
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
                    $this->idProfessor = $id;
                }
                
                return ($sql->select(
                    "CALL sp_insert_update_tblProfessores(:ATRIBUTO00,:ATRIBUTO01, :ATRIBUTO02, :ATRIBUTO03, :ATRIBUTO04)",
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
                        ":ATRIBUTO00" => $this->idProfessor,
                        ":ATRIBUTO01" => $this->matricula,
                        ":ATRIBUTO02" => $this->nomeProfessor ,
                        ":ATRIBUTO03" => $this->txtEmail,
                        ":ATRIBUTO04" => $this->fkEscola,
                    );
                break;
            }
        }
    }
?>

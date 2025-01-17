<?php
    class Horarios{
        private $idHorario;
        private $fkEscola;
        private $nomeHorario;

        public function setDadosForm($post)
        {
            $this->idHorario     =$post['idHorario'];
            $this->fkEscola      =$post['fkEscola'];
            $this->nomeHorario   =$post['nomeHorario'];
            
        }

        //Função devolve um array com todos os dados do banco de dados da tabela 
        public function listAll()
        {
            try
            {
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblHorarios order by nomeHorario;");
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
                    "SELECT * FROM tblHorarios WHERE idHorario = :ID;",
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
    }
?>
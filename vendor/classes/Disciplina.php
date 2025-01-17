<?php
    class Disciplinas{
        private $idDisciplina = null;
        private $sigla;
        private $codigoDisciplina;
        private $nomeDisciplina;

        public function setDadosForm($post)
        {
            // Idetificadores da Escola:
            $this->idDisciplina     =$post['idDisciplina'];
            $this->sigla            =$post['sigla'];
            $this->codigoDisciplina =$post['codigoDisciplina'];
            $this->nomeDisciplina   =$post['nomeDisciplina'];
            
        }

        //Função devolve um array com todos os dados do banco de dados da tabela 
        public function listAll()
        {
            try
            {
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblDisciplinas order by nomeDisciplina;");
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
                    "SELECT * FROM tblDisciplinas WHERE idDisciplina = :ID;",
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
                    "DELETE FROM tblDisciplinas WHERE idDisciplina = :ID;",
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
                    $this->idDisciplina = $id;
                }
                
                return ($sql->select(
                    "CALL sp_insert_update_tblDisciplinas(:ATRIBUTO00,:ATRIBUTO01, :ATRIBUTO02, :ATRIBUTO03)",
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
                        ":ATRIBUTO00" => $this->idDisciplina,
                        ":ATRIBUTO01" => $this->sigla,
                        ":ATRIBUTO02" => $this->codigoDisciplina,
                        ":ATRIBUTO03" => $this->nomeDisciplina,
                    );
                break;
            }
        }
    }
?>
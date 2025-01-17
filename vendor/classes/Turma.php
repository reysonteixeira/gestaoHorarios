<?php

use ElementorPro\Modules\Forms\Fields\Date;

class Turma
    {
        // Variaveis pricipais:
        private $idTurma = null;
        private $nomeTurma;
        private $turno;
        private $podeRepetirAula;
        private $fkEscola;

        // Array de apoio:
        public $list_turno = ["MANHÃ", "TARDE", "NOTURNO", "INTEGRAL"];

        // Objetos relacionados:
        // private $obj_escola = new Escola()

        public function setDadosForm($post)
        {
            $this->idTurma         =$post['idTurma'];
            $this->nomeTurma       =$post['nomeTurma'];
            $this->turno           =$post['turno'];
            $this->podeRepetirAula =$post['podeRepetirAula'];
            $this->fkEscola        =$post['fkEscola'];
        }

        //Função devolve um array com todos os dados do banco de dados da tabela 
        public function listAll()
        {
            try
            {
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblTurmas order by nomeTurma;");
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
                    "SELECT * FROM tblTurmas WHERE idTurma = :ID;",
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
                    "DELETE FROM tblTurmas WHERE idTurma = :ID;",
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
                        ":ATRIBUTO02" => $this->turno,
                        ":ATRIBUTO03" => $this->podeRepetirAula,
                        ":ATRIBUTO04" => $this->fkEscola,
                    );
                break;
            }
        }
    }
?>

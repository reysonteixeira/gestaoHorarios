<?php
class DisciplinaTurma
{
        private $idDisciplinaTurma;
        private $fkProfessor;
        private $fkDisciplina;
        private $fkTurma;
        private $fkEscola;
        private $turno;

        private $maximoAulasDia;
        private $maximoAulasSemana;


        public function setDados($dados)
        {
                $this->fkProfessor = $dados['fkProfessor'];
                $this->fkDisciplina = $dados['fkDisciplina'];
                $this->fkEscola = $dados['fkEscola'];
                $this->turno = $dados['intTurno'];
                $this->maximoAulasDia = $dados['maximoAulasDia'];
                $this->maximoAulasSemana = $dados['maximoAulasSemana'];
        }

        public function save()
        {
                try {
                        $sql = new Sql();
                        $sql->select("CALL  sp_insert_update_tblDisciplinasTurma(
                                :idDisciplinaTurma,  :maximoAulasSemana, 
                                :fkDisciplina, :fkProfessor, :fkTurma,  :turno, :maximoAulasDia)", array(
                                ':idDisciplinaTurma' => $this->getIdDisciplinaTurma(),
                                ':fkProfessor' => $this->getFkProfessor(),
                                ':fkDisciplina' => $this->getFkDisciplina(),
                                ':fkTurma' => $this->getFkTurma(),
                                ':turno' => $this->getTurno(),
                                ':maximoAulasDia' => $this->getMaximoAulasDia(),
                                ':maximoAulasSemana' => $this->getMaximoAulasSemana()
                        ));
                } catch (Exception $e) {
                        var_dump($e);
                }
        }


        public function get(){
                try{
                        $sql = new Sql();
                        return $sql->select("SELECT * FROM tblDisciplinasTurma WHERE idDisciplinaTurma = :idDisciplinaTurma", array(
                                ':idDisciplinaTurma' => $this->getIdDisciplinaTurma()
                        ));
                        
                }catch(Exception $e){
                        var_dump($e);
                }
        }

        public function listaDisciplinasTurma()
        {
                try{
                        $sql = new Sql();
                        return $sql->select("SELECT * FROM tblDisciplinasTurma 
                                inner join tblDisciplinas on tblDisciplinasTurma.fkDisciplina = tblDisciplinas.idDisciplina 
                                inner join tblProfessores on tblDisciplinasTurma.fkProfessor = tblProfessores.idProfessor 
                                inner join tblTurmas on tblDisciplinasTurma.fkTurma = tblTurmas.idTurma 
                                WHERE fkTurma = :idTurma and tblTurmas.fkEscola = :fkEscola", array(
                                ':idTurma' => $this->getFkTurma(),
                                ':fkEscola' => $this->getFkEscola()
                                
                        ));
                }catch(Exception $e){
                        var_dump($e);
                }
               
        }

        public function deleteDisciplinaTurma(){
                try{
                        $sql = new Sql();
                        return $sql->select("DELETE FROM tblDisciplinasTurma 
                                WHERE idDisciplinaTurma = :idTurma", array(
                                ':idTurma' => $this->getIdDisciplinaTurma()
                                
                        ));
                }catch(Exception $e){
                        var_dump($e);
                }
        }

        /**
         * Get the value of idDisciplinaTurma
         */
        public function getIdDisciplinaTurma()
        {
                return $this->idDisciplinaTurma;
        }

        /**
         * Set the value of idDisciplinaTurma
         */
        public function setIdDisciplinaTurma($idDisciplinaTurma): self
        {
                $this->idDisciplinaTurma = $idDisciplinaTurma;

                return $this;
        }

        /**
         * Get the value of idProfessorDisciplinaTurma
         */


        /**
         * Get the value of fkProfessor
         */
        public function getFkProfessor()
        {
                return $this->fkProfessor;
        }

        /**
         * Set the value of fkProfessor
         */
        public function setFkProfessor($fkProfessor): self
        {
                $this->fkProfessor = $fkProfessor;

                return $this;
        }

        /**
         * Get the value of fkDisciplina
         */
        public function getFkDisciplina()
        {
                return $this->fkDisciplina;
        }

        /**
         * Set the value of fkDisciplina
         */
        public function setFkDisciplina($fkDisciplina): self
        {
                $this->fkDisciplina = $fkDisciplina;

                return $this;
        }

        /**
         * Get the value of fkTurma
         */
        public function getFkTurma()
        {
                return $this->fkTurma;
        }

        /**
         * Set the value of fkTurma
         */
        public function setFkTurma($fkTurma): self
        {
                $this->fkTurma = $fkTurma;

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
         * Get the value of turno
         */
        public function getTurno()
        {
                return $this->turno;
        }

        /**
         * Set the value of turno
         */
        public function setTurno($turno): self
        {
                $this->turno = $turno;

                return $this;
        }

        /**
         * Get the value of maximoAulasSemana
         */
        public function getMaximoAulasSemana()
        {
                return $this->maximoAulasSemana;
        }

        /**
         * Set the value of maximoAulasSemana
         */
        public function setMaximoAulasSemana($maximoAulasSemana): self
        {
                $this->maximoAulasSemana = $maximoAulasSemana;

                return $this;
        }

        /**
         * Get the value of maximoAulasDia
         */
        public function getMaximoAulasDia()
        {
                return $this->maximoAulasDia;
        }

        /**
         * Set the value of maximoAulasDia
         */
        public function setMaximoAulasDia($maximoAulasDia): self
        {
                $this->maximoAulasDia = $maximoAulasDia;

                return $this;
        }
}

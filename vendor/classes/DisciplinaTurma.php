<?php
    class DisciplinaTurma{
        private $idDisciplinaTurma;
        private $idProfessorDisciplinaTurma;
        private $fkProfessor;
        private $fkDisciplina;
        private $fkTurma;
        private $fkEscola;
        private $turno;
        

        


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
        public function getIdProfessorDisciplinaTurma()
        {
                return $this->idProfessorDisciplinaTurma;
        }

        /**
         * Set the value of idProfessorDisciplinaTurma
         */
        public function setIdProfessorDisciplinaTurma($idProfessorDisciplinaTurma): self
        {
                $this->idProfessorDisciplinaTurma = $idProfessorDisciplinaTurma;

                return $this;
        }

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
    }
?>
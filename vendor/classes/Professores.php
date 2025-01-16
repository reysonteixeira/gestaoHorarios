<?php
    class Professores {
        private $idProfessor;
        private $matricula;
        private $txtemail;
        private $fkEscola;
        

        /**
         * Get the value of idProfessor
         */
        public function getIdProfessor()
        {
                return $this->idProfessor;
        }

        /**
         * Set the value of idProfessor
         */
        public function setIdProfessor($idProfessor): self
        {
                $this->idProfessor = $idProfessor;

                return $this;
        }

        /**
         * Get the value of matricula
         */
        public function getMatricula()
        {
                return $this->matricula;
        }

        /**
         * Set the value of matricula
         */
        public function setMatricula($matricula): self
        {
                $this->matricula = $matricula;

                return $this;
        }

        /**
         * Get the value of txtemail
         */
        public function getTxtemail()
        {
                return $this->txtemail;
        }

        /**
         * Set the value of txtemail
         */
        public function setTxtemail($txtemail): self
        {
                $this->txtemail = $txtemail;

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
    }

?>
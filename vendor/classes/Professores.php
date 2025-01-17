<?php
class Professores
{
        private $idProfessor;
        private $matricula;
        private $txtemail;
        private $fkEscola;

        private $nomeProfessor;


        public function setDados($dados)
        {
                $this->txtemail = $dados['txtemail'];
                $this->nomeProfessor = $dados['nomeProfessor'];
        }

        public function save()
        {
                try {
                        $sql = new Sql();
                        return ($sql->select(
                                "CALL sp_SaveProfessores(:ATRIBUTO1, :ATRIBUTO2, :ATRIBUTO3,:ATRIBUTO4)",
                                array(
                                        ":ATRIBUTO1" => $this->getNomeProfessor(),
                                        ":ATRIBUTO2" => $this->getMatricula(),
                                        ":ATRIBUTO3" => $this->getTxtemail(),
                                        ":ATRIBUTO4" => $this->getFkEscola()
                                ) //fim array
                        ) //fim função select
                        ); //fim return
                } //fim try

                catch (Exception $e) {
                } //fim catch            
        }

        public function update(){
                try {
                        $sql = new Sql();
                        return ($sql->select(
                        "CALL sp_updProfessores(:ATRIBUTO1, :ATRIBUTO2, :ATRIBUTO3,:ATRIBUTO4, :ATRIBUTO5)",
                        array(
                                ":ATRIBUTO1"=>$this->getIdProfessor(),
                                ":ATRIBUTO2" => $this->getNomeProfessor(),
                                ":ATRIBUTO3"=>$this->getMatricula(),
                                ":ATRIBUTO4"=>$this->getTxtemail(),
                                ":ATRIBUTO5"=>$this->getFkEscola()
                        ) //fim array
                        ) //fim função select
                        ); //fim return
                } //fim try
        
                catch (Exception $e) {
                   
                } //fim catch            
        }

        public function listProfessorEscola(){
                try {
                        $sql = new Sql();
                        return ($sql->select(
                                "SELECT * from tblProfessores where fkEscola = :ATRIBUTO1 order by nomeProfessor;",
                                array(
                                        ":ATRIBUTO1" => $this->getFkEscola()
                                ) //fim array
                        ) //fim função select
                        ); //fim return
                } //fim try
        
                catch (Exception $e) {
                   
                } //fim catch      
        }

        public function listAll(){
                try {
                        $sql = new Sql();
                        return ($sql->select(
                                "SELECT * from tblProfessores order by nomeProfessor;"
                        ) //fim função select
                        ); //fim return
                } //fim try
        
                catch (Exception $e) {
                   
                } //fim catch      
        }

        public function getProfessor(){
                try {
                        $sql = new Sql();
                        return ($sql->select(
                                "SELECT * from tblProfessores where idProfessor = :ATRIBUTO1;",
                                array(
                                        ":ATRIBUTO1" => $this->getIdProfessor()
                                ) //fim array
                        ) //fim função select
                        ); //fim return
                } //fim try
        
                catch (Exception $e) {
                   
                } //fim catch      
        }

        public function searchProfessor(){
                try {
                        $sql = new Sql();
                        return ($sql->select(
                                "SELECT * from tblProfessores where nomeProfessor like :ATRIBUTO1;",
                                array(
                                        ":ATRIBUTO1" => "%".$this->getNomeProfessor()."%"
                                ) //fim array
                        ) //fim função select
                        ); //fim return
                } //fim try
        
                catch (Exception $e) {
                   
                } //fim catch
        }

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

        /**
         * Get the value of nomeProfessor
         */
        public function getNomeProfessor()
        {
                return $this->nomeProfessor;
        }

        /**
         * Set the value of nomeProfessor
         */
        public function setNomeProfessor($nomeProfessor): self
        {
                $this->nomeProfessor = $nomeProfessor;

                return $this;
        }
}

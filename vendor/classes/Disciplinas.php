<?php
    class Disciplinas{
        private $idDisciplinas;
        private $txtNomeDisciplina;
        private $intTipoAvaliacao;
        private $matrizCurricular;
        private $tipoConceito;
        private $turma;

        public function save(){
            try {
                $sql = new Sql();
                return ($sql->select(
                    "CALL sp_SaveDisciplinas(:ATRIBUTO2, :ATRIBUTO3,:ATRIBUTO4)",
                    array(
                        ":ATRIBUTO2" => $this->getTxtNomeDisciplina(),
                        ":ATRIBUTO3" => $this->getIntTipoAvaliacao(),
                        ":ATRIBUTO4" => $this->getMatrizCurricular()
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
                    "CALL sp_updDisciplinas(:ATRIBUTO1, :ATRIBUTO2,
                    :ATRIBUTO3, :ATRIBUTO4)",
                    array(
                        ":ATRIBUTO1"=>$this->getIdDisciplinas(),
                        ":ATRIBUTO2" => $this->getTxtNomeDisciplina(),
                        ":ATRIBUTO3"=>$this->getIntTipoAvaliacao(),
                        ":ATRIBUTO4"=>$this->getMatrizCurricular()
                    ) //fim array
                ) //fim função select
                ); //fim return
            } //fim try
    
            catch (Exception $e) {
               
            } //fim catch            
        }



        public static function listAll(){
            try {
                $sql = new Sql();
                return ($sql->select(
                    "SELECT * from tblDisciplinas order by txtNomeDisciplina;"
                ) //fim função select
                ); //fim return
            } //fim try
    
            catch (Exception $e) {
               
            } //fim catch      

           
        }


        public function listaConceitosDisciplina(){
            try {
                $sql = new Sql();
                return ($sql->select(
                    "SELECT * FROM tblConceito inner join tblTipoConceitos on idTipoConceito = fkTipoConceito 
                        inner join tblDisciplinaTurma on fkConceito = idTipoConceito where fkDisciplina = :ATRIBUTO1 
                        and fkTurma = :ATRIBUTO2
                        group by idConceito order by intNota desc;", array(":ATRIBUTO1"=>$this->getIdDisciplinas(), 
                        ":ATRIBUTO2"=>$this->getTurma())
                ) //fim função select
                ); //fim return
            } //fim try
    
            catch (Exception $e) {
               
            } //fim catch      

           
        }


        public function listaConceitosTipo(){
            try {
                $sql = new Sql();
                return ($sql->select(
                    "SELECT * FROM tblConceito where fkTipoConceito = :ATRIBUTO1;", 
                    array(":ATRIBUTO1"=>$this->getTipoConceito())
                ) //fim função select
                ); //fim return
            } //fim try
    
            catch (Exception $e) {
               
            } //fim catch      

           
        }

        public function getDisciplinaTurma(){
            try {
                $sql = new Sql();
                return ($sql->select(
                    "SELECT * FROM tblDisciplinaTurma where fkDisciplina = :ATRIBUTO1 and fkTurma = :ATRIBUTO2;",
                     array(":ATRIBUTO1"=>$this->getIdDisciplinas(), ":ATRIBUTO2"=>$this->getTurma())
                )[0] //fim função select
                ); //fim return
            } //fim try
    
            catch (Exception $e) {
               
            } //fim catch      

           
        }





        public function getTipoAvaliacao(){
            try {
                $sql = new Sql();
                return ($sql->select(
                    "SELECT * from tblDisciplinaTurma where fkDisciplina = :ATRIBUTO1 and fkTurma = :ATRIBUTO2;", 
                        array(":ATRIBUTO1" => $this->getIdDisciplinas(), ":ATRIBUTO2" => $this->getTurma())
                )[0] //fim função select
                ); //fim return
            } //fim try
    
            catch (Exception $e) {
               
            } //fim catch      

           
        }




        
        public function get(){
            try {
                $sql = new Sql();
                return ($sql->select(
                    "SELECT * from tblDisciplinas where idDisciplina = :ATRIBUTO1 ;", 
                        array(":ATRIBUTO1" => $this->getIdDisciplinas())
                )[0] //fim função select
                ); //fim return
            } //fim try
    
            catch (Exception $e) {
               
            } //fim catch      

           
        }



        
        public function delete(){
            try {
                $sql = new Sql();
                return ($sql->select("DELETE from tblDisciplinas WHERE idDisciplina = :ATRIBUTO1;", 
                array(":ATRIBUTO1"=>$this->getIdDisciplinas()))); //fim função select
                //fim return
            } //fim try
    
            catch (Exception $e) {
               
            } //fim catch      

           
        }

        /**
         * Get the value of idDisciplinas
         */
        public function getIdDisciplinas()
        {
                return $this->idDisciplinas;
        }

        /**
         * Set the value of idDisciplinas
         *
         * @return  self
         */
        public function setIdDisciplinas($idDisciplinas)
        {
                $this->idDisciplinas = $idDisciplinas;

                return $this;
        }

        /**
         * Get the value of txtNomeDisciplina
         */
        public function getTxtNomeDisciplina()
        {
                return $this->txtNomeDisciplina;
        }

        /**
         * Set the value of txtNomeDisciplina
         *
         * @return  self
         */
        public function setTxtNomeDisciplina($txtNomeDisciplina)
        {
                $this->txtNomeDisciplina = $txtNomeDisciplina;

                return $this;
        }

        /**
         * Get the value of intTipoAvaliacao
         */ 
        public function getIntTipoAvaliacao()
        {
                return $this->intTipoAvaliacao;
        }

        /**
         * Set the value of intTipoAvaliacao
         *
         * @return  self
         */ 
        public function setIntTipoAvaliacao($intTipoAvaliacao)
        {
                $this->intTipoAvaliacao = $intTipoAvaliacao;

                return $this;
        }

        /**
         * Get the value of matrizCurricular
         */ 
        public function getMatrizCurricular()
        {
                return $this->matrizCurricular;
        }

        /**
         * Set the value of matrizCurricular
         *
         * @return  self
         */ 
        public function setMatrizCurricular($matrizCurricular)
        {
                $this->matrizCurricular = $matrizCurricular;

                return $this;
        }

        /**
         * Get the value of turma
         */
        public function getTurma()
        {
                return $this->turma;
        }

        /**
         * Set the value of turma
         */
        public function setTurma($turma): self
        {
                $this->turma = $turma;

                return $this;
        }

        /**
         * Get the value of tipoConceito
         */
        public function getTipoConceito()
        {
                return $this->tipoConceito;
        }

        /**
         * Set the value of tipoConceito
         */
        public function setTipoConceito($tipoConceito): self
        {
                $this->tipoConceito = $tipoConceito;

                return $this;
        }
    }
?>
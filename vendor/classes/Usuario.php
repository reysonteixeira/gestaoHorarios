<?php

    class Usuario{
        private $idUsuario;
        private $nomeUsuario;
        private $email;
        private $senha;
        private $fkEscola;
        private $tipoAcesso;


        public function setDados($dados){
            $this->setNomeUsuario($dados['nomeUsuario']);
            $this->setEmail($dados['email']);

            $partesNome = explode(" ", $dados['nomeUsuario']); // Divide o nome em partes
$primeiraParte = strtolower($partesNome[0]);
            $this->setSenha(($primeiraParte . "123"));
            $this->setFkEscola($dados['fkEscola']);
            $this->setTipoAcesso($dados['tipoAcesso']);
        }

        public function save(){
            try{
                $sql = new Sql();
                $sql->select("CALL sp_usuarios_insert(:idUsuario, :nomeUsuario, :email, :senha, :fkEscola, :tipoAcesso)", array(
                    ":idUsuario"=>$this->getIdUsuario(),
                    ":nomeUsuario"=>$this->getNomeUsuario(),
                    ":email"=>$this->getEmail(),
                    ":senha"=>$this->getSenha(),
                    ":fkEscola"=>$this->getFkEscola(),
                    ":tipoAcesso"=>$this->getTipoAcesso()
                ));
            }catch(Exception $e){
                var_dump($e->getMessage());
            }
        }

        public function listByEscola(){
            try{
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblUsuarios where idUsuario = :idUsuario and fkEscola = :escola", array(
                    ":idUsuario"=>$this->getIdUsuario(),
                    ":escola"=>$this->getFkEscola()
                ));
            }catch(Exception $e){
                var_dump($e->getMessage());
            }
        }

        public function listAll(){
            try{
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblUsuarios");
            }catch(Exception $e){
                var_dump($e->getMessage());
            }
        }

        public function getUserById(){
            try{
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblUsuarios where idUsuario = :idUsuario where fkEscola = :escola", array(
                    ":idUsuario"=>$this->getIdUsuario(),
                    ":escola"=>$this->getFkEscola()
                ));
            }catch(Exception $e){
                var_dump($e->getMessage());
            }
        }
        /**
         * Get the value of idUsuario
         */
        public function getIdUsuario()
        {
                return $this->idUsuario;
        }

        /**
         * Set the value of idUsuario
         */
        public function setIdUsuario($idUsuario): self
        {
                $this->idUsuario = $idUsuario;

                return $this;
        }

        /**
         * Get the value of nomeUsuario
         */
        public function getNomeUsuario()
        {
                return $this->nomeUsuario;
        }

        /**
         * Set the value of nomeUsuario
         */
        public function setNomeUsuario($nomeUsuario): self
        {
                $this->nomeUsuario = $nomeUsuario;

                return $this;
        }

        /**
         * Get the value of email
         */
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         */
        public function setEmail($email): self
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of senha
         */
        public function getSenha()
        {
                return $this->senha;
        }

        /**
         * Set the value of senha
         */
        public function setSenha($senha): self
        {
            if(!defined('SECRET_IV')){
                define('SECRET_IV', pack('a16', 'Rey1129@'));
                define('SECRET', pack('a16', 'tonner285AMotorola'));
                }
               
                $this->senha = openssl_encrypt($senha,'AES-128-CBC', SECRET, 0, SECRET_IV);
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
         * Get the value of tipoAcesso
         */
        public function getTipoAcesso()
        {
                return $this->tipoAcesso;
        }

        /**
         * Set the value of tipoAcesso
         */
        public function setTipoAcesso($tipoAcesso): self
        {
                $this->tipoAcesso = $tipoAcesso;

                return $this;
        }
    }     
?>
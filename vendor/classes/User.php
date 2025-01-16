<?php

    class User {
       

        private $id;
        private $email;
        private $password;
        private $tipo;
        private $recuperacao;
        private $nome;
        private $localTrabalho;


     

        //FUNCAO verifyLogin
        //Obj.: Consulta se o usuário já está logado no sistema, caso não esteja impede acesso a página solicitada e envia para tela de login
        public static function verifyLogin(){
            if(!isset($_SESSION["user"]["id"])){
                header("location: /login");
                exit;
            }
        } 

        
        //FUNCAO getById
        //Obj.: Realiza a busca de todas informações de determinado usuário igual ao ID solicitado
        public function getById(){
            $sql= new Sql();
            return $sql->select("SELECT * from tblUsers where idUsers = :id;",
            array(":id"=>$this->getId()));
        }


        //FUNCAO setDadosForm
        //Param.: Formulário com informacoes do usuario
        //Obj.: Recebe por parâmetro informacoes do usuario e aplica as informacoes a classe User
        public function setDadosForm($post){
            $this->setNome($post["txtNome"]);
            $this->setEmail($post["txtEmail"]);
            $this->setPassword($post["txtPassword"]);
            $this->setTipo($post["cbTipo"]);
            $this->setLocalTrabalho($post["cbLocal"]);
        }


   

        //FUNCAO save
        //Obj.: Faz conexao com banco de dados e chama Stored Procedure que faz a inclusao de usuarios
        public function save(){
            $sql = new Sql();
            $sql->select("CALL spCadUsuarios(:TIPO, :NOME, :EMAIL,:SENHA, :LOCAL);",
            array(":NOME"=>$this->getNome(),":TIPO"=>$this->getTipo(), ":LOCAL"=>$this->getLocalTrabalho(),
            ":EMAIL"=>$this->getEmail(), ":SENHA"=>$this->getPassword()));
        }



      

        //FUNCAO login
        //Param.: Dados de email e senha do usuario
        //Obj.: Recebe por parâmetro informacoes de login e retorna o ID do usuario ou algum valor para controle de erro
        public function login($email, $password){
            $sql = new Sql();
            $results = $sql->select("SELECT * from tblUsers WHERE txtEmail = :email", array(":email"=>$email));
        
            //Verifica se existe resultados compativeis com o email digitado
            if(count($results) ===0)
            {
                return -1;//Erro pertinente a Email errado
            }
            else{
                //Confere se a senha presente no banco de dados decriptada confere com a senha informada pelo usuario
                if($this->decrypt($results[0]["txtPassword"]) == $password){
                  return $results[0];//ID do usuario
                }
                else{
                   return -2;//Erro pertinente a Senha errada
                }
            }

        }


        //FUNCAO login
        //Obj.: Busca  no banco de dados a senha do usuario
        public function getPasswordBD(){
            $sql = new Sql();
            return $sql->select("SELECT txtPassword FROM tblUsers WHERE idUsers = :id", array(":id"=>$this->getId()))[0]["txtPassword"];
        }

        public function updateEmail(){
            $sql = new Sql();
            $sql->select("UPDATE tblUsers set txtEmail = :email where idUsers = :id;", array(":id"=>$this->getId(),
            ":email"=>$this->getEmail()));
        }

        public function setDadosRecuperacao(){
            $sql = new Sql();
            $sql->select("UPDATE tblUsers set txtRecuperacao= :codigo where txtEmail = :email;", 
            array(":codigo"=>$this->getRecuperacao(), ":email"=>$this->getEmail()));
        }

        public function redefinicao(){
            $sql = new Sql();
            $sql->select("UPDATE tblUsers set txtPassword = :senha where txtRecuperacao = :codigo;", 
            array(":codigo"=>$this->getRecuperacao(), ":senha"=>$this->getPassword()));
            $email = $sql->select("SELECT txtEmail from tblUsers where txtRecuperacao = :codigo;", 
            array(":codigo"=>$this->getRecuperacao()));
            $sql->select("UPDATE tblUsers set txtRecuperacao = null where txtRecuperacao = :codigo;", 
            array(":codigo"=>$this->getRecuperacao()));
            return $email[0];
        }   



        //FUNCAO login
        //Obj.: Atualiza a senha do usuario
        public function updateSenha(){
            $sql = new Sql();
            $sql->select("CALL spPasswordUpdate(:id, :password)", 
            array(":id"=>$this->getId(), ":password"=>$this->getPassword()));
        }

        public function validarEmailCpf(){
            $sql = new Sql();
            return $sql->select("SELECT * from tblUsers where txtEmail = :email or txtCpf = :cpf;",
            array(":email"=>$this->getEmail(), ":cpf"=>$this->getCpf()));
        }

        public function recuperarConta(){
            $sql = new Sql();
            return $sql->select("SELECT * from tblUsers where txtEmail = :email;",
            array(":email"=>$this->getEmail()));
        }

        public function validaSenha(){
            $sql = new Sql();
            return $sql->select("SELECT * from tblUsers where txtPassword = :senha and idUsers = :id;",
            array(":senha"=>$this->getPassword(), ":id"=>$this->getId()));
        }


        public function loginAdmin($email, $password){
            $sql = new Sql();
            $results = $sql->select("SELECT * from tblServidores WHERE txtEmail = :email;", array(":email"=>$email));
            if( count($results) ===0)
            {
                return -1;
            }
            else{
                if($this->decrypt($results[0]["txtSenha"]) == $password){
                  return $results[0];
                }
                else{
                   return -2;
                }
            }
        }


        public function loginCovid($email, $password){
            $sql = new Sql();
            $results = $sql->select("SELECT * from tblProfissionais WHERE txtEmail = :email", array(":email"=>$email));
            if( count($results) ===0)
            {
                return -1;
            }
            else{
                if($this->decrypt($results[0]["txtSenha"]) == $password){
                  return $results[0];
                }
                else{
                   return -2;
                }
            }
        }





        

        public static function verifyLoginAdmin(){
            if(!isset($_SESSION["admin"]["id"])){
                header("location: /admin/login");
                exit;
            }
        }


        
        public static function verifyLoginCovid(){
            if(!isset($_SESSION["acessoCovid"]["id"])  ){
                header("location: /monitoramento-covid/login");
                exit;
            }
        }

       


        

        public static function listAllUsersAdmin(){
            $sql= new Sql();
            return $sql->select("SELECT * from tblUsers where numUserType = 2;");
        }


        public function get(){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tblUsers u INNER JOIN tblPersons p on p.idtblPerson = u.idtblUsers 
            WHERE u.txtEmail = :email", array(":email"=>$this->getEmail()));
        }

       
      

   

        public function verifyUser(){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tblUsers u INNER JOIN tblPersons p on p.idtblPerson = u.idtblUsers 
            WHERE u.txtEmail = :email or p.txtCPF = :cpf;", array(":email"=>$this->getEmail(),":cpf"=>$this->getCpf()));
        }
        






        function validaCPF($cpf) {
 
            // Extrai somente os números
            $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
             
            // Verifica se foi informado todos os digitos corretamente
            if (strlen($cpf) != 11) {
                return false;
            }
        
            // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
            if (preg_match('/(\d)\1{10}/', $cpf)) {
                return false;
            }
        
            // Faz o calculo para validar o CPF
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }
            return true;
        
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
        public function setEmail($email)
        {
                $this->email = $email;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         */ 
        public function setPassword($password)
        {
            if(!defined('SECRET_IV')){
            define('SECRET_IV', pack('a16', 'pirilampos'));
            define('SECRET', pack('a16', 'covid19forabolsonaro'));
            }
           
            $this->password = openssl_encrypt($password,
            'AES-128-CBC', SECRET, 0, SECRET_IV);
        }

        public function decrypt($password){
        
            define('KEY_IV', pack('a16', 'pirilampos'));
            define('KEY', pack('a16', 'covid19forabolsonaro'));
            return (openssl_decrypt($password, 'AES-128-CBC',KEY, 0, KEY_IV ));
        }

        /**
         * Get the value of inAdmin
         */ 
      

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of recuperacao
         */ 
        public function getRecuperacao()
        {
                return $this->recuperacao;
        }

        /**
         * Set the value of recuperacao
         *
         * @return  self
         */ 
        public function setRecuperacao($recuperacao)
        {
                $this->recuperacao = $recuperacao;

                return $this;
        }

        /**
         * Get the value of tipo
         */ 
        public function getTipo()
        {
                return $this->tipo;
        }

        /**
         * Set the value of tipo
         *
         * @return  self
         */ 
        public function setTipo($tipo)
        {
                $this->tipo = $tipo;

                return $this;
        }

        /**
         * Get the value of nome
         */ 
        public function getNome()
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         *
         * @return  self
         */ 
        public function setNome($nome)
        {
                $this->nome = $nome;

                return $this;
        }

        /**
         * Get the value of localTrabalho
         */ 
        public function getLocalTrabalho()
        {
                return $this->localTrabalho;
        }

        /**
         * Set the value of localTrabalho
         *
         * @return  self
         */ 
        public function setLocalTrabalho($localTrabalho)
        {
                $this->localTrabalho = $localTrabalho;

                return $this;
        }
}

?>
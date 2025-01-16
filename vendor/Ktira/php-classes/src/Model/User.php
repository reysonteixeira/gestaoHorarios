<?php

    namespace ktira\Model;

    use \Ktira\DB\Sql;
    use \Ktira\Model\Person;
    
    class User extends Person{
        const SESSION = "User";

        private $id;
        private $email;
        private $password;
        private $inAdmin;



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
            $this->setName($post["txtName"]);
            $this->setCpf($post["txtCPF"]);
            $this->setPhoneNumber($post["txtPhone"]);
            $this->setEmail($post["txtEmail"]);
            $this->setPassword($post["txtPassword"]);
        }


        //FUNCAO setDadosUpdateInfo
        //Param.: Formulário com informacoes de dados do usuario
        //Obj.: Recebe por parâmetro informacoes do usuario e aplica as informacoes a classe User
        public function setDadosUpdateInfo($post){
            $this->setName($post["txtName"]);
            $this->setCpf($post["txtCPF"]);
            $this->setPhoneNumber($post["txtPhone"]);
        }


        //FUNCAO save
        //Obj.: Faz conexao com banco de dados e chama Stored Procedure que faz a inclusao de usuarios
        public function save(){
            $sql = new Sql();
            $sql->select("CALL spUsersSave(:name, :cpf, :phone, :email, :password, :permission);",
            array(":name"=>$this->getName(),":cpf"=>$this->getCpf(), ":phone"=>$this->getPhoneNumber(),
            ":email"=>$this->getEmail(), ":password"=>$this->getPassword(), ":permission"=>$this->getInAdmin()));
        }


        //FUNCAO updateInfo
        //Obj.: Faz conexão com banco de dados e chama Stored Procedure que atualiza as informacoes pessoais do usuario
        public function updateInfo(){
            $sql = new Sql();
            $sql->select("CALL spUsersUpdate(:id, :name, :cpf, :phone);", array(":id"=>$this->getId(),
            ":name"=>$this->getName(), ":cpf"=>$this->getCpf(), ":phone"=>$this->getPhoneNumber()));
        }


        public function updateEmail(){
            $sql = new Sql();
            $sql->select("UPDATE tblUsers set txtEmail = :email where idUsers = :id;", array(":id"=>$this->getId(),
            ":email"=>$this->getEmail()));
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


        //FUNCAO login
        //Obj.: Atualiza a senha do usuario
        public function updateSenha(){
            $sql = new Sql();
            $sql->select("CALL spPasswordUpdate(:id, :password)", 
            array(":id"=>$this->getId(), ":password"=>$this->getPassword()));
        }




        public function loginAdmin($email, $password){
            $sql = new Sql();
            $results = $sql->select("SELECT * from tblUsers WHERE txtEmail = :email and numUserType = 2", array(":email"=>$email));
            if( count($results) ===0)
            {
                return -1;
            }
            else{
                if($this->decrypt($results[0]["txtPassword"]) == $password){
                  return $results[0];
                }
                else{
                   return -2;
                }
            }
        }







        

        public static function verifyLoginAdmin(){
            if(!isset($_SESSION["admin"]["id"]) || !isset($_SESSION["admin"]["auth"]) || !isset($_SESSION["admin"]["hash"]) || $_SESSION["admin"]["hash"] != "ForaBolsonaro" ){
                header("location: /SSBordados-admin/login");
                exit;
            }
        }





        public static function listAllClients(){
            $sql= new Sql();
            return $sql->select("SELECT * from tblUsers u inner join tblPersons p on p.idtblPerson = u.fktblPersons where inAdmin = 0;");
        }

        public static function listAllUsersAdmin(){
            $sql= new Sql();
            return $sql->select("SELECT * from tblUsers u inner join tblPersons p on p.idtblPerson = u.fktblPersons where inAdmin = 1;");
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
        

    //     public static function login($login, $password){
    //     $sql = new Sql();

    //     $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
    //         ":LOGIN"=>$login
    //     ));

    //     if(count($results)===0){
    //         throw new \Exception("Usuario inexistente ou senha inválida.");
    //     }
    //     $data = $results[0];
    //     if(password_verify($password, $data["despassword"])===true)
    //     {
    //         $user = new User();
    //         $user->setData($data);
    //         $_SESSION[User::SESSION]= $user->getValues();
    //         return $user;
    //     }
    //     else{
    //         throw new \Exception("Usuario inexistente ou senha inválida.");
    //     }
    // }

    // public static function verifyLogin($inadmin = true){
    //     if(!isset($_SESSION[User::SESSION]) 
    //       ||!$_SESSION[User::SESSION] 
    //       || !(int)$_SESSION[User::SESSION]["iduser"] > 0 
    //       || (bool)$_SESSION[User::SESSION]["inadmin"]!== $inadmin){
    //         header("Location: /admin/login");
    //         exit;
    //     }
    // }
    // public static function logout(){
    //     $_SESSION[User::SESSION] = NULL;
    // }

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
            define('SECRET_IV', pack('a16', 'pirilampos'));
            define('SECRET', pack('a16', 'covid19forabolsonaro'));
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
        public function getInAdmin()
        {
                return $this->inAdmin;
        }

        /**
         * Set the value of inAdmin
         */ 
        public function setInAdmin($inAdmin)
        {
                $this->inAdmin = $inAdmin;
        }

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
}

?>
<?php
    
    class Escola
    {
        private $idEscola;
        private $txtNome;
        private $txtLogo;

private $txtEndereco; 
private $txtCidade; 
private $txtEstado;
private  $txtTelefone;

private $codigoInep;
private $txtNumero;
private $txtComplemento;
private $txtBairro;
private $txtCep;

private $txtLocalizacao;
private $txtLocalizacaoDiferenciada;
private $txtDDD;

        /*public function __construct($idEscola, $txtNome)
        {
            $this->idEscola = $idEscola;
            $this->txtNome = $txtNome;
        }*/

        /**
         * Get the value of idEscola
         */ 
        public function getIdEscola()
        {
            return $this->idEscola;
        }

        /**
         * Set the value of idEscola
         *
         * @return  self
         */ 
        public function setIdEscola($idEscola)
        {
            $this->idEscola = $idEscola;

            return $this;
        }

        /**
         * Get the value of txtNome
         */ 
        public function getTxtNome()
        {
            return $this->txtNome;
        }

        /**
         * Set the value of txtNome
         *
         * @return  self
         */ 
        public function setTxtNome($txtNome)
        {
            $this->txtNome = $txtNome;

            return $this;
        }

        public function setDadosForm($post)
        {
            /*Atributos da class Turma
            $this->idTurma     ($post["idTurma"]);
            $this->txtNome     ($post["txtNome"]);
            $this->txt
            */
            $this->setTxtNome ($post["txtNome"]);
            $this->setTxtEndereco ($post["txtEndereco"]);
            $this->setTxtCidade ($post["txtCidade"]);
            $this->setTxtEstado ($post["txtEstado"]);
            $this->setTxtTelefone ($post["txtTelefone"]);
            $this->setCodigoInep ($post["codigoInep"]);
            $this->setTxtNumero ($post["txtNumero"]);
            $this->setTxtComplemento ($post["txtComplemento"]);
            $this->setTxtBairro ($post["txtBairro"]);
            $this->setTxtCep ($post["txtCep"]);
            $this->setTxtLocalizacao ($post["txtLocalizacao"]);
            $this->setTxtLocalizacaoDiferenciada ($post["txtLocalizacaoDiferenciada"]);
            $this->setTxtDDD ($post["txtDDD"]);
            
        }

        //Cria array para tratamento de erros
        public function arrayErros($e)
        {
            return(
                array(
                    'mensagem' => $e->getMessage(),//mensagem de erro
                    'linha'    => $e->getLine(),   //linha do erro
                    'file'     => $e->getFile(),   //arquivo do erro
                    'code'     => $e->getCode()    //numero do erro
                )//fim array
            );
        }

        //Função devolve um array com todos os dados do banco de dados da tabela Escola
        static function listAllEscolas()
        {
            try
            {
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblEscola order by txtNome;");
            }//fim try
            
            catch (Exception $e)
            {
                return json_encode(arrayErros($e));
            }//fim catch
        }//fim função listAllEscola()

        //Função de busca por meio do id da tabela
        public function get()
        {
            try{
                $sql = new Sql();
                return ($sql->select("SELECT *, txtNome as nomeEscola FROM tblEscola WHERE idEscola = :ID;",
                        array(
                            ":ID" => $this->getIdEscola()
                        )//fim array
                    )[0]//fim função select
                );//fim return
            }//fim try
            
            catch (Exception $e)
            {
                return json_encode(arrayErros($e));
            }//fim catch
        }//fim função getEscola()

        //Deleta do banco de dados os dados referete ao id
        public function delete()
        {
            try{
                $sql = new Sql();
                return ($sql->query("DELETE FROM tblEscola WHERE idEscola = :ID;",
                        array(
                            ":ID" => $this->getIdEscola()
                        )//fim array
                    )//fim função setquery
                );//fim return
            }//fim try
            
            catch (Exception $e)
            {
                return json_encode(arrayErros($e));
            }//fim catch
        }//fim função deleteEscola()

        public function uploadLogo($files){
            $filename = $files["fotos"]["name"];
            move_uploaded_file($files["fotos"]["tmp_name"],"res/_img/escolas/$filename");
        }

        //Faz insert no banco de dados
        public function save()
        {
            try{
                $sql = new Sql();
                return ($sql->select("CALL spCadEscolas(:ATRIBUTO1, :ATRIBUTO2, :ATRIBUTO3,
                :ATRIBUTO4, :ATRIBUTO5, :ATRIBUTO6, :ATRIBUT07, :ATRIBUTO8, :ATRIBUTO9, :ATRIBUTO10, :ATRIBUTO11,
                :ATRIBUTO12, :ATRIBUTO13, :ATRIBUTO14, :ATRIBUTO15, :ATRIBUTO16)",
                        array(
                            ":ATRIBUTO1" => $this->getTxtNome(),
                            ":ATRIBUTO2" => $this->getTxtLogo(),
                            ":ATRIBUTO3" => $this->getTxtEndereco(),
                            ":ATRIBUTO4" => $this->getTxtCidade(),
                            ":ATRIBUTO5" => $this->getTxtEstado(),
                            ":ATRIBUTO6" => $this->getTxtTelefone(),
                            ":ATRIBUTO7" => $this->getCodigoInep(),
                            ":ATRIBUTO8" => $this->getTxtNumero(),
                            ":ATRIBUTO9" => $this->getTxtComplemento(),
                            ":ATRIBUTO10" => $this->getTxtBairro(),
                            ":ATRIBUTO11" => $this->getTxtCep(),
                            ":ATRIBUTO12" => $this->getTxtEstado(),
                            ":ATRIBUTO13" => $this->getTxtLocalizacao(),
                            ":ATRIBUTO14" => $this->getTxtLocalizacaoDiferenciada(),
                            ":ATRIBUTO15" => $this->getTxtCep(),
                            ":ATRIBUTO16" => $this->getTxtDDD()

                 

                            )
                        )//fim array
                        );//fim função select
                
            }//fim try
            
            catch (Exception $e)
            {
                return json_encode(arrayErros($e));
            }//fim catch
        }//fim função saveCadEscola()

        //Faz update no bancode dados
        public function update()
        {

           
            try{
                $sql = new Sql();
                return ($sql->select("CALL spUpdEscolas(:ATRIBUTO0, 
                :ATRIBUTO1, :ATRIBUTO3, :ATRIBUTO4, :ATRIBUTO5, :ATRIBUTO6,:ATRIBUTO7,  :ATRIBUTO8, :ATRIBUTO9, :ATRIBUTO10, :ATRIBUTO11,
                 :ATRIBUTO13, :ATRIBUTO14, :ATRIBUTO16)",
                        array(
                            ":ATRIBUTO0" => $this->getIdEscola(),
                            ":ATRIBUTO1" => $this->getTxtNome(),
                            ":ATRIBUTO3" => $this->getTxtEndereco(),
                            ":ATRIBUTO4" => $this->getTxtCidade(),
                            ":ATRIBUTO5" => $this->getTxtEstado(),
                            ":ATRIBUTO6" => $this->getTxtTelefone(),
                            ":ATRIBUTO7" => $this->getCodigoInep(),
                            ":ATRIBUTO8" => $this->getTxtNumero(),
                            ":ATRIBUTO9" => $this->getTxtComplemento(),
                            ":ATRIBUTO10" => $this->getTxtBairro(),
                            ":ATRIBUTO11" => $this->getTxtCep(),
                 
                            ":ATRIBUTO13" => $this->getTxtLocalizacao(),
                            ":ATRIBUTO14" => $this->getTxtLocalizacaoDiferenciada(),
                          
                            ":ATRIBUTO16" => $this->getTxtDDD()
                        )//fim array
                    )//fim função select
                );//fim return
            }//fim try
            
            catch (Exception $e)
            {
                return json_encode(arrayErros($e));
            }//fim catch
        }//fim função saveUpdEscola()

        /**
         * Get the value of txtLogo
         */ 
        public function getTxtLogo()
        {
                return $this->txtLogo;
        }

        /**
         * Set the value of txtLogo
         *
         * @return  self
         */ 
        public function setTxtLogo($txtLogo)
        {
                $this->txtLogo = $txtLogo;

                return $this;
        }

/**
 * Get the value of txtEndereco
 */ 
public function getTxtEndereco()
{
return $this->txtEndereco;
}

/**
 * Set the value of txtEndereco
 *
 * @return  self
 */ 
public function setTxtEndereco($txtEndereco)
{
$this->txtEndereco = $txtEndereco;

return $this;
}

/**
 * Get the value of txtCidade
 */ 
public function getTxtCidade()
{
return $this->txtCidade;
}

/**
 * Set the value of txtCidade
 *
 * @return  self
 */ 
public function setTxtCidade($txtCidade)
{
$this->txtCidade = $txtCidade;

return $this;
}

/**
 * Get the value of txtEstado
 */ 
public function getTxtEstado()
{
return $this->txtEstado;
}

/**
 * Set the value of txtEstado
 *
 * @return  self
 */ 
public function setTxtEstado($txtEstado)
{
$this->txtEstado = $txtEstado;

return $this;
}



/**
 * Get the value of txtTelefone
 */ 
public function getTxtTelefone()
{
return $this->txtTelefone;
}

/**
 * Set the value of txtTelefone
 *
 * @return  self
 */ 
public function setTxtTelefone($txtTelefone)
{
$this->txtTelefone = $txtTelefone;

return $this;
}

/**
 * Get the value of codigoInep
 */
public function getCodigoInep()
{
return $this->codigoInep;
}

/**
 * Set the value of codigoInep
 */
public function setCodigoInep($codigoInep): self
{
$this->codigoInep = $codigoInep;

return $this;
}

/**
 * Get the value of txtNumero
 */
public function getTxtNumero()
{
return $this->txtNumero;
}

/**
 * Set the value of txtNumero
 */
public function setTxtNumero($txtNumero): self
{
$this->txtNumero = $txtNumero;

return $this;
}

/**
 * Get the value of txtComplemento
 */
public function getTxtComplemento()
{
return $this->txtComplemento;
}

/**
 * Set the value of txtComplemento
 */
public function setTxtComplemento($txtComplemento): self
{
$this->txtComplemento = $txtComplemento;

return $this;
}

/**
 * Get the value of txtBairro
 */
public function getTxtBairro()
{
return $this->txtBairro;
}

/**
 * Set the value of txtBairro
 */
public function setTxtBairro($txtBairro): self
{
$this->txtBairro = $txtBairro;

return $this;
}

/**
 * Get the value of txtCep
 */
public function getTxtCep()
{
return $this->txtCep;
}

/**
 * Set the value of txtCep
 */
public function setTxtCep($txtCep): self
{
$this->txtCep = $txtCep;

return $this;
}

/**
 * Get the value of txtLocalizacao
 */
public function getTxtLocalizacao()
{
return $this->txtLocalizacao;
}

/**
 * Set the value of txtLocalizacao
 */
public function setTxtLocalizacao($txtLocalizacao): self
{
$this->txtLocalizacao = $txtLocalizacao;

return $this;
}

/**
 * Get the value of txtLocalizacaoDiferenciada
 */
public function getTxtLocalizacaoDiferenciada()
{
return $this->txtLocalizacaoDiferenciada;
}

/**
 * Set the value of txtLocalizacaoDiferenciada
 */
public function setTxtLocalizacaoDiferenciada($txtLocalizacaoDiferenciada): self
{
$this->txtLocalizacaoDiferenciada = $txtLocalizacaoDiferenciada;

return $this;
}

/**
 * Get the value of txtDDD
 */
public function getTxtDDD()
{
return $this->txtDDD;
}

/**
 * Set the value of txtDDD
 */
public function setTxtDDD($txtDDD): self
{
$this->txtDDD = $txtDDD;

return $this;
}
    }//fim da class
?>
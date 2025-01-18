<?php
    class Msg{
        //Cria array para tratamento de erros
        static function arrayErros($e)
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
    }
?>
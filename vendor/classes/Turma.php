<?php

use ElementorPro\Modules\Forms\Fields\Date;

class Turma
{
    private $idTurma;
    private $txtNome;
    private $txtAnoTurma;
    private $fkEscola;
    private $aluno;
    private $professor;
    private $disciplina;
    private $dataMatricula;
    private $dataSaida;
    private $motivoSaida;
    private $dataPesquisada;
    private $etapa;
    private $turno;
    private $nivel;
    private $ensino;
    private $professorRegente;
    private $dataFim;
    private $semestre;
    private $boolStatus;
    private $intTipoSaida;

    private $observacaoHistorico;
    private $observacaoDeclaracao;
    /**
     * Get the value of idTurma
     */
    public function getIdTurma()
    {
        return $this->idTurma;
    }

    /**
     * Set the value of idTurma
     *
     * @return  self
     */
    public function setIdTurma($idTurma)
    {
        $this->idTurma = $idTurma;

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

    /**
     * Get the value of txtAnoTurma
     */
    public function getTxtAnoTurma()
    {
        return $this->txtAnoTurma;
    }

    /**
     * Set the value of txtAnoTurma
     *
     * @return  self
     */
    public function setTxtAnoTurma($txtAnoTurma)
    {
        $this->txtAnoTurma = $txtAnoTurma;

        return $this;
    }

    public function setDadosForm($post)
    {
        $this->setTxtNome(mb_strtoupper($post["txtNome"], 'UTF-8'));
        $this->setTxtAnoTurma($post["txtAnoTurma"]);
        $this->setFkEscola($post["fkEscola"]);
        $this->setEtapa($post["txtEtapa"]);
        $this->setTurno($post["txtTurno"]);
        $this->setNivel($post["txtNivelEnsino"]);
        $this->setEnsino($post["txtEnsino"]);
        if (isset($post["professorResponsavel"])) {
            $this->setProfessorRegente($post["professorResponsavel"]);
        }
    }

    //Cria array para tratamento de erros
    public function arrayErros($e)
    {
        return (array(
                'mensagem' => $e->getMessage(), //mensagem de erro
                'linha'    => $e->getLine(),   //linha do erro
                'file'     => $e->getFile(),   //arquivo do erro
                'code'     => $e->getCode()    //numero do erro
            ) //fim array
        );
    }

    //Função devolve um array com todos os dados do banco de dados da tabela Turma
    public function listAllTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma FROM tblTurma t 
                inner join tblEscola e on idEscola = fkEscola WHERE txtAnoTurma = :ATRIBUTO1 order by e.txtNome, t.txtNome;",
                array(":ATRIBUTO1" => $this->getTxtAnoTurma())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()

    public function listAlunosEscolaTransporte(){
        try{
            $sql = new Sql();
            return $sql->select(
                "SELECT *, a.txtNome as nomeAluno, t.txtNome as nomeTurma FROM `tblTurma` t inner join tblAlunoTurma on fkTurma = idTurma inner join tblAlunos a
                 on idAlunos = fkAluno WHERE txtAnoTurma = :ATRIBUTO1 and fkEscola = :ATRIBUTO2 and boolTransporte = true 
                 order by txtNivelEnsino, txtEtapa, nomeAluno;", array(":ATRIBUTO1" => $this->getTxtAnoTurma(), 
                 ":ATRIBUTO2"=> $this->getFkEscola())
            );
        }catch(Exception $e){

        }
    }

    static function listAnos()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT txtAnoTurma from tblTurma group by txtAnoTurma;"
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()


    public function turmaAlunoProfessor()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT * FROM tblTurma t inner join tblAlunoTurma alunoTurma 
                on idTurma = alunoTurma.fkTurma inner join tblProfessoresTurma pt
                on pt.fkTurma = idTurma  where fkProfessor = :ATRIBUTO1 and fkAluno = :ATRIBUTO2;",
                array(":ATRIBUTO1" => $this->getProfessor(), ":ATRIBUTO2" => $this->getAluno())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()


    public function alunoInTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT * FROM tblTurma t inner join tblAlunoTurma alunoTurma 
                on idTurma = alunoTurma.fkTurma inner join tblProfessoresTurma pt
                on pt.fkTurma = idTurma  where idTurma = :ATRIBUTO1, fkAluno = :ATRIBUTO2;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getAluno())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()


    public function alunoInTurmaAtivo()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT * FROM tblTurma t inner join tblAlunoTurma alunoTurma 
                on idTurma = alunoTurma.fkTurma inner join tblProfessoresTurma pt
                on pt.fkTurma = idTurma  where idTurma = :ATRIBUTO1 and fkAluno = :ATRIBUTO2 and boolStatus = 1;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getAluno())
            )[0];
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()



    public function cadastrarDisciplinaTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "Call spCadDisciplinaTurma(:ATRIBUTO1, :ATRIBUTO2)",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getDisciplina())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()




    public function removerDisciplinaTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "Delete from tblDisciplinaTurma where fkTurma = :ATRIBUTO1 and fkDisciplina = :ATRIBUTO2",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getDisciplina())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()


    public function listarDisciplinasProfessorTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT * from tblProfessorDisciplinaTurma 
                inner join tblDisciplinas on idDisciplina = fkDisciplina
                where fkTurma = :ATRIBUTO1 and fkProfessor = :ATRIBUTO2",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getProfessor())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()


    public function getDisciplinasProfessorTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT  * from tblProfessorDisciplinaTurma where fkTurma = :ATRIBUTO1 
                and fkProfessor = :ATRIBUTO2 and fkDisciplina = :ATRIBUTO3",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getProfessor(), ":ATRIBUTO3" => $this->getDisciplina())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()

    public function getProfessorDisciplinaTurma(){
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT  * from tblProfessorDisciplinaTurma where fkTurma = :ATRIBUTO1 
                and  fkDisciplina = :ATRIBUTO3",
                array(":ATRIBUTO1" => $this->getIdTurma(),  ":ATRIBUTO3" => $this->getDisciplina())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()
    
    public function getTurmaByAnoEtapa(){
        try{
            $sql = new Sql();
            return $sql->select("SELECT * FROM tblTurma where txtAnoTurma = :ATRIBUTO1 and txtEtapa = :ATRIBUTO2 and fkEscola = :ATRIBUTO3",
            
            array(":ATRIBUTO1" => $this->getTxtAnoTurma(), ":ATRIBUTO2" => $this->getEtapa(), ":ATRIBUTO3" => $this->getFkEscola()));
        }catch(Exception $e){

        }
    }

    public function deleteAllDisciplinasProfessorTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "DELETE from tblProfessorDisciplinaTurma where fkTurma = :ATRIBUTO1 
                and fkProfessor = :ATRIBUTO2",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getProfessor())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()

    public function deleteDisciplinaProfessorTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "DELETE from tblProfessorDisciplinaTurma where fkTurma = :ATRIBUTO1 
                and fkProfessor = :ATRIBUTO2 and fkDisciplina = :ATRIBUTO3",
                array(":ATRIBUTO1" => $this->getIdTurma(), 
                ":ATRIBUTO2" => $this->getProfessor(),
                ":ATRIBUTO3" => $this->getDisciplina()
                )
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()




    public function cadastrarDisciplinaProfessorTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "INSERT INTO tblProfessorDisciplinaTurma(fkTurma,fkProfessor, fkDisciplina)
                
                values(:ATRIBUTO1, :ATRIBUTO2, :ATRIBUTO3)",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getProfessor(), ":ATRIBUTO3" => $this->getDisciplina())
            );
        } //fim try

        catch (Exception $e) {
            var_dump($e);
        } //fim catch
    } //fim função listAllTurma()


    public function listarOutrasTurmasEtapa()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT * from tblAlunoTurma inner join tblTurma on idTurma = fkTurma
                where fkEscola =:ATRIBUTO4 and
                txtEtapa = :ATRIBUTO2 and txtAnoTurma = :ATRIBUTO3
                and fkAluno = :ATRIBUTO7
                 and txtEnsino != :ATRIBUTO5 order by dataMatricula desc;",
                array(
                   
                    ":ATRIBUTO2" => $this->getEtapa(),
                    ":ATRIBUTO3" => $this->getTxtAnoTurma(),
                    ":ATRIBUTO4" => $this->getFkEscola(),
                    ":ATRIBUTO5" => $this->getEnsino(),
                    ":ATRIBUTO7" => $this->getAluno()

                )
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()



    public function listarOutrasTurmasEnsino()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT * from tblTurma
                where fkEscola =:ATRIBUTO4 and
                txtEtapa = :ATRIBUTO2 and txtAnoTurma = :ATRIBUTO3
                and idTurma != :ATRIBUTO1;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma(),
                    ":ATRIBUTO2" => $this->getEtapa(),
                    ":ATRIBUTO3" => $this->getTxtAnoTurma(),
                    ":ATRIBUTO4" => $this->getFkEscola(),
                )
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()

    public function verificaAlunoTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "SELECT * from tblAlunoTurma
                where fkTurma = :ATRIBUTO1 and fkAluno = :ATRIBUTO2",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma(),
                    ":ATRIBUTO2" => $this->getAluno()
                )
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()

    public function getDisciplinaTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "select * from tblDisciplinaTurma where fkTurma = :ATRIBUTO1 and 
                fkDisciplina = :ATRIBUTO2;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getDisciplina())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()

    public function getAllDisciplinaTurma()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "select *,  dt.intTipoAvaliacao as tipoDisciplina  from tblDisciplinaTurma dt inner join tblDisciplinas 
                on fkDisciplina = idDisciplina where fkTurma = :ATRIBUTO1 order by intOrdem;",
                array(":ATRIBUTO1" => $this->getIdTurma())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()
    

    public function getAllDisciplinaCurriculoNacional()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "select *, dt.intTipoAvaliacao as tipoDisciplina  from tblDisciplinaTurma dt inner join tblDisciplinas 
                on fkDisciplina = idDisciplina where fkTurma = :ATRIBUTO1 
                and intEstruturaCurricular = 1
                order by intOrdem;",
                array(":ATRIBUTO1" => $this->getIdTurma())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()


    public function getAllDisciplinaDiversificada()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "select *,  dt.intTipoAvaliacao as tipoDisciplina  from tblDisciplinaTurma dt inner join tblDisciplinas 
                on fkDisciplina = idDisciplina where fkTurma = :ATRIBUTO1 
                and intEstruturaCurricular = 2
                order by txtNomeDisciplina;",
                array(":ATRIBUTO1" => $this->getIdTurma())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()


    public function listTurmaProfessor()
    {
        try {
            $sql = new Sql();
            return $sql->select("SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                inner join tblProfessoresTurma  on fkTurma = idTurma where fkProfessor = :PROFESSOR and txtAnoTurma = :ATRIBUTO1 
                order by e.txtNome, 
                t.txtNome;", array(":PROFESSOR" => $this->getProfessor(), ":ATRIBUTO1" => $this->getTxtAnoTurma()));
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função listAllTurma()



    //Função de busca por meio do id da tabela
    public function get()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, t.txtNome as nomeTurma, t.txtEnsino as ensino, s.txtNome as nomeProfessor  FROM tblTurma t inner join tblEscola on fkEscola = idEscola  left join tblServidores s on professorRegente = idServidores WHERE idTurma = :ID;",
                array(
                    ":ID" => $this->getIdTurma()
                ) //fim array
            )[0] //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()


    public function getInfomation()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, t.txtNome as nomeTurma, s.txtNome as nomeProfessor , t.txtEnsino as ensino
                FROM tblTurma t left join tblServidores s on  t.professorRegente = s.idServidores WHERE idTurma = :ID;",
                array(
                    ":ID" => $this->getIdTurma()
                ) //fim array
            )[0] //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()


    public function getEscolaByIDTurma()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola FROM tblTurma  inner join tblEscola e on idEscola = fkEscola  WHERE idTurma = :ID;",
                array(
                    ":ID" => $this->getIdTurma()
                ) //fim array
            )[0] //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()

    //Função de busca que vincula a turma a sua escola por meio do id da tabela
    public function getTurmaEscolaAno()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma FROM tblTurma t inner join tblEscola e on idEscola = fkEscola
                 WHERE idEscola = :ID and txtAnoTurma = :ATRIBUTO1 order by t.txtNome;",
                array(
                    ":ID" => $this->getFkEscola(),
                    ":ATRIBUTO1" => $this->getTxtAnoTurma()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()


    public function getTurmaEscolaAnoEnsinoTurno()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma FROM tblTurma t inner join tblEscola e on idEscola = fkEscola
                 WHERE idEscola = :ID and txtAnoTurma = :ATRIBUTO1 and txtEtapa = :ATRIBUTO2 and txtTurno = :ATRIBUTO3;",
                array(
                    ":ID" => $this->getFkEscola(),
                    ":ATRIBUTO1" => $this->getTxtAnoTurma(),
                    ":ATRIBUTO2" => $this->getEtapa(),
                    ":ATRIBUTO3" => $this->getTurno()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()

    public function getProfessoresTurma(){
        try{
            $sql = new Sql();
            return ($sql->select(
                "SELECT * FROM tblProfessoresTurma pt inner join tblServidores s on fkProfessor = idServidores
                where fkTurma = :ID;",
                array(
                    ":ID" => $this->getIdTurma()
                )
            ) //fim função select
            ); //fim return
        }catch(Exception $e){

        }
    }

    public function getTurmaRegularEscolaAno()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma FROM tblTurma t inner join tblEscola e on idEscola = fkEscola
                 WHERE idEscola = :ID and txtAnoTurma = :ATRIBUTO1 and t.txtEnsino = 1 order by t.txtNome;",
                array(
                    ":ID" => $this->getFkEscola(),
                    ":ATRIBUTO1" => $this->getTxtAnoTurma()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()




    public function getTurmaEscola()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma FROM tblTurma t inner join tblEscola e on idEscola = fkEscola WHERE idEscola = :ID order by t.txtNome;",
                array(
                    ":ID" => $this->getFkEscola()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()


    
    public function getAlunosTurmaComAuxilio()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * FROM tblAlunoTurma inner join tblAlunos on fkAluno = idAlunos WHERE boolBolsaFamilia = true and fkTurma = :ID ORDER BY txtNome;",
                array(
                    ":ID" => $this->getIdTurma()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()


    public function getTurmaAtualAlunoDeclaracao()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma
                 FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                 inner join tblAlunoTurma on fkTurma = idTurma
                 WHERE fkAluno = :ID and dataSaida is null and t.txtEnsino = 1
                order by txtAnoTurma desc;",
                array(
                    ":ID" => $this->getAluno(),
                  
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()

    public function getTurmaAtualAluno()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma
                 FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                 inner join tblAlunoTurma on fkTurma = idTurma
                 WHERE fkAluno = :ID and dataSaida is null 
                 and t.txtEnsino = 1 order by txtAnoTurma desc;",
                array(
                    ":ID" => $this->getAluno(),
                  
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()


    public function getTurmaAlunoByInfantilAtivo()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma
                 FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                 inner join tblAlunoTurma on fkTurma = idTurma
                 WHERE fkAluno = :ID and dataSaida is null 
                 and t.txtNivelEnsino = 'Educação Infantil' order by txtAnoTurma desc;",
                array(
                    ":ID" => $this->getAluno(),
                  
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()

    public function getTurmasAlunoFundamental()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma
                 FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                 inner join tblAlunoTurma on fkTurma = idTurma
                 WHERE fkAluno = :ID 
                 and (t.txtNivelEnsino = 'Ensino Fundamental I' or t.txtNivelEnsino = 'Ensino Fundamental II')  order by 
                 txtAnoTurma desc , boolStatus desc;",
                array(
                    ":ID" => $this->getAluno(),
                  
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()


    public function getAlunoTurmaMatriculaStatus()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos al
                    inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                    where alT.fkTurma= :ATRIBUTO1 and idAlunos = :ATRIBUTO2 and
                        dataMatricula =:ATRIBUTO3 AND boolStatus = :ATRIBUTO4; ",
                array(":ATRIBUTO1" => $this->getIdTurma(), 
                    ":ATRIBUTO2" => $this->getAluno(),
                    ":ATRIBUTO3" => $this->getDataMatricula(),
                    ":ATRIBUTO4" => $this->getBoolStatus()
                    )
            )[0] //fim função select
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas



    public function getAlunoTurmaSaidaStatus()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos al
                    inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                    where alT.fkTurma= :ATRIBUTO1 and idAlunos = :ATRIBUTO2 and
                        dataSaida =:ATRIBUTO3 AND boolStatus = :ATRIBUTO4; ",
                array(":ATRIBUTO1" => $this->getIdTurma(), 
                    ":ATRIBUTO2" => $this->getAluno(),
                    ":ATRIBUTO3" => $this->getDataSaida(),
                    ":ATRIBUTO4" => $this->getBoolStatus()
                    )
            )[0] //fim função select
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas


    public function getTurmaAlunoByIdTurma()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma
                 FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                 inner join tblAlunoTurma on fkTurma = idTurma
                 WHERE idTurma = :ID  and fkAluno = :IDALUNO and dataSaida is null 
                 and t.txtEnsino = 1 order by txtAnoTurma desc;",
                array(
                    ":ID" => $this->getIdTurma(),
                    ":IDALUNO" => $this->getAluno()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma(


        public function getTurmaAlunoDetailsByIdTurma()
        {
            try {
                $sql = new Sql();
                return ($sql->select(
                    "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma
                     FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                  
                     inner join tblAlunoTurma aTurma on aTurma.fkTurma = idTurma
                     left join tblSaidaAlunoTurma st on st.fkAluno = aTurma.fkAluno and st.fkTurma = idTurma 

                     WHERE idTurma = :ID  and aTurma.fkAluno = :IDALUNO
                     and t.txtEnsino = 1 order by txtAnoTurma desc;",
                    array(
                        ":ID" => $this->getIdTurma(),
                        ":IDALUNO" => $this->getAluno()
                    ) //fim array
                ) //fim função select
                ); //fim return
            } //fim try
    
            catch (Exception $e) {
            } //fim catch
        } //fim função getTurma()



        public function getSaidaAlunoDetailsByIdTurma()
        {
            try {
                $sql = new Sql();
                return ($sql->select(
                    "SELECT *
                     FROM tblSaidaAlunoTurma st

                     WHERE fkTurma = :ID  and fkAluno = :IDALUNO;",
                    array(
                        ":ID" => $this->getIdTurma(),
                        ":IDALUNO" => $this->getAluno()
                    ) //fim array
                ) //fim função select
                ); //fim return
            } //fim try
    
            catch (Exception $e) {
            } //fim catch
        } //fim função getTurma()



    public function getInfoTurmaAluno()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma
                 FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                 inner join tblAlunoTurma on fkTurma = idTurma
                 WHERE idTurma = :ID  and fkAluno = :IDALUNO;",
                array(
                    ":ID" => $this->getIdTurma(),
                    ":IDALUNO" => $this->getAluno()
                ) //fim array
            )[0] //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()

    public function getTurmasFundamentalAno(){
        try{
            $sql = new Sql();
            return ($sql->select(
                "SELECT *
                 FROM tblTurma 
                 WHERE  txtNivelEnsino = 'Ensino Fundamental I' and txtAnoTurma = :ANO
                 order by txtAnoTurma desc;",
                array(
                    ":ANO" => $this->getTxtAnoTurma()
                ) //fim array
            ) //fim função select
            ); //fim return
        }catch(Exception $e){

        }
    }


    public function getTurmaAlunoByAno($ano)
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma
                 FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                 inner join tblAlunoTurma on fkTurma = idTurma
                 WHERE fkAluno = :ID and dataSaida is null 
                 and txtEtapa = :ANO
                 and t.txtEnsino = 1;",
                array(
                    ":ID" => $this->getAluno(),
                    ":ANO" => $ano
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função getTurma()

    //Deleta do banco de dados os dados referete ao id
    public function deleteTurma()
    {
        try {
            $sql = new Sql();
            return ($sql->query(
                "DELETE FROM tblTurma WHERE idTurma = :ID;",
                array(
                    ":ID" => $this->getIdTurma()
                ) //fim array
            ) //fim função setquery
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função deleteTurma()


    public function cadastraAlunoTurma()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "INSERT INTO tblAlunoTurma(fkAluno, fkTurma, boolStatus, dataMatricula)
                                VALUES(:ATRIBUTO1, :ATRIBUTO2, true, :ATRIBUTO3)",
                array(
                    ":ATRIBUTO1" => $this->getAluno(),
                    ":ATRIBUTO2" => $this->getIdTurma(),
                    ":ATRIBUTO3" => $this->getDataMatricula(),
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    }

    //Faz listagem de aluno em turma
    public function listAlunosTurma()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos 
                      inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                      left join tblSaidaAlunoTurma st on st.fkAluno = alT.fkAluno and st.fkTurma  = alT.fkTurma and alT.dataSaida  = st.dataSaida
                       where alT.fkTurma= :ATRIBUTO1 order by txtNome;",
                array(":ATRIBUTO1" => $this->getIdTurma())
            ) //fim função select
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas

    public function listAlunosTurmaMatricula()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos
                      inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                      left join tblSaidaAlunoTurma st on st.fkAluno = alT.fkAluno and st.fkTurma  = alT.fkTurma and alT.dataSaida  = st.dataSaida
                       where alT.fkTurma= :ATRIBUTO1 and dataMatricula between :ATRIBUTO2 AND :ATRIBUTO3 order by dataMatricula, txtNome;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getDataMatricula(), ":ATRIBUTO3" => $this->getDataFim())
            ) //fim função select
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas

    public function listAlunosTurmaMovimentacao()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos
                      inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                      inner join tblSaidaAlunoTurma st on st.fkAluno = alT.fkAluno and st.fkTurma  = alT.fkTurma and alT.dataSaida  = st.dataSaida
                       where alT.fkTurma= :ATRIBUTO1 and alT.dataSaida between :ATRIBUTO2 AND :ATRIBUTO3 ORDER by alT.dataSaida, txtNome;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2" => $this->getDataMatricula(), ":ATRIBUTO3" => $this->getDataFim())
            ) //fim função select
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas

    public function listAlunosTurmaCenso()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos 
                      inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                    
                       where alT.fkTurma= :ATRIBUTO1 and (dataSaida is null or dataSaida > '2024-04-30') order by txtNome;",
                array(":ATRIBUTO1" => $this->getIdTurma())
            ) //fim função select
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas


    

    public function listAlunosAtivosTurma()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos al
                      inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                      left join tblSaidaAlunoTurma st on st.fkAluno = alT.fkAluno and st.fkTurma  = alT.fkTurma and alT.dataSaida  = st.dataSaida
                       where alT.fkTurma= :ATRIBUTO1 and (alT.dataSaida > :ATRIBUTO2 or alT.dataSaida is null)  order by al.txtNome; ",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2"=>$this->getDataPesquisada())
            ) //fim função select
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas

    public function listAlunosEixo1Turma()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos 
                          inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                          left join tblSaidaAlunoTurma sAT on idAlunos = sAT.fkAluno and alT.fkTurma = sAT.fkTurma
                          left join tblEvolucaoEuOutro e on idAlunos = e.fkAluno and e.intSemestre = :ATRIBUTO2
                           where alT.fkTurma= :ATRIBUTO1 ;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2"=>$this->getSemestre())
            ) //fim função select
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas


    public function listAlunosEixo2Turma()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos 
                              inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                              left join tblSaidaAlunoTurma sAT on idAlunos = sAT.fkAluno and alT.fkTurma = sAT.fkTurma
                              left join tblEvolucaoFalaEscuta e on idAlunos = e.fkAluno
                              and e.intSemestre = :ATRIBUTO2
                           where alT.fkTurma= :ATRIBUTO1 ;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2"=>$this->getSemestre())            ) //fim função select
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas



    public function listAlunosEixo3Turma()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos 
                                  inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                                  left join tblSaidaAlunoTurma sAT on idAlunos = sAT.fkAluno and alT.fkTurma = sAT.fkTurma
                                  left join tblEspacoTempo e on idAlunos = e.fkAluno
                                  and e.intSemestre = :ATRIBUTO2
                           where alT.fkTurma= :ATRIBUTO1 ;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2"=>$this->getSemestre()))
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas    




    public function listAlunosEixo4Turma()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos 
                                  inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                                  left join tblSaidaAlunoTurma sAT on idAlunos = sAT.fkAluno and alT.fkTurma = sAT.fkTurma
                                  left join tblEvolucaoCorpoGesto e on idAlunos = e.fkAluno
                                  and e.intSemestre = :ATRIBUTO2
                           where alT.fkTurma= :ATRIBUTO1 ;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2"=>$this->getSemestre()))
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas    



    public function listAlunosEixo5Turma()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos 
                                      inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                                      left join tblSaidaAlunoTurma sAT on idAlunos = sAT.fkAluno and alT.fkTurma = sAT.fkTurma
                                      left join tblEvolucaoTracosSons e on idAlunos = e.fkAluno
                                      and e.intSemestre = :ATRIBUTO2
                           where alT.fkTurma= :ATRIBUTO1 ;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2"=>$this->getSemestre()))
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas    




    public function listAlunosEixo6Turma()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos 
                                      inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                                      left join tblSaidaAlunoTurma sAT on idAlunos = sAT.fkAluno and alT.fkTurma = sAT.fkTurma
                                      left join tblObservacaoFicha e on idAlunos = e.fkAluno
                                      and e.intSemestre = :ATRIBUTO2
                           where alT.fkTurma= :ATRIBUTO1 ;",
                array(":ATRIBUTO1" => $this->getIdTurma(), ":ATRIBUTO2"=>$this->getSemestre()))
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas    



    public function listAlunosTurmaInPeriodo()
    {

        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos 
                          inner join tblAlunoTurma alT on idAlunos = alT.fkAluno
                           where alT.fkTurma= :ATRIBUTO1 and dataMatricula >= :ATRIBUTO2 and dataSaida <=;",
                array(":ATRIBUTO1" => $this->getIdTurma())
            ) //fim função select
            ); //fim return
        } //fim try


        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas




    public function listAlunosTurmaAtivos()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos inner join tblAlunoTurma on idAlunos = fkAluno
                       where fkTurma = :ATRIBUTO1 and dataMatricula <= :ATRIBUTO2 and 
                       (dataSaida >= :ATRIBUTO2 or dataSaida is Null) order by txtNome;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma(),
                    ":ATRIBUTO2" => $this->getDataPesquisada()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas

    public function listAlunosTurmaAtivosBimestre()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos inner join tblAlunoTurma on idAlunos = fkAluno
                       where fkTurma = :ATRIBUTO1 and dataMatricula <= :ATRIBUTO3 and 
                       (dataSaida >= :ATRIBUTO2 or dataSaida is Null) order by txtNome;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma(),
                    ":ATRIBUTO3" => $this->getDataPesquisada(),
                    ":ATRIBUTO2" => $this->getDataFim()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas

    public function listAlunosTurmaPeriodo()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos inner join tblAlunoTurma on idAlunos = fkAluno
                           where fkTurma = :ATRIBUTO1 and dataMatricula between :ATRIBUTO1 and :ATRIBUTO2 order by txtNome;",
                array() //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas



    //Faz listagem de aluno em turma
    public function listTurmasEscolaProfessor()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma 
                      FROM tblProfessoresTurma inner join tblTurma t
                      on fkTurma = idTurma inner join tblEscola e on idEscola = fkEscola where  fkProfessor = :ATRIBUTO1 
                      and idTurma != :ATRIBUTO2 and txtAnoTurma = :ATRIBUTO3",
                array(
                    ":ATRIBUTO1" => $this->getProfessor(),
                    ":ATRIBUTO2" => $this->getIdTurma(),
                    ":ATRIBUTO3" => $this->getTxtAnoTurma()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas


    public function listTurmasEscola()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                " SELECT *, p.txtNome as nomeProfessor, t.txtNome as nomeTurma,
                      count(aluno.fkTurma) as qtde
                      from tblTurma t left join tblServidores p on idServidores = professorRegente 
                      inner join tblAlunoTurma aluno on idTurma = fkTurma 
                      inner join tblEscola e on idEscola = fkEscola 
                       where fkEscola = :ATRIBUTO0 and txtAnoTurma = :ATRIBUTO1 and dataSaida is null
                       group by fkTurma
                       ;",
                array(
                    ":ATRIBUTO0" => $this->getFkEscola(),
                    ":ATRIBUTO1" => $this->getTxtAnoTurma()

                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas


    //Faz listagem de aluno em turma
    public function listAlunosOfTurma()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos inner join tblAlunoTurma on idAlunos = fkAluno
                       where fkTurma = :ATRIBUTO1 order by dataSaida, txtNome;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas


    public function listAlunosOfTurmaPeriodo()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos inner join tblAlunoTurma on idAlunos = fkAluno
                           where fkTurma = :ATRIBUTO1 and dataMatricula <= :ATRIBUTO3 
                           and (dataSaida >= :ATRIBUTO2 or isNull(dataSaida)) order by txtNome;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma(),
                    ":ATRIBUTO2" => $this->getDataPesquisada(),
                    ":ATRIBUTO3" => $this->getDataFim()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas

    public function listAlunosOfTurmaPeriodoAula()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos inner join tblAlunoTurma on idAlunos = fkAluno
                               where fkTurma = :ATRIBUTO1 and dataMatricula <= :ATRIBUTO2 
                               and (dataSaida >= :ATRIBUTO2 or isNull(dataSaida)) order by txtNome;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma(),
                    ":ATRIBUTO2" => $this->getDataPesquisada()

                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas


    public function listAlunosOutTurma()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos left join tblAlunoTurma on idAlunos = fkAluno
                           where fkTurma != :ATRIBUTO1 order by txtNome;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas



    public function getAlunoTurma()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * from tblAlunos left join tblAlunoTurma on idAlunos = fkAluno
                           where fkTurma = :ATRIBUTO1 and idAlunos = :ATRIBUTO2 order by txtNome, dataMatricula desc;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma(),
                    ":ATRIBUTO2" => $this->getAluno()
                ) //fim array
            )[0] //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas



    //Faz inclusão de aluno em turma
    public function insereAlunoTurma()
    {
        try {
            $sql = new Sql();
            $sql->select(
                "INSERT INTO tblAlunoTurma(fkAluno, fkTurma) VALUES(:ATRIBUTO1, :ATRIBUTO2);",
                array(
                    ":ATRIBUTO2" => $this->getIdTurma(),
                    ":ATRIBUTO1" => $this->getAluno()
                ) //fim array
            ); //fim função select

        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas

    
    
    //fim de inclusão de aluno em turmas/

    public function removeAlunoTurma()
    {
        try {
            $sql = new Sql();
            $sql->select(
                
                "CALL spCadSaidaTurma(:ATRIBUTO1, :ATRIBUTO2, :ATRIBUTO3, :ATRIBUTO4, :ATRIBUTO5, :ATRIBUTO6, :ATRIBUTO7);",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma(),
                    ":ATRIBUTO2" => $this->getAluno(),
                    ":ATRIBUTO3" => $this->getDataSaida(),
                    ":ATRIBUTO4" => $this->getMotivoSaida(),
                    ":ATRIBUTO5" => $this->getIntTipoSaida(),
                    ":ATRIBUTO6" => $this->getObservacaoHistorico(),
                    ":ATRIBUTO7" => $this->getObservacaoDeclaracao()
                ) //fim array
            ); //fim função select

        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas



    public function apagaAlunoTurma()
    {
        try {
            $sql = new Sql();
            $sql->select(
                "DELETE FROM tblAlunoTurma where fkAluno = :ATRIBUTO1 and fkTurma = :ATRIBUTO2;",
                array(
                    ":ATRIBUTO2" => $this->getIdTurma(),
                    ":ATRIBUTO1" => $this->getAluno(),

                ) //fim array
            ); //fim função select

        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas




    //Faz inclusão de professores em turma
    public function insereProfessores()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "CALL spCadProfessorTurma(:TURMA, :PROFESSOR)",
                array(":PROFESSOR" => $this->getProfessor(), ":TURMA" => $this->getIdTurma())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim listAllServidores()


    //Faz listagem de professores em turma
    public function listProfessoresTurma()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT * FROM tblServidores left join tblProfessoresTurma on fkProfessor =idServidores where fkTurma = :ATRIBUTO1;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas


    public function listProfessoresTurmaSemRegente()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, s.txtNome as nomeProfessor  FROM tblServidores s left join tblProfessoresTurma on fkProfessor =idServidores
                inner join tblTurma on idTurma = fkTurma
                 where fkTurma = :ATRIBUTO1 and idServidores != professorRegente;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas



    //Faz listagem de professores em turma
    public function getAlunoTurmaInfo()
    {


        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma
                    FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                    inner join tblAlunoTurma as at on idTurma = at.fkTurma
                    left join tblSaidaAlunoTurma as st on st.fkAluno = at.fkAluno and st.fkTurma  = at.fkTurma and at.dataSaida  = st.dataSaida
                     where at.fkTurma= :ATRIBUTO1 and at.fkAluno = :ATRIBUTO2 order by at.dataSaida desc;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma(),
                    ":ATRIBUTO2" => $this->getAluno()
                ) //fim array
            ) //fim função select
            )[0]; //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas

    public function getAlunoTurmaOrderByMatricula()
    {


        try {
            $sql = new Sql();
            return ($sql->select(
                "SELECT *, e.txtNome as nomeEscola, t.txtNome as nomeTurma
                    FROM tblTurma t inner join tblEscola e on idEscola = fkEscola 
                    inner join tblAlunoTurma as at on idTurma = at.fkTurma
                    left join tblSaidaAlunoTurma as st on st.fkAluno = at.fkAluno and st.fkTurma  = at.fkTurma and at.dataSaida  = st.dataSaida
                     where at.fkTurma= :ATRIBUTO1 and at.fkAluno = :ATRIBUTO2 order by at.dataMatricula desc;",
                array(
                    ":ATRIBUTO1" => $this->getIdTurma(),
                    ":ATRIBUTO2" => $this->getAluno()
                ) //fim array
            ) //fim função select
            )[0]; //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim de inclusão de aluno em turmas


    //Função que limpa tabela de professores vinculados a turma para posterior inclusão
    public function removeProfessores()
    {
        try {
            $sql = new Sql();
            return $sql->select(
                "DELETE FROM tblProfessoresTurma where fkTurma = :TURMA;",
                array(":TURMA" => $this->getIdTurma())
            );
        } //fim try

        catch (Exception $e) {
        } //fim catch

    }
    //Faz insert no banco de dados
    public function save()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "CALL spCadTurma(:ATRIBUTO1,:ATRIBUTO2, :ATRIBUTO3, :ATRIBUTO4, 
                :ATRIBUTO5, :ATRIBUTO6, :ATRIBUTO7, :ATRIBUTO8)",
                array(
                    ":ATRIBUTO1" => $this->getTxtNome(),
                    ":ATRIBUTO2" => $this->getFkEscola(),
                    ":ATRIBUTO3" => $this->getTxtAnoTurma(),
                    ":ATRIBUTO4" => $this->getEtapa(),
                    ":ATRIBUTO5" => $this->getTurno(),
                    ":ATRIBUTO6" => $this->getNivel(),
                    ":ATRIBUTO7" => $this->getEnsino(),
                    ":ATRIBUTO8" => null
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função saveCadTurma()

    //Faz update no banco de dados
    public function update()
    {
        try {
            $sql = new Sql();
            return ($sql->select(
                "CALL spUpdTurma(:ATRIBUTO0,:ATRIBUTO1,:ATRIBUTO2, :ATRIBUTO3, 
                :ATRIBUTO4, :ATRIBUTO5, :ATRIBUTO6, :ATRIBUTO7, :ATRIBUTO8)",
                array(
                    ":ATRIBUTO0" => $this->getIdTurma(),
                    ":ATRIBUTO1" => $this->getTxtNome(),
                    ":ATRIBUTO2" => $this->getFkEscola(),
                    ":ATRIBUTO3" => $this->getTxtAnoTurma(),
                    ":ATRIBUTO4" => $this->getEtapa(),
                    ":ATRIBUTO5" => $this->getTurno(),
                    ":ATRIBUTO6" => $this->getNivel(),
                    ":ATRIBUTO7" => $this->getEnsino(),
                    ":ATRIBUTO8" => $this->getProfessorRegente()
                ) //fim array
            ) //fim função select
            ); //fim return
        } //fim try

        catch (Exception $e) {
        } //fim catch
    } //fim função saveUpdTurma()


    public function generateHtml($notas, $disciplina, $conceitos, $avaliacao, $alunos, $turma, $supervisionar=false, $rotaRetorno=''){
        $html =  '<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
           <!-- Content Header (Page header) -->
           <div class="content-header">
             <div class="container-fluid">
               <div class="row mb-2">
                 <div class="col-sm-6">
                   <h1 class="m-0 text-dark">Atribuir Nota</h1>
                 </div><!-- /.col -->
               </div><!-- /.row -->
             </div><!-- /.container-fluid -->
           </div>
           <!-- /.content-header -->
       
           <!-- Main content -->
           <section>
             <div class="container-fluid">
               
               
               
       
       
               
                   <table class="table mt-3">
                     <form action="/admin/atribuirNotas/avaliacao/' . $avaliacao . '" method="POST">
                       <input type="hidden" name="turma" value='. $turma;
                       
                       $html.='>
                    <input type="hidden" name="alunos" value="'.htmlspecialchars(json_encode($alunos)) .'">
                       <thead>
                       <tr>
                         <th scope="col">Aluno</th>
                         <th scope="col"></th>
                        
                         <th></th>
                         <th></th>
                       </tr>
                     </thead>
                     <tbody>';

                     for($i=0; $i<count($notas); $i++){
                        $html .= '<tr>
                        <td><label>';
                        $html .= $notas[$i]["nomeAluno"];
                        
                        $html .= '</label>';
                        
                        if($notas[$i]["retroativo"]){
                            $html .= '<span class="badge badge-warning">Entrou na turma em:'.$notas[$i]["retroativo"] .'</span>';
                        }
                        
                       $html.= '</td>';


                        if($disciplina["intTipoAvaliacao"] == 0 || $disciplina["intTipoAvaliacao"] == 1){
                            $html .= '<td><div class="row"><div class="col-3">';

                            if(!$supervisionar){
                               $html.= '<input type="number" class="form-control" pattern="[0-9]+([,\.][0-9]+)?" step="any" style="width: 100px" min="0" max="'.$notas[$i]["notaProva"].'" value="'.$notas[$i]["nota"].'" name="notas[]" id="">';
                            }else{
                               $html.= '<input type="number" class="form-control" disabled pattern="[0-9]+([,\.][0-9]+)?" step="any" style="width: 100px" min="0" max="'.$notas[$i]["notaProva"].'" value="'.$notas[$i]["nota"].'" name="notas[]" id="">';

                            }
                               $html.='</div></div></td>';
                        }else{
                            $html .= '<td><div class="row"><div class="col-3">';


                               if(!$supervisionar){
                                $html.='<select name="conceitos:'.$notas[$i]["idAluno"].'" class="form-control" style="width: 300px;" id="">';
                               }else{

                                $html.='<select name="conceitos:'.$notas[$i]["idAluno"].'" disabled  class="form-control" style="width: 300px;" id="">';

                               }
                                
                                
                                foreach($conceitos as $conceito){
                                    $html .= '<option value="'.$conceito["idConceito"].'"';
                                    
                                    if($conceito["idConceito"] == $notas[$i]["conceito"]){
                                        $html .= ' selected';
                                    }
                                    $html .= '>'.$conceito["txtConceito"].'</option>';
                                }
                                $html .= '</select>';
                            }
                     $html.= '<td></td>
                       <td></td>
                      </tr>';
                     }
                       
       
               
                     $html .= '</tbody>
                     <div class="col-md-1">';

                     if(!$supervisionar){
                        $html .= '  <a href="/admin/avaliacoes/';
                        $html .= $turma;
                        
                        
                        $html .= '" class="btn btn-info">Voltar</a>';
                     }else{
                        $html.= '<a href="';
                        $html .= $rotaRetorno;
                        
                        
                        $html .= '" class="btn btn-info">Voltar</a>';
                     }
                     
                     $html.='</div>
                     
       
                     
                     
                   
                   </table>
                 
                 
                 <!-- ./col -->
               </div>';

               if(!$supervisionar){
                 $html .= '<div class="col-12">
                   <input type="submit" value="ENVIAR" class="btn btn-success form-control">
                 </div>';
               }
               
             $html.='</form>
             </div>
           </section>
           <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->';

         return $html;
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
     *
     * @return  self
     */
    public function setFkEscola($fkEscola)
    {
        $this->fkEscola = $fkEscola;

        return $this;
    }

    /**
     * Get the value of aluno
     */
    public function getAluno()
    {
        return $this->aluno;
    }

    /**
     * Set the value of aluno
     *
     * @return  self
     */
    public function setAluno($aluno)
    {
        $this->aluno = $aluno;

        return $this;
    }

    /**
     * Get the value of professor
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * Set the value of professor
     *
     * @return  self
     */
    public function setProfessor($professor)
    {
        $this->professor = $professor;

        return $this;
    }

    /**
     * Get the value of disciplina
     */
    public function getDisciplina()
    {
        return $this->disciplina;
    }

    /**
     * Set the value of disciplina
     *
     * @return  self
     */
    public function setDisciplina($disciplina)
    {
        $this->disciplina = $disciplina;

        return $this;
    }

    /**
     * Get the value of dataSaida
     */
    public function getDataSaida()
    {
        return $this->dataSaida;
    }

    /**
     * Set the value of dataSaida
     *
     * @return  self
     */
    public function setDataSaida($dataSaida)
    {
        $this->dataSaida = $dataSaida;

        return $this;
    }

    /**
     * Get the value of motivoSaida
     */
    public function getMotivoSaida()
    {
        return $this->motivoSaida;
    }

    /**
     * Set the value of motivoSaida
     *
     * @return  self
     */
    public function setMotivoSaida($motivoSaida)
    {
        $this->motivoSaida = $motivoSaida;

        return $this;
    }

    /**
     * Get the value of dataPesquisada
     */
    public function getDataPesquisada()
    {
        return $this->dataPesquisada;
    }

    /**
     * Set the value of dataPesquisada
     *
     * @return  self
     */
    public function setDataPesquisada($dataPesquisada)
    {
        $this->dataPesquisada = $dataPesquisada;

        return $this;
    }

    /**
     * Get the value of dataMatricula
     */
    public function getDataMatricula()
    {
        return $this->dataMatricula;
    }

    /**
     * Set the value of dataMatricula
     *
     * @return  self
     */
    public function setDataMatricula($dataMatricula)
    {
        $this->dataMatricula = $dataMatricula;

        return $this;
    }

    /**
     * Get the value of etapa
     */
    public function getEtapa()
    {
        return $this->etapa;
    }

    /**
     * Set the value of etapa
     *
     * @return  self
     */
    public function setEtapa($etapa)
    {
        $this->etapa = $etapa;

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
     *
     * @return  self
     */
    public function setTurno($turno)
    {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get the value of nivel
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set the value of nivel
     *
     * @return  self
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get the value of ensino
     */
    public function getEnsino()
    {
        return $this->ensino;
    }

    /**
     * Set the value of ensino
     *
     * @return  self
     */
    public function setEnsino($ensino)
    {
        $this->ensino = $ensino;

        return $this;
    }

    /**
     * Get the value of professorRegente
     */
    public function getProfessorRegente()
    {
        return $this->professorRegente;
    }

    /**
     * Set the value of professorRegente
     *
     * @return  self
     */
    public function setProfessorRegente($professorRegente)
    {
        $this->professorRegente = $professorRegente;

        return $this;
    }

    /**
     * Get the value of dataFim
     */
    public function getDataFim()
    {
        return $this->dataFim;
    }

    /**
     * Set the value of dataFim
     *
     * @return  self
     */
    public function setDataFim($dataFim)
    {
        $this->dataFim = $dataFim;

        return $this;
    }

    /**
     * Get the value of semestre
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * Set the value of semestre
     */
    public function setSemestre($semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }

    /**
     * Get the value of intTipoSaida
     */
    public function getIntTipoSaida()
    {
        return $this->intTipoSaida;
    }

    /**
     * Set the value of intTipoSaida
     */
    public function setIntTipoSaida($intTipoSaida): self
    {
        $this->intTipoSaida = $intTipoSaida;

        return $this;
    }

    /**
     * Get the value of boolStatus
     */
    public function getBoolStatus()
    {
        return $this->boolStatus;
    }

    /**
     * Set the value of boolStatus
     */
    public function setBoolStatus($boolStatus): self
    {
        $this->boolStatus = $boolStatus;

        return $this;
    }

    /**
     * Get the value of observacaoHistorico
     */
    public function getObservacaoHistorico()
    {
        return $this->observacaoHistorico;
    }

    /**
     * Set the value of observacaoHistorico
     */
    public function setObservacaoHistorico($observacaoHistorico): self
    {
        $this->observacaoHistorico = $observacaoHistorico;

        return $this;
    }

    /**
     * Get the value of observacaoDeclaracao
     */
    public function getObservacaoDeclaracao()
    {
        return $this->observacaoDeclaracao;
    }

    /**
     * Set the value of observacaoDeclaracao
     */
    public function setObservacaoDeclaracao($observacaoDeclaracao): self
    {
        $this->observacaoDeclaracao = $observacaoDeclaracao;

        return $this;
    }
}//fim da class
?>

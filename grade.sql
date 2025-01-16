CREATE TABLE  tblEscola (
  `idEscola` INT NOT NULL auto_increment,
  `nomeEscola` VARCHAR(200) not NULL,
  `registroInep` varchar(20) not null,
    `logradouro`varchar(200) null,
	`numero` int,
 `complemento` varchar(200) null,
`bairro` varchar(200) null,
`cidade` varchar(200) null,
`estado` varchar(2) null,
 `cep` varchar(9) null,
`telefone`varchar(11) null,   
  PRIMARY KEY (`idEscola`));
  
  
  create table tblProfessores (
  `idProfessor` int primary key auto_increment,
  `matricula` varchar(200) null,
`txtEmail` varchar(200) null,
fkEscola int,
foreign key (fkEscola) references tblEscola(idEscola)
  )

drop database if exists servico_facil;
create database servico_facil;
use servico_facil;
create table tb_clientes(
	id int primary key AUTO_INCREMENT,
 	email varchar(100) unique not null,
  senha varchar(16) not null,
  creditos numeric(11,2),
  validacao_email int
 );

 create table tb_tipos_servico(
   id int primary key AUTO_INCREMENT,
   nome varchar(30) not null
 );

 create table tb_servicos(
   id int primary key AUTO_INCREMENT,
   fk_id_tipo int,
   descricao varchar(100) not null,
   valor numeric(11,2),
  -- status int, ESSE É PARA A SOLICITAÇÃO QUE SERÁ CONSULTADA PELA TABELA SOLICITAÇÕES
   FOREIGN KEY (fk_id_tipo) REFERENCES tb_tipos_servico(id)
 );

 create table tb_prestadores(
	  id int primary key AUTO_INCREMENT,
 	  email varchar(100) unique not null,
    senha varchar(16) not null,
    validacao_email int,
    ultimo_atendimento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    executando_servico int
 );


 create table tb_solicitacao(
  id int primary key AUTO_INCREMENT,
  fk_id_prestador int,
  fk_id_cliente int,
  fk_id_servico int,
  data_solicitacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  valor_final numeric(11,2),
  status_solicitacao int,
  FOREIGN KEY (fk_id_cliente) REFERENCES tb_clientes(id),
  FOREIGN KEY (fk_id_prestador) REFERENCES tb_prestadores(id),
  FOREIGN KEY (fk_id_servico) REFERENCES tb_servicos(id)
 );
 
 -- popular as tabelas
INSERT INTO `tb_tipos_servico` VALUES (0,'Hidráulica');
INSERT INTO `tb_tipos_servico` VALUES (0,'Elétrica');
INSERT INTO `tb_tipos_servico` VALUES (0,'Conserto de Aparelhos');
INSERT INTO `tb_tipos_servico` VALUES (0,'Pintura');
INSERT INTO `tb_tipos_servico` VALUES (0,'Jardinagem');

-- tabela de serviços
INSERT INTO tb_servicos values(0, 1,'Detecção e reparo de vazamentos de água',200.0);
INSERT INTO tb_servicos values(0, 1,'Desentupimento de pias e ralos',80.00);
INSERT INTO tb_servicos values(0, 1,'Instalação de tubulações de água',150.00);
INSERT INTO tb_servicos values(0, 1,'Conserto de válvulas e registros',120.00);
INSERT INTO tb_servicos values(0, 2,'Conserto de tomada',200.0);
INSERT INTO tb_servicos values(0, 2,'Instalação de painéis elétricos',480.00);
INSERT INTO tb_servicos values(0, 2,'Troca de tomadas e interruptores',150.00);
INSERT INTO tb_servicos values(0, 2,'Instalação de iluminação interna e externa',320.00);
INSERT INTO tb_servicos values(0, 3,'Conserto de Chuveiro',200.0);
INSERT INTO tb_servicos values(0, 3,'Manutenção de Televisão',480.00);
INSERT INTO tb_servicos values(0, 3,'Configuração de Alexa',150.00);
INSERT INTO tb_servicos values(0, 3,'Limpeza de Computadores',80.00);
INSERT INTO tb_servicos values(0, 4,'Pintura de ambiente interno',700.0);
INSERT INTO tb_servicos values(0, 4,'Pintura personalizada',480.00);
INSERT INTO tb_servicos values(0, 4,'Grafite',150.00);
INSERT INTO tb_servicos values(0, 4,'Pintura de fachada',1800.00);
INSERT INTO tb_servicos values(0, 5,'Corte de gramado',300.0);
INSERT INTO tb_servicos values(0, 5,'Remoção de ervas daninhas',200.00);
INSERT INTO tb_servicos values(0, 5,'Manutenção de canteiros',600.00);
INSERT INTO tb_servicos values(0, 5,'Adubação de plantas',150.00);


-- tabela de clientes
INSERT INTO tb_clientes values(0,'cliente1@teste.com.br','senha123',40.00,1);
INSERT INTO tb_clientes values(0,'cliente2@teste.com.br','senha321',0.00,1);


-- tabela de prestadores
INSERT INTO tb_prestadores values(0,'prestador1@teste.com.br','senha456',1,"2023-11-14 13:18:00",0);
INSERT INTO tb_prestadores values(0,'prestador2@teste.com.br','senha654',1,"2023-11-14 13:18:00",1);


insert into tb_solicitacao values(0,2,2,1,"2023-11-14 13:18:00",300.0,2);
insert into tb_solicitacao values(0,2,1,1,"2023-11-14 13:18:00",300.0,1);
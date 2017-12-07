/* Script definitivo do banco de dados Gerenciador 
* Author - Huriel Lopes
* Data de Criação - 11/11/2017
* Descrição - Desenvolvimento de tabelas, restrições de tabelas, ligação de chaves estrangeiras, criação de procedures, triggers, views! 
*/

-- Criação do Banco de Dados
CREATE DATABASE gerenciador;

-- Usa o banco
USE gerenciador;

-- TABELA USUARIO
CREATE TABLE usuarios(
    idUsuario int not null auto_increment,
    nomeUsuario varchar(255) not null,
    rg varchar(13) null,
    cpfUsuario varchar(14) UNIQUE NOT NULL,
    email varchar(255) UNIQUE NOT NULL,
    senha varchar(200) not null,
    id_nivel int not null,
    ativo char(1) not null,
    dtcadastro TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP,
    primary key(idUsuario)
);

-- ADICIONANDO RESTRIÇÃO NA COLUNA ATIVO
ALTER TABLE usuarios ADD CONSTRAINT CK_ativo CHECK(ativo in('1','0'));

-- TABELA NIVEL DE ACESSO (ESTÁTICO)
CREATE TABLE nivelacesso(
    idnivel int not null auto_increment,
    nivel char(1) not null,
    descricao varchar(200) not null,
    dtcadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(idnivel)
);

-- ADICIONANDO RESTRIÇÃO NA COLUNA NIVEL
ALTER TABLE nivelacesso ADD CONSTRAINT CK_nivel CHECK(nivel in('A','F','G'));

-- ADICIONANDO FOREIGN KEY E CONSTRAINT ENTRE A TABELA USUARIOS E NIVELACESSO
ALTER TABLE usuarios ADD CONSTRAINT FK_usuario_nivel 
FOREIGN KEY(id_nivel) REFERENCES nivelacesso(idnivel);

-- POPULANDO A TABELA NIVEL DE ACESSO
INSERT INTO nivelacesso(nivel,descricao,dtcadastro)VALUES('A','Administrador',now()),('F','Funcionario',now()),('G','Gestor',now());

-- TABELA CLIENTES
CREATE TABLE cliente(
    idcliente int not null auto_increment,
    nomeCliente varchar(255) not null,
    rg varchar(10) NULL DEFAULT NULL,
    Cpf varchar(15) null UNIQUE DEFAULT NULL,
    Cnpj varchar(20) null UNIQUE DEFAULT NULL,
    id_tipo int not null,
    nascimentoCliente date not null,
    email varchar(255) UNIQUE not null,
    senha varchar(200),
    telefone varchar(15) not null,
    sexo char(1) not null,
    endereco varchar(255) not null,
    numero varchar(10) not null,
    complemento varchar(200) null DEFAULT NULL,
    cep varchar(11) not null,
    uf char(2) not null,
    cidade varchar(150) not null,
    bairro varchar(150) not null,
    ativo char(1) DEFAULT '1',
    dtcadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(idcliente)
);

-- Tabela Tipo de Pessoa
CREATE TABLE tipo(
    idtipo int not null auto_increment,
    tipo char(2) not null,
    descricao varchar(200) not null,
    dtcadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(idtipo)
);

-- ADICIONANDO RESTRIÇÃO NA COLUNA TIPO TABELA TIPO
ALTER TABLE tipo ADD CONSTRAINT CK_tipo CHECK(tipo in('PF','PJ'));

-- POPULANDO A TABELA TIPO
INSERT INTO tipo(tipo,descricao,dtcadastro)VALUES('PF','Pessoa Física',now()),
('PJ','Pessoa Jurídica',now());

-- ADICIONANDO RESTRIÇÃO NA COLUNA ATIVO TABELA CLIENTE
ALTER TABLE cliente ADD CONSTRAINT CK_ativo CHECK(ativo in('1','0'));

-- ADICIONANDO RESTRIÇÃO NA COLUNA SEXO TABELA CLIENTE
ALTER TABLE cliente ADD CONSTRAINT CK_sexo CHECK(sexo in('M','F'));

-- ADICIONANDO FOREIGN KEY E CONSTRAINT NA TABLE CLIENTE
ALTER TABLE cliente ADD CONSTRAINT FK_cliente_tipo 
FOREIGN KEY(id_tipo) REFERENCES tipo(idtipo);

-- TABELA FORNECEDOR)
CREATE TABLE fornecedor(
    idfornecedor int not null auto_increment,
    nomeFantasia varchar(255) not null,
    razaoSocial varchar(255) not null,
    cnpj varchar(20) not null,
    dataCriacao date not null,
    email varchar(150) not null UNIQUE,
    telefone varchar(15),
    endereco varchar(100) not null,
    numero char(3) not null,
    complemento varchar(150),
    cep varchar(11) not null,
    uf char(2) not null,
    cidade varchar(100) not null,
    bairro varchar(100) not null,
    ativo char(1) not null,
    dtcadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(idfornecedor)
);

-- ADICIONANDO RESTRIÇÃO NA COLUNA ATIVO TABELA FORNECEDOR
ALTER TABLE fornecedor ADD CONSTRAINT CK_ativo CHECK(ativo in('1','0'));

-- TABELA PRODUTO
CREATE TABLE produto(
    idProduto int not null auto_increment,
    cod_produto varchar(8) not null UNIQUE,
    nomeProduto varchar(255) not null,
    validade date not null,
    quantidade varchar(255) not null,
    descricao varchar(255) not null,
    valor float(10,2) not null,
    id_categoria int not null,
    id_fornecedor int not null,
    ativo char(1) not null DEFAULT '1',
    dtcadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(idProduto)
);

-- TABELA CATEGORIA
CREATE TABLE categoria(
    idcategoria int not null auto_increment,
    nomeCategoria varchar(255) not null,
    descricao varchar(150) not null,
    ativo char(1) not null,
    dtcadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(idcategoria)
);

-- ADICIONANDO RESTRIÇÃO NO CAMPO ATIVO TABELA CATEGORIA
ALTER TABLE categoria ADD CONSTRAINT CK_ativo CHECK(ativo in('1','0'));

ALTER TABLE produto ADD CONSTRAINT CK_ativo CHECK(ativo in('1','0'));

-- ADICIONANDO FOREING KEY E CONSTRAINT NA TABELA PRODUTO
ALTER TABLE produto ADD CONSTRAINT FK_fornecedor_produto
FOREIGN KEY(id_fornecedor) REFERENCES fornecedor(idfornecedor);

ALTER TABLE produto ADD CONSTRAINT FK_categoria_produto
FOREIGN KEY(id_categoria) REFERENCES categoria(idcategoria);

-- TABELA VENDAS
CREATE TABLE vendas(
    idvendas int not null auto_increment,
    id_produto int,
    id_cliente int,
    qtd_vendida varchar(10),
    id_forma int,
    id_status int,
    dtcadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(idvendas)
);

-- TABELA FORMA PAGAMENTO ESTÁTICA
CREATE TABLE formapagamento(
    idforma int not null auto_increment,
    forma CHAR(2) NOT NULL,
    descricao varchar(200) NOT NULL,
    dtcadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(idforma)
);

-- ADICIONANDO RESTRIÇÃO NO CAMPO FORMA TABELA FORMA PAGAMENTO
ALTER TABLE formapagamento ADD CONSTRAINT CK_forma CHECK(forma in('B','CC','CD','D'));

-- POPULANDO A TABELA FORMA PAGAMENTO
INSERT INTO formapagamento(forma,descricao,dtcadastro)VALUES('B','Boleto Bancário',now()),('CC','Cartão de Crédito',now()),('CD','Cartão de Débito',now()),('D','Dinheiro',now());

-- ADICIONANDO FOREIGN KEY E CONSTRAINT NA TABELA VENDAS
ALTER TABLE vendas ADD CONSTRAINT FK_produto_vendas
FOREIGN KEY(id_produto) REFERENCES produto(idproduto);

ALTER TABLE vendas ADD CONSTRAINT FK_cliente_vendas
FOREIGN KEY(id_cliente) REFERENCES cliente(idcliente);

ALTER TABLE vendas ADD CONSTRAINT FK_Pagamento_vendas
FOREIGN KEY(id_forma) REFERENCES formapagamento(idforma);

-- TABELA TBSTATUS
CREATE TABLE tbstatus(
    idstatus int not null auto_increment,
    stat char(2) not null,
    descstatus varchar(200) not null,
    dtcadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(idstatus)
);

-- ADICIONANDO RESTRIÇÃO NO CAMPO STAT TABELA TBSTATUS
ALTER TABLE tbstatus ADD CONSTRAINT CK_stat CHECK(stat in('A','C','P'));

-- POPULANDO A TABELA TBSTATUS
INSERT INTO tbstatus(stat,descstatus,dtcadastro)VALUES('A','Andamento',now()),
('C','Concludo',now()),('P','Pendente',now());

-- ADICIONANDO FOREIGN KEY E CONSTRAINT NA TABELA VENDAS
ALTER TABLE vendas ADD CONSTRAINT FK_status_vendas
FOREIGN KEY(id_status) REFERENCES tbstatus(idstatus);

-- TABELA CARRINHO
CREATE TABLE carrinho(
    idcarrinho int not null auto_increment,
    qtd_compras varchar(100),
    id_produto int,
    id_cliente int,
    dtcadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(idcarrinho)
);

-- ADICIONANDO FOREIGN KEY E CONSTRAINT NA TABELA CARRINHO
ALTER TABLE carrinho ADD CONSTRAINT FK_produto_carrinho
FOREIGN KEY(id_produto) REFERENCES produto(idproduto);

ALTER TABLE carrinho ADD CONSTRAINT FK_cliente_carrinho
FOREIGN KEY(id_cliente) REFERENCES cliente(idcliente);

-- VIEW DE RELATÓRIO DE ESTOQUE/PRODUTO
CREATE VIEW V_RelEstoque AS
SELECT 
    p.cod_produto,
    p.nomeProduto,
    p.quantidade,
    p.valor,
    c.nomeCategoria,
    f.nomeFantasia,
    p.dtcadastro
FROM produto as p
INNER JOIN categoria as c
ON p.id_categoria = c.idcategoria
INNER JOIN fornecedor as f
ON p.id_fornecedor = f.idfornecedor;

-- VIEW DE RELATÓRIO DE CLIENTES
CREATE VIEW V_RelClientes AS
SELECT 
    c.nomeCliente,
    c.Cpf,
    c.Cnpj,
    t.tipo,
    DATE_FORMAT(c.nascimentoCliente,'%d/%m/%Y') as nascimentoCliente,
    c.email,
    c.sexo,
    c.telefone,
    c.uf,
    c.ativo,
    c.dtcadastro
FROM cliente as c
INNER JOIN tipo t
on c.id_tipo = t.idtipo;

-- VIEW DE RELATÓRIO DE VENDAS
CREATE VIEW V_RelVendas AS
SELECT
    c.nomeCliente,
    c.Cpf,
    c.email,
    c.telefone,
    p.cod_produto,
    p.nomeProduto,
    p.quantidade,
    p.valor,
    f.forma,
    v.dtcadastro
FROM vendas as v
INNER JOIN produto as p
ON v.id_produto = p.idproduto
INNER JOIN cliente as c
ON v.id_cliente = c.idcliente
INNER JOIN formapagamento as f
ON v.id_forma = f.idforma;

-- TRIGGER PARA ATUALIZAR QUANTIDADE DE PRODUTO QUANDO HOUVER UM INSERT NA TABELA DE VENDAS

DELIMITER $$

CREATE TRIGGER Atualiza_quantidade
AFTER INSERT ON vendas
FOR EACH ROW
BEGIN
    UPDATE produto SET quantidade = quantidade-new.qtd_vendida where produto.idProduto = new.id_produto;    
END
$$

DELIMITER ;

-- TRIGGER PARA ATUALIZAR QUANTIDADE DE PRODUTO QUANDO HOUVER UM INSERT NA TABELA DE CARRINHO

DELIMITER $$

CREATE TRIGGER Atualiza_qtd_Produto
AFTER INSERT ON carrinho
FOR EACH ROW
BEGIN
    IF (new.qtd_compras > 0) THEN
        UPDATE produto SET quantidade = quantidade-new.qtd_compras WHERE produto.idProduto = new.id_produto;
    END IF;
END

$$

DELIMITER ;
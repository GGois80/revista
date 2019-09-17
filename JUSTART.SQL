CREATE DATABASE justArt DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci; -- usar sempre CREATE DATABASE justArt DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE justArt;

CREATE TABLE usuario(
id_usuario int auto_increment primary key,
nome  varchar(30) not null,
sexo  varchar(1) not null, -- f: feminino / m: masculino
email varchar(40) not null,
foto  varchar(37) null,
cel	  varchar(17) not null,
senha varchar(40) not null,
flag  int(1) not null,  -- 1=UsuarioComun, 2=Jornalista 3=ADM 
moderuser int(1) not null -- 1= ativo 2= bloqueado/O AM pode bloquear tanto usuario nivel 1 é 2/Pois o ADM pode bloquear o usuario. isso não tem nada aver com o sistema de chutar.
);

CREATE TABLE noticia(
id_not int auto_increment primary key,
texto Longtext not null,
foto  varchar(37) null,
data_noticia DATETIME not null,
titulo varchar(255) not null, 
id_usunot integer,

CONSTRAINT fk_usunot FOREIGN KEY (id_usunot) REFERENCES usuario (id_usuario)
);

CREATE TABLE comentarios(
id_com int auto_increment primary key,
comentario varchar(255) not null,
moderado int(1) null, -- 1: comentario esperando ser aprovado/ 2: comentario aprovado e exibido.
data_coment DATETIME not null,
id_usucom integer,
id_comentnot integer,

CONSTRAINT fk_usucom FOREIGN KEY (id_usucom) REFERENCES usuario (id_usuario),
CONSTRAINT fk_comentnot FOREIGN KEY (id_comentnot) REFERENCES noticia (id_not)
);

 SELECT * FROM usuario;

 -- update usuario set flag = 3 where id_usuario = 1; -- // isso ira mudar de usuario comun para ADM, não se preocupe com a foto,pq todas as fotos de usuario estão em uma só pasta.

-- /*************************TESTES! CODIGOS************************************/
-- INSERT INTO noticia(texto,data_noticia,id_usunot) VALUES('testeteste2222',now(),2);
-- DELETE FROM usuario where id_usuario =3; -- deletar adm antigo sem foto.
-- DROP DATABASE justart;
-- SELECT id_usuario,nome,email,flag FROM usuario where email='etec2@gmail.com'and sha1('1234');
-- PHP: Sistema de Login com Níveis de Acesso
-- Drop database justart;
-- UPDATE  usuario SET nome='jonfrank2',sexo='m',email='jonfranksiles@gmail.com',cel='(11)99123-1234',senha=sha1('1234'),flag=1,moderuser=1 WHERE id_usuario = 3;
-- SELECT u.id_usuario AS idusuario, u.nome, c.id_com AS idcoment, c.comentario, c.data_coment, c.id_usucom, c.id_comentnot FROM usuario u INNER JOIN comentarios c ON u.id_usuario = c.id_usucom AND moderado =1 WHERE c.id_comentnot = 1;
-- alter table comentarios drop column moderado;
-- INSERT INTO usuario(nome,sexo,email,cel,senha,flag,moderuser) VALUES('Elias','m','elias@gmail.com','912345678',sha1('1234'),3,1);
-- UPDATE comentarios SET moderado = 2 WHERE id_com = $id_com;
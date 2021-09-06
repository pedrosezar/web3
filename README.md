# Projeto WEB III

<p>Este projeto foi desenvolvido na disciplina Desenvolvimento para WEB III do curso de Tecnologia em Sistemas para Internet da Universidade Tecnológica Federal do Paraná. Campus Guarapuava, ministrada pelo Professor Guilherme da Costa Silva.</p>

### :desktop_computer: Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [Apache](https://www.apache.org/), [MySQL](https://www.mysql.com/), [PHP](https://www.php.net/).
Além disto é bom ter um editor para trabalhar com o código como [Sublime Text](https://www.sublimetext.com/)

### :hammer_and_wrench: Tecnologias

As seguintes ferramentas estão sendo utilizadas na construção do projeto

- [Apache 2.4.41](https://www.apache.org/)
- [MySQL 8.0.26](https://www.mysql.com/)
- [PHP 7.4.3](https://www.php.net/)
- [Bootstrap 4.1.3](https://getbootstrap.com.br/)
- [DW3](https://github.com/guilhermedacsilva/web3)

### :game_die: Rodando o Projeto

- Clonar o repositório com ```git clone```
- Executar o script SQL para criação da Base de Dados e das Tabelas
```bash
CREATE DATABASE culinaria COLLATE utf8_unicode_ci;

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha CHAR(60) NOT NULL,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE receitas (
    id INT NOT NULL AUTO_INCREMENT,
    categoria_id INT NOT NULL,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    ingredientes TEXT NOT NULL,
    modo_preparo TEXT NOT NULL,
    data_cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
)
ENGINE = InnoDB;

CREATE TABLE comentarios (
    id INT NOT NULL AUTO_INCREMENT,
    receita_id INT NOT NULL,
    usuario_id INT NOT NULL,
    comentario TEXT NOT NULL,
    data_comentario TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (receita_id) REFERENCES receitas (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
)
ENGINE = InnoDB;
```
- Editar o arquivo ```qsaboroso/cfg/banco.php``` com as configurações de acesso ao banco de dados ```culinaria```

### Autor
---

 <img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/58284302?v=4" width="100px;" alt=""/>

Feito com :heart: por Pedro Sézar :wave: Entre em contato!

[![Linkedin Badge](https://img.shields.io/badge/-LinkedIn-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/pedro-sézar-1783b0140/)](https://www.linkedin.com/in/pedro-sézar-1783b0140/)
[![Gmail Badge](https://img.shields.io/badge/-Gmail-c14438?style=flat-square&logo=Gmail&logoColor=white&link=mailto:pedrosezar@gmail.com)](mailto:pedrosezar@gmail.com)

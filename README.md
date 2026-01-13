# site_php

## Descrição
Este projeto consiste num **site desenvolvido em PHP**, com **base de dados MySQL**, destinado à **gestão de equipamentos dos LED**.  
A aplicação permite administrar equipamentos e recursos, com funcionalidades de autenticação e gestão de dados através de uma interface web simples.

## Objetivo
O principal objetivo deste projeto é apoiar a **gestão de equipamentos**, permitindo o seu registo, consulta e edição, servindo também como projeto **educativo** para consolidação de conhecimentos em PHP e bases de dados.

## Funcionalidades
- Login e logout de utilizadores
- Gestão de equipamentos (criar, listar e editar)
- Gestão de recursos
- Ligação a base de dados MySQL
- Interface web desenvolvida com PHP, HTML, CSS e JavaScript
- Estrutura modular com ficheiros reutilizáveis

## Estrutura do Projeto
/css -> Ficheiros de estilos
/images -> Imagens do site
/js -> Scripts JavaScript
/video -> Conteúdos multimédia
db_connect.php -> Ligação à base de dados
header.php -> Cabeçalho comum
footer.php -> Rodapé comum
index.php -> Página inicial
login.php -> Autenticação de utilizadores
logout.php -> Encerramento de sessão
lista_equipamentos.php -> Listagem de equipamentos
editar_equipamento.php -> Edição de equipamentos
lista_requisicoes.php -> Gestão de requisições
criar_base_de_dados_e_tabelas.txt -> Instruções de criação da BD
gestaobd.sql -> Script SQL da base de dados

## Requisitos
- Servidor Web (Apache recomendado)
- PHP 7.x ou superior
- MySQL ou MariaDB
- Navegador web atualizado

## Instalação
1. Copiar o projeto para a pasta do servidor web (ex: `htdocs` ou `www`)
2. Criar uma base de dados em MySQL
3. Importar o ficheiro `gestaobd.sql`
4. Configurar o ficheiro `db_connect.php` com os dados de acesso à base de dados
5. Aceder ao projeto através do navegador

## Base de Dados
A base de dados é utilizada para armazenar informação relativa a:
- Utilizadores
- Equipamentos
- Recursos
- Requisições

O ficheiro `gestaobd.sql` contém toda a estrutura necessária para criação das tabelas.

## Tecnologias Utilizadas
- PHP
- MySQL
- HTML
- CSS
- JavaScript

## Notas Finais
Este projeto foi desenvolvido com fins **académicos**, permitindo aplicar conceitos de programação web, bases de dados e organização de projetos em PHP.


# Laravel Roadmap: Advanced Beginner Level Challenge

Este repositório contém minha implementação do Advanced Beginner Level Challenge Laravel. O objetivo deste projeto é cobrir o maior número possível de tópicos listados no desafio, proporcionando uma compreensão prática e aprofundada das funcionalidades do Laravel.

## Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Funcionalidades Implementadas](#funcionalidades-implementadas)
- [Pré-requisitos](#pre-requisitos)
- [Instalação](#instalacao)
- [Como Usar](#como-usar)
- [Construído com](#construido-com)

## Sobre o Projeto

Este projeto foi criado para demonstrar o conhecimento e a aplicação prática dos conceitos do Laravel em um nível iniciante avançado. A implementação abrange diversos tópicos essenciais para o desenvolvimento de aplicações web robustas usando o Laravel.

## Funcionalidades Implementadas

- Autenticação com Laravel Breeze
- Operações CRUD 
- Validação de Dados
- Envio de E-mails
- Permissões e Funções
- Manipulação de Relacionamentos Eloquent
- Paginação
- Seeders e Factories

## Pré-requisitos

- PHP >= 7.4
- Composer
- MySQL ou outro banco de dados compatível
- Node.js e NPM (para compilação de assets)

## Instalação

Siga os passos abaixo para configurar e rodar o projeto localmente:

1. Clone o repositório:
    
```bash
$ git clone 
$ cd seu-repositorio

```
    
2. Instale as dependências do PHP e do Node.js:
    
```bash
$ composer install
$ npm install
$ npm run dev

```
    
3. Configure o arquivo `.env`:
    
```bash
$ cp .env.example .env
$ php artisan key:generate

```
    
4. Configure as variáveis de ambiente no arquivo `.env`, como conexão com o banco de dados e outras configurações necessárias.
5. Execute as migrações e os seeders:
    
```bash
$ php artisan migrate --seed

```
    
6. Inicie o servidor de desenvolvimento:
    
```bash
$ php artisan serve

```
    

## Como Usar

1. Acesse a aplicação em seu navegador através do endereço:
    
```bash
$ http://localhost:8000

```
    
2. Faça login com as credenciais de um usuário criado pelos seeders, a senha padrão para todos eles é password.
3. Explore as funcionalidades implementadas, como criação, edição e exclusão de registros, gerenciamento de usuários e permissões, etc.

```bash
$ npm install && npm run dev
$ npm install && npm run watch
```


## Construído com

-   [Laravel 10](https://laravel.com/docs/9.x/)
-   [MySQL](https://dev.mysql.com/doc/)
-   [Laratrust](https://github.com/santigarcor/laratrust)
-   [Faker](https://github.com/fzaninotto/Faker)
-   [Laravel Breeze](https://github.com/laravel/breeze)
-   [Laravel Cascade SoftDeletes](https://github.com/michaeldyrynda/laravel-cascade-soft-deletes)

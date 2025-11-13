📖 Agenda de Contatos Pessoal em PHP

Este é um projeto de uma agenda de contatos segura, multiusuário, desenvolvida em PHP com arquitetura MVC básica. O sistema demonstra um CRUD (Create, Read, Update, Delete) completo, onde cada usuário só pode gerenciar os seus próprios contatos.

O projeto utiliza PHP 8+, MySQL com PDO para conexões seguras, e JavaScript "vanilla" para melhorias de experiência de usuário (UX).

✨ Funcionalidades Principais

Sistema de Autenticação:

Página de Login (View/login.php).

Página de Registro (pode ser adicionada futuramente, no momento o usuário admin é criado pelo SQL).

Logout seguro com destruição da sessão (Controller/LogoutController.php).

Segurança (IDOR Safe):

Cada contato cadastrado é vinculado ao user_id do usuário logado.

Um usuário não pode ver, editar ou excluir contatos de outro usuário, mesmo que tente adivinhar o ID na URL.

CRUD de Contatos:

Create (Criar): Adicionar novos contatos com múltiplos campos (Nome, Telefone, E-mail, Endereço completo).

Read (Ler): Listar todos os contatos apenas do usuário logado (listar.php).

Update (Atualizar): Editar as informações de um contato existente (editar.php).

Delete (Excluir): Remover um contato com confirmação (excluir.php).

Melhorias de UX (JavaScript):

Busca por CEP: Preenchimento automático dos campos de endereço (Rua, Bairro, Cidade, UF) ao digitar o CEP, utilizando a API ViaCEP.

Máscara de Telefone: Formatação automática do campo de telefone para (XX) XXXXX-XXXX.

Validação de E-mail: Validação de formato de e-mail no formulário.

Confirmação de Exclusão: Um confirm() em JavaScript impede a exclusão acidental de contatos.

🚀 Tecnologias Utilizadas

Back-end:

PHP 8+ (Linguagem principal).

MySQL (Banco de dados relacional).

PDO (PHP Data Objects): Extensão para conexão segura com o banco, prevenindo SQL Injection.

Front-end:

HTML5 (Estrutura).

CSS3 (Estilização).

JavaScript (Vanilla): Para máscaras, busca de CEP (Fetch API) e confirmação de exclusão.

🔧 Instalação e Execução Local

Siga estes passos para rodar o projeto em sua máquina local.

1. Pré-requisitos

Um ambiente de servidor local, como WAMP, XAMPP ou MAMP, que inclua Apache, MySQL e PHP 8+.

Um gerenciador de banco de dados, como o phpMyAdmin.

2. Obtenha os Arquivos

Coloque todos os arquivos e pastas do projeto (Core/, Controller/, View/, listar.php, etc.) dentro de uma pasta no seu servidor web (ex: C:/wamp64/www/agendadecontato).

3. Crie o Banco de Dados e as Tabelas

Este é o passo mais importante. O antigo instalar.php foi removido em favor da importação manual, que é mais segura.

Abra o phpMyAdmin (ex: http://localhost/phpmyadmin).

Crie um novo banco de dados chamado agenda (ou o nome que você definiu em Core/config.php).

Clique no banco agenda recém-criado e vá para a aba "SQL".

Abra o arquivo DB.Sql/agenda.sql do projeto, copie todo o conteúdo dele.

Cole o conteúdo na caixa de texto do phpMyAdmin e clique em "Executar" (Go).

Isso irá criar as tabelas users e contatos (já com as novas colunas de endereço) e inserir um usuário de teste para você.

4. Use a Aplicação!

Pronto! Agora você pode acessar a aplicação no seu navegador:

Acesso Principal: http://localhost/agendadecontato/

O index.php irá redirecionar para listar.php, que por sua vez, por você não estar logado, irá redirecionar para View/login.php.

Credenciais de Teste:

Usuário: admin

Senha: admin

🗂️ Estrutura dos Arquivos

/agendadecontato
├── Core/
│   ├── config.php      # (IMPORTANTE) Credenciais do banco de dados
│   ├── Database.php    # Classe de conexão com o banco (Singleton PDO)
│   └── Session.php     # Classe para gerenciamento de sessão segura
│
├── Controller/
│   ├── AuthController.php    # Processa o login (verifica usuário e senha)
│   └── LogoutController.php  # Processa o logout (destrói a sessão)
│
├── DB.Sql/
│   └── agenda.sql      # Script de criação do banco de dados e tabelas
│
├── Model/
│   └── User.php        # Classe que lida com a lógica de usuário (login, find)
│
├── View/
│   ├── dashboard.php   # Página de boas-vindas após o login
│   ├── index.html      # Formulário para ADICIONAR novo contato
│   └── login.php       # Formulário de login
│
├── editar.php          # (Raiz) Formulário para EDITAR um contato existente
├── excluir.php         # (Raiz) Lógica de back-end para EXCLUIR um contato
├── index.php           # (Raiz) Ponto de entrada, redireciona para listar.php
├── listar.php          # (Raiz) Tela que LISTA todos os contatos do usuário
├── salvar.php          # (Raiz) Lógica de back-end para SALVAR (INSERT ou UPDATE)
│
├── script.js           # Funções de front-end (Máscara, CEP, Confirmar Exclusão)
└── style.css           # Folha de estilos principal

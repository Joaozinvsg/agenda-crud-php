📖 Agenda de Contatos em PHP (CRUD Completo)
Este é um projeto simples de uma agenda de contatos desenvolvida em PHP, demonstrando as quatro operações de um sistema: Create, Read, Update e Delete (CRUD).

O projeto conecta-se a um banco de dados MySQL (via WAMP/phpMyAdmin) utilizando a extensão PDO (PHP Data Objects), com foco em segurança e boas práticas.

✨ Funcionalidades
Create (Criar): Adicionar novos contatos (Nome, Endereço, Telefone, E-mail) através de um formulário.
Read (Ler): Listar todos os contatos cadastrados em uma tabela organizada.
Update (Atualizar): Editar as informações de um contato existente.
Delete (Excluir): Remover um contato do banco de dados, com uma etapa de confirmação em JavaScript.

🚀 Tecnologias Utilizadas
Back-end:
PHP 8+ (Linguagem de script do lado do servidor)
MySQL (Banco de dados relacional)
PDO (PHP Data Objects): Extensão para conexão segura com o banco.

Front-end:
HTML5 (Estrutura da página)
CSS3 (Estilização básica)
JavaScript (Vanilla): Para a funcionalidade de confirmação de exclusão.

Ambiente:
WAMP (Servidor local: Windows, Apache, MySQL, PHP)
phpMyAdmin (Interface de gerenciamento do banco de dados)

Versionamento:
Git

🔧 Pré-requisitos
Antes de começar, você precisará ter o seguinte software instalado em sua máquina:
Um ambiente de servidor local, como WAMP (para Windows), XAMPP (Windows/Linux/Mac) ou MAMP (Mac).
Um gerenciador de versão Git (opcional, se for clonar).

⚙️ Passo a Passo: Instalação e Execução
Siga estes passos para rodar o projeto localmente:

1. Obtenha os Arquivos
Opção A: Clonar o Repositório (Recomendado)

Abra seu terminal e navegue até o diretório www do seu WAMP (geralmente C:\wamp64\www) e clone o projeto:

Bash

cd C:\wamp64\www
git clone https://github.com/SEU_USUARIO/SEU_REPOSITORIO.git agenda
(Substitua pela URL do seu repositório no GitHub. agenda é o nome da pasta que será criada)

Opção B: Baixar Manualmente

Se você não estiver usando Git, simplesmente coloque a pasta inteira do projeto (agenda) dentro do seu diretório C:\wamp64\www.

2. Inicie o Servidor WAMP
Abra o aplicativo WAMP.

Espere o ícone na barra de tarefas ficar verde, indicando que todos os serviços (Apache e MySQL) estão rodando.

3. Crie o Banco de Dados e a Tabela
Este projeto inclui um script de instalação automática.

Abra seu navegador de internet (Chrome, Firefox, etc.).

Acesse o script instalar.php através do localhost:

http://localhost/agenda/instalar.php

Se tudo correu bem, você verá uma mensagem de "Sucesso!" na tela.

(Opcional) Você pode verificar no phpMyAdmin (http://localhost/phpmyadmin) que o banco agenda e a tabela contatos foram criados.

4. Use a Aplicação!
Pronto! Agora você pode acessar a aplicação:

Para adicionar contatos: http://localhost/agenda/index.html

Para ver a lista de contatos: http://localhost/agenda/listar.php

🗂️ Estrutura dos Arquivos
Uma breve explicação sobre o que cada arquivo faz:

instalar.php: (Executar 1ª vez) Script que cria o banco de dados agenda e a tabela contatos.

conexao.php: (Obrigatório) Arquivo central que estabelece a conexão segura com o banco via PDO. É incluído por todos os outros arquivos PHP.

index.html: (Página Inicial) Formulário HTML para cadastrar (Create) novos contatos.

salvar.php: (Lógica de Back-end) Recebe os dados do index.html (para criar) ou editar.php (para atualizar). Decide se deve executar INSERT ou UPDATE no banco.

listar.php: (Página de Listagem) Tela que busca (Read) todos os contatos do banco e os exibe em uma tabela.

editar.php: (Página de Edição) Formulário pré-preenchido com os dados de um contato específico, permitindo a edição (Update).

excluir.php: (Lógica de Back-end) Recebe o ID de um contato e executa o comando DELETE para removê-lo.

style.css: Folha de estilos para dar uma aparência básica e limpa ao projeto.

script.js: Código JavaScript que adiciona a caixa de diálogo "Tem certeza?" antes de excluir um contato.

.gitignore: Arquivo que diz ao Git quais arquivos e pastas ignorar (como arquivos de configuração de IDEs ou senhas).

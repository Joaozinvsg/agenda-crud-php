<?php
// Configurações para conexão com o WAMP
$host = "localhost";
$usuario = "root"; // Usuário padrão do WAMP
$senha = "";       // Senha padrão do WAMP (em branco)
$charset = "utf8mb4";
$banco = "agenda"; // Nome do banco que queremos criar

try {
    // 1. Conecta ao MySQL (sem selecionar o banco)
    $pdo = new PDO("mysql:host=$host;charset=$charset", $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // 2. Cria o banco de dados 'agenda' se ele não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$banco`");
    
    // 3. Seleciona o banco de dados
    $pdo->exec("USE `$banco`");

    // 4. Cria a tabela 'contatos' (nome, endereco, telefone, email)
    $sql = "CREATE TABLE IF NOT EXISTS `contatos` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `nome` VARCHAR(100) NOT NULL,
        `endereco` VARCHAR(255) NULL,
        `telefone` VARCHAR(20) NULL,
        `email` VARCHAR(100) NULL,
        `data_cadastro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($sql);

    echo "<h1>Sucesso!</h1><p>Banco de dados '<strong>$banco</strong>' e tabela '<strong>contatos</strong>' criados com sucesso.</p>";
    echo "<a href='index.html'>Ir para a Agenda</a>";

} catch (PDOException $e) {
    die("Erro na instalação: " . $e->getMessage());
}
?>
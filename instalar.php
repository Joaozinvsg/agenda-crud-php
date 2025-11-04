<?php
$host = "localhost";
$usuario = "root"; 
$senha = "Z2liKsAkDw8g3lys";    
$charset = "utf8mb4";
$banco = "agenda"; 

try {
   
    $pdo = new PDO("mysql:host=$host;charset=$charset", $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$banco`");
    $pdo->exec("USE `$banco`");

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
    echo "<a href='index.php'>Ir para a Agenda</a>";

} catch (PDOException $e) {
    die("Erro na instalação: " . $e->getMessage());
}
?>

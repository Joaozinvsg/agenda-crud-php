<?php
// Configurações do banco de dados (WAMP)
$host = "localhost";
$banco = "agenda";      // Nome do banco de dados
$usuario = "root";      // Usuário padrão
$senha = "";            // Senha padrão (em branco)
$charset = "utf8mb4";

// DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$banco;charset=$charset";

// Opções do PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em caso de erro
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Retorna arrays associativos
    PDO::ATTR_EMULATE_PREPARES   => false, // Desativa a emulação
];

try {
     // Cria a instância do PDO
     $pdo = new PDO($dsn, $usuario, $senha, $options);
} catch (\PDOException $e) {
     // Em caso de falha, exibe o erro
     die("Falha na conexão com o banco de dados: " . $e->getMessage());
}
?>
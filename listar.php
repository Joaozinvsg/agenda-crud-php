<?php
require_once __DIR__ . '/Core/Session.php';
Session::init();

$user_id = Session::get('user_id');

if (!$user_id) {
    Session::set('error_message', 'Você precisa estar logado para ver esta página.');
    header('Location: View/login.php');
    exit;
}

require_once __DIR__ . '/Core/Database.php';

try {
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->query("SELECT * FROM contatos ORDER BY nome");
    $contatos = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Erro ao carregar contatos: " . $e->getMessage();
}
?>

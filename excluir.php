<?php
require_once __DIR__ . '/../Core/Session.php';
Session::init();

$user_id = Session::get('user_id');

if (!$user_id) {
    Session::set('error_message', 'Você precisa estar logado para ver esta página.');
    header('Location: View/login.php'); // Redireciona para o login
    exit;
}

require_once '/Core/Database.php';
$pdo = Database::getInstance()->getConnection();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listar.php');
    exit;
}

$id = (int)$_GET['id'];

try {
    $stmt = $pdo->prepare('DELETE FROM contatos WHERE id = ?');
    $stmt->execute([$id]);

    header('Location: listar.php');
    exit;

} catch (PDOException $e) {
    die("Erro ao excluir contato: " . $e->getMessage());
}
?>

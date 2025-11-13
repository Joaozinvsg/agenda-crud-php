<?php
// INÍCIO DO "GATEKEEPER" (Porteiro)
require_once __DIR__ . '/Core/Session.php';
Session::init();

$user_id = Session::get('user_id');

// Se não há um 'user_id' na sessão, chuta o usuário para a página de login
if (!$user_id) {
    Session::set('error_message', 'Você precisa estar logado para ver esta página.');
    header('Location: View/login.php'); // Redireciona para o login
    exit;
}
// FIM DO "GATEKEEPER"

require_once __DIR__ . '/Core/Database.php';
$pdo = Database::getInstance()->getConnection();

// 1. Verifica se recebeu um ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listar.php');
    exit;
}

$id = (int)$_GET['id'];

try {
    // 2. Prepara e executa o DELETE (E verifica se pertence ao usuário)
    $stmt = $pdo->prepare('DELETE FROM contatos WHERE id = ? AND user_id = ?');
    $stmt->execute([$id, $user_id]);

    // 3. Redireciona de volta para a lista
    header('Location: listar.php');
    exit;

} catch (PDOException $e) {
    die("Erro ao excluir contato: " . $e->getMessage());
}
?>

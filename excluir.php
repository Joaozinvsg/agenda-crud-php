<?php
require_once 'conexao.php';

// 1. Verifica se recebeu um ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listar.php');
    exit;
}

$id = (int)$_GET['id'];

try {
    // 2. Prepara e executa o DELETE
    $stmt = $pdo->prepare('DELETE FROM contatos WHERE id = ?');
    $stmt->execute([$id]);

    // 3. Redireciona de volta para a lista
    header('Location: listar.php');
    exit;

} catch (PDOException $e) {
    die("Erro ao excluir contato: " . $e->getMessage());
}
?>
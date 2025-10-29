<?php
require_once 'database.php';
 $pdo = Database::getInstance()->getConnection();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Pega os dados do formulário
    $nome = trim($_POST['nome']);
    $endereco = trim($_POST['endereco']);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    
    // Pega o ID (se existir, é uma atualização)
    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;

    try {
        if ($id) {
            // 2. Lógica de ATUALIZAR (UPDATE)
            $sql = "UPDATE contatos SET nome = ?, endereco = ?, telefone = ?, email = ? WHERE id = ?";
            $params = [$nome, $endereco, $telefone, $email, $id];
        } else {
            // 3. Lógica de CRIAR (INSERT)
            $sql = "INSERT INTO contatos (nome, endereco, telefone, email) VALUES (?, ?, ?, ?)";
            $params = [$nome, $endereco, $telefone, $email];
        }
        
        // 4. Executa a query
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // 5. Redireciona para a lista
        header('Location: listar.php');
        exit;

    } catch (PDOException $e) {
        die("Erro ao salvar contato: " . $e->getMessage());
    }

} else {
    // Se não for POST, redireciona
    header('Location: index.html');
    exit;
}
?>

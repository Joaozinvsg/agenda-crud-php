<?php
require_once __DIR__ . '/Core/Session.php';
Session::init();

$user_id = Session::get('user_id');

if (!$user_id) {
    Session::set('error_message', 'Você precisa estar logado para ver esta página.');
    header('Location: View/login.php'); // Redireciona para o login
    exit;
}

require_once __DIR__ . '/Core/Database.php';
 $pdo = Database::getInstance()->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $nome = trim($_POST['nome']);
    $endereco = trim($_POST['endereco']);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
   
    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;

    try {
        if ($id) {
            
            $sql = "UPDATE contatos SET nome = ?, endereco = ?, telefone = ?, email = ? WHERE id = ?";
            $params = [$nome, $endereco, $telefone, $email, $id];
        } else {
            
            $sql = "INSERT INTO contatos (nome, endereco, telefone, email) VALUES (?, ?, ?, ?)";
            $params = [$nome, $endereco, $telefone, $email];
        }
        
       
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

    
        header('Location: listar.php');
        exit;

    } catch (PDOException $e) {
        die("Erro ao salvar contato: " . $e->getMessage());
    }

} else {
    
    header('Location: index.php');
    exit;
}
?>

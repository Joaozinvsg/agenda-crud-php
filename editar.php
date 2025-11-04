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
$pdo = Database::getInstance()->getConnection();


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listar.php');
    exit;
}

$id = (int)$_GET['id'];

try {
    
    $stmt = $pdo->prepare('SELECT * FROM contatos WHERE id = ?');
    $stmt->execute([$id]);
    $contato = $stmt->fetch();

    
    if (!$contato) {
        header('Location: listar.php');
        exit;
    }
} catch (PDOException $e) {
    die("Erro ao carregar contato: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contato</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Contato</h1>
            <a href="listar.php" class="btn">Voltar para a Lista</a>
        </header>

        <main>
            <form action="salvar.php" method="POST" class="card">
                <input type="hidden" name="id" value="<?php echo $contato['id']; ?>">
                
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required 
                           value="<?php echo htmlspecialchars($contato['nome']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco"
                           value="<?php echo htmlspecialchars($contato['endereco']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone"
                           value="<?php echo htmlspecialchars($contato['telefone']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email"
                           value="<?php echo htmlspecialchars($contato['email']); ?>">
                </div>
                
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
        </main>
    </div>
</body>
</html>

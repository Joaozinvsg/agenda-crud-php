<?php
require_once 'conexao.php';

// 1. Verifica se recebeu um ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listar.php'); // Redireciona se o ID for inválido
    exit;
}

$id = (int)$_GET['id'];

try {
    // 2. Busca o contato no banco de dados
    $stmt = $pdo->prepare('SELECT * FROM contatos WHERE id = ?');
    $stmt->execute([$id]);
    $contato = $stmt->fetch();

    // 3. Se não encontrar o contato, volta para a lista
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
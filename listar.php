<?php
require_once 'conexao.php'; // Inclui a conexão

try {
    // Busca todos os contatos ordenados pelo nome
    $stmt = $pdo->query("SELECT * FROM contatos ORDER BY nome");
    $contatos = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Erro ao carregar contatos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Lista de Contatos</h1>
            <a href="index.html" class="btn btn-primary">Adicionar Novo Contato</a>
        </header>

        <main>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php elseif (empty($contatos)): ?>
                <div class="alert">Nenhum contato cadastrado.</div>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Endereço</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contatos as $contato): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($contato['nome']); ?></td>
                                <td><?php echo htmlspecialchars($contato['endereco']); ?></td>
                                <td><?php echo htmlspecialchars($contato['telefone']); ?></td>
                                <td><?php echo htmlspecialchars($contato['email']); ?></td>
                                <td class="acoes">
                                    <a href="editar.php?id=<?php echo $contato['id']; ?>" class="btn btn-secondary">
                                        Editar
                                    </a>
                                    <a href="excluir.php?id=<?php echo $contato['id']; ?>" class="btn btn-danger btn-excluir">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </main>
    </div>
    
    <script src="script.js"></script>
</body>
</html>
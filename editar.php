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
?>

<?php
require_once __DIR__ . '/Core/Database.php';
$pdo = Database::getInstance()->getConnection();

// 1. Verifica se recebeu um ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listar.php'); // Redireciona se o ID for inválido
    exit;
}

$id = (int)$_GET['id'];

try {
    // 2. Busca o contato no banco de dados (E verifica se pertence ao usuário)
    $stmt = $pdo->prepare('SELECT * FROM contatos WHERE id = ? AND user_id = ?');
    $stmt->execute([$id, $user_id]);
    $contato = $stmt->fetch();

    // 3. Se não encontrar o contato (ou não for do usuário), volta para a lista
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
    
                <label for="cep">CEP:</label>
                <input name="cep" type="text" id="cep" value="" size="10" maxlength="9"
               onblur="pesquisacep(this.value);" /></label><br />
                <small id="cep-error" style="color: red; display: none;">CEP não encontrado.</small>
              </div>

              <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" placeholder="Será preenchido automaticamente">
              </div>

                <div class ="form-group">
              <label for="numero">Número:</label>
              <input type="text" id="numero" name="numero">
              </div>
              
              <div class="form-group">
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento">
                </div>

              <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" placeholder="Será preenchido automaticamente">
                </div>
                
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" placeholder="Será preenchido automaticamente">
                </div>

                    <div class="form-group">
                    <label for="uf">Estado (UF):</label>
                    <input type="text" id="uf" name="uf" placeholder="Será preenchido automaticamente">
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
<script src="script.js"></script></body>
</html>

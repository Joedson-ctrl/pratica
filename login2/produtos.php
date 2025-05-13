<?php 
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

require 'config/db.php';

// Consulta os produtos do banco
$produtos = [];
$sql = "SELECT * FROM produtos ORDER BY id DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Produtos - Minha Loja Online</title>

  <!-- SweetAlert2 para mensagens -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      color: white;
      padding: 1rem;
      text-align: center;
    }

    .btn-container {
      text-align: center;
      margin-top: 20px;
    }

    .btn-novo {
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }

    .product-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
      padding: 2rem;
    }

    .product-card {
      background: white;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 1rem;
      width: 200px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .product-card img {
      max-width: 100%;
      height: auto;
    }

    .empty-message {
      text-align: center;
      padding: 2rem;
      color: #666;
    }
  </style>
</head>
<body>

  <header>
    <h1>Produtos Disponíveis</h1>
  </header>

  <div class="btn-container">
    <a href="form_produto.php" class="btn-novo">+ Cadastrar Novo Produto</a>
  </div>

  <div class="product-list">
    <?php if (count($produtos) > 0): ?>
      <?php foreach ($produtos as $produto): ?>
        <div class="product-card">
          <img src="<?php echo htmlspecialchars($produto['url']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
          <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
          <p>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
          <p style="font-size: 0.9em; color: #777;"><?php echo htmlspecialchars($produto['descricao']); ?></p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="empty-message">
        Nenhum produto cadastrado ainda.
      </div>
    <?php endif; ?>
  </div>

  <script>
    // Exibir mensagem de sucesso ou erro via URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('sucesso') == '1') {
      Swal.fire('Sucesso!', 'Produto cadastrado com sucesso!', 'success');
    }
    if (urlParams.get('erro') == '1') {
      Swal.fire('Erro!', 'Erro ao cadastrar o produto.', 'error');
    }
  </script>

</body>
</html>

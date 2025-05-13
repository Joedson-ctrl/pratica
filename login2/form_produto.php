<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Produto</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 20px;
    }
    .container {
      background: white;
      max-width: 500px;
      margin: auto;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    input, textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      background: #28a745;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    a {
      display: inline-block;
      margin-top: 10px;
      text-decoration: none;
      color: #007bff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Cadastrar Novo Produto</h2>
    <form action="cad_produtos.php" method="POST">
      <label>Nome do Produto:</label>
      <input type="text" name="nome" required>

      <label>Preço:</label>
      <input type="number" step="0.01" name="preco" required>

      <label>Descrição:</label>
      <textarea name="descricao" rows="3" required></textarea>

      <label>URL da Imagem:</label>
      <input type="file" name="url" required>

      <button type="submit">Cadastrar</button>
    </form>
    <a href="produtos.php">← Voltar para Produtos</a>
  </div>
</body>
</html>

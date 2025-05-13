<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php'); // Redireciona para login se não estiver logado
    exit();
}

// Conexão com o banco de dados
require 'config/db.php';

// Verifica se o formulário foi enviado pelo método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifica se todos os campos obrigatórios estão preenchidos
    if (!empty($_POST['nome']) && !empty($_POST['preco']) && !empty($_POST['descricao']) && !empty($_POST['url'])) {
        
        // Recebe os dados do formulário
        $nome = trim($_POST['nome']);
        $preco = floatval($_POST['preco']);
        $descricao = trim($_POST['descricao']);
        $url = trim($_POST['url']);

        // Prepara a query para evitar SQL Injection
        $stmt = $conn->prepare("INSERT INTO produtos (nome, preco, descricao, url) VALUES (?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("sdss", $nome, $preco, $descricao, $url);

            if ($stmt->execute()) {
                // Redireciona com sucesso
                header("Location: produtos.php?sucesso=1");
                exit();
            } else {
                echo "Erro ao cadastrar produto: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erro na preparação da query: " . $conn->error;
        }

    } else {
        echo "Todos os campos são obrigatórios.";
    }
}
?>

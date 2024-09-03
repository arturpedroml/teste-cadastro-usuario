<?php
$host = 'localhost';
$dbname = 'cadastro_usuarios';
$user = 'postgres';
$password = 'P@ssw0rd';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    if (empty($nome) || empty($email) || empty($senha)) {
        header("Location: ../index.html?message=Todos os campos são obrigatórios.&type=error");
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.html?message=Email inválido.&type=error");
        exit;
    }
    if (strlen($senha) < 8) {
        header("Location: ../index.html?message=A senha deve conter pelo menos 8 caracteres.&type=error");
        exit;
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha_hash);
    $stmt->execute();

    header("Location: ../index.html?message=Cadastro realizado com sucesso!&type=success");
} catch (PDOException $e) {
    header("Location: ../index.html?message=Erro ao conectar com o banco de dados: " . $e->getMessage() . "&type=error");
}
?>

<?php
session_start();
require_once "conexao.php";

$email = $_POST["email"];
$senha = $_POST["senha"];


if ($conexao) {

    $stmt = $conexao->prepare("SELECT idusuario, nome FROM usuario WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $stmt->bind_result($idusuario, $nome);

    if ($stmt->fetch()) {
        $_SESSION["idusuario"] = $idusuario;
        $_SESSION["usuario"] = $nome;

        echo "<script>alert('Logado com Sucesso!');window.location.href='menu.php';</script>";
    } else {
        echo "<script>alert('Login ou Senha incorretos!');window.location.href='index.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Erro na conexão com o banco de dados');window.location.href='index.php';</script>";
}

$conexao->close();
?>

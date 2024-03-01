<?php
session_start();

include "verifica_sessao.php";
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION["usuario"])) {
        $nomeUsuario = $_SESSION["usuario"];
        
        // Consulta para obter o idusuario pelo nome de usuário
        $stmt = $conexao->prepare("SELECT idusuario FROM usuario WHERE nome = ?");
        if ($stmt) {
            $stmt->bind_param("s", $nomeUsuario);
            $stmt->execute();        
            $stmt->bind_result($idusuario);
            $stmt->fetch();
            $stmt->close();

            // Insere a turma associada ao idusuario na tabela turma
            $stmt_insert = $conexao->prepare("INSERT INTO turma (idusuario, nome_turma) VALUES (?, ?)");
            if ($stmt_insert) {
                $nomeTurma = $_POST["nomeTurma"];
                $stmt_insert->bind_param("is", $idusuario, $nomeTurma);
                $stmt_insert->execute();        

                if ($stmt_insert->affected_rows > 0) {
                    echo "<script>alert('Turma cadastrada com sucesso!');window.location.href='menu.php';</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar a turma.');window.location.href='menu.php';</script>";
                }

                $stmt_insert->close();
            } else {
                echo "<script>alert('Erro na preparação da declaração de inserção.');window.location.href='menu.php';</script>";
            }
        } else {
            echo "<script>alert('Erro na preparação da declaração de busca.');window.location.href='menu.php';</script>";
        }
    } else {
        echo "<script>alert('Nome de usuário não encontrado na sessão.');window.location.href='menu.php';</script>";
    }
}
?>

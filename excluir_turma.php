<?php
session_start();
include "conexao.php";

$nomeUsuario = $_SESSION["usuario"];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $idTurma = $_GET['id'];

    $queryAtividades = "SELECT COUNT(*) AS total FROM atividade WHERE idturma = $idTurma";
    $resultadoAtividades = $conexao->query($queryAtividades);
    $rowAtividades = $resultadoAtividades->fetch_assoc();
    $totalAtividades = $rowAtividades['total'];

    if ($totalAtividades > 0) {
        echo "<script>alert('Você não pode excluir uma turma com atividades cadastradas.');window.location.href='menu.php';</script>";
    } else {
        // Exibição de confirmação
        echo "
        <script>
            if(confirm('Tem certeza que deseja excluir esta turma?')) {
                window.location.href = 'excluir_turma_confirma.php?id=$idTurma';
            } else {
                window.location.href = 'menu.php';
            }
        </script>";
    }
}
?>
<?php
include "conexao.php";

if (isset($_GET['id'])) {
    $idTurma = $_GET['id'];

    $queryExcluir = "DELETE FROM turma WHERE idturma = $idTurma";
    if ($conexao->query($queryExcluir) === TRUE) {
        echo "<script>alert('Turma excluída com sucesso!');window.location.href='menu.php';</script>";
    } else {
        echo "Erro ao excluir turma: " . $conexao->error;
    }
}

$conexao->close();
?>

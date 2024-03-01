<?php
session_start();
include "conexao.php";

$nomeUsuario = $_SESSION["usuario"];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); 
    exit();
}

// Consulta para obter o ID do usuário a partir do nome de usuário na sessão
$queryIDUsuario = "SELECT idusuario FROM usuario WHERE nome = '$nomeUsuario'";
$resultadoIDUsuario = $conexao->query($queryIDUsuario);

if ($resultadoIDUsuario && $resultadoIDUsuario->num_rows > 0) {
    $row = $resultadoIDUsuario->fetch_assoc();
    $idUsuario = $row['idusuario']; // Obtém o ID do usuário da sessão
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeAtividade']) && isset($idUsuario)) {
        $nomeAtividade = $_POST['nomeAtividade'];
        $idTurma = $_POST['idTurma']; // ID da turma obtido via POST
        
        // Preparar e executar a inserção da atividade no banco de dados
        $stmt = $conexao->prepare("INSERT INTO atividade (idturma, idusuario, nome_atividade) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $idTurma, $idUsuario, $nomeAtividade);
        
        if ($stmt->execute()) {
            // Atividade cadastrada com sucesso
            header("Location: atividades_turma.php?id=" . $idTurma);
            exit();
        } else {
            // Se houver algum erro ao cadastrar a atividade
            echo "Erro ao cadastrar a atividade: " . $conexao->error;
        }
        
        // Fechar a conexão
        $stmt->close();
        $conexao->close();
    }
}
?>

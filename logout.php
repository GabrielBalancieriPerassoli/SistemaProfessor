<?php
    session_start();
    // Destruir todas as variáveis de sessão
    session_unset();
    // Destruir a sessão
    session_destroy();

    header("Location: index.php"); // Redirecionar para a página de login após o logout
    exit;
?>

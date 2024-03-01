<?php
session_start();
include "conexao.php";

$nomeUsuario = $_SESSION["usuario"];

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); 
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID da turma não fornecido!";
    exit();
}

$idTurma = $_GET['id'];

$queryAtividadesTurma = "SELECT idatividade, nome_atividade FROM atividade WHERE idturma = $idTurma";
$resultadoAtividadesTurma = $conexao->query($queryAtividadesTurma);

$queryNomeTurma = "SELECT nome_turma FROM turma WHERE idturma = $idTurma";
$resultadoNomeTurma = $conexao->query($queryNomeTurma);

if ($resultadoNomeTurma && $resultadoNomeTurma->num_rows > 0) {
    $rowNomeTurma = $resultadoNomeTurma->fetch_assoc();
    $nomeTurma = $rowNomeTurma['nome_turma'];
} else {
    $nomeTurma = "Turma não encontrada";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Atividades da Turma</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Seus estilos personalizados aqui */
        .navbar {
            background-color: #28a745;
        }

        .cadastro-atividade {
            margin-top: 30px;
            border: 1px solid #ccc;
            padding: 40px;
            text-align: center;
            background-color: #e9ecef;
        }

        table {
            background-color: #fff;
        }

        .center-table {
            margin: 0 auto;
        }

        .center-table td {
            text-align: center;
        }

        .center-table th {
            text-align: center;
        }

        .btn-verde {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand"> <span class="navbar-text">
                Bem-vindo, Professor: <?php echo $nomeUsuario; ?>
            </span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-danger" href="logout.php" role="button">Sair</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 order-md-1">
                <a href="menu.php" class="btn btn-outline-danger">Voltar para o Menu</a>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="cadastro-atividade">
                    <h3>Turma: <?php echo $nomeTurma; ?></h3>
                    <br/>
                    <button class="btn btn-verde" data-toggle="modal" data-target="#modalCadastroAtividade">Cadastrar Atividade</button>
                </div>
            </div>
        </div>
        <table class="table center-table">
            <thead>
                <tr>
                    <th>Número da Atividade</th>
                    <th>Professor</th>
                    <th>Descrição da Atividade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultadoAtividadesTurma) {
                    // Verificar se existem atividades para essa turma
                    if ($resultadoAtividadesTurma->num_rows > 0) {
                        // Exibir as atividades
                        while ($row = $resultadoAtividadesTurma->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['idatividade'] . "</td>";
                            echo "<td>" . $nomeUsuario . "</td>";
                            echo "<td>" . $row['nome_atividade'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Nenhuma atividade encontrada para esta turma.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Erro na consulta: " . $conexao->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para cadastro de Atividade -->
    <div class="modal fade" id="modalCadastroAtividade" tabindex="-1" role="dialog" aria-labelledby="modalCadastroAtividadeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroAtividadeLabel">Cadastrar Atividade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="cadatividade.php" method="POST">
                        <input type="hidden" name="idTurma" value="<?php echo $idTurma; ?>">
                        <div class="form-group">
                            <label for="nomeAtividade">Nome da Atividade:</label>
                            <input type="text" class="form-control" id="nomeAtividade" name="nomeAtividade">
                        </div>
                        <button type="submit" class="btn btn-verde">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#formCadastroAtividade").submit(function (event) {
                event.preventDefault();
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

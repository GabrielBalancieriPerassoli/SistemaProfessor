<?php
    session_start();
    include "conexao.php";
    include "verifica_sessao.php";

    $nomeUsuario = $_SESSION["usuario"];

    $query = "SELECT turma.idturma, turma.nome_turma, usuario.nome 
            FROM turma 
            INNER JOIN usuario ON turma.idusuario = usuario.idusuario";

    $resultado = $conexao->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #28a745;
        }

        .cadastro-turma {
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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cadastro-turma">
                    <h3>Cadastro de Turma</h3>
                    <br/>
                    <button class="btn btn-verde" data-toggle="modal" data-target="#modalCadastroTurma">Cadastrar Turma</button>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table center-table">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Nome do Usuário</th>
                            <th>Nome da Turma</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = $resultado->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['idturma'] . "</td>";
                                echo "<td>" . $row['nome'] . "</td>";
                                echo "<td>" . $row['nome_turma'] . "</td>";
                                echo "<td>
                                        <a href='excluir_turma.php?id=" . $row['idturma'] . "' class='btn btn-danger mr-2'>Excluir</a>
                                        <a href='atividades_turma.php?id=" . $row['idturma'] . "' class='btn btn-primary'>Visualizar</a>
                                    </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para cadastro de turma -->
    <div class="modal fade" id="modalCadastroTurma" tabindex="-1" role="dialog" aria-labelledby="modalCadastroTurmaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroTurmaLabel">Cadastrar Turma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="cadturma.php" method="POST">
                        <div class="form-group">
                            <label for="nomeTurma">Nome da Turma:</label>
                            <input type="text" class="form-control" id="nomeTurma" name="nomeTurma">
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
            $("#formCadastroTurma").submit(function (event) {
                event.preventDefault();
            });
        });
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>

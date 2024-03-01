<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

    <div class="cotainer-login">

        <div class="content-box">

            <form action="verificacao_login.php" method="post">

                <section class="box">

                    <h3 class="mb-5">Login Usuário</h3>

                    <br>

                    <div class="form-group">
                        <input type="email" id="typeUsernameX-2" class="form-control" name="email" required>
                        <label class="form-label" for="typeUsernameX-2">Email Usuário</label>
                    </div>

                    <div class="form-group">
                        <input type="password" id="typePasswordX-2" class="form-control" name="senha" required>
                        <label class="form-label" for="typePasswordX-2">Senha Usuário</label>
                    </div>

                    <br>

                    <input id="login" class="btn btn btn-lg btn-block" style="background-color: rgb(11, 184, 34); color:white" type="submit" name="logar" value="Login">

                </section>

            </form>

        </div>

    </div>

</body>

</html>
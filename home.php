<?php


require_once 'funcoesclientemysql.php';

session_start();

$email = '';
$senha = '';


if (!empty($_POST)) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    verificarUsuario($email, $senha);
}



?>

<head>
    <title>Página principal</title>
    <meta charset='utf-8'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="../styles/estilo.css">

</head>

<body>

    <h1 class="calma; container" style="margin-top: 20px;font-size: 70px; text-align: auto;">
        BEM VINDO
    </h1>


    <div class="row" style="color: blue">
        <div class="col-md-4"></div>
        <div class="container; col-md-4">
            <form method="POST" action="home.php">
                <div class="form-group">
                    <label for="email">Endereço email</label>
                    <input type="text" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Digite seu email">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="text" name="senha" class="form-control" placeholder="Digite sua senha">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Lembre-me</label>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <br>
                <a href="#" style="font-size: 13;font-style: oblique;">Não tem login? Clique aqui!</a>
            </form>
        </div>
    </div>


</body>
<?php

require_once 'funcoesmysql.php';


?>
<html>

<head>
    <title>SuperCarRent:</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.1.html">SuperCarRent</a>
        <button class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container">
        <h1>Listagem de Carros</h1>

        <div class="row">

            <?php
            $listarUsuario = listarUsuario();

            foreach ($listarUsuario as $usuario) {

                ?>


                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= $usuario['url'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $usuario['nome'] ?></h5>
                            <p class="card-text"><?= $usuario['email'] ?></p>
                            <a href="detalhes.php?id=<?= $usuario['id'] ?>" class="btn btn-primary">Veja mais...</a>
                        </div>
                    </div>
                    &nbsp;
                </div>
            <?php
        }
        ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/jquery.mask.js"> </script>
    <script src="js/jquery.validate.js"> </script>

</body>

</html>
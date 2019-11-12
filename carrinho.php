<?php

require_once 'funcoesmysql.php';
require_once 'Facebook\autoload.php';

session_start();

$fb = new Facebook\Facebook([
  'app_id' => '555520875021408', // Replace {app-id} with your app id
  'app_secret' => 'ec1bfd77d6326bf25fbaf0a856dcc4d2',
  'default_graph_version' => 'v3.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/php/resultadologin.php', $permissions);

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
        <?php
        session_start();
        if (empty($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
        }

        if (!empty($_GET)) {
            $id = $_GET['id'];
            $usuario = buscarUsuarioPorId($id);            
            array_push($_SESSION['carrinho'], $usuario);
        }

        $carrinho = $_SESSION['carrinho'];        

        ?>

        <table class="table">
            <tr>
                <th>Item</th>
                <th>Quantidade</th>
                <th>&nbsp;</th>
            </tr>
            <?php
            foreach ($carrinho as $item) {
                ?>
                <tr>
                    <td><?= $item['nome'] ?></td>
                    <td>1</td>
                    <td><a href="#" class="btn btn-danger">Excluir</a>

                </tr>

            <?php
        }
        ?>

        </table>
        <a href="<?= htmlspecialchars($loginUrl) ?>" class="btn btn-info" >Login with Facebook</a>
       
        <a href="dashboard.php" class="btn btn-info">continuar comprando</a>



    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/jquery.mask.js"> </script>
    <script src="js/jquery.validate.js"> </script>
</body>

</html>
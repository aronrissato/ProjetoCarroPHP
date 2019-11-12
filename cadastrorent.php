<?php

require_once 'funcoesmysql.php';

$id = "";
$nome = "";
$cpf = "";
$email = "";
$data = "";
$url = "";

if (!empty($_FILES)) {

  $caminhodasimagens = "C:\\xampp\\htdocs\\php\\imagens\\";
  $nomedoarquivo = $_FILES['foto']['name'];


  move_uploaded_file($_FILES['foto']['tmp_name'], $caminhodasimagens . $nomedoarquivo);
  

  $url = "imagens/" . $nomedoarquivo;
}


if (!empty($_GET)) {
  $acao = $_GET['acao'];
  $id = $_GET['id'];

  if ($acao == 'carregar') {
    $usuario = buscarUsuarioPorId($id);
    $nome = $usuario['nome'];
    $cpf = $usuario['cpf'];
    $email = $usuario['email'];
    $data = $usuario['data'];
    $url = $usuario['url'];
  }


  if ($acao == 'excluir') {
    excluirUsuario($id);
  }
}
if (!empty($_GET)) {
  $acao = $_GET['acao'];
  $id = $_GET['id'];

  if ($acao == 'alterar') {
    $msg =  AlterarUsuario($id, $nome, $cpf, $email, $data);
    echo $msg;
  }
}

if (!empty($_POST)) {
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $cpf = $_POST['cpf'];
  $email = $_POST['email'];
  $data = $_POST['data'];

  $msg = salvarUsuario($id, $nome, $cpf, $email, $data, $url);
  echo $msg;
}

$listarUsuario = listarUsuario();

?>
<html>

<head>
  <title>SuperCarRent:</title>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="estilo2.css">
</head>

<body>
  <nav class="header" class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.1.html">SuperCarRent</a>
    <button class="navbar-toggler" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <div class="body">
    <div class="container">
      <h1>Faça seu cadastro abaixo:</h1>
      <form id="form" action="cadastrorent.php" method="POST" enctype="multipart/form-data">


        <div class="form-row">
          <div class="col-7">
            <div class="form-group">
              <label for="id">ID: </label>
              <input type="text" class="form-control" name="id" value="<?= $id ?>" placeholder="" readonly>
            </div>
            <div class="form-group">
              <label for="nome">Nome: </label>
              <input type="text" class="form-control" name="nome" value="<?= $nome ?>" placeholder="Digite o Nome">
            </div>
            <div class="form-group">
              <label for="cpf">CPF: </label>
              <input type="text" class="form-control cpf" name="cpf" value="<?= $cpf ?>" placeholder="Digite o CPF">
            </div>
          </div>
          <div class="col">
            <img src="<?= $url ?>" width="100%" height="100%" />
          </div>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" name="email" value="<?= $email ?>" placeholder="Digite o email">
        </div>
        <div class="form-group">
          <label for="data">Data:</label>
          <input type="text" class="form-control date" name="data" value="<?= $data ?>" placeholder="dd/mm/yyyy">
        </div>




        <input type="file" name="foto" /><br><br>

        <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
      <table class="table">
        <tr>
          <th>ID</th>
          <th>NOME</th>
          <th>CPF</th>
          <th>EMAIL</th>
          <th>DATA</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>

        </tr>
        <?php

        foreach ($listarUsuario as $usuario) {

          ?>
          <tr>
            <td><?= $usuario['id'] ?></td>
            <td><?= $usuario['nome'] ?></td>
            <td><?= $usuario['cpf'] ?></td>
            <td><?= $usuario['email'] ?></td>
            <td><?= $usuario['data'] ?></td>
            <td><a href="cadastrorent.php?acao=carregar&id=<?= $usuario['id'] ?>">Carregar</a></td>
            <td><a href="cadastrorent.php?acao=excluir&id=<?= $usuario['id'] ?>">Excluir</a></td>
          </tr>
        <?php
      }
      ?>
      </table>
    </div>
  </div>
  <div class="footer">
    <h4>www.quemdesenvolveu.com</h4>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="js/jquery.mask.js"> </script>
  <script src="js/jquery.validate.js"> </script>
  <script>
    $(document).ready(function() {
      $('.date').mask('00/00/0000');
      $('.cpf').mask('000.000.000-00');
      $("#form").validate({
        rules: {
          -
          nome: "required",
          cpf: "required",
          email: {
            required: true,
            email: true
          }
        },
        messages: {
          nome: "Digite seu nome corretamente.",
          cpf: "Digite seu cpf corretamente.",
          email: {
            required: "Você precisa colocar o email",
            email: "Seu email deve ser nesse formato: name@gmail.com"
          }
        }
      });
    });
  </script>
</body>

</html>
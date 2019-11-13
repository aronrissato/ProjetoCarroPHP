
<?php

require_once 'funcaocarromysql.php';

$carro = "";
$modelo = "";
$preco = "";
$marca = "";
$potencia = "";
$url = "";

if (!empty($_FILES)) {

  $caminhodasimagens = "C:\\xampp\\htdocs\\php\\imagens\\";
  $nomedoarquivo = $_FILES['foto']['name'];


  move_uploaded_file($_FILES['foto']['tmp_name'], $caminhodasimagens . $nomedoarquivo);
  

  $url = "imagens/" . $nomedoarquivo;
}


if (!empty($_GET)) {
  $acao = $_GET['acao'];
  $carroid = $_GET['carroid'];

  if ($acao == 'carregar') {
    $carro = buscarCarroPorId($carroid);
    $modelo = $carro['modelo'];
    $cpf = $carro['preco'];
    $email = $carro['marca'];
    $data = $carro['potencia'];
    $url = $carro['url'];
  }


  if ($acao == 'excluir') {
    ExcluirCarro($id);
  }
}
if (!empty($_GET)) {
  $acao = $_GET['acao'];
  $carroid = $_GET['carroid'];

  if ($acao == 'alterar') {
    $msg =  AlterarCarro($id, $modelo, $preco, $marca, $potencia);
    echo $msg;
  }
}

if (!empty($_POST)) {
  $carro = $_POST['carroid'];
  $modelo = $_POST['modelo'];
  $preco = $_POST['preco'];
  $marca = $_POST['marca'];
  $potencia = $_POST['potencia'];

  $msg = salvarCarro($id, $modelo, $preco, $marca, $potencia, $url);
  echo $msg;
}

$listarCarro = listarCarro();

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
      <h1>Cadastro dos carros:</h1>
      <form id="form" action="carro.php" method="POST" enctype="multipart/form-data">


        <div class="form-row">
          <div class="col-7">
            <div class="form-group">
              <label for="id">ID: </label>
              <input type="text" class="form-control" name="carroid" value="<?= $id ?>" placeholder="" readonly>
            </div>
            <div class="form-group">
              <label for="nome">Modelo: </label>
              <input type="text" class="form-control" name="modelo" value="<?= $nome ?>" placeholder="Digite o Nome">
            </div>
            <div class="form-group">
              <label for="cpf">Preço: </label>
              <input type="text" class="form-control cpf" name="preco" value="<?= $cpf ?>" placeholder="Digite o CPF">
            </div>
          </div>
          <div class="col">
            <img src="<?= $url ?>" width="100%" height="100%" />
          </div>
        </div>

        <div class="form-group">
          <label for="email">Marca:</label>
          <input type="email" class="form-control" name="marca" value="<?= $email ?>" placeholder="Digite o email">
        </div>
        <div class="form-group">
          <label for="data">Potencia:</label>
          <input type="text" class="form-control date" name="potencia" value="<?= $data ?>" placeholder="dd/mm/yyyy">
        </div>




        <input type="file" name="foto" /><br><br>

        <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
      <table class="table">
        <tr>
          <th>ID</th>
          <th>MODELO</th>
          <th>PREÇO</th>
          <th>MARCA</th>
          <th>POTENCIA</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>

        </tr>
        <?php

        foreach ($listarCarro as $carro) {

          ?>
          <tr>
            <td><?= $carro['carroid'] ?></td>
            <td><?= $carro['modelo'] ?></td>
            <td><?= $carro['preco'] ?></td>
            <td><?= $carro['marca'] ?></td>
            <td><?= $carro['potencia'] ?></td>
            <td><a href="carro.php?acao=carregar&id=<?= $carro['carroid'] ?>">Carregar</a></td>
            <td><a href="carro.php?acao=excluir&id=<?= $carro['carroid'] ?>">Excluir</a></td>
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
 
</body>

</html>
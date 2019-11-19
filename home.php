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
            <form method="POST" action="login">
                <div class="form-group">
                    <label for="exampleInputEmail1">Endereço email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Digite sua senha">
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
<?php

function conexao()
{
    try {
        $conn = new PDO("mysql:host=localhost:3306;dbname=projetocarros", "root", "");
        return $conn;
    } catch (PDOException $e) {
        echo '' . $e->getMessage();
    }
}


function verificarUsuario($email, $senha)
{
    $query = "SELECT * FROM funcionario 
    where email = :email and senha = :senha";
    $conn = conexao();
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha);


    if ($stmt->execute()) {

        $ret = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($ret)) {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: dashboard.php');
           
        } else {
            printf("Usuário e senha incorretos");
        }
    } else {
        print_r($stmt->errorInfo());
        return "ERRO SQL";
    }
}



function salvarUsuario($id, $nome, $cpf, $email, $data, $url)
{
    $conn = conexao();
    $stmt = "";
    if (empty($id)) {
        $stmt = $conn->prepare("
        INSERT INTO USUARIO (NOME,CPF,EMAIL,DATA,URL) VALUES 
        (:nome,:cpf,:email,:data, :url)");
    } else {
        $stmt = $conn->prepare("
        UPDATE USUARIO set nome=:nome, cpf=:cpf, email=:email, data=:data, url=:url 
        WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);
    }


    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":cpf", $cpf);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":data", $data);
    $stmt->bindParam(":url", $url);
    if ($stmt->execute()) {
        return "Usuario cadastrado com sucesso.";
    } else {
        print_r($stmt->errorInfo());
        return "Erro ao inserir o usuário";
    }
    //echo $nome . " " . $cpf . " " . $email . " " . $data;
}

function listarUsuario()
{
    $query = "SELECT id, nome, cpf, email, data, url FROM usuario";
    $conn = conexao();
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($stmt->errorInfo());
        return "Erro ao inserir o usuário";
    }
}

function ExcluirUsuario($id)
{
    $query = "delete FROM usuario where id = :id";
    $conn = conexao();
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    if ($stmt->execute()) {
        return "Usuario excluido com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "Erro ao excluir o usuário";
    }
}
function buscarUsuarioPorId($id)
{
    $query = "SELECT id, nome, cpf, email, data, url FROM usuario 
    where id = :id";
    $conn = conexao();
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        print_r($stmt->errorInfo());
        return "Erro ao inserir o usuário";
    }
}

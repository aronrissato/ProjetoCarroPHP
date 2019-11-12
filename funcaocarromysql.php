<?php

function conexao()
{
    try {
        $conn = new PDO("mysql:host=localhost:3306;dbname=aulaterca", "root", "");
        return $conn;
    } catch (PDOException $e) {
        echo '' . $e->getMessage();
    }
}

function salvarCarro($id, $modelo, $preco, $marca, $potencia, $url)
{
    $conn = conexao();
    $stmt = "";
    if(empty($id)){
        $stmt = $conn->prepare("
        INSERT INTO USUARIO (NOME,CPF,EMAIL,DATA,URL) VALUES 
        (:nome,:cpf,:email,:data, :url)");
    }else{
        $stmt = $conn->prepare("
        UPDATE USUARIO set nome=:nome, cpf=:cpf, email=:email, data=:data, url=:url 
        WHERE id = :id
        ");
        $stmt->bindParam(":id",$id);
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

function listarCarro()
{
    $query = "SELECT id, nome, cpf, email, data, url FROM usuario";
    $conn = conexao();
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
      return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($stmt->errorInfo());
        return "Erro ao inserir o usuário";
    }
}

function ExcluirCarro($id)
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
function buscarCarroPorId($id){
    $query = "SELECT id, nome, cpf, email, data, url FROM usuario 
    where id = :id";
    $conn = conexao();
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    if ($stmt->execute()) {
      return $stmt -> fetch(PDO::FETCH_ASSOC);
    } else {
        print_r($stmt->errorInfo());
        return "Erro ao inserir o usuário";
}
}

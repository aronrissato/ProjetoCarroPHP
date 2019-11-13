<?php

function conexao()
{
    try {
        $conn = new PDO(
            "mysql:host=localhost:3306;dbname=projetocarros",
            "root",
            ""
        );
        return $conn;
    } catch (PDOException $e) {
        echo '' . $e->getMessage();
    }
}

function salvarCarro($carroid, $modelo, $preco, $marca, $potencia, $url)
{
    $conn = conexao();
    $stmt = "";
    if (empty($carroid)) {
        $stmt = $conn->prepare("
        INSERT INTO USUARIO (MODELO,PRECO,MARCA,POTENCIA,URL) VALUES 
        (:modelo,:preco,:marca,:potencia, :url)");
    } else {
        $stmt = $conn->prepare("
        UPDATE USUARIO set modelo=:modelo,preco=:preco, marca=:marca, potencia=:potencia, url=:url 
        WHERE carroid = :carroid
        ");
        $stmt->bindParam(":carroid", $carroid);
    }


    $stmt->bindParam(":modelo", $modelo);
    $stmt->bindParam(":preco", $preco);
    $stmt->bindParam(":marca", $marca);
    $stmt->bindParam(":potencia", $potencia);
    $stmt->bindParam(":url", $url);
    if ($stmt->execute()) {
        return "Carro cadastrado com sucesso.";
    } else {
        print_r($stmt->errorInfo());
        return "Erro ao inserir o carro";
    }
    //echo $modelo . " " . $preco . " " . $marca . " " . $potencia;
}

function listarCarro()
{
    $query = "SELECT carroid, modelo, preco, marca, potencia, url FROM carro";
    $conn = conexao();
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($stmt->errorInfo());
        return "Erro ao inserir o carro";
    }
}

function ExcluirCarro($carroid)
{
    $query = "delete FROM carro where carroid = :carroid";
    $conn = conexao();
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":carroid", $carroid);
    if ($stmt->execute()) {
        return "Carro excluido com sucesso!";
    } else {
        print_r($stmt->errorInfo());
        return "Erro ao excluir o carro";
    }
}
function buscarCarroPorId($carroid)
{
    $query ="SELECT carroid, modelo, preco, marca, potencia, url FROM carro
    where carroid = :carroid";
    $conn = conexao();
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":carroid", $carroid);
    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        print_r($stmt->errorInfo());
        return "Erro ao inserir o usuário";
    }
}

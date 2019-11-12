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


function salvarUsuario($id, $login, $email, $data, $url)
{
	$conn = conexao();
	$stmt = '';

	if (empty($id)) {
		$stmt = $conn->prepare("
	INSERT INTO USUARIO (LOGIN,EMAIL,DATA,URL) 	VALUES
	(:login,:email,:data, :url) ");
	} else {
		$stmt = $conn->prepare("
				UPDATE USUARIO SET login = :login, email = :email, data = :data, url = :url
				WHERE id = :id
				");
		$stmt->bindParam(":id", $id);
	}

	$stmt->bindParam(":login", $login);
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":data", $data);
	$stmt->bindParam(":url", $url);

	if ($stmt->execute()) {
		return "Usuario cadastrado com sucesso!";
	} else {
		printr_r($stmt->errorInfo());
		return "Erro ao cadastrar usuário.";
	}
}

function listarUsuario()
{
	$query = "SELECT id, login, email, data, url FROM USUARIO";
	$conn = conexao();
	$stmt = $conn->prepare($query);

	if ($stmt->execute()) {
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	} else {
		print_r($stmt->errorInfo());
		return "Erro ao listar o usuário";
	}
}


function excluirUsuario($id)
{
	$query = "DELETE FROM USUARIO where id = :id";
	$conn = conexao();
	$stmt = $conn->prepare($query);
	$stmt->bindParam(":id", $id);

	if ($stmt->execute()) {
		return "Usuario excluido com sucesso!";
	} else {
		print_r($stmt->errorInfo());
		return "Erro ao inserir o usuário";
	}
}

function buscarUsuarioPorId($id)
{
	$query = "SELECT id, login, email, data, URL FROM USUARIO
	where id = :id";
	$conn = conexao();
	$stmt = $conn->prepare($query);
	$stmt->bindParam(":id", $id);

	if ($stmt->execute()) {
		return $stmt->fetch(PDO::FETCH_ASSOC);
	} else {
		print_r($stmt->errorInfo());
		return "Erro ao buscar o usuário";
	}
}
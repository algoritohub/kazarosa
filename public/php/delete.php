<?php

// BANCO DE DADOS LOCAL
$name_banco = "kazarosa";
$conectDB = 'mysql:host=localhost;dbname='.$name_banco;
$name_user = "root";
$pass_banco = "";

// BANCO DE DADOS WEB
// $name_banco = "u586034439_webservice";
// $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
// $name_user = "u586034439_kazarosa";
// $pass_banco = "@kazaRosa2022";

$conn = new PDO($conectDB, $name_user, $pass_banco);

// VARIÁVEIS
$id = $_GET['id'];

// DELETAR AGENDAMENTOS
$stmtn1 = $conn->prepare('SELECT * FROM agendamentos WHERE user = :id');
$stmtn1->execute(array('id' => $id)); 
$resultn1 = $stmtn1->fetchAll();

foreach ($resultn1 as $agenda1) {
    
    $stmt1 = $conn->prepare('DELETE FROM agendamentos WHERE id = :id');
    $stmt1->bindParam(':id', $agenda1['id']);
    $stmt1->execute();
}

// DELETAR AVALIAÇÕES
$stmtn2 = $conn->prepare('SELECT * FROM avalias WHERE usuario = :id');
$stmtn2->execute(array('id' => $id)); 
$resultn2 = $stmtn2->fetchAll();

foreach ($resultn2 as $avalia2) {
    
    $stmt2 = $conn->prepare('DELETE FROM avalias WHERE id = :id');
    $stmt2->bindParam(':id', $avalia2['id']);
    $stmt2->execute();
}

// DELETAR SEGUIDORES
$stmtn3 = $conn->prepare('SELECT * FROM conexao_seguirs WHERE usuario = :id');
$stmtn3->execute(array('id' => $id)); 
$resultn3 = $stmtn3->fetchAll();

foreach ($resultn3 as $seguidor3) {
    
    $stmt3 = $conn->prepare('DELETE FROM conexao_seguirs WHERE id = :id');
    $stmt3->bindParam(':id', $seguidor3['id']);
    $stmt3->execute();
}

// DELETAR SEGUIDOS
$stmtn4 = $conn->prepare('SELECT * FROM conexao_seguirs WHERE seguidor = :id');
$stmtn4->execute(array('id' => $id)); 
$resultn4 = $stmtn4->fetchAll();

foreach ($resultn4 as $seguidor4) {
    
    $stmt4 = $conn->prepare('DELETE FROM conexao_seguirs WHERE id = :id');
    $stmt4->bindParam(':id', $seguidor4['id']);
    $stmt4->execute();
}

// DELETAR POSTAGENS
$stmtn5 = $conn->prepare('SELECT * FROM networks WHERE usuario = :id');
$stmtn5->execute(array('id' => $id)); 
$resultn5 = $stmtn5->fetchAll();

foreach ($resultn5 as $post5) {
    
    $stmt5 = $conn->prepare('DELETE FROM networks WHERE id = :id');
    $stmt5->bindParam(':id', $post5['id']);
    $stmt5->execute();
}

// DELETAR CONTA
$stmt5 = $conn->prepare('DELETE FROM usuarios WHERE id = :id');
$stmt5->bindParam(':id', $id);
$stmt5->execute();

// RETORNO
header("Location: http://localhost:8000/web/configuracao/excluir");
// header("Location: https://kazarosa.com/web/configuracao/excluir");
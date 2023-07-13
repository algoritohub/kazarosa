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

$espaco = $_POST['id'];

// REGISTRO DE IMAGEM 1
if(isset($_FILES['img1'])) {

    $path1     = $_FILES['img1']['name'];
    $ext1      = pathinfo($path1, PATHINFO_EXTENSION);
	$new_name1 = rand().".".$ext1;
	$dir1      = '../img/salas/';
	move_uploaded_file($_FILES['img1']['tmp_name'], $dir1.$new_name1);
	$new_dir1  = $new_name1;

    // UPDATE
    $stmt = $conn->prepare('UPDATE salas SET img1 = :img1 WHERE id = :espaco');
    $stmt->execute(array(
        ':espaco' => $espaco,
        ':img1' => $new_dir1
    ));

    // STATUS
    $stmt = $conn->prepare('UPDATE salas SET stts = :stts WHERE id = :espaco');
    $stmt->execute(array(
        ':espaco' => $espaco,
        ':stts' => "ativo"
    ));
}

// RETORNO
header("Location: http://localhost:8000/admin/dashboard/salas/$espaco");
// header("Location: https://kazarosa.com/admin/dashboard/salas/$espaco");
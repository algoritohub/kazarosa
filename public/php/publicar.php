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

$usuario   = $_POST['usuario'];
$descricao = $_POST['descricao'];
$datas     = $_POST['datas'];

// REGISTRO DE IMAGEM
if(isset($_FILES['postagem'])) {

    $path     = $_FILES['postagem']['name'];
    $ext      = pathinfo($path, PATHINFO_EXTENSION);
	$new_name = rand().".".$ext;
	$dir      = '../img/feed/';
	move_uploaded_file($_FILES['postagem']['tmp_name'], $dir.$new_name);
	$new_dir  = $new_name;
}

$conn = new PDO($conectDB, $name_user, $pass_banco);

$stmt = $conn->prepare('INSERT INTO networks(usuario, postagem, descricao, curtidas, datas) VALUES(:usuario, :postagem, :descricao, :curtidas, :datas)');
$stmt->execute(array(
'usuario' => $usuario,
'postagem' => $new_dir,
'descricao' => $descricao,
'curtidas' => 0,
'datas' => $datas,
));

header("Location: http://localhost:8000/feed");
// header("Location: https://kazarosa.com/feed");
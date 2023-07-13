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
$titulo     = $_POST['titulo'];
$descricao  = $_POST['descricao'];
$datas      = $_POST['data'];
$hora       = $_POST['hora'];
$quantidade = $_POST['quantidade'];
$entrada    = $_POST['entrada'];
$valor      = $_POST['valor'];
$imagem     = "null";
$stts       = "ativo";
@$link      = $_POST['link'];

$stmt = $conn->prepare('INSERT INTO eventos(titulo, descricao, datas, hora, quantidade, entrada, valor, imagem, stts, link) VALUES(:titulo, :descricao, :datas, :hora, :quantidade, :entrada, :valor, :imagem, :stts, :link)');
$stmt->execute(array(
'titulo' => $titulo,
'descricao' => $descricao,
'datas' => $datas,
'hora' => $hora,
'quantidade' => $quantidade,
'entrada' => $entrada,
'valor' => $valor,
'imagem' => $imagem,
'stts' => $stts,
'link' => $link,
));

// REGISTRO DE IMAGEM 1
if(isset($_FILES['imagem'])) {

    $path1     = $_FILES['imagem']['name'];
    $ext1      = pathinfo($path1, PATHINFO_EXTENSION);
	$new_name1 = rand().".".$ext1;
	$dir1      = '../img/eventos/';
	move_uploaded_file($_FILES['imagem']['tmp_name'], $dir1.$new_name1);
	$new_dir1  = $new_name1;

    // UPDATE
    $stmt = $conn->prepare('UPDATE eventos SET imagem = :img1 WHERE titulo = :titulo');
    $stmt->execute(array(
        ':titulo'   => $titulo,
        ':img1' => $new_dir1
    ));
}

// RETORNO
header("Location: http://localhost:8000/admin/dashboard/eventos");
// header("Location: https://kazarosa.com/admin/dashboard/eventos");
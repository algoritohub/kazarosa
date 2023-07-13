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
$id = $_POST['id'];

// REGISTRO DE IMAGEM 1
if(isset($_FILES['imagem'])) {

    // $path1     = $_FILES['imagem']['name'];
    // $ext1      = pathinfo($path1, PATHINFO_EXTENSION);
	// $new_name1 = rand().".".$ext1;
	// $dir1      = '../img/usuario/';
	// move_uploaded_file($_FILES['imagem']['tmp_name'], $dir1.$new_name1);
	// $new_dir1  = $new_name1;

    $img  = $_FILES['imagem'];
    $name =$img['name'];
    $tmp  =$img['tmp_name'];
    $ext  =end(explode('.',$name));

    $pasta    ='../img/usuario/'; //Pasta onde a imagem será salva

    $permiti  =array('jpg', 'jpeg', 'png');
    $name = uniqid().'.'.$ext; $uid = uniqid();

    $upload   = move_uploaded_file($tmp, $pasta.'/'.$name);}; //Faz o upload da imagem para o servidor

    if($upload){
    function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 60){
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];
    //resize and crop image by center
    switch($mime){
    case 'image/gif':
    $image_create = "imagecreatefromgif";
    $image = "imagegif";
    break;
    //resize and crop image by center
    case 'image/png':
    $image_create = "imagecreatefrompng";
    $image = "imagepng";
    $quality = 6;
    break;
    //resize and crop image by center
    case 'image/jpeg':
    $image_create = "imagecreatefromjpeg";
    $image = "imagejpeg";
    $quality = 60;
    break;
    default:
    return false;
    break;
    }
    $dst_img = imagecreatetruecolor($max_width, $max_height);
    $src_img = $image_create($source_file);
    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    if($width_new > $width){
    $h_point = (($height - $height_new) / 2);
    imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    }else{
    $w_point = (($width - $width_new) / 2);
    imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }
    $image($dst_img, $dst_dir, $quality);
    if($dst_img)imagedestroy($dst_img);
    if($src_img)imagedestroy($src_img);
    }

    //Tamanho da Imagem final
    resize_crop_image(300, 300, $pasta.'/'.$name, $pasta.'/'.$name);

    // UPDATE
    $stmt = $conn->prepare('UPDATE usuarios SET imagem = :foto WHERE id = :id');
    $stmt->execute(array(
        'id' => $id,
        'foto' => $name,
    ));
}

// RETORNO
header("Location: http://localhost:8000/perfil");
// header("Location: https://kazarosa.com/perfil");

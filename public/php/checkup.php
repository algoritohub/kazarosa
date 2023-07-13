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

// VERIFICAR SE PLANOS EXPIRARAM
<?php

// PDO
$name_banco = env('PDO_BANCO');
$conectDB = 'mysql:host=localhost;dbname='.$name_banco;
$name_user = env('PDO_USER');
$pass_banco = env('PDO_SENHA');

$conn = new PDO($conectDB, $name_user, $pass_banco);

@$usuario = $info_usuario;

// RESGATAR INFORMAÇÕES DA EMPRESA
$stmt = $conn->prepare('SELECT * FROM usuarios WHERE stts = :stts');
$stmt->execute(array('stts' => $usuario)); 
$result = $stmt->fetchAll();

if ($result) {
    foreach($result as $inform) {};
}

?>

<div style="width: 100%; display: inline-block;">
    <!--  -->
    <div style="width: 70%; margin: 0px 15% 0px 15%; display: inline-block;">
        <!--  -->
        <div style="width: 100%; padding: 40px; margin-top: 50px; display: inline-block; border: solid 1px #cdcdcd; border-radius: 20px;">
            <center>
                <img style="width: 150px;" src="https://kazarosa.com/img/Ativo%2021.png">
                <!--  -->
                <p style="margin-top: 20px;font-weight: bold; font-size: 20px;">Olá {{ $inform['nome'] }}!</p>
                <!--  -->
                <p style="margin-top: 20px;">Você acabou de realizar uma solicitação de agendamento em nosso espaço, para isso, incluímos seu cadastro em nosso sistema. Para acessar suas informações de agendamentos e aproveitar todos os nossos serviços, acesse nosso website <a href="https://www.kazarosa.com" target="_blank">https://www.kazarosa.com/login</a>, usando seu email <b>{{ $inform['email'] }}</b> e sua senha temporária <b>{{ $usuario }}</b>.</p>
                <p style="margin-top: 40px;">Equipe Kaza Rosa</p>
            </center>
        </div>
        <!--  -->
        <center>
            <p style="font-size: 10px; margin-top: 20px;">Todos os direitos reservados a Kaza Rosa &copy; 2022</p>
        </center>
    </div>
</div>
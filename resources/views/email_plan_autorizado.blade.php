<?php

// PDO
$name_banco = env('PDO_BANCO');
$conectDB = 'mysql:host=localhost;dbname='.$name_banco;
$name_user = env('PDO_USER');
$pass_banco = env('PDO_SENHA');

$conn = new PDO($conectDB, $name_user, $pass_banco);

@$plano = $info_plan;

$stmtxx = $conn->prepare('SELECT * FROM clubes WHERE id = :id');
$stmtxx->execute(array('id' => $plano)); 
$resultxx = $stmtxx->fetchAll();

if ($resultxx) {
    foreach($resultxx as $sheldon) {};
}

// RESGATAR INFORMAÇÕES DO USUÁRIO
$stmt = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
$stmt->execute(array('id' => $sheldon['id_user'])); 
$result = $stmt->fetchAll();

if ($result) {
    foreach($result as $inform) {};
}

// VERIFICANDO VENCIMENTO
$vencimento = $sheldon['inicio'];
$new_vencimento = explode( "/", $vencimento);
$new_vencimento_dia = $new_vencimento[0];
$new_vencimento_mes = $new_vencimento[1];
$new_vencimento_ano = $new_vencimento[2];

// VERIFICAÇÃO DE MÊS E ANO
if ($new_vencimento_mes < 12) {
    $new_mes = $new_vencimento_mes + 1;
}
else{
    $new_mes = "01";
    $new_vencimento_ano = $new_vencimento[2] + 1;
}

// CONTAGEM DE CARACTÉRES
$count_mes = strlen($new_mes);

// INCREMENTO DE ZERO
if($count_mes == 1){
    $novo_mes = "0".$new_mes;
}
else{
    $novo_mes = $new_mes;
}

// NOVA DATA DE VENCIMENTO
$data_vencimento = $new_vencimento[0]."/".$novo_mes."/".$new_vencimento_ano;

?>

@if($sheldon['plano'] == 1)
<div style="width: 100%; display: inline-block;">
    <!--  -->
    <div style="width: 50%; margin: 0px 25% 0px 25%; display: inline-block;">
        <!--  -->
        <div style="width: 90%; padding: 40px 5% 40px 5%; margin-top: 50px; display: inline-block; border: solid 1px #cdcdcd; border-radius: 20px;">
            <center>
                <img style="width: 150px;" src="https://kazarosa.com/img/Ativo%2021.png">
                <!--  -->
                <p style="margin-top: 20px;font-weight: bold; font-size: 20px;">Olá {{ $inform['nome'] }}!</p>
                <!--  -->
                        <p style="margin-top: 20px;">Parabéns! Seus pagamento foi confirmado e seu Plan Basic foi autorizado. Você poderá usar seu desconto de {{ $sheldon['desconto'] }}% em qualquer sala e {{ $sheldon['horas'] }} horas mensais extras para locação de espaço, até o dia {{ $data_vencimento }}, acompanhe informações sobre seu plano, acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
            </center>
        </div>
        <!--  -->
        <center>
            <p style="font-size: 10px; margin-top: 20px;">Todos os direitos reservados a Kaza Rosa &copy; 2022</p>
        </center>
    </div>
</div>
@elseif($sheldon['plano'] == 2)
<div style="width: 100%; display: inline-block;">
    <!--  -->
    <div style="width: 50%; margin: 0px 25% 0px 25%; display: inline-block;">
        <!--  -->
        <div style="width: 90%; padding: 40px 5% 40px 5%; margin-top: 50px; display: inline-block; border: solid 1px #cdcdcd; border-radius: 20px;">
            <center>
                <img style="width: 150px;" src="https://kazarosa.com/img/Ativo%2021.png">
                <!--  -->
                <p style="margin-top: 20px;font-weight: bold; font-size: 20px;">Olá {{ $inform['nome'] }}!</p>
                <!--  -->
                        <p style="margin-top: 20px;">Parabéns! Seus pagamento foi confirmado e seu Plan Vip foi autorizado. Você poderá usar seu desconto de {{ $sheldon['desconto'] }}% em qualquer sala e {{ $sheldon['horas'] }} horas mensais extras para locação de espaço, até o dia {{ $data_vencimento }}, acompanhe informações sobre seu plano, acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
            </center>
        </div>
        <!--  -->
        <center>
            <p style="font-size: 10px; margin-top: 20px;">Todos os direitos reservados a Kaza Rosa &copy; 2022</p>
        </center>
    </div>
</div>
@elseif($sheldon['plano'] == 4)
<div style="width: 100%; display: inline-block;">
    <!--  -->
    <div style="width: 50%; margin: 0px 25% 0px 25%; display: inline-block;">
        <!--  -->
        <div style="width: 90%; padding: 40px 5% 40px 5%; margin-top: 50px; display: inline-block; border: solid 1px #cdcdcd; border-radius: 20px;">
            <center>
                <img style="width: 150px;" src="https://kazarosa.com/img/Ativo%2021.png">
                <!--  -->
                <p style="margin-top: 20px;font-weight: bold; font-size: 20px;">Olá {{ $inform['nome'] }}!</p>
                <!--  -->
                        <p style="margin-top: 20px;">Parabéns! Seus pagamento foi confirmado e seu Plan Private foi autorizado. Você poderá usar seu desconto de {{ $sheldon['desconto'] }}% em qualquer sala e {{ $sheldon['horas'] }} horas mensais extras para locação de espaço, até o dia {{ $data_vencimento }}, acompanhe informações sobre seu plano, acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
            </center>
        </div>
        <!--  -->
        <center>
            <p style="font-size: 10px; margin-top: 20px;">Todos os direitos reservados a Kaza Rosa &copy; 2022</p>
        </center>
    </div>
</div>
@elseif($sheldon['plano'] == 3)
<div style="width: 100%; display: inline-block;">
    <!--  -->
    <div style="width: 50%; margin: 0px 25% 0px 25%; display: inline-block;">
        <!--  -->
        <div style="width: 90%; padding: 40px 5% 40px 5%; margin-top: 50px; display: inline-block; border: solid 1px #cdcdcd; border-radius: 20px;">
            <center>
                <img style="width: 150px;" src="https://kazarosa.com/img/Ativo%2021.png">
                <!--  -->
                <p style="margin-top: 20px;font-weight: bold; font-size: 20px;">Olá {{ $inform['nome'] }}!</p>
                <!--  -->
                        <p style="margin-top: 20px;">Parabéns! Seus pagamento foi confirmado e seu Plan Executive foi autorizado. Você poderá usar seu desconto de {{ $sheldon['desconto'] }}% em qualquer sala e {{ $sheldon['horas'] }} horas mensais extras para locação de espaço, até o dia {{ $data_vencimento }}, acompanhe informações sobre seu plano, acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
            </center>
        </div>
        <!--  -->
        <center>
            <p style="font-size: 10px; margin-top: 20px;">Todos os direitos reservados a Kaza Rosa &copy; 2022</p>
        </center>
    </div>
</div>
@endif
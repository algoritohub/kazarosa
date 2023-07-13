<?php

// PDO
$name_banco = env('PDO_BANCO');
$conectDB = 'mysql:host=localhost;dbname='.$name_banco;
$name_user = env('PDO_USER');
$pass_banco = env('PDO_SENHA');

$conn = new PDO($conectDB, $name_user, $pass_banco);

@$usuario = $info_usuario;

// RESGATAR INFORMAÇÕES DO USUÁRIO
$stmt = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
$stmt->execute(array('id' => $usuario));
$result = $stmt->fetchAll();

if ($result) {
    foreach($result as $inform) {};
}

// RESGATAR DO PLANO
$stmt1 = $conn->prepare('SELECT * FROM clubes WHERE id_user = :id');
$stmt1->execute(array('id' => $inform['id']));
$result1 = $stmt1->fetchAll();

if ($result1) {
    foreach($result1 as $inform1) {};
}

?>

@if($inform1['plano'] == 1)
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
                <p style="margin-top: 20px;">Bem-vinda ao nosso Clube de Negócios. Parabéns pela escolha! Você está adquirindo o Plano Basic, com benefícios especiais para clientes mensais. Segue os dados de pagamento para confirmar sua compra. Para mais informações sobre seu plano, acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
                <p style="margin: 20px 0px 20px 0px; font-size: 12px;">Copie e cole em seu aplicativo de pagamento.</p>
                <div style="width: 90%; padding: 30px 5% 30px 5%; border-radius: 20px; border: solid #cdcdcd 1px;">
                    <!--  -->
                    00020126500014br.gov.bcb.pix0114393649410001400210Basic Plan5204000053039865406167.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525P8XD04138455167036657286763042771
                </div>
            </center>
        </div>
        <!--  -->
        <center>
            <p style="font-size: 10px; margin-top: 20px;">Todos os direitos reservados a Kaza Rosa &copy; 2022</p>
        </center>
    </div>
</div>
@elseif($inform1['plano'] == 2)
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
                <p style="margin-top: 20px;">Bem-vinda ao nosso Clube de Negócios. Parabéns pela escolha! Você está adquirindo o Plano Vip, com benefícios especiais para clientes mensais. Segue os dados de pagamento para confirmar sua compra. Para mais informações sobre seu plano, acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
                <p style="margin: 20px 0px 20px 0px; font-size: 12px;">Copie e cole em seu aplicativo de pagamento.</p>
                <div style="width: 90%; padding: 30px 5% 30px 5%; border-radius: 20px; border: solid #cdcdcd 1px;">
                    <!--  -->
                    00020126480014br.gov.bcb.pix0114393649410001400208Vip Plan5204000053039865406257.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525MDHG0413845516708701884196304B166
                </div>
            </center>
        </div>
        <!--  -->
        <center>
            <p style="font-size: 10px; margin-top: 20px;">Todos os direitos reservados a Kaza Rosa &copy; 2022</p>
        </center>
    </div>
</div>
@elseif($inform1['plano'] == 4)
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
                <p style="margin-top: 20px;">Bem-vinda ao nosso Clube de Negócios. Parabéns pela escolha! Você está adquirindo o Plano Private, com benefícios especiais para clientes mensais. Segue os dados de pagamento para confirmar sua compra. Para mais informações sobre seu plano, acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
                <p style="margin: 20px 0px 20px 0px; font-size: 12px;">Copie e cole em seu aplicativo de pagamento.</p>
                <div style="width: 90%; padding: 30px 5% 30px 5%; border-radius: 20px; border: solid #cdcdcd 1px;">
                    <!--  -->
                    00020126520014br.gov.bcb.pix0114393649410001400212Private Plan5204000053039865406420.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525UXG1041384551672171247851630428F2
                </div>
            </center>
        </div>
        <!--  -->
        <center>
            <p style="font-size: 10px; margin-top: 20px;">Todos os direitos reservados a Kaza Rosa &copy; 2022</p>
        </center>
    </div>
</div>
@elseif($inform1['plano'] == 3)
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
                <p style="margin-top: 20px;">Bem-vinda ao nosso Clube de Negócios. Parabéns pela escolha! Você está adquirindo o Plano Basic, com benefícios especiais para clientes mensais. Segue os dados de pagamento para confirmar sua compra. Para mais informações sobre seu plano, acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
                <p style="margin: 20px 0px 20px 0px; font-size: 12px;">Copie e cole em seu aplicativo de pagamento.</p>
                <div style="width: 90%; padding: 30px 5% 30px 5%; border-radius: 20px; border: solid #cdcdcd 1px;">
                    <!--  -->
                    00020126540014br.gov.bcb.pix0114393649410001400214Executive Plan5204000053039865406637.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525ZDKX041384551670870337094630444D0
                </div>
            </center>
        </div>
        <!--  -->
        <center>
            <p style="font-size: 10px; margin-top: 20px;">Todos os direitos reservados a Kaza Rosa &copy; 2022</p>
        </center>
    </div>
</div>
@endif

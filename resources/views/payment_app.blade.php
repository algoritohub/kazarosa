@extends('layout.main_payment')
@section('title', 'Kaza Rosa | Pagamento')

@section('content')
<!--  -->
<?php

// PDO
$name_banco = env('PDO_BANCO');
$conectDB = 'mysql:host=localhost;dbname='.$name_banco;
$name_user = env('PDO_USER');
$pass_banco = env('PDO_SENHA');

$conn = new PDO($conectDB, $name_user, $pass_banco);

$usuario = $status_user;

// RESGATAR INFORMAÇÕES DO USUÁRIO
$stmt = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
$stmt->execute(array('id' => $usuario));
$result = $stmt->fetchAll();

if ($result) {
    foreach($result as $inform) {};
}

// RESGATE DE CÓDIGO DE PLANO
$stmtxx = $conn->prepare('SELECT * FROM clubes WHERE id_user = :id');
$stmtxx->execute(array('id' => $inform['id']));
$resultxx = $stmtxx->fetchAll();

if ($resultxx) {
    foreach($resultxx as $informxx) {};
}

?>
<!--  -->
<section class="w-[100%] inline-block">
    <!--  -->
    <div class="w-[90%] mx-[5%] mb-[130px] inline-block">
        <!--  -->
        <div class="w-[100%] mt-[150px] inline-block">
            <!--  -->
            @if($informxx['plano'] == 1)
            <div class="w-[100%] inline-block">
                <div id="idea" class="w-[60%] pr-[50px] inline-block float-left">
                    <!--  -->
                    <p class="mt-[20px] font-bold text-[20px]">Olá {{ $inform['nome'] }}!</p>
                    <p class="mt-[40px] text-[17px]">Bem-vinda ao nosso Clube de Negócios. Parabéns pela escolha! Você está adquirindo o Plano Basic, com benefícios especiais para clientes mensais. Segue os dados de pagamento para confirmar sua compra. Acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
                    <p class="my-[20px] text-[11px]">Copie e cole em seu aplicativo de pagamento:</p>
                    <div class="w-[100%] p-[30px] overflow-scroll rounded-[20px] border-[1px] border-[#cdcdcd] inline-block">
                        <!--  -->
                        <center>
                            <textarea class="w-[100%] inline-block rounded-[10px] outline-none">
                                00020126500014br.gov.bcb.pix0114393649410001400210Basic Plan5204000053039865406167.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525P8XD04138455167036657286763042771
                            </textarea>
                        </center>
                    </div>
                    <!--  -->
                    <div class="w-[100%] mt-[30px] inline-block">
                        <!--  -->
                        <img class="w-[80px]" src="/img/pix-106.png">
                    </div>
                </div>
                <!--  -->
                <div id="pad" class="w-[40%] pl-[50px] pb-[50px] border-l-[1px] border-l-[#cdcdcd] inline-block float-left">
                    <!--  -->
                    <img class="w-[60%] mx-[auto]" src="/img/celular_redesocial.png">
                    <!--  -->
                    <center><p class="text-[13px]">Acesse sua conta e encontre esse e outros planos exclusivos!</p></center>
                    <!--  -->
                    <a href="{{ route('login') }}"><button class="w-[100%] mt-[18px] h-[45px] rounded-[10px] bg-[#313131] text-[#ffffff]">Já fez seu pagamento, acesse sua conta</button></a>
                </div>
            </div>
            @elseif($informxx['plano'] == 2)
            <div class="w-[100%] inline-block">
                <div id="idea" class="w-[60%] pr-[50px] inline-block float-left">
                    <!--  -->
                    <p class="mt-[20px] font-bold text-[20px]">Olá {{ $inform['nome'] }}!</p>
                    <p class="mt-[40px] text-[17px]">Bem-vinda ao nosso Clube de Negócios. Parabéns pela escolha! Você está adquirindo o Plano Vip, com benefícios especiais para clientes mensais. Segue os dados de pagamento para confirmar sua compra. Acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
                    <p class="my-[20px] text-[11px]">Copie e cole em seu aplicativo de pagamento:</p>
                    <div class="w-[100%] p-[30px] overflow-scroll rounded-[20px] border-[1px] border-[#cdcdcd] inline-block">
                        <!--  -->
                        <center>
                            <textarea class="w-[100%] inline-block rounded-[10px] outline-none">
                                00020126480014br.gov.bcb.pix0114393649410001400208Vip Plan5204000053039865406257.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525MDHG0413845516708701884196304B166
                            </textarea>
                        </center>
                    </div>
                    <!--  -->
                    <div class="w-[100%] mt-[30px] inline-block">
                        <!--  -->
                        <img class="w-[80px]" src="/img/pix-106.png">
                    </div>
                </div>
                <!--  -->
                <div id="pad" class="w-[40%] pl-[50px] pb-[50px] border-l-[1px] border-l-[#cdcdcd] inline-block float-left">
                    <!--  -->
                    <img class="w-[60%] mx-[auto]" src="/img/celular_redesocial.png">
                    <!--  -->
                    <center><p class="text-[13px]">Acesse sua conta e encontre esse e outros planos exclusivos!</p></center>
                    <!--  -->
                    <a href="{{ route('login') }}"><button class="w-[100%] mt-[18px] h-[45px] rounded-[10px] bg-[#313131] text-[#ffffff]">Já fez seu pagamento, acesse sua conta</button></a>
                </div>
            </div>
            @elseif($informxx['plano'] == 4)
            <div class="w-[100%] inline-block">
                <div id="idea" class="w-[60%] pr-[50px] inline-block float-left">
                    <!--  -->
                    <p class="mt-[20px] font-bold text-[20px]">Olá {{ $inform['nome'] }}!</p>
                    <p class="mt-[40px] text-[17px]">Bem-vinda ao nosso Clube de Negócios. Parabéns pela escolha! Você está adquirindo o Plano Private, com benefícios especiais para clientes mensais. Segue os dados de pagamento para confirmar sua compra. Acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
                    <p class="my-[20px] text-[11px]">Copie e cole em seu aplicativo de pagamento:</p>
                    <div class="w-[100%] p-[30px] overflow-scroll rounded-[20px] border-[1px] border-[#cdcdcd] inline-block">
                        <!--  -->
                        <center>
                            <textarea class="w-[100%] inline-block rounded-[10px] outline-none">
                                00020126520014br.gov.bcb.pix0114393649410001400212Private Plan5204000053039865406420.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525UXG1041384551672171247851630428F2
                            </textarea>
                        </center>
                    </div>
                    <!--  -->
                    <div class="w-[100%] mt-[30px] inline-block">
                        <!--  -->
                        <img class="w-[80px]" src="/img/pix-106.png">
                    </div>
                </div>
                <!--  -->
                <div id="pad" class="w-[40%] pl-[50px] pb-[50px] border-l-[1px] border-l-[#cdcdcd] inline-block float-left">
                    <!--  -->
                    <img class="w-[60%] mx-[auto]" src="/img/celular_redesocial.png">
                    <!--  -->
                    <center><p class="text-[13px]">Acesse sua conta e encontre esse e outros planos exclusivos!</p></center>
                    <!--  -->
                    <a href="{{ route('login') }}"><button class="w-[100%] mt-[18px] h-[45px] rounded-[10px] bg-[#313131] text-[#ffffff]">Já fez seu pagamento, acesse sua conta</button></a>
                </div>
            </div>
            @elseif($informxx['plano'] == 3)
            <div id="idea" class="w-[100%] inline-block">
                <div class="w-[60%] pr-[50px] inline-block float-left">
                    <!--  -->
                    <p class="mt-[20px] font-bold text-[20px]">Olá {{ $inform['nome'] }}!</p>
                    <p class="mt-[40px] text-[17px]">Bem-vinda ao nosso Clube de Negócios. Parabéns pela escolha! Você está adquirindo o Plano Basic, com benefícios especiais para clientes mensais. Segue os dados de pagamento para confirmar sua compra. Acesse sua conta pelo App Web, <a href="https://www.kazarosa.com/web" target="_blank">https://www.kazarosa.com/web</a>.</p>
                    <p class="my-[20px] text-[11px]">Copie e cole em seu aplicativo de pagamento:</p>
                    <div class="w-[100%] p-[30px] overflow-scroll rounded-[20px] border-[1px] border-[#cdcdcd] inline-block">
                        <!--  -->
                        <center>
                            <textarea class="w-[100%] inline-block rounded-[10px] outline-none">
                                00020126540014br.gov.bcb.pix0114393649410001400214Executive Plan5204000053039865406637.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525ZDKX041384551670870337094630444D0
                            </textarea>
                        </center>
                    </div>
                    <!--  -->
                    <div class="w-[100%] mt-[30px] inline-block">
                        <!--  -->
                        <img class="w-[80px]" src="/img/pix-106.png">
                    </div>
                </div>
                <!--  -->
                <div id="pad" class="w-[40%] pl-[50px] pb-[50px] border-l-[1px] border-l-[#cdcdcd] inline-block float-left">
                    <!--  -->
                    <img class="w-[60%] mx-[auto]" src="/img/celular_redesocial.png">
                    <!--  -->
                    <center><p class="text-[13px]">Acesse sua conta e encontre esse e outros planos exclusivos!</p></center>
                    <!--  -->
                    <a href="{{ route('login') }}"><button class="w-[100%] mt-[18px] h-[45px] rounded-[10px] bg-[#313131] text-[#ffffff]">Já fez seu pagamento, acesse sua conta</button></a>
                </div>
            </div>
            @endif
            <div class="inline-block mt-[30px] w-[100%]">
                <a href="{{ route('principal') }}"><button id="bt_version" class="float-right w-[120px] h-[36px] mx-auto rounded-[10px] bg-[#874645] text-[#ffffff]">Web Version</button></a>
            </div>
        </div>
    </div>
</section>
@endsection

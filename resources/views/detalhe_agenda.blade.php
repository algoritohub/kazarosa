@extends('layout.main_vantagens')
@section('title', 'Kaza Rosa | Agendamento')
@section('titulo_max', 'Agendamento')
@section('titulo_min', 'Confirmar detalhes')

@section('content')
<!--  -->
<section class="md:hidden">
    <div class="w-[100%] inline-block">
        <!-- BANNER -->
    </div>
</section>
<!-- ESPAÇOS -->
<section class="md:hidden">
    <!-- INFORMAÇÕES GERAIS -->
    <div class="w-[100%] inline-block mb-[20px]">
        <!-- CONEXÃO PDO -->
        <?php

        $name_banco = env('PDO_BANCO');
        $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
        $name_user = env('PDO_USER');
        $pass_banco = env('PDO_SENHA');

        $conn = new PDO($conectDB, $name_user, $pass_banco);

        // $code_agd = $agendamento;

        // RESGATAR DETALHES DO AGENDAMENTO
        $stmt = $conn->prepare('SELECT * FROM agendamentos WHERE codigo = :code');
        $stmt->execute(array('code' => session('agendamento')));
        $result = $stmt->fetchAll();
        foreach($result as $detalhe) {};

        // RESGATAR INFORMAÇÕES DO ESPAÇO
        $stmt1 = $conn->prepare('SELECT * FROM salas WHERE id = :id');
        $stmt1->execute(array('id' => $detalhe['sala']));
        $result1 = $stmt1->fetchAll();
        foreach($result1 as $detalhe1) {};

        ?>
        <div class="w-[90%] mx-[5%] mt-[20px] inline-block">
            <!--  -->
            <p class="text-[15px]">Você agendou</p>
            <!--  -->
            <p class="text-[25px]">{{ $detalhe1['nome'] }}</p>
            <!--  -->
            <p class="text-[15px] mt-[20px] font-bold">Detalhes do agendamento:</p>
            <!--  -->
            <p class="text-[13px] mt-[3px]">Agendado por {{ $detalhe['tempo'] }} horas, no dia {{ $detalhe['dia'] }} ás {{ $detalhe['horario'] }}hs.</p>
            <!--  -->
            <p class="text-[15px] mt-[20px] font-bold">Local do agendamento:</p>
        </div>
        <!--  -->
        <div class="w-[100%] mt-[10px] inline-block">
            <div class="w-[100%] h-[200px] bg-[silver]">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3969.242745681896!2d-35.21838788621892!3d-5.821352159019275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7b255dd21f19701%3A0xfee43b7ddacae54e!2sKaza%20Rosa!5e0!3m2!1spt-BR!2sbr!4v1667276522439!5m2!1spt-BR!2sbr" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <!--  -->
        <div class="w-[90%] mx-[5%] inline-block">
        <!--  -->
            <?php

            // RESGATAR VALOR ATUAL
            $stmtgg = $conn->prepare('SELECT * FROM agendamentos WHERE user = :user');
            $stmtgg->execute(array('user' => $detalhe['user']));
            $resultgg = $stmtgg->fetchAll();
            foreach($resultgg as $yupgg) {};

            $new_tipo = $yupgg['tipo'];
            $new_valor = number_format($yupgg['desconto'],2,",",".");

            ?>
            @if($new_tipo != "null")
            <p class="text-[20px] mt-[20px]">R${{ $new_valor }} (desconto em plano)</p>
            @else
            <p class="text-[25px] mt-[20px]">R${{ $new_valor }}</p>
            @endif
            <!--  -->
            <p class="text-[13px] mt-[3px]">Pagar no local de agendamento</p>
            <!--  -->
            <a href="{{ route('confirmar_agenda', ['id' => $detalhe['id']]) }}"><button class="w-[100%] mt-[30px] text-[#ffffff] h-[45px] bg-[#A35554] rounded-[5px]">Confirmar agendamento</button></a>
            <!-- RECUPERA TEMPO USANDO DO PLANO EM CASO DE CANCELAMENTO -->
            <center><a href="{{ route('cancelar_agenda', ['id' => $detalhe['id']]) }}"><p class="mt-[20px]">Não quero mais agendar</p></a></center>
        </div>
    </div>
</section>
@endsection

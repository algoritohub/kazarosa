@extends('layout.main_vantagens')
@section('title', 'Kaza Rosa | Agendamento')
@section('titulo_max', 'Comprovante')
@section('titulo_min', 'Detalhes do agendamento')

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

        $id_agendamento = $agenda->id;

        // RESGATAR DETALHES DO AGENDAMENTO
        $stmt = $conn->prepare('SELECT * FROM agendamentos WHERE id = :id');
        $stmt->execute(array('id' => $id_agendamento));
        $result = $stmt->fetchAll();
        foreach($result as $detalhe) {};

        // RESGATAR INFORMAÇÕES DO ESPAÇO
        $stmt1 = $conn->prepare('SELECT * FROM salas WHERE id = :id');
        $stmt1->execute(array('id' => $detalhe['sala']));
        $result1 = $stmt1->fetchAll();
        foreach($result1 as $detalhe1) {};

        $stmtoo = $conn->prepare('SELECT * FROM log_financeiros WHERE codigo = :codigo');
        $stmtoo->execute(array('codigo' => $detalhe['codigo']));
        $resultoo = $stmtoo->fetchAll();
        foreach($resultoo as $rowoo) {}

        $valor = $rowoo['vantagem'];
        $preco_pagar = number_format($valor,2,",",".");

        ?>
        <div class="w-[90%] mx-[5%] mt-[20px] inline-block">
            <!--  -->
            @if($detalhe['stts'] == "pagamento")
            <p class="text-[15px]">Você agendou</p>
            @elseif($detalhe['stts'] == "encerrado" OR $detalhe['stts'] == "avaliar")
            <p class="text-[15px]">Você usou</p>
            @endif
            <!--  -->
            <p class="text-[25px]">{{ $detalhe1['nome'] }}</p>
            <!--  -->
            <hr class="my-[10px]">
            <!--  -->
            <center><p class="text-[15px] mt-[20px]">Código do agendamento:</p></center>
            <!--  -->
            <center><p class="text-[40px] rounded-[20px] mt-[10px] p-[10px] border-[1px] bg-[#fafafa]">{{ $detalhe['codigo'] }}</p></center>
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
            <p class="text-[25px] mt-[20px]">R${{ $preco_pagar }}</p>
            <!--  -->
            <!-- <p class="text-[13px] mt-[3px]">Pagar no local de agendamento</p> -->
            <!--  -->
            @if($detalhe['stts'] == "pagamento")
            <button class="w-[100%] mt-[30px] text-[#ffffff] h-[45px] bg-[#A35554] rounded-[5px]">Pagar agora</button>
            <!--  -->
            <center><a href="{{ route('cancelar_agenda', ['id' => $detalhe['id']]) }}"><p class="mt-[20px]">Desistir do agendamento</p></a></center>
            @elseif($detalhe['stts'] == "avaliar")
            <!--  -->
            <p class="mt-[20px] text-[20px] font-bold">Avalie esse espaço</p>
            <!--  -->
            <form action="{{ route('avaliar_espaco', ['id' => $agenda->id]) }}" method="POST">
                @csrf
                <div class="w-[100%] inline-block mt-[30px]">
                    <!--  -->
                    <div class="bg-[#fafafa] float-left mr-[10px] mb-[10px] inline-block border-[1px] border-[#cdcdcd] rounded-[50px] pt-[8px] pb-[3px] px-[10px]">
                        <input class="float-left" name="estrela" type="radio" value="1">
                        <p class="float-left text-[16px] mt-[-5px] ml-[5px]">1</p>
                        <img class="float-left w-[13px] ml-[4px] mt-[-1px]" src="/img/estrela.png">
                    </div>
                    <!--  -->
                    <div class="bg-[#fafafa] float-left mr-[10px] mb-[10px] inline-block border-[1px] border-[#cdcdcd] rounded-[50px] py-[8px] px-[10px]">
                        <input class="float-left" name="estrela" type="radio" value="2">
                        <p class="float-left text-[16px] mt-[-5px] ml-[5px]">2</p>
                        <img class="float-left w-[13px] ml-[4px] mt-[-1px]" src="/img/estrela.png">
                    </div>
                    <!--  -->
                    <div class="bg-[#fafafa] float-left mr-[10px] mb-[10px] inline-block border-[1px] border-[#cdcdcd] rounded-[50px] py-[8px] px-[10px]">
                        <input class="float-left" name="estrela" type="radio" value="3">
                        <p class="float-left text-[16px] mt-[-5px] ml-[5px]">3</p>
                        <img class="float-left w-[13px] ml-[4px] mt-[-1px]" src="/img/estrela.png">
                    </div>
                    <!--  -->
                    <div class="bg-[#fafafa] float-left mr-[10px] mb-[10px] inline-block border-[1px] border-[#cdcdcd] rounded-[50px] py-[8px] px-[10px]">
                        <input class="float-left" name="estrela" type="radio" value="4">
                        <p class="float-left text-[16px] mt-[-5px] ml-[5px]">4</p>
                        <img class="float-left w-[13px] ml-[4px] mt-[-1px]" src="/img/estrela.png">
                    </div>
                    <!--  -->
                    <div class="bg-[#fafafa] float-left mr-[10px] mb-[10px] inline-block border-[1px] border-[#cdcdcd] rounded-[50px] py-[8px] px-[10px]">
                        <input class="float-left" name="estrela" type="radio" value="5">
                        <p class="float-left text-[16px] mt-[-5px] ml-[5px]">5</p>
                        <img class="float-left w-[13px] ml-[4px] mt-[-1px]" src="/img/estrela.png">
                    </div>
                    <!--  -->
                    <textarea name="avaliacao" class="w-[100%] h-[100px] outline-none bg-[#fafafa] border-[#cdcdcd] p-[10px] border-[1px] rounded-[20px]" placeholder="Deixe uma avaliação (opcional)"></textarea>
                    <!--  -->
                    <input type="hidden" name="espaco" value="{{ $detalhe1['id'] }}">
                    <!--  -->
                    <input type="hidden" name="usuario" value="{{ session('usuario')['id'] }}">
                </div>
                <!--  -->
                <button class="w-[100%] text-[#ffffff] mt-[20px] h-[45px] bg-[#A35554] rounded-[5px]">Avaliar espaço</button>
            </form>
            @elseif($detalhe['stts'] == "encerrado")
            <button class="w-[100%] mt-[30px] text-[#ffffff] h-[45px] bg-[#A35554] rounded-[5px]">Usado em {{ $detalhe['dia'] }}</button>
            @else
            <button class="w-[100%] mt-[30px] text-[#ffffff] h-[45px] bg-[#A35554] rounded-[5px]">Encerra às {{ $detalhe['horario'] }}</button>
            @endif
        </div>
    </div>
</section>
@endsection

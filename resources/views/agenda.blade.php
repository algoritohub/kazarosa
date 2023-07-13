@extends('layout.main_lista_agenda')
@section('title', 'Kaza Rosa | Agendamento')
@section('titulo_max', 'Agendamentos')
@section('titulo_min', 'Meus agendamentos')

@section('content')
<!--  -->
<section class="md:hidden">
    <div class="w-[100%] inline-block">
        <!-- BANNER -->
    </div>
</section>
<!-- ESPAÇOS -->
<section class="md:hidden">
    <div class="w-[100%] inline-block mt-[10px] overflow-scroll">
        <div class="w-[90%] mx-[5%] inline-block">
            <!-- CONEXÃO PDO -->
            <?php

            $name_banco = env('PDO_BANCO');
            $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
            $name_user = env('PDO_USER');
            $pass_banco = env('PDO_SENHA');

            $conn = new PDO($conectDB, $name_user, $pass_banco);

            $usuario = session('usuario')['id'];

            $stmt = $conn->prepare('SELECT * FROM agendamentos WHERE user = :id AND stts != "encerrado" ORDER BY dia DESC');
            $stmt->execute(array('id' => $usuario));
            $result = $stmt->fetchAll();

            ?>
            @foreach($result as $row)
            <!--  -->
            <?php

            $stmtx = $conn->prepare('SELECT * FROM salas WHERE id = :id');
            $stmtx->execute(array('id' => $row['sala']));
            $resultx = $stmtx->fetchAll();
            foreach($resultx as $rowx) {}

            $stmtoo = $conn->prepare('SELECT * FROM log_financeiros WHERE codigo = :codigo');
            $stmtoo->execute(array('codigo' => $row['codigo']));
            $resultoo = $stmtoo->fetchAll();
            foreach($resultoo as $rowoo) {}

            $valor = $rowoo['vantagem'];
            $preco = number_format($valor,2,",",".");

            ?>
            <!--  -->
            @if($row['stts'] == "pagamento")
            <a href="{{ route('comprovante', ['id' => $row['id']]) }}">
            <div class="w-[100%] border-[1px] border-l-[5px] border-l-[orange] border-[orange] rounded-[10px] p-[20px] inline-block">
                <!--  -->
                <div class="w-[70%] inline-block float-left">
                    <!--  -->
                    <p style="border-radius: 8px 0px 8px 0px;" class="text-[10px] p-[3px] mb-[5px] bg-[orange] mt-[-20px] text-[#ffffff] ml-[-20px] relativo px-[10px]">Aguardando pagamento</p>
                    <!--  -->
                    <p class="text-[15px] font-bold">{{ $rowx['nome'] }}</p>
                    <!--  -->
                    <p class="">Agendado para {{ $row['dia'] }}</p>
                </div>
                <!--  -->
                <div class="w-[30%] inline-block float-left">
                    <!--  -->
                    <p class="float-right mt-[15px] font-bold text-[18px]">R${{ $preco }}</p>
                </div>
            </div>
            </a>
            @elseif($row['stts'] == "encerrado")
            <a href="{{ route('comprovante', ['id' => $row['id']]) }}">
            <div class="w-[100%] border-[1px] border-l-[5px] border-l-[red] border-[red] rounded-[10px] p-[20px] inline-block">
                <!--  -->
                <div class="w-[70%] inline-block float-left">
                    <!--  -->
                    <p style="border-radius: 8px 0px 8px 0px;" class="text-[10px] p-[3px] mb-[5px] bg-[red] mt-[-20px] ml-[40px] text-[#ffffff] relativo px-[10px]">Encerrado</p>
                    <!--  -->
                    <p class="text-[15px] font-bold">{{ $rowx['nome'] }}</p>
                    <!--  -->
                    <p class="">Agendado para {{ $row['dia'] }}</p>
                </div>
                <!--  -->
                <div class="w-[30%] inline-block float-left">
                    <!--  -->
                    <p class="float-right mt-[15px] font-bold text-[18px]">R${{ $preco }}</p>
                </div>
            </div>
            @elseif($row['stts'] == "avaliar")
            <a href="{{ route('comprovante', ['id' => $row['id']]) }}">
            <div class="w-[100%] border-[1px] border-l-[5px] border-l-[blue] border-[blue] rounded-[10px] p-[20px] inline-block">
                <!--  -->
                <div class="w-[70%] inline-block float-left">
                    <!--  -->
                    <p style="border-radius: 8px 0px 8px 0px;" class="text-[10px] p-[3px] mb-[5px] bg-[blue] mt-[-20px] ml-[-20px] text-[#ffffff] relativo px-[10px]">Avaliar espaço</p>
                    <!--  -->
                    <p class="text-[15px] font-bold">{{ $rowx['nome'] }}</p>
                    <!--  -->
                    <p class="">Agendado para {{ $row['dia'] }}</p>
                </div>
                <!--  -->
                <div class="w-[30%] inline-block float-left">
                    <!--  -->
                    <p class="float-right mt-[15px] font-bold text-[18px]">R${{ $preco }}</p>
                </div>
            </div>
            @else
            <a href="{{ route('comprovante', ['id' => $row['id']]) }}">
            <div class="w-[100%] border-[1px] border-l-[5px] border-l-[green] border-[green] rounded-[10px] p-[20px] inline-block">
                <!--  -->
                <div class="w-[70%] inline-block float-left">
                    <!--  -->
                    <p style="border-radius: 8px 0px 8px 0px;" class="text-[10px] p-[3px] mb-[5px] bg-[green] mt-[-20px] ml-[-20px] text-[#ffffff] relative px-[10px]">Encerra às {{ $row['stts'] }}</p>
                    <!--  -->
                    <p class="text-[15px] font-bold">{{ $rowx['nome'] }}</p>
                    <!--  -->
                    <p class="">Agendado para {{ $row['dia'] }}</p>
                </div>
                <!--  -->
                <div class="w-[30%] inline-block float-left">
                    <!--  -->
                    <p class="float-right mt-[15px] font-bold text-[18px]">R${{ $preco }}</p>
                </div>
            </div>
            </a>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endsection

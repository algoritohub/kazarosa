@php
    $name_banco = env('PDO_BANCO');
    $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
    $name_user = env('PDO_USER');
    $pass_banco = env('PDO_SENHA');

    $conn = new PDO($conectDB, $name_user, $pass_banco);

    @$usuario_carrinho = session('usuario')['id'];

    // VERIFICAR DE JÁ TENHO UM PLANO
    $stmtx1 = $conn->prepare('SELECT * FROM clubes WHERE id_user = :id AND stts = "autorizado"');
    $stmtx1->execute(array('id' => $usuario_carrinho));
    $resultx1 = $stmtx1->fetchAll();
    $contadox1 = count($resultx1);

    if ($contadox1 > 0) {

        foreach ($resultx1 as $kenny) {}

        if ($kenny['plano'] == 1) {
            $nome_plan = "Plan Basic";
        }
        elseif ($kenny['plano'] == 2) {
            $nome_plan = "Plan Vip";
        }
        elseif ($kenny['plano'] == 4) {
            $nome_plan = "Plan Private";
        }
        elseif ($kenny['plano'] == 3) {
            $nome_plan = "Plan Executive";
        }

        // CALCULO DE DIAS
        $inicio_data = $kenny['inicio'];
        $explode_data = explode('/', $inicio_data);

        $dia_plan = $explode_data[0];
        $mes_plan = $explode_data[1];
        $ano_plan = $explode_data[2];

        if ($ano_plan == 12) {
            $data_mes = 01;
            $ano_novo = $ano_plan + 1;
        }
        else{
            $data_mes = $mes_plan + 1;
            $ano_novo = $ano_plan;

            $ver_mes = strlen($data_mes);

            if($ver_mes == 2){
                $data_mes = $mes_plan + 1;
            }
            else{
                $data_mes = $mes_plan + 1;
            }
        }

        $new_data_fim = $explode_data[0]."/".$data_mes."/".$ano_novo;
    }
@endphp

@extends('layout.main_lista_agenda')
@section('title', 'Kasa Rosa | Meu plano')
@section('titulo_max', 'Meu plano')
@if($contadox1 > 0)
    @section('titulo_min', $nome_plan)
@else
    @section('titulo_min', 'Aguardando autorização')
@endif
@section('content')
<!--  -->
@if($contadox1 > 0)
    <section class="md:hidden">
        <div class="w-[100%] inline-block">
            <!-- BANNER -->
        </div>
    </section>
    <!-- ESPAÇOS -->
    <section class="md:hidden">
        <div class="w-[100%] inline-block mt-[10px] overflow-scroll">
            {{-- CONTAGEM DO PLANO --}}
            <div class="w-[90%] mx-[5%] inline-block">
                <!-- BARRA CIRCULAR -->
                @php
                    $dias_atual = $kenny['dias'];
                    $porcentagem = $dias_atual * 100 / 30;
                    $formatar_porc = strlen($porcentagem);

                    if ($porcentagem > 2){
                        $novo_formato = explode('.', $porcentagem);
                        $new_porcente = $novo_formato[0];
                    }
                    else{
                        $new_porcente = $porcentagem;
                    }
                @endphp
                <div class="mx-[auto] mt-[10px]" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:{{ $new_porcente }}"><p class="text-center text-[#333333] mt-[-100px]">{{ $dias_atual }} dias</p></div>
                <!--  -->
            </div>
            {{--  --}}
            <div class="w-[100%] mt-[30px] inline-block">
                {{--  --}}
                <div class="w-[90%] mx-[5%] inline-block">
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="font-bold">Desconto ({{ $kenny['desconto'] }}%)</p>
                    </div>
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="float-right text-[12px]">Válido até {{ $new_data_fim }}</p>
                    </div>
                </div>
                {{--  --}}
                <div style="background: linear-gradient(to right, #cdcdcd 30%, #eeeeee 70%);" class="w-[90%] mx-[5%] bg-[#eeeeee] text-[12px] rounded-[5px] border-[1px] py-[10px]">
                    <p class="text-center text-[#333333]">Desconto válido para qualquer espaço.</p>
                </div>
            </div>
            {{--  --}}
            <hr class="my-[10px]">
            {{--  --}}
            <div class="w-[100%] inline-block">
                {{--  --}}
                <div class="w-[90%] mx-[5%] inline-block">
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="font-bold">Horas Adquiridas</p>
                    </div>
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="float-right text-[12px]">{{ $kenny['horas'] }} horas restantes</p>
                    </div>
                </div>
                {{--  --}}
                <div style="background: linear-gradient(to left, #C5908F 30%, #A35554 70%);" class="w-[90%] rounded-[5px] mx-[5%] bg-[#eeeeee] text-[12px] border-[1px] py-[10px]">
                    <p class="text-center text-[#ffffff]">Em estações Compartilhadas</p>
                </div>
            </div>
            {{--  --}}
            @php
                $my_plan = Illuminate\Support\Facades\DB::select("SELECT * FROM clubes WHERE id_user = '$usuario_carrinho'");
                $blockup = $my_plan[0]->turno;
            @endphp
            {{--  --}}
            <div class="w-[100%] mt-[10px] inline-block">
                {{--  --}}
                <div class="w-[90%] mx-[5%] inline-block">
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="font-bold">Rede social</p>
                    </div>
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        @if ($blockup == 1)
                        <p class="float-right text-[12px]">Liberada</p>
                        @else
                        <p class="float-right text-[12px]">Bloqueado</p>
                        @endif
                    </div>
                </div>
                {{--  --}}
                @if ($blockup == 1)
                <div style="background: linear-gradient(to left, #C5908F 30%, #A35554 70%);" class="w-[90%] rounded-[5px] mx-[5%] bg-[#eeeeee] text-[12px] border-[1px] py-[10px]">
                    <p class="text-center text-[#ffffff]">Acesso liberado até {{ $new_data_fim }}</p>
                </div>
                @else
                <a href="{{ route('liberar_rede', ['id' => $my_plan[0]->id]) }}"><button class="w-[90%] h-[40px] mx-[5%] rounded-[3px] bg-[#333333] text-[#ffffff]">Liberar meu acesso</button></a>
                @endif
            </div>
        </div>
    </section>
@else
    <section class="md:hidden">
        <div class="w-[100%] inline-block">
            <!-- BANNER -->
            <center>
                <p class="mt-[50%] w-[300px] text-[12px]">Você contratou um de nossos planos de benefícios, aguarde a autorização de seu plano para obter todas as informações sobre ele.</p>
            </center>
        </div>
    </section>
@endif
@endsection

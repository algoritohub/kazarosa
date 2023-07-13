@extends('dashboard.layout.main')
@section('title', 'Dashboard - Geral')
@section('titulo', 'Painel geral')
@section('imagem', 'painel.png')
@section('descricao', 'ATENÇÂO: Todos os lançamentos financeiros serão atualizados a partir do dia 03/01/2023')

@section('content')
<!--  -->
<div class="w-[100%] inline-block">
    <!-- CHECK SISTEMA -->
    <a style="display: none;" href="/php/checkup.php"><button class="w-[250px] ml-[18px] mb-[30px] h-[40px] rounded-[5px] bg-[green] text-[#ffffff]" title="checkagem de hoje não foi realizada!">Check sistema ✔</button></a>
</div>
<!--  -->
<div class="w-[100%] bg-white float-left overflow-auto">
    <!--  -->
    <div class="inline-block w-[100%]">
        <!-- CARD -->
        <div class="float-left w-[22%] h-[200px] mx-[1.5%] border-[1px] p-[20px] bg-slate-50 ">
            <!-- CONEXÃO PDO -->
            <?php

            $name_banco = env('PDO_BANCO');
            $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
            $name_user = env('PDO_USER');
            $pass_banco = env('PDO_SENHA');

            $conn = new PDO($conectDB, $name_user, $pass_banco);

            @$user = $_GET['user'];

            // USUARIOS TOTAIS
            $stmt1 = $conn->prepare('SELECT * FROM usuarios');
            $stmt1->execute();
            $result1 = $stmt1->fetchAll();
            $contagem1 = count($result1);

            // USUARIOS VERIFICADOS
            $stmt2 = $conn->prepare('SELECT * FROM usuarios WHERE stts = :stts');
            $stmt2->execute(array('stts' => 'ativo'));
            $result2 = $stmt2->fetchAll();
            $contagem2 = count($result2);

            ?>

            <div class="w-[100%] h-[40px] border-b-4 border-[#C5908F]">
                <!--  -->
                <div class="float-left w-[70%] h-[40px]">
                    <p class="font-bold">Usuários ativos</p>
                </div>
                <!--  -->
                <div class="float-left w-[30%] h-[40px]">
                    <p class="float-right mt-[-3px]">◡</p>
                </div>
            </div>
            <!--  -->
            <p class="text-4xl font-bold mt-[10px]">{{ $contagem1 }}</p>
            <!--  -->
            <p class="text-[11px] mt-[10px]">Usuários verificados</p>
            <!--  -->
            <p class="text-base font-bold mt-[10px]">{{ $contagem2 }}</p>
        </div>
        <!-- CARD -->
        <div class="float-left w-[22%] h-[200px] mx-[1.5%] border-[1px] p-[20px] bg-slate-50">
            <?php

            date_default_timezone_set('America/Sao_Paulo');

            $dataLocal = date('d/m/Y');

            $mes_atual = date('m');

            // RESGATE TODOS AGENDAMENTOS DE HOJE
            $stmt2 = $conn->prepare('SELECT * FROM agendamentos WHERE dia = :dia');
            $stmt2->execute(array('dia' => $dataLocal));

            $result2 = $stmt2->fetchAll();

            $dia_hoje = count($result2);

            // RESGATE TODOS AGENDAMENTOS DE HOJE
            $stmt3 = $conn->prepare('SELECT * FROM agendamentos WHERE dia = :dia AND stts = "pronto"');
            $stmt3->execute(array('dia' => $dataLocal));

            $result3 = $stmt3->fetchAll();

            $todos = count($result3);

            // LÓGICA DE OCUPAÇÃO DE ESPAÇOS
            $estacoes = 9; // 5
            $estacoes_priv = 2; // 8
            $penteadeira = 1; // 11
            $sala_priv = 1; // 9
            $sala_exec = 1; // 10
            $salao_princ = 1; // 14

            $total_espaco = 15; // 100%

            // AGENDANETOS HOJE PARA ESTACOES LIVRES
            $stmtv1 = $conn->prepare('SELECT * FROM agendamentos WHERE dia = :dia AND sala = 5');
            $stmtv1->execute(array('dia' => $dataLocal));
            $resultv1 = $stmtv1->fetchAll();
            $contagemv1 = count($resultv1);

            // AGENDANETOS HOJE PARA ESTAÇOES PRIVADAS
            $stmtv2 = $conn->prepare('SELECT * FROM agendamentos WHERE dia = :dia AND sala = 8');
            $stmtv2->execute(array('dia' => $dataLocal));
            $resultv2 = $stmtv2->fetchAll();
            $contagemv2 = count($resultv2);

            // AGENDANETOS HOJE PARA PENTEADEIRA
            $stmtv3 = $conn->prepare('SELECT * FROM agendamentos WHERE dia = :dia AND sala = 11');
            $stmtv3->execute(array('dia' => $dataLocal));
            $resultv3 = $stmtv3->fetchAll();
            $contagemv3 = count($resultv3);

            // AGENDANETOS HOJE PARA SALA PRIVADA
            $stmtv4 = $conn->prepare('SELECT * FROM agendamentos WHERE dia = :dia AND sala = 9');
            $stmtv4->execute(array('dia' => $dataLocal));
            $resultv4 = $stmtv4->fetchAll();
            $contagemv4 = count($resultv4);

            // AGENDANETOS HOJE PARA SALA EXECUTIVA
            $stmtv5 = $conn->prepare('SELECT * FROM agendamentos WHERE dia = :dia AND sala = 10');
            $stmtv5->execute(array('dia' => $dataLocal));
            $resultv5 = $stmtv5->fetchAll();
            $contagemv5 = count($resultv5);

            // AGENDANETOS HOJE PARA SALÃO PRINCIPAL
            $stmtv6 = $conn->prepare('SELECT * FROM agendamentos WHERE dia = :dia AND sala = 14');
            $stmtv6->execute(array('dia' => $dataLocal));
            $resultv6 = $stmtv6->fetchAll();
            $contagemv6 = count($resultv6);

            $ocupacao = $contagemv1 + $contagemv2 + $contagemv3 + $contagemv4 + $contagemv5 + $contagemv6;

            if ($ocupacao >= 15) {
                $total_ocupacao = 15;
            }
            else{
                $total_ocupacao = $ocupacao;
            }

            $porcentagem = $total_ocupacao * 100 / 15;
            $formatar_porc = strlen($porcentagem);

            if ($porcentagem > 2){
                $novo_formato = explode('.', $porcentagem);
                $new_porcente = $novo_formato[0];
            }
            else{
                $new_porcente = $porcentagem;
            }

            ?>
            <!--  -->
            <div class="w-[100%] h-[40px] border-b-4 border-[#C5908F]">
                <!--  -->
                <div class="float-left w-[70%] h-[40px]">
                    <p class="font-bold">Agendamentos hoje</p>
                </div>
                <!--  -->
                <div class="float-left w-[30%] h-[40px]">
                    <p class="float-right mt-[-3px]">◡</p>
                </div>
            </div>
            <!--  -->
            <p class="text-4xl font-bold mt-[10px]">{{ $dia_hoje }}</p>
            <!--  -->
            <p class="text-[11px] mt-[10px]">Agendamentos totais</p>
            <!--  -->
            <p class="text-base font-bold mt-[10px]">{{ $todos }}</p>
        </div>
        <!-- CARD -->
        <div class="float-left w-[22%] h-[200px] mx-[1.5%] border-[1px] p-[20px] bg-slate-50">
            <!-- VERIFICAR OCUPAÇÃO DEPOIS VER TRELLO -->
            <!--  -->
            <div class="w-[100%] h-[40px] border-b-4 border-[#C5908F]">
                <!--  -->
                <div class="float-left w-[70%] h-[40px]">
                    <p class="font-bold">Ocupação hoje</p>
                </div>
                <!--  -->
                <div class="float-left w-[30%] h-[40px]">
                    <p class="float-right mt-[-3px]">◡</p>
                </div>
            </div>
            <!-- ESSA OCUPAÇÃO É RESGATADA EM UMA TABELA DE LOGS DE AGENDAMENTOS -->
            <p class="text-4xl font-bold mt-[10px]">{{ $new_porcente }}%</p>
            <!--  -->
                    <p class="text-[11px] mt-[10px]">Ocupação no mês</p>
            <!--  -->
            <p class="text-base font-bold mt-[10px]">{{ $new_porcente }}%</p>
        </div>
        <!-- CARD -->
        <div class="float-left w-[22%] h-[200px] mx-[1.5%] border-[1px] p-[20px] bg-slate-50">
            @php
                // AGENDAMENTOS
                $fatura_financeiro = Illuminate\Support\Facades\DB::select("SELECT * FROM log_financeiros WHERE stts = 'pago' AND tipo = 'agendamento' AND mes = '$mes_atual'");

                $total_log = 0;

                foreach ($fatura_financeiro as $kinob) {
                    $log_valor = $kinob->vantagem;

                    if ($log_valor != 0) {

                        $total_log = $total_log + $log_valor;
                    }
                }

                // PLANOS
                $fatura_planos = Illuminate\Support\Facades\DB::select("SELECT * FROM log_financeiros WHERE stts = 'pago' AND tipo = 'plano' AND mes = '$mes_atual'");

                $total_plan_log = 0;

                foreach ($fatura_planos as $kasa) {
                    $log_plan = $kasa->valor;

                    if ($log_plan != 0) {

                        $total_plan_log = $total_plan_log + $log_plan;
                    }
                }

                $total_recebido = $total_log + $total_plan_log;
                $format_total_recebido = number_format($total_recebido,2,",",".");

            @endphp
            <!--  -->
            <div class="w-[100%] h-[40px] border-b-4 border-[#C5908F]">
                <!--  -->
                <div class="float-left w-[70%] h-[40px]">
                    <p class="font-bold">Faturamento mensal</p>
                </div>
                <!--  -->
                <div class="float-left w-[30%] h-[40px]">
                    <p class="float-right mt-[-3px]">◡</p>
                </div>
            </div>
            <!-- ESSE VALOR É RESGATADO DA TABELA DE LOGO DE VENDAS -->
            <p class="text-4xl font-bold mt-[10px]">R${{ $format_total_recebido }}</p>
            <!--  -->
            <p class="text-[11px] mt-[10px]">Faturamento pendente</p>
            <!--  -->
            <p class="text-base font-bold mt-[10px]">-</p>
        </div>
    </div>
    {{--  --}}
    <div class="inline-block float-left w-[50%]">
        {{--  --}}
        <p class="font-bold text-[20px] ml-[19px] mt-[20px] pl-[15px] border-l-[3px] border-[#C5908F]">Usuários</p>
    </div>
    {{--  --}}
    <div class="inline-block float-left w-[50%]">
        {{--  --}}
        <button id="button_ordem" class="px-[20px] h-[35px] bg-[#333333] mt-[20px] mr-[30px] text-[#ffffff] rounded-[10px] float-right text-[12px]">Ordenar lista</button>
    </div>
    {{-- ORDEM GERAL --}}
    <div id="ord_gerl" class="w-[98.5%] h-[200px] inline-block overflow-scroll mt-[30px] ml-[1.5%]">
        {{--  --}}
        <table class="w-[100%]">
            <tr>
                <td class="w-[40%]"><p class="font-bold">Usuario</p></td>
                <td class="w-[10%]"><p class="font-bold">Nascimento</p></td>
                <td class="w-[35%]"><p class="font-bold">Status</p></td>
                <td class="w-[15%]"><p class="font-bold"></p></td>
            </tr>
        </table>
        {{--  --}}
        <hr class="my-[10px]">
        {{--  --}}
        @php
            // USUARIOS TOTAIS
            $geral_usuarios = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios");
        @endphp
        {{--  --}}
        @foreach ($geral_usuarios as $user1)
        {{--  --}}
        <table class="w-[100%]">
            <tr>
                <td class="w-[40%]">
                    <p class="float-left">{{ $user1->nome }}</p>
                    @php
                        $nascimento = $user1->nascimento;
                        $exp_nascim = explode('/', $nascimento);
                        $mes_nascim = $exp_nascim[1];
                        $mes_atual  = date('m');
                    @endphp
                    {{--  --}}
                    @if($mes_atual == $mes_nascim)
                        <img title="Aniversariante" class="float-left cursor-pointer w-[15px] ml-[10px]" src="/img/bolo-aniversario.png">
                    @endif
                </td>
                <td class="w-[10%]"><p class="">{{ $user1->nascimento }}</p></td>
                <td class="w-[35%]"><p class="">{{ $user1->email }}</p></td>
                <td class="w-[15%]"><a href="?user={{ $user1->id }}"><button class="w-[85%] h-[30px] text-[11px] rounded-[8px] bg-[#333333] text-[#ffffff]">visualizar</button></a></td>
            </tr>
        </table>
        {{--  --}}
        <hr class="my-[10px]">
        @endforeach
    </div>
    {{-- ORDEM POR NASCIMENTO --}}
    <div id="ord_nasc" style="display: none;" class="w-[98.5%] h-[200px] inline-block overflow-scroll mt-[30px] ml-[1.5%]">
        {{--  --}}
        <table class="w-[100%]">
            <tr>
                <td class="w-[40%]"><p class="font-bold">Usuario</p></td>
                <td class="w-[10%]"><p class="font-bold">Nascimento</p></td>
                <td class="w-[35%]"><p class="font-bold">Status</p></td>
                <td class="w-[15%]"><p class="font-bold"></p></td>
            </tr>
        </table>
        {{--  --}}
        <hr class="my-[10px]">
        {{--  --}}
        @php
            // USUARIOS NASCIMENTO
            $nascm_usuarios = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios ORDER BY nascimento DESC");
        @endphp
        {{--  --}}
        @foreach ($nascm_usuarios as $user16)
        {{--  --}}
        <table class="w-[100%]">
            <tr>
                <td class="w-[40%]">
                    <p class="float-left">{{ $user16->nome }}</p>
                    @php
                        $nascimento = $user16->nascimento;
                        $exp_nascim = explode('/', $nascimento);
                        $mes_nascim = $exp_nascim[1];
                        $mes_atual  = date('m');
                    @endphp
                    {{--  --}}
                    @if($mes_atual == $mes_nascim)
                        <img title="Aniversariante" class="float-left cursor-pointer w-[15px] ml-[10px]" src="/img/bolo-aniversario.png">
                    @endif
                </td>
                <td class="w-[10%]"><p class="">{{ $user16->nascimento }}</p></td>
                <td class="w-[35%]"><p class="">{{ $user16->email }}</p></td>
                <td class="w-[15%]"><a href="?user={{ $user16->id }}"><button class="w-[85%] h-[30px] text-[11px] rounded-[8px] bg-[#333333] text-[#ffffff]">visualizar</button></a></td>
            </tr>
        </table>
        {{--  --}}
        <hr class="my-[10px]">
        @endforeach
    </div>
    {{-- MODAL --}}
    @if (isset($user) AND !empty($user))
        @php
            $url_usuario = $_SERVER["REQUEST_URI"];
            $explode_url = explode("=", $url_usuario);
            $id_url_user = $explode_url[1];

            $maxi = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
            $maxi->execute(array('id' => $id_url_user));
            $resmaxi = $maxi->fetchAll();
            foreach ($resmaxi as $maxius) {}

            $max4 = $conn->prepare('SELECT * FROM clubes WHERE id_user = :id');
            $max4->execute(array('id' => $id_url_user));
            $resmax4 = $max4->fetchAll();
            $contadormax4 = count($resmax4);
            foreach ($resmax4 as $maxius4) {}
        @endphp
        <div class="modal_inform_user">
            <!--  -->
            <div class="w-[1000px] mx-[auto] mt-[4%] h-[600px] p-[50px] bg-[#ffffff] shadow-lg">
                <!--  -->
                <div class="w-[100%] mb-[30px] inline-block">
                    <!--  -->
                    <div class="w-[50%] float-left inline-block">
                        <p class="text-[25px] font-bold">Informações do usuário</p>
                    </div>
                    <!--  -->
                    <div class="w-[50%] float-left inline-block">
                        <a href="{{ route('agendamento') }}">
                            <a href="{{ route('geral') }}"><p class="float-right cursor-pointer">✕</p></a>
                        </a>
                    </div>
                </div>
                {{--  --}}
                <div class="w-[100%] inline-block">
                    {{--  --}}
                    <div class="w-[49%] float-left mr-[1%]">
                        <!--  -->
                        <p class="text-[13px] font-bold">Nome:</p>
                        <!--  -->
                        <p class="text-[16px] mt-[3px]">{{ $maxius['nome'] }}</p>
                    </div>
                    {{--  --}}
                    <div class="w-[49%] float-left ml-[1%]">
                        <!--  -->
                        <p class="text-[13px] font-bold">Profissão:</p>
                        <!--  -->
                        @if(isset($maxius['atuacao']) AND !empty($maxius['atuacao']))
                            <p class="text-[16px] mt-[3px]">{{ $maxius['atuacao'] }}</p>
                        @else
                            <p class="text-[16px] mt-[3px]">Não informado</p>
                        @endif
                    </div>
                </div>
                {{--  --}}
                <div class="w-[100%] mt-[20px] inline-block">
                    {{--  --}}
                    <div class="w-[49%] float-left mr-[1%]">
                        <!--  -->
                        <p class="text-[13px] font-bold">E-mail:</p>
                        <!--  -->
                        <p class="text-[16px] mt-[3px]">{{ $maxius['email'] }}</p>
                    </div>
                    {{--  --}}
                    <div class="w-[49%] float-left ml-[1%]">
                        <!--  -->
                        <p class="text-[13px] font-bold">Nascimento:</p>
                        <!--  -->
                        <p class="text-[16px] mt-[3px]">{{ $maxius['nascimento'] }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="w-[100%] mt-[20px] inline-block">
                    {{--  --}}
                    <div class="w-[49%] float-left mr-[1%]">
                        <!--  -->
                        <p class="text-[13px] font-bold">Plano:</p>
                        <!--  -->
                        @if ($contadormax4 > 0)
                            @if ($maxius4['plano'] == 1)
                                <p class="text-[16px] mt-[3px]">Plan Basic</p>
                            @elseif($maxius4['plano'] == 2)
                                <p class="text-[16px] mt-[3px]">Plan Vip</p>
                            @elseif($maxius4['plano'] == 4)
                                <p class="text-[16px] mt-[3px]">Plan Private</p>
                            @elseif($maxius4['plano'] == 3)
                                <p class="text-[16px] mt-[3px]">Plan Executive</p>
                            @endif
                        @else
                            <p class="text-[16px] mt-[3px]">Não optante</p>
                        @endif
                    </div>
                </div>
                {{--  --}}
                <div class="w-[100%] mt-[20px] inline-block">
                    {{--  --}}
                    <a href="{{ route('geral') }}"><button class="w-[200px] float-left h-[50px] rounded-[5px] bg-[#333333] text-[#ffffff] mt-[150px]">Voltar a lista</button></a>
                    <a href="{{ route('excluir_user', ['id' => $maxius['id']]) }}"><p class="float-left font-bold text-[12px] mt-[165px] ml-[20px]">Excluir usuário</p></a>
                </div>
            </div>
        </div>
    @endif
    {{--  --}}
    <p class="font-bold text-[20px] ml-[19px] mt-[20px] pl-[15px] border-l-[3px] border-[#C5908F]">Agendamentos</p>
    {{--  --}}
    <div class="w-[98.5%] mt-[30px] ml-[1.5%] inline-block">
        {{--  --}}
        <div class="w-[75%] inline-block h-[200px] float-left overflow-scroll">
            <table class="w-[100%]">
                <tr>
                    <td class="w-[20%]"><p class="font-bold">Código</p></td>
                    <td class="w-[20%]"><p class="font-bold">Data</p></td>
                    <td class="w-[20%]"><p class="font-bold">Valor</p></td>
                    <td class="w-[20%]"><p class="font-bold">Serviço</p></td>
                    <td class="w-[20%]"><p class="font-bold">Status</p></td>
                </tr>
            </table>
            {{--  --}}
            <hr class="my-[10px]">
            {{--  --}}
            @php
                $stmtf1 = $conn->prepare('SELECT * FROM agendamentos ORDER BY id DESC');
                $stmtf1->execute();
                $resultf1 = $stmtf1->fetchAll();
                $contagemf1 = count($resultf1);
            @endphp
            {{--  --}}
            @foreach ($resultf1 as $adamf1)
            {{--  --}}
            @php
                $stmtf2 = $conn->prepare('SELECT * FROM log_financeiros WHERE codigo = :code');
                $stmtf2->execute(array('code' => $adamf1['codigo']));
                $resultf2 = $stmtf2->fetchAll();
                $contagemf2 = count($resultf2);

                if (isset($resultf2) AND !empty($resultf2)) {
                    foreach ($resultf2 as $kay) {}
                    $valor_van = number_format($kay['vantagem'],2,",",".");
                }

            @endphp
            @if(isset($resultf2) AND !empty($resultf2))
            <table class="w-[100%]">
                <tr>
                    <td class="w-[20%]"><p>{{ $kay['codigo'] }}</p></td>
                    <td class="w-[20%]"><p>{{ $kay['data'] }}</p></td>
                    <td class="w-[20%]"><p>R${{ $valor_van }}</p></td>
                    <td class="w-[20%]"><p>{{ $kay['tipo'] }}</p></td>
                    <td class="w-[20%]"><p>{{ $kay['stts'] }}</p></td>
                </tr>
            </table>
            <hr class="my-[10px]">
            @endif
            @endforeach
        </div>
        {{--  --}}
        <div class="w-[25%] inline-block float-left">
            {{--  --}}
            <div class="w-[90%] mx-[5%] p-[20px] cursor-pointer float-left mx-[1.5%] inline-block bg-slate-50 border-[1px]">
                <!--  -->
                @php
                    $stmtf3 = $conn->prepare('SELECT * FROM agendamentos');
                    $stmtf3->execute();
                    $resultf3 = $stmtf3->fetchAll();
                    $contagemf3 = count($resultf3);

                    $stmtf4 = $conn->prepare('SELECT * FROM agendamentos WHERE stts = :stts');
                    $stmtf4->execute(array(':stts' => 'avaliar'));
                    $resultf4 = $stmtf4->fetchAll();
                    $contagemf4 = count($resultf4);

                    @$total_agendamentos = $contagemf3;
                    @$total_usados = $contagemf4;
                    @$total_pendentes = $total_agendamentos - $total_usados;

                    //

                    if($contagemf3 > 0) {

                        $porc_usados = $total_usados * 100 / $total_agendamentos;

                        $numb_porcent_usados = strlen($porc_usados);

                        if ($numb_porcent_usados > 2) {

                            $explode_usados = explode('.', $porc_usados);
                            $essencial_usados = $explode_usados[0];
                            $depois_do_ponto = substr($explode_usados[1], 0, 1);

                            $porcentagem_usados_final = $essencial_usados.".".$depois_do_ponto;
                        }

                        else{
                            $porcentagem_usados_final = $porc_usados;
                        }
                    }
                    else{
                        $porcentagem_usados_final = 0;
                    }

                    //

                    if($contagemf4 > 0) {

                        $porc_pendentes = $total_pendentes * 100 / $total_agendamentos;

                        $numb_porcent_pendentes1 = strlen($porc_pendentes);

                        if ($numb_porcent_pendentes1 > 2) {

                            $explode_pendentes1 = explode('.', $porc_pendentes);
                            $essencial_pendentes1 = $explode_pendentes1[0];
                            $depois_do_ponto1 = substr($explode_pendentes1[1], 0, 1);

                            $porcentagem_pendentes_final1 = $essencial_pendentes1.".".$depois_do_ponto1;
                        }
                        else{
                            $porcentagem_pendentes_final1 = $porc_pendentes;
                        }
                    }
                    else{
                        $porcentagem_pendentes_final1 = 0;
                    }

                @endphp
                {{--  --}}
                <p class="text-[#333333] text-[14px] font-bold">Agendamentos</p>
                <!-- BARRA ESTENDINDA -->
                <div class="w-[100%] mt-[15px] inline-block bg-[#333333]">
                    <div class="w-[{{ $porcentagem_usados_final }}%] h-[20px] float-left bg-[#a35554]"></div>
                    <div class="w-[{{ $porcentagem_pendentes_final1 }}%] h-[20px] float-left bg-[orange]"></div>
                </div>
                <!--  -->
                <div class="inline-block w-[100%] mt-[20px]">
                    <!--  -->
                    <div class="inline-block w-[15px] h-[12px] bg-[orange] float-left"></div><p class="ml-[10px] float-left mt-[-3px]">Pendentes ({{ $porcentagem_pendentes_final1 }}%)</p>
                </div>
                <!--  -->
                <div class="inline-block w-[100%] mt-[5px]">
                    <!--  -->
                    <div class="inline-block w-[15px] h-[12px] bg-[#a35554] float-left"></div><p class="ml-[10px] float-left mt-[-3px]">Usados ({{ $porcentagem_usados_final }}%)</p>
                </div>
                <!--  -->
                <div class="inline-block w-[100%] mt-[5px]">
                    <!--  -->
                    <div class="inline-block w-[15px] h-[12px] bg-[#333333] float-left"></div><p class="ml-[10px] float-left mt-[-3px]">Total mensal ({{ $total_agendamentos }})</p>
                </div>
                {{--  --}}
            </div>
        </div>
    </div>
</div>
@endsection

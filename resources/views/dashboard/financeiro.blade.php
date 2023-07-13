@extends('dashboard.layout.main')
@section('title', 'Dashboard - Financeiro')
@section('titulo', 'Financeiro')
@section('imagem', 'apresentacao.png')

@section('content')
<!--  -->
@php
    // VALORES TOTAL
    $mes_atual = date('m');
    $mes_ano   = date('m/Y');

    $total_financa_geral = Illuminate\Support\Facades\DB::select("SELECT * FROM log_financeiros ORDER BY id DESC");

    // +-----------------------------------------------------------+
    // |           RESGATE DE FINANCEIRO DE AGENDAMENTOS           |
    // +-----------------------------------------------------------+

    $total_financeiro = Illuminate\Support\Facades\DB::select("SELECT * FROM log_financeiros WHERE tipo = 'agendamento' AND mes = '$mes_atual' ORDER BY id DESC");
    $nb_total = count($total_financeiro);

    $valor_total = 0;

    if ($nb_total > 0) {

        foreach ($total_financeiro as $yep) {

            $valor_total = $valor_total + $yep->vantagem;
        }
    }

    // VALORES PAGOS
    $pago_financeiro = Illuminate\Support\Facades\DB::select("SELECT * FROM log_financeiros WHERE stts = 'pago' AND tipo = 'agendamento' AND mes = '$mes_atual'");
    $nb_pago = count($pago_financeiro);

    $valor_total_pago = 0;

    if ($nb_pago > 0) {

        // MELHORE ESSE CÓDIGO
        foreach ($pago_financeiro as $yup) {

            $valor_total_pago = $valor_total_pago + $yup->vantagem;
        }

        $total_pendentes = $valor_total - $valor_total_pago;

        $format_total            = number_format($valor_total,2,",",".");
        $format_pagos            = number_format($valor_total_pago,2,",",".");
        $format_pendentes        = number_format($total_pendentes,2,",",".");

        // PORCENTAGEM DE AGENDAMENTOS PAGOS
        $porcent_agenda          = $nb_pago * 100 / $nb_total;
        $explodir_porcent_agenda = explode(".", $porcent_agenda);
        $valor_porcent           = $explodir_porcent_agenda[0];
    }

    // +-----------------------------------------------------------+
    // |            RESGATE DE FINANCEIRO DE PLANOS                |
    // +-----------------------------------------------------------+

    // TOTAL PLANOS
    $total_planos = Illuminate\Support\Facades\DB::select("SELECT * FROM log_financeiros WHERE tipo = 'plano' AND mes = '$mes_atual' ORDER BY id DESC");
    $nb_total_planos = count($total_planos);

    $valor_total_planos = 0;

    if ($nb_total_planos > 0) {

        foreach ($total_planos as $zap) {

            $valor_total_planos = $valor_total_planos + $zap->valor;
        }
    }

    // TOTAL DE PLANOS PAGOS
    $total_planos_pagos = Illuminate\Support\Facades\DB::select("SELECT * FROM log_financeiros WHERE tipo = 'plano' AND stts = 'pago' AND mes = '$mes_atual'");
    $nb_total_planos_pagos = count($total_planos_pagos);

    $valor_total_planos_pagos = 0;

    if ($nb_total_planos_pagos > 0) {

        foreach ($total_planos_pagos as $zup) {

            $valor_total_planos_pagos = $valor_total_planos_pagos + $zup->valor;
        }
    }

    $total_pendentes_planos  = $valor_total_planos - $valor_total_planos_pagos;

    $format_total_plano = number_format($valor_total_planos,2,",",".");
    $format_total_plano_pagos = number_format($valor_total_planos_pagos,2,",",".");
    $format_total_pendentes_plano = number_format($total_pendentes_planos,2,",",".");

    // PORCENTAGEM DE AGENDAMENTOS PAGOS

    // REFATORAR POR MÊS TOTAL
    $numero_total_plano_mes = 0;

    foreach ($total_planos as $plano_mensal) {

        $refatorar_data  = $plano_mensal->data;
        $explode_refatorar_mes = explode("/", $refatorar_data);
        $refatorar_data_plano  = $explode_refatorar_mes[1];

        if ($refatorar_data_plano == $mes_atual) {
            $numero_total_plano_mes = $numero_total_plano_mes + 1;
        }
    }

    // REFATORAR POR MÊS TOTAL PAGO
    $numero_total_plano_pago_mes = 0;

    foreach ($total_planos_pagos as $plano_pago_mensal) {

        $refatorar_data_pago  = $plano_pago_mensal->data;
        $explode_refatorar_pago_mes = explode("/", $refatorar_data_pago);
        $refatorar_data_plano_pago  = $explode_refatorar_pago_mes[1];

        if ($refatorar_data_plano_pago == $mes_atual) {
            $numero_total_plano_pago_mes = $numero_total_plano_pago_mes + 1;
        }
    }

    if ($numero_total_plano_pago_mes > 0) {

        $porcent_planos = $numero_total_plano_pago_mes * 100 / $numero_total_plano_mes;
        $explodir_porcent_planos = explode(".", $porcent_planos);
        $valor_porcent_planos = $explodir_porcent_planos[0];
    }

    else{
        $valor_porcent_planos = 0;
    }

    // MEDIA GERAL
    $total_receber  = $valor_total_planos_pagos + $valor_total_pago;
    $total_pendente = $total_pendentes_planos + $total_pendentes;

    $format_total_receber  = number_format($total_receber,2,",",".");
    $format_total_pendente = number_format($total_pendente,2,",",".");

@endphp
{{--  --}}
<div class="w-[100%] h-[480px] bg-white float-left overflow-auto">
    <!--  -->
    <div class="w-[100%] inline-block">
        {{--  --}}
        <div class="w-[30.3%] float-left mx-[1.5%] h-[250px] p-[20px] rounded-[8px] border-[#cdcdcd] border-[1px] bg-[#eeeeee]">
            {{--  --}}
            <div class="w-[100%] h-[40px] inline-block">
                {{--  --}}
                <div class="w-[70%] inline-block float-left">
                    {{--  --}}
                    <p class="text-[18px] font-bold">Demonstrativo Geral</p>
                </div>
                {{--  --}}
                <div class="w-[30%] inline-block float-left">
                    {{--  --}}
                </div>
            </div>
            {{--  --}}
            <div class="w-[100%] inline-block">
                {{--  --}}
                <p class="font-bold text-[35px] cursor-pointer" title="Valor total recebido no mês, indicado por todas as operações com pagamento confirmado.">R${{ $format_total_receber }}</p>
                {{--  --}}
                <p class="text-[18px] cursor-pointer" title="Valor total pendente no mês, indicado por todas as operações com pagamento pendentes, indicando uma projeção de lucro.">R${{ $format_total_pendente }}</p>
                {{--  --}}
                <p class="mt-[50px]">Os valores acima são referentes ao mês {{ $mes_ano }}</p>
            </div>
        </div>
        {{--  --}}
        <div class="w-[30.3%] float-left mx-[1.5%] h-[250px] p-[20px] rounded-[8px] border-[#cdcdcd] border-[1px] bg-[#eeeeee]">
            {{--  --}}
            <div class="w-[100%] h-[40px] inline-block">
                {{--  --}}
                <div class="w-[70%] inline-block float-left">
                    {{--  --}}
                    <p class="text-[18px] font-bold">Agendamentos do Mês</p>
                </div>
                {{--  --}}
                <div class="w-[30%] inline-block float-left">
                    {{--  --}}
                </div>
            </div>
            {{--  --}}
            <div class="w-[100%] inline-block">
                {{--  --}}
                <div class="w-[100%] mb-[20px] h-[15px] bg-[silver] cursor-pointer" title="R${{ $format_total }}">
                    <div class="w-[{{ $valor_porcent }}%] h-[15px] bg-[#a35554] cursor-pointer" title="R${{ $format_pagos }}"></div>
                </div>
                {{--  --}}
                <div class="w-[100%] inline-block">
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="text-[14px]">Recebido</p>
                    </div>
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="text-[14px] float-right">Pendentes</p>
                    </div>
                </div>
                {{--  --}}
                <div class="w-[100%] h-[40px] inline-block">
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="font-bold text-[20px] cursor-pointer" title="Valor total recebido no mês, indicado por todos os agendamentos com pagamento confirmado.">R${{ $format_pagos }}</p>
                    </div>
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="font-bold text-[20px] cursor-pointer float-right" title="Valor total pendente no mês, indicado por todos os agendamentos com pagamento pendentes, indicando uma projeção de lucro.">R${{ $format_pendentes }}</p>
                    </div>
                </div>
                {{--  --}}
                <p class="mt-[20px]">Os valores acima são referentes ao mês {{ $mes_ano }}</p>
            </div>
        </div>
        {{--  --}}
        <div class="w-[30.3%] float-left mx-[1.5%] h-[250px] p-[20px] rounded-[8px] border-[#cdcdcd] border-[1px] bg-[#eeeeee]">
            {{--  --}}
            <div class="w-[100%] h-[40px] inline-block">
                {{--  --}}
                <div class="w-[70%] inline-block float-left">
                    {{--  --}}
                    <p class="text-[18px] font-bold">Vendas de Planos</p>
                </div>
                {{--  --}}
                <div class="w-[30%] inline-block float-left">
                    {{--  --}}
                </div>
            </div>
            {{--  --}}
            <div class="w-[100%] inline-block">
                {{--  --}}
                <div class="w-[100%] mb-[20px] h-[15px] bg-[silver] cursor-pointer" title="R${{ $format_total_plano }}">
                    <div class="w-[{{ $valor_porcent_planos }}%] h-[15px] bg-[#a35554] cursor-pointer" title="R${{ $format_total_plano_pagos }}"></div>
                </div>
                {{--  --}}
                <div class="w-[100%] inline-block">
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="text-[14px]">Recebido</p>
                    </div>
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="text-[14px] float-right">Pendentes</p>
                    </div>
                </div>
                {{--  --}}
                <div class="w-[100%] h-[40px] inline-block">
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="font-bold text-[20px] cursor-pointer" title="Valor total recebido no mês, indicado por todos os agendamentos com pagamento confirmado.">R${{ $format_total_plano_pagos }}</p>
                    </div>
                    {{--  --}}
                    <div class="w-[50%] inline-block float-left">
                        {{--  --}}
                        <p class="font-bold text-[20px] cursor-pointer float-right" title="Valor total pendente no mês, indicado por todos os agendamentos com pagamento pendentes, indicando uma projeção de lucro.">R${{ $format_total_pendentes_plano }}</p>
                    </div>
                </div>
                {{--  --}}
                <p class="mt-[20px]">Os valores acima são referentes ao mês {{ $mes_ano }}</p>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="w-[97%] mt-[30px] mx-[1.5%] inline-block">
        {{--  --}}
        <p class="text-[20px] font-bold mb-[20px]">Lançamentos financeiros</p>
        {{--  --}}
        <div class="w-[100%] h-[150px] overflow-scroll inline-block">
            {{--  --}}
            <table class="w-[100%] mt-[20px]">
                <tr>
                    <td class="w-[15%]"><p class="font-bold">Código</p></td>
                    <td class="w-[25%]"><p class="font-bold">Data</p></td>
                    <td class="w-[30%]"><p class="font-bold">Tipo</p></td>
                    <td class="w-[20%]"><p class="font-bold">Valor</p></td>
                    <td class="w-[10%]"><p class="font-bold">Status</p></td>
                </tr>
            </table>
            {{--  --}}
            <hr class="my-[5px]">
            {{--  --}}
            @foreach ($total_financa_geral as $agendax)
            {{--  --}}
            @php
                // FORMATAR VALOR
                if ($agendax->tipo == "agendamento") {
                    $valor_agendax = number_format($agendax->vantagem,2,",",".");
                }
                else{
                    $valor_agendax = number_format($agendax->valor,2,",",".");
                }

                // VERIFICAR MÊS
                $data_agenda_ver = $agendax->data;
                $explodir_data_ver = explode("/", $data_agenda_ver);
                $mes_data_ver = $explodir_data_ver[1];

            @endphp
            {{--  --}}
            @if($mes_atual == $mes_data_ver)
            <table class="w-[100%]">
                <tr>
                    <td class="w-[15%]"><p class="">{{ $agendax->codigo }}</p></td>
                    <td class="w-[25%]"><p class="">{{ $agendax->data }}</p></td>
                    <td class="w-[30%]"><p class="">{{ $agendax->tipo }}</p></td>
                    <td class="w-[20%]"><p class="">{{ $valor_agendax }}</p></td>
                    <td class="w-[10%]"><p class="">{{ $agendax->stts }}</p></td>
                </tr>
            </table>
            {{--  --}}
            <hr class="my-[5px]">
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

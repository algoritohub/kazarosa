@extends('dashboard.layout.main')
@section('title', 'Dashboard - Entrada e Saída')
@section('titulo', 'Entrada e Saída')
@section('imagem', 'painel.png')
@section('descricao', 'Evite a perda de registros importantes, só apague itens do relatório se estiverem incorretos.')

@section('content')

@php
    // DATA DE HOJE
    $data_hoje = date('d/m/Y');

    // ENTRADA DE ITENS
    $entradas  = Illuminate\Support\Facades\DB::select("SELECT * FROM entrada_saidas WHERE stts = 'entrada' ORDER BY id DESC");
    $count_ent = count($entradas);

    // SAÍDA DE ITENS
    $saidas    = Illuminate\Support\Facades\DB::select("SELECT * FROM entrada_saidas WHERE stts = 'saida' ORDER BY id DESC");
    $count_sai = count($saidas);
@endphp

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
            @php
                // ENTRADAS HOJE
                $itens_entrad = Illuminate\Support\Facades\DB::select("SELECT * FROM entrada_saidas WHERE stts = 'entrada'");
                $count_itens1 = count($itens_entrad);

                $entrad_hoje  = 0;

                foreach ($itens_entrad as $entrad_ttl) {

                    $registro_saida = $entrad_ttl->registro;

                    if ($registro_saida == $data_hoje) {

                        $entrad_hoje = $entrad_hoje + 1;
                    }
                }

            @endphp
            <div class="w-[100%] h-[40px] border-b-4 border-[#C5908F]">
                <!--  -->
                <div class="float-left w-[70%] h-[40px]">
                    <p class="font-bold">Entradas hoje</p>
                </div>
                <!--  -->
                <div class="float-left w-[30%] h-[40px]">
                    <p class="float-right mt-[-3px]">◡</p>
                </div>
            </div>
            <!--  -->
            <p class="text-4xl font-bold mt-[10px]">{{ $entrad_hoje }}</p>
            <!--  -->
            <p class="text-[11px] mt-[10px]">Todas as entradas</p>
            <!--  -->
            <p class="text-base font-bold mt-[10px]">{{ $count_itens1 }}</p>
        </div>
        <!-- CARD -->
        <div class="float-left w-[22%] h-[200px] mx-[1.5%] border-[1px] p-[20px] bg-slate-50">
            <!-- CONEXÃO PDO -->
            @php
                // SAIDAS HOJE
                $itens_saidas = Illuminate\Support\Facades\DB::select("SELECT * FROM entrada_saidas WHERE stts = 'saida'");
                $count_itens2 = count($itens_saidas);

                $saidas_hoje  = 0;

                foreach ($itens_saidas as $saida_ttl) {

                    $registro_saida = $saida_ttl->registro;

                    if ($registro_saida == $data_hoje) {

                        $saidas_hoje = $saidas_hoje + 1;
                    }
                }

            @endphp
            <!--  -->
            <div class="w-[100%] h-[40px] border-b-4 border-[#C5908F]">
                <!--  -->
                <div class="float-left w-[70%] h-[40px]">
                    <p class="font-bold">Saídas hoje</p>
                </div>
                <!--  -->
                <div class="float-left w-[30%] h-[40px]">
                    <p class="float-right mt-[-3px]">◡</p>
                </div>
            </div>
            <!--  -->
            <p class="text-4xl font-bold mt-[10px]">{{ $saidas_hoje }}</p>
            <!--  -->
            <p class="text-[11px] mt-[10px]">Todas as saídas</p>
            <!--  -->
            <p class="text-base font-bold mt-[10px]">{{ $count_itens2 }}</p>
        </div>
        <!-- CARD -->
        <div class="float-left w-[22%] h-[200px] mx-[1.5%] border-[1px] p-[20px] bg-slate-50">
            <!-- CALCULO DE VALOR -->
            @php
                // VALOR TOTAL DE ENTRADA
                $valor_entrada = Illuminate\Support\Facades\DB::select("SELECT * FROM entrada_saidas WHERE stts = 'entrada'");

                $valor_total1  = 0;

                foreach($valor_entrada as $entrada_val){

                    $valor_total1 = $entrada_val->total + $valor_total1;
                }

                $valor_formt1  = number_format($valor_total1,2,",",".");

            @endphp
            <!--  -->
            <div class="w-[100%] h-[40px] border-b-4 border-[#C5908F]">
                <!--  -->
                <div class="float-left w-[70%] h-[40px]">
                    <p class="font-bold">Valor em entradas</p>
                </div>
                <!--  -->
                <div class="float-left w-[30%] h-[40px]">
                    <p class="float-right mt-[-3px]">◡</p>
                </div>
            </div>
            <!-- ESSE VALOR É RESGATADO DA TABELA DE LOGO DE VENDAS -->
            <p class="text-4xl font-bold mt-[10px]">R${{ $valor_formt1 }}</p>
            <!--  -->
            <p class="text-[11px] mt-[10px]">Faturamento pendente</p>
            <!--  -->
            <p class="text-base font-bold mt-[10px]">-</p>
        </div>
        <!-- CARD -->
        <div class="float-left w-[22%] h-[200px] mx-[1.5%] border-[1px] p-[20px] bg-slate-50">
            <!-- CALCULO DE VALOR -->
            @php
                // VALOR TOTAL DE ENTRADA
                $valor_saida  = Illuminate\Support\Facades\DB::select("SELECT * FROM entrada_saidas WHERE stts = 'saida'");

                $valor_total2 = 0;

                foreach($valor_saida as $saida_val){

                    $valor_total2 = $valor_total2 + $saida_val->valor;
                }

                $valor_formt2 = number_format($valor_total2,2,",",".");

            @endphp
            <!--  -->
            <div class="w-[100%] h-[40px] border-b-4 border-[#C5908F]">
                <!--  -->
                <div class="float-left w-[70%] h-[40px]">
                    <p class="font-bold">Valor em saída</p>
                </div>
                <!--  -->
                <div class="float-left w-[30%] h-[40px]">
                    <p class="float-right mt-[-3px]">◡</p>
                </div>
            </div>
            <!-- ESSE VALOR É RESGATADO DA TABELA DE LOGO DE VENDAS -->
            <p class="text-4xl font-bold mt-[10px]">R${{ $valor_formt2 }}</p>
            <!--  -->
            <p class="text-[11px] mt-[10px]">Faturamento pendente</p>
            <!--  -->
            <p class="text-base font-bold mt-[10px]">-</p>
        </div>
    </div>
    {{--  --}}
    <div class="w-[100%] mt-[30px] float-left inline-block">
        {{--  --}}
        <div class="w-[50%] inline-block float-left">
            {{--  --}}
            <p class="font-bold text-[20px] ml-[19px] mt-[20px] pl-[15px] border-l-[3px] border-[#C5908F]">Entradas</p>
        </div>
        {{--  --}}
        <div class="w-[50%] inline-block float-left">
            {{--  --}}
            <button id="add_entrada" class="w-[200px] h-[40px] rounded-[5px] bg-[#a35554] float-right text-[#ffffff] mt-[20px] mr-[15px]">Incluir nova entrada</button>
        </div>
        {{-- LISTAGEM --}}
        <div class="w-[97%] mt-[20px] h-[200px] overflow-scroll rounded-[5px] ml-[20px] inline-block border-[1px] p-[30px] border-[#cdcdcd]">
            {{--  --}}
            <table class="w-[100%]">
                <tr>
                    <td class="w-[35%]"><p class="font-bold">Nome entrada</p></td>
                    <td class="w-[15%]"><p class="font-bold">Valor (UN)</p></td>
                    <td class="w-[15%]"><p class="font-bold">Quant.</p></td>
                    <td class="w-[15%]"><p class="font-bold">Data</p></td>
                    <td class="w-[25%]"><p class="font-bold"></p></td>
                </tr>
            </table>
            {{--  --}}
            <hr class="my-[10px]">
            {{--  --}}
            @if ($count_ent > 0)
                {{--  --}}
                @foreach ($entradas as $entrad)
                {{--  --}}
                @php
                    $new_valor = number_format($entrad->valor,2,",",".");
                @endphp
                {{--  --}}
                <table class="w-[100%]">
                    <tr>
                        <td class="w-[35%]"><p class="">{{ $entrad->nome }}</p></td>
                        <td class="w-[15%]"><p class="">R${{ $new_valor }}</p></td>
                        <td class="w-[15%]"><p class="">{{ $entrad->quantidade }}</p></td>
                        <td class="w-[10%]"><p class="">{{ $entrad->registro }}</p></td>
                        <td class="w-[25%]">
                            <ul class="inline-block float-right">
                                <a href="{{ route('edit_entrada_saida', ['id' => $entrad->id]) }}"><li class="inline-block ml-[20px]"><button class="w-[100px] h-[30px] rounded-[5px] bg-[#a35554] text-[#ffffff]">Editar</button></li></a>
                                <a href="{{ route('delete_entrada_saida', ['id' => $entrad->id]) }}"><li class="inline-block ml-[20px]"><button class="w-[100px] h-[30px] rounded-[5px] bg-[#a35554] text-[#ffffff]">Excluir</button></li></a>
                            </ul>
                        </td>
                    </tr>
                </table>
                {{--  --}}
                <hr class="my-[10px]">
                @endforeach
            @else
            <p class="text-[13px] text-center mt-[5%]">sem registros no momento!</p>
            @endif
        </div>
    </div>
    {{--  --}}
    <div class="inline-block mt-[30px] float-left w-[100%]">
        {{--  --}}
        <div class="w-[50%] inline-block float-left">
            {{--  --}}
            <p class="font-bold text-[20px] ml-[19px] mt-[20px] pl-[15px] border-l-[3px] border-[#C5908F]">Saídas</p>
        </div>
        {{--  --}}
        <div class="w-[50%] inline-block float-left">
            {{--  --}}
            <button id="add_saida" class="w-[200px] h-[40px] rounded-[5px] bg-[#a35554] float-right text-[#ffffff] mt-[20px] mr-[15px]">Incluir nova saída</button>
        </div>
        {{-- LISTAGEM --}}
        <div class="w-[97%] mt-[20px] h-[200px] overflow-scroll rounded-[5px] ml-[20px] inline-block border-[1px] p-[30px] border-[#cdcdcd]">
            {{--  --}}
            <table class="w-[100%]">
                <tr>
                    <td class="w-[35%]"><p class="font-bold">Nome saída</p></td>
                    <td class="w-[15%]"><p class="font-bold">Valor (UN)</p></td>
                    <td class="w-[15%]"><p class="font-bold">Quant.</p></td>
                    <td class="w-[10%]"><p class="font-bold">Data</p></td>
                    <td class="w-[25%]"><p class="font-bold"></p></td>
                </tr>
            </table>
            {{--  --}}
            <hr class="my-[10px]">
            {{--  --}}
            @if ($count_sai > 0)
                {{--  --}}
                @foreach ($saidas as $said)
                {{--  --}}
                @php
                    $sai_valor = number_format($said->valor,2,",",".");
                @endphp
                {{--  --}}
                <table class="w-[100%]">
                    <tr>
                        <td class="w-[35%]"><p class="">{{ $said->nome }}</p></td>
                        <td class="w-[15%]"><p class="">R${{ $sai_valor }}</p></td>
                        <td class="w-[15%]"><p class="">{{ $said->quantidade }}</p></td>
                        <td class="w-[10%]"><p class="">{{ $said->registro }}</p></td>
                        <td class="w-[25%]">
                            <ul class="inline-block float-right">
                                <a href="{{ route('edit_entrada_saida', ['id' => $said->id]) }}"><li class="inline-block ml-[20px]"><button class="w-[100px] h-[30px] rounded-[5px] bg-[#a35554] text-[#ffffff]">Editar</button></li></a>
                                <a href="{{ route('delete_entrada_saida', ['id' => $said->id]) }}"><li class="inline-block ml-[20px]"><button class="w-[100px] h-[30px] rounded-[5px] bg-[#a35554] text-[#ffffff]">Excluir</button></li></a>
                            </ul>
                        </td>
                    </tr>
                </table>
                {{--  --}}
                <hr class="my-[10px]">
                @endforeach
            @else
            <p class="text-[13px] text-center mt-[5%]">sem registros no momento!</p>
            @endif
        </div>
    </div>
    {{--  --}}
    <div class="modal_incluir_entrada">
        {{--  --}}
        <div class="w-[1000px] mx-auto bg-[#ffffff] h-[500px] p-[40px] mt-[8%]">
            <!--  -->
            <div class="w-[100%] mb-[30px] inline-block">
                <!--  -->
                <div class="w-[50%] float-left inline-block">
                    {{--  --}}
                    <p class="text-[25px] font-bold">Incluir nova entrada</p>
                </div>
                <!--  -->
                <div class="w-[50%] float-left inline-block">
                    {{--  --}}
                    <p id="but_entrada_fechar" class="float-right cursor-pointer">✕</p>
                </div>
            </div>
            {{--  --}}
            <div clasds="w-[100%] inline-block">
                {{--  --}}
                <form action="{{ route('new_add_entrada') }}" method="POST">
                    @csrf
                    <table class="w-[100%]">
                        {{--  --}}
                        <tr>
                            <td><p class="font-bold">Nome da entrada</p></td>
                        </tr>
                        {{--  --}}
                        <tr>
                            <td><input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="nome" type="text"></td>
                        </tr>
                    </table>
                    {{--  --}}
                    <div class="w-[100%] mt-[10px] inline-block">
                        {{--  --}}
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="font-bold">Quantidade</p></td>
                                </tr>
                                {{--  --}}
                                <tr>
                                    <td><input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="quantidade" placeholder="Apenas números, EX.: 50" type="text"></td>
                                </tr>
                            </table>
                        </div>
                        {{--  --}}
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="font-bold">Tipo de entrada</p></td>
                                </tr>
                                {{--  --}}
                                <tr>
                                    <td>
                                        <select name="tipo" class="w-[100%] bg-[#ffffff] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]">
                                            <option value="1">Venda extra</option>
                                            <option value="2">Acompanhamentos</option>
                                            <option value="3">Serviços adicionais</option>
                                            <option value="4">Outros</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="w-[100%] mt-[8px] inline-block">
                        {{--  --}}
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                <tr>
                                    <td><p class="font-bold">Valor de compra</p></td>
                                </tr>
                            </table>
                            {{--  --}}
                            <table class="w-[100%]">
                                <tr>
                                    <td><input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="valor" placeholder="Apenas números, EX.: 700" type="text"></td>
                                </tr>
                            </table>
                        </div>
                        {{--  --}}
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                <tr>
                                    <td><p class="font-bold">Valor de venda</p></td>
                                </tr>
                            </table>
                            {{--  --}}
                            <table class="w-[100%]">
                                <tr>
                                    <td><input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="valor_venda" placeholder="Apenas números, EX.: 700" type="text"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{--  --}}
                    <table class="w-[100%]">
                        <tr>
                            <td><button class="w-[100%] h-[40px] mt-[20px] rounded-[5px] text-[#ffffff] bg-[#a35554]">Adicionar nova entrada</button></td>
                        </tr>
                    </table>
                </form>
                {{--  --}}
                <div style="display:none;" class="w-[100%] border-[1px] border-[#cdcdcd] mt-[20px] rounded-[5px] inline-block p-[20px]">
                    {{--  --}}
                    <p>Entradas podem ser definidas como todos os valores de entrada, obtidos por venda de serviços adicionais, material de apoio (livros ou revistas), ou produtos de acompanhamento (café, alimentos e outras bebidas).</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="modal_incluir_saida">
        {{--  --}}
        <div class="w-[1000px] mx-auto bg-[#ffffff] h-[500px] p-[40px] mt-[8%]">
            <!--  -->
            <div class="w-[100%] mb-[30px] inline-block">
                <!--  -->
                <div class="w-[50%] float-left inline-block">
                    {{--  --}}
                    <p class="text-[25px] font-bold">Inlcuir nova saída</p>
                </div>
                <!--  -->
                <div class="w-[50%] float-left inline-block">
                    {{--  --}}
                    <p id="but_saida_fechar" class="float-right cursor-pointer">✕</p>
                </div>
            </div>
            {{--  --}}
            <div clasds="w-[100%] inline-block">
                {{--  --}}
                <form action="{{ route('add_saida') }}" method="POST">
                    @csrf
                    <table class="w-[100%]">
                        {{--  --}}
                        @php
                            // ENTRADA DE ITENS
                            $entradas_total = Illuminate\Support\Facades\DB::select("SELECT * FROM entrada_saidas WHERE stts = 'entrada'");
                        @endphp
                        {{--  --}}
                        <tr>
                            <td><p class="font-bold">Produto ou serviço</p></td>
                        </tr>
                        {{--  --}}
                        <tr>
                            <td>
                                <select class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="nome">
                                    @foreach ($entradas_total as $ttl)
                                    <option value="{{ $ttl->id }}">{{ $ttl->nome }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                    {{--  --}}
                    <div class="w-[100%] mt-[10px] inline-block">
                        {{--  --}}
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="font-bold">Quantidade vendida</p></td>
                                </tr>
                                {{--  --}}
                                <tr>
                                    <td><input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="quantidade" placeholder="Apenas números, EX.: 50" type="text"></td>
                                </tr>
                            </table>
                        </div>
                        {{--  --}}
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="font-bold">Tipo de saída</p></td>
                                </tr>
                                {{--  --}}
                                <tr>
                                    <td>
                                        <select name="tipo" class="w-[100%] bg-[#ffffff] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]">
                                            <option value="1">Venda</option>
                                            <option value="2">Venda online</option>
                                            <option value="3">Outros</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        {{--  --}}
                        <table class="w-[100%]">
                            <tr>
                                <td><button class="w-[100%] h-[40px] mt-[20px] rounded-[5px] text-[#ffffff] bg-[#a35554]">Adicionar baixa</button></td>
                            </tr>
                        </table>
                    </div>
                </form>
                {{--  --}}
                <div class="w-[100%] border-[1px] border-[#cdcdcd] mt-[20px] rounded-[5px] inline-block p-[20px]">
                    {{--  --}}
                    <p>Saídas podem ser definidas como todos os valores de despesas, obtidos por compra de produtos de acompanhamento (café, alimentos e outras bebidas), despesas do estabelecimento ou pagamentos de funcionários e serviços.</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    @if (isset($item) AND !empty($item))
    {{--  --}}
    @php
        $edit_item = Illuminate\Support\Facades\DB::select("SELECT * FROM entrada_saidas WHERE id = '$item'");
    @endphp
    {{--  --}}
    <div class="modal_edit_entrada_saida">
        {{--  --}}
        <div class="w-[1000px] mx-auto bg-[#ffffff] h-[500px] p-[40px] mt-[8%]">
            <!--  -->
            <div class="w-[100%] mb-[30px] inline-block">
                <!--  -->
                <div class="w-[50%] float-left inline-block">
                    {{--  --}}
                    <p class="text-[25px] font-bold">Editar item</p>
                </div>
                <!--  -->
                <div class="w-[50%] float-left inline-block">
                    {{--  --}}
                    <a href="{{ route('entrada_saida') }}">
                        <p class="float-right cursor-pointer">✕</p>
                    </a>
                </div>
            </div>
            {{--  --}}
            <div clasds="w-[100%] inline-block">
                {{--  --}}
                <form action="{{ route('editar_entrada_saida', ['id' => $item]) }}" method="GET">
                    @csrf
                    <div class="w-[100%] inline-block">
                        {{--  --}}
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="font-bold">Nome do item</p></td>
                                </tr>
                                {{--  --}}
                                <tr>
                                    <td><p class="text-[18px] font-bold">{{ $edit_item[0]->nome }}</p></td>
                                </tr>
                            </table>
                        </div>
                        {{--  --}}
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="font-bold">Registro do item</p></td>
                                </tr>
                                {{--  --}}
                                <tr>
                                    <td><p class="text-[18px] font-bold">{{ $edit_item[0]->registro }}</p></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="w-[100%] mt-[30px] inline-block">
                        {{--  --}}
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="font-bold">Quantidade</p></td>
                                </tr>
                                {{--  --}}
                                <tr>
                                    <td><input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="quantidade" value="{{ $edit_item[0]->quantidade }}" type="text"></td>
                                </tr>
                            </table>
                        </div>
                        {{--  --}}
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="font-bold">Tipo do item</p></td>
                                </tr>
                                {{--  --}}
                                <tr>
                                    <td>
                                        <select name="tipo" class="w-[100%] bg-[#ffffff] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]">
                                            @if ($edit_item[0]->tipo == 1)
                                            <option value="1" selected="selected">Produto adicional (selecionado)</option>
                                            <option value="2">Serviço</option>
                                            <option value="3">Funcionário</option>
                                            <option value="4">Outros</option>
                                            @elseif($edit_item[0]->tipo == 2)
                                            <option value="1">Produto adicional</option>
                                            <option value="2" selected="selected">Serviço (selecionado)</option>
                                            <option value="3">Funcionário</option>
                                            <option value="4">Outros</option>
                                            @elseif($edit_item[0]->tipo == 3)
                                            <option value="1">Produto adicional</option>
                                            <option value="2">Serviço</option>
                                            <option value="3" selected="selected">Funcionário (selecionado)</option>
                                            <option value="4">Outros</option>
                                            @elseif($edit_item[0]->tipo == 4)
                                            <option value="1">Produto adicional</option>
                                            <option value="2">Serviço</option>
                                            <option value="3">Funcionário</option>
                                            <option value="4" selected="selected">Outros (selecionado)</option>
                                            @endif
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="w-[100%] mt-[10px] inline-block">
                        {{--  --}}
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="font-bold">Valor de compra</p></td>
                                </tr>
                                {{--  --}}
                                <tr>
                                    <td><input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="valor" value="{{ $edit_item[0]->valor }}" type="text"></td>
                                </tr>
                            </table>
                        </div>
                        {{--  --}}
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                <table class="w-[100%]">
                                    {{--  --}}
                                    <tr>
                                        <td><p class="font-bold">Valor de venda</p></td>
                                    </tr>
                                    {{--  --}}
                                    <tr>
                                        <td><input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="valor_venda" value="{{ $edit_item[0]->valor_venda }}" type="text"></td>
                                    </tr>
                                </table>
                            </table>
                        </div>
                    </div>
                    {{--  --}}
                    <table class="w-[100%]">
                        <tr>
                            <td><button class="w-[100%] h-[40px] mt-[20px] rounded-[5px] text-[#ffffff] bg-[#a35554]">Editar informações do item</button></td>
                        </tr>
                    </table>
                </form>
                {{--  --}}
                <div style="display: none;" class="w-[100%] border-[1px] border-[#cdcdcd] mt-[20px] rounded-[5px] inline-block p-[20px]">
                    {{--  --}}
                    @if ($edit_item[0]->tipo == 'entrada')
                    <p>Entradas podem ser definidas como todos os valores de entrada, obtidos por venda de serviços adicionais, material de apoio (livros ou revistas), ou produtos de acompanhamento (café, alimentos e outras bebidas).</p>
                    @else
                    <p>Saídas podem ser definidas como todos os valores de despesas, obtidos por compra de produtos de acompanhamento (café, alimentos e outras bebidas), despesas do estabelecimento ou pagamentos de funcionários e serviços.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@extends('dashboard.layout.main')
@section('title', 'Dashboard - Contato')
@section('titulo', 'Contato')
@section('imagem', 'apresentacao.png')
@section('descricao', 'ATENÇÂO: Os contatos podem ser inseridos também pelo formulário de contato na landingpage.')

@section('content')
<!--  -->
<div class="w-[100%] h-[480px] bg-white float-left overflow-auto">
    {{--  --}}
    <div class="w-[100%] inline-block">
        {{--  --}}
        {{-- <button id="incluir_contato" class="px-[30px] h-[40px] rounded-[100px] text-[11px] mr-[30px] bg-[#212121] font-bold text-[#ffffff] float-right">Incluir contato</button> --}}
    </div>
    <!--  -->
    <div class="inline-block p-[30px] w-[100%]">
        {{--  --}}
        <div class="w-[100%] inline-block border-b-[1px] pb-[15px]">
            {{--  --}}
            <table class="w-[100%]">
                <tr>
                    <td class="w-[15%]"><p class="text-[12px] text-[#212121] font-bold">Nome</p></td>
                    <td class="w-[20%]"><p class="text-[12px] text-[#212121] font-bold">E-mail</p></td>
                    <td class="w-[11%]"><p class="text-[12px] text-[#212121] font-bold">Telefone</p></td>
                    <td class="w-[10%]"><p class="text-[12px] text-[#212121] font-bold">Sala</p></td>
                    <td class="w-[13%]"><p class="text-[12px] text-[#212121] font-bold">Status</p></td>
                    <td class="w-[20%]">
                        <button id="incluir_contato" class="px-[30px] h-[40px] rounded-[100px] text-[11px] bg-[#212121] font-bold text-[#ffffff] float-right">Incluir contato</button>
                    </td>
                </tr>
            </table>
        </div>
        {{--  --}}
        <div class="w-[100%] h-[300px] overflow-scroll inline-block">
            {{--  --}}
            @foreach($newsletter as $news)
            <table class="w-[100%]">
                <tr>
                    <td class="w-[15%]"><p class="text-[12px] text-[#212121]">{{ $news->nome }}</p></td>
                    <td class="w-[20%]"><p class="text-[12px] text-[#212121]">{{ $news->email }}</p></td>
                    <td class="w-[11%]"><p class="text-[12px] text-[#212121]">{{ $news->telefone }}</p></td>
                    <td class="w-[10%]">
                        @if ($news->sala == "5")
                        <p class="text-[12px] text-[#212121]">Estação Compartilhada</p>
                        @elseif ($news->sala == "8")
                        <p class="text-[12px] text-[#212121]">Estações Privativas</p>
                        @elseif ($news->sala == "9")
                        <p class="text-[12px] text-[#212121]">Sala Privativa</p>
                        @elseif ($news->sala == "10")
                        <p class="text-[12px] text-[#212121]">Sala Executiva</p>
                        @elseif ($news->sala == "11")
                        <p class="text-[12px] text-[#212121]">Penteadeira Luxo</p>
                        @elseif ($news->sala == "14")
                        <p class="text-[12px] text-[#212121]">Salão principal</p>
                        @endif
                    </td>
                    <td class="w-[13%]">
                        @if($news->estado == 1)
                        <p class="text-[12px] font-bold text-[#4682B4]">Adicionado / Recebido</p>
                        @elseif($news->estado == 2)
                        <p class="text-[12px] font-bold text-[#FF8C00]">Enviado / Respondido</p>
                        @elseif($news->estado == 3)
                        <p class="text-[12px] font-bold text-[#228B22]">Obtive retorno</p>
                        @elseif($news->estado == 4)
                        <p class="text-[12px] font-bold text-[#a35554]">Tornou-se cliente</p>
                        @endif
                    </td>
                    <td class="w-[20%]">
                        @if ($news->estado == 1)
                        {{--  --}}
                        <a href="{{ route('contato_marcado', ['id' => $news->id]) }}"><button class="float-right px-[30px] rounded-[100px] h-[40px] bg-[#4682B4] text-[#ffffff]">Marcar como contactado¹</button></a>
                        @elseif($news->estado == 2)
                        {{--  --}}
                        <a href="{{ route('contato_marcado', ['id' => $news->id]) }}"><button class="float-right px-[30px] rounded-[100px] h-[40px] bg-[#FF8C00] text-[#ffffff]">Obtive retorno²</button></a>
                        @elseif($news->estado == 3)
                        {{--  --}}
                        <a href="{{ route('contato_marcado', ['id' => $news->id]) }}"><button class="float-right px-[30px] rounded-[100px] h-[40px] bg-[#228B22] text-[#ffffff]">Obtive uma venda³</button></a>
                        @elseif($news->estado == 4)
                        {{--  --}}
                        <a href="{{ route('remover_contato', ['id' => $news->id]) }}"><button class="float-right px-[30px] rounded-[100px] h-[40px] bg-[#a35554] text-[#ffffff]">Remover da lista</button></a>
                        @endif
                    </td>
                </tr>
            </table>
            <hr class="my-[10px]" size="1px">
            @endforeach
        </div>
    </div>
    {{-- MODAL --}}
    <div class="modal_contato">
        {{--  --}}
        <div class="w-[1000px] h-[500px] mx-auto p-[30px] rounded-[20px] mt-[8%] shadow-lg bg-[#ffffff]">
             <!--  -->
             <div class="w-[100%] mb-[30px] inline-block">
                <!--  -->
                <div class="w-[50%] float-left inline-block">
                    {{--  --}}
                    <p class="text-[20px] font-bold">Incluir novo contato</p>
                </div>
                <!--  -->
                <div class="w-[50%] float-left inline-block">
                    {{--  --}}
                    <p id="fechar_modal_contato" class="float-right cursor-pointer">✕</p>
                </div>
            </div>
            {{--  --}}
            <div class="w-[100%] inline-block">
                {{--  --}}
                <div class="mt-[30px] mb-[30px]">Adicione contato importantes a sua lista, esses contatos ficarão disponíveis na sua lista até que sejam removidos!</div>
                {{--  --}}
                <form action="{{ route('adm_contato_cliente') }}" method="POST">
                    @csrf
                    {{--  --}}
                    <div class="w-[100%] inline-block">
                        {{--  --}}
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                <td>
                                    <tr>
                                        <input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="nome" placeholder="Nome" type="text">
                                    </tr>
                                </td>
                            </table>
                        </div>
                        {{--  --}}
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                <td>
                                    <tr>
                                        <input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="email" placeholder="E-mail" type="text">
                                    </tr>
                                </td>
                            </table>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="w-[100%] inline-block">
                        {{--  --}}
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                <td>
                                    <tr>
                                        <input class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" id="phone1" name="telefone" placeholder="Telefone" type="text">
                                    </tr>
                                </td>
                            </table>
                        </div>
                        {{--  --}}
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            {{--  --}}
                            <table class="w-[100%]">
                                <td>
                                    <tr>
                                        <select class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]" name="tipo">
                                            <option value="1">Contato já é cliente</option>
                                            <option value="2">Contato é um cliente em potencial</option>
                                            <option value="3">Contato é uma indicação</option>
                                        </select>
                                    </tr>
                                </td>
                            </table>
                        </div>
                    </div>
                    {{--  --}}
                    <table class="w-[100%]">
                        {{--  --}}
                        @php
                            // RESGATE DE SALAS
                            $salas = Illuminate\Support\Facades\DB::select("SELECT * FROM salas");
                        @endphp
                        {{--  --}}
                        <select name="sala" class="w-[100%] mt-[10px] h-[40px] text-[14px] outline-none border-[1px] border-[#212121] pl-[10px] rounded-[5px]">
                            {{--  --}}
                            <option value="">Escolha uma sala de interesse do contato</option>
                            {{--  --}}
                            @foreach ($salas as $sala)
                                <option value="{{ $sala->id }}">{{ $sala->nome }}</option>
                            @endforeach
                        </select>
                    </table>
                    {{--  --}}
                    <button class="bg-[#212121] text-[12px] px-[50px] h-[40px] rounded-[100px] mt-[10px] text-[#ffffff]">Inlcuir contato</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

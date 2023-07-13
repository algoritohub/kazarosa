@extends('dashboard.layout.main')
@section('title', 'Dashboard - Salas')
@section('titulo', 'Editar')
@section('imagem', 'apresentacao.png')
@section('descricao', 'Edite as informações de um espaço, inclua novas imagens ou altere preços.')

@section('content')
<!--  -->
<div class="inline-block px-[15px] w-[100%] overflow-scroll">
    <!-- LISTAGEM DE SALAS -->
    <div class="w-[100%] inline-block">
        <!--  -->
        <?php 
        
        $valor_hora = number_format($sala->valor,2,".",".");
        $valor_turno = number_format($sala->turno,2,".",".");
        $valor_diario = number_format($sala->diaria,2,".",".");
        
        ?>
        <!--  -->
        <div class="w-[70%] float-left inline-block">
            <form action="{{ route('atl_sala', ['id' => $sala->id]) }}" method="POST">
                @csrf
                <!--  -->
                <table class="w-[100%]">
                    <!--  -->
                    <tr>
                        <td><p class="font-bold">Nome da sala</p></td>
                    </tr>
                    <!--  -->
                    <tr>
                        <td><input class="w-[100%] h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="nome" value="{{ $sala->nome }}" type="text"></td>
                    </tr>
                    <!--  -->
                    <tr>
                        <td><p class="font-bold">Descrição</p></td>
                    </tr>
                    <!--  -->
                    <tr>
                        <td><textarea class="w-[100%] h-[100px] p-[15px] outline-none mt-[5px] mb-[10px] border-[1px] bg-slate-50" name="descricao">{{ $sala->descricao }}</textarea></td>
                    </tr>
                </table>
                <!--  -->
                <div class="w-[100%] inline-block">
                    <!--  -->
                    <div class="w-[49%] mr-[1%] inline-block float-left">
                        <table class="w-[100%]">
                            <!--  -->
                            <tr>
                                <td><p class="font-bold">Mínimo de locação</p></td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <select name="minimo" class="w-[100%] pl-[5px] h-[40px] outline-none mt-[5px] mb-[10px] border-[1px] bg-slate-50">
                                        @if($sala->minimo == 1)
                                        <option value="1" selected>1 hora</option>
                                        <option value="2">2 horas</option>
                                        <option value="3">+3 horas</option>
                                        @elseif($sala->minimo == 2)
                                        <option value="1">1 hora</option>
                                        <option value="2" selected>2 horas</option>
                                        <option value="3">+3 horas</option>
                                        @elseif($sala->minimo == 3)
                                        <option value="1">1 hora</option>
                                        <option value="2">2 horas</option>
                                        <option value="3" selected>+3 horas</option>
                                        @endif
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--  -->
                    <div class="w-[49%] ml-[1%] inline-block float-left">
                        <table class="w-[100%]">
                            <!--  -->
                            <tr>
                                <td><p class="font-bold ml-[9px]">Preço/hora</p></td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td><input class="w-[100%] float-right h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="valor" value="{{ $valor_hora }}" placeholder="Ex.: 00.00" type="text"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!--  -->
                <div class="w-[100%] mb-[20px] inline-block">
                    <!--  -->
                    <div class="w-[49%] mr-[1%] inline-block float-left">
                        <table class="w-[100%]">
                            <!--  -->
                            <tr>
                                <td><p class="font-bold">Valor turno (4 horas)</p></td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td><input class="w-[100%] float-right h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="turno" value="{{ $valor_turno }}" placeholder="Ex.: 00.00" type="text"></td>
                            </tr>
                        </table>
                    </div>
                    <!--  -->
                    <div class="w-[49%] ml-[1%] inline-block float-left">
                        <table class="w-[100%]">
                            <!--  -->
                            <tr>
                                <td><p class="font-bold ml-[9px]">Valor diária (8 horas)</p></td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td><input class="w-[100%] float-right h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="diaria" value="{{ $valor_diario }}" placeholder="Ex.: 00.00" type="text"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!--  -->
                <button class="w-[190px] h-[40px] rounded-[5px] float-left bg-[#333333] text-[#ffffff] font-bold">Atualizar espaço</button>
            </form>
            <!--  -->
            <a href="{{ route('del_sala', ['id' => $sala->id]) }}"><button class="w-[190px] h-[40px] rounded-[5px] float-left bg-[#333333] ml-[10px] text-[#ffffff] font-bold">Deletar espaço</button></a>
            <!--  -->
            <a href="{{ route('salas') }}"><p class="float-left ml-[20px] mt-[12px]">Voltar a lista de espaços</p></a>
        </div>
        <!--  -->
        <div class="w-[30%] pl-[30px] float-left inline-block">
            <!--  -->
            @if($sala->stts == "imagem")
            <p class="mt-[20px] text-[red] text-[13px]">✱ Sua sala ainda não está pronta, esse espaço não possui uma imagem de exibição, inclua uma ou mais imagens usando os botões abaixo:</p>
            @else
            <p class="mt-[20px] text-[13px]">Atualize as imagens deste espaço usando os botões abaixo:</p>
            @endif
            <!--  -->
            <form class="mt-[30px]" action="/php/sala.php" method="post" enctype="multipart/form-data">
                <!--  -->
                <table class="w-[100%]">
                    <!--  -->
                    <tr>
                        <td>
                            @if($sala->img1 == "nulla")
                            <label for="imagem1" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Carregar nova imagem</center></label>
                            @else
                            <label for="imagem1" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Atualizar imagem</center></label>
                            @endif
                            <input id="imagem1" class="hidden" type="file" name="img1">
                        </td>
                    </tr>
                    <!--  -->
                    <tr style="display: none;">
                        <td>
                            @if($sala->img2 == "nulla")
                            <label for="imagem2" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Carregar imagem 2</center></label>
                            @else
                            <label for="imagem2" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[green] float-right mb-[10px]"><center>Carregar imagem 2</center></label>
                            @endif
                            <input id="imagem2" class="hidden" type="file" name="img2">
                        </td>
                    </tr>
                    <!--  -->
                    <tr style="display: none;">
                        <td>
                            @if($sala->img3 == "nulla")
                            <label for="imagem3" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Carregar imagem 3</center></label>
                            @else
                            <label for="imagem3" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[green] float-right mb-[10px]"><center>Carregar imagem 3</center></label>
                            @endif
                            <input id="imagem3" class="hidden" type="file" name="img3">
                        </td>
                    </tr>
                    <!--  -->
                    <tr style="display: none;">
                        <td>
                            @if($sala->img4 == "nulla")
                            <label for="imagem4" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Carregar imagem 4</center></label>
                            @else
                            <label for="imagem4" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[green] float-right mb-[10px]"><center>Carregar imagem 4</center></label>
                            @endif
                            <input id="imagem4" class="hidden" type="file" name="img4">
                        </td>
                    </tr>
                    <!--  -->
                    <tr style="display: none;">
                        <td>
                            @if($sala->img5 == "nulla")
                            <label for="imagem5" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Carregar imagem 5</center></label>
                            @else
                            <label for="imagem5" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[green] float-right mb-[10px]"><center>Carregar imagem 5</center></label>
                            @endif
                            <input id="imagem5" class="hidden" type="file" name="img5">
                        </td>
                    </tr>
                    <!--  -->
                    <input type="hidden" name="id" value="{{ $sala->id }}">
                    <!--  -->
                    <tr>
                        <td>
                            <button class="w-[100%] rounded-[5px] h-[40px] font-bold text-[#ffffff] bg-[#a35554]">Fazer upload</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>   
@endsection
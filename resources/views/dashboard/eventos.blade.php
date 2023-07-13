@extends('dashboard.layout.main')
@section('title', 'Dashboard - Eventos')
@section('titulo', 'Eventos')
@section('imagem', 'apresentacao.png')

@section('content')
<!--  -->
<div class="modal_novo_evento">
  <!--  -->
  <div class="w-[1000px] mx-[auto] mt-[4%] h-[600px] p-[50px] overflow-scroll bg-[#ffffff] shadow-lg">
    <!--  -->
    <div class="w-[100%] inline-block">
      <!--  -->
      <div class="w-[70%] inline-block float-left">
        <!--  -->
        <p class="font-bold text-[25px] mb-[30px] text-[#313131]">Novo evento</p>
      </div>
      <!--  -->
      <div class="w-[30%] inline-block float-left">
        <!--  -->
        <p id="fechar_evv" class="float-right text-[18px] cursor-pointer">✕</p>
      </div>
    </div>
    <!--  -->
    <form action="/php/eventos.php" method="POST" enctype="multipart/form-data">
        @csrf
        <!--  -->
        <table class="w-[100%]">
            <!-- TÍTULO -->
            <tr>
                <td>
                    <input class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]" name="titulo" placeholder="Título do evento (*)" type="text">
                </td>
            </tr>
            <!-- DESCRIÇÃO -->
            <tr>
                <td>
                    <textarea class="w-[100%] h-[80px] mt-[5px] mb-[10px] p-[15px] outline-none h-[50px] rounded-[5px] border-[1px]" name="descricao" placeholder="Descrição (*)"></textarea>
                </td>
            </tr>
        </table>
        <!-- DATA/HORA -->
        <div class="w-[100%] inline-block">
            <!--  -->
            <div class="w-[49%] mr-[1%] inline-block float-left">
                <table class="w-[100%]">
                    <tr>
                        <td>
                            <input class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]" name="data" id="date02" placeholder="Data (*)" type="text">
                        </td>
                    </tr>
                </table>
            </div>
            <!--  -->
            <div class="w-[49%] ml-[1%] inline-block float-left">
                <table class="w-[100%]">
                    <tr>
                        <td>
                            <input class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]" name="hora" id="hor2" placeholder="Hora (*)" type="text">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- PARTICIPANTES/IMAGEM -->
        <div class="w-[100%] inline-block">
            <!--  -->
            <div class="w-[49%] mr-[1%] inline-block float-left">
                <table class="w-[100%]">
                    <tr>
                        <td>
                            <input class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]" name="quantidade" placeholder="Número maximo de participantes (*)" type="text">
                        </td>
                    </tr>
                </table>
            </div>
            <!--  -->
            <div class="w-[49%] ml-[1%] inline-block float-left">
                <table class="w-[100%]">
                    <tr>
                        <td>
                            <label for="imagem" class="font-bold w-[100%] rounded-[5px] mt-[6px] h-[47px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#C5908F] float-right mb-[10px]"><center class="mt-[4px]">Carregar imagem</center></label>
                            <input id="imagem" class="hidden" type="file" name="imagem">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- ENTRADA/VALOR -->
        <div class="w-[100%] inline-block">
            <!--  -->
            <div class="w-[49%] mr-[1%] inline-block float-left">
                <table class="w-[100%]">
                    <tr>
                        <td>
                            <select name="entrada" class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]">
                                <option value="1">Evento aberto</option>
                                <option value="2">Evento pago</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <!--  -->
            <div class="w-[49%] ml-[1%] inline-block float-left">
                <table class="w-[100%]">
                    <tr>
                        <td>
                            <input class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]" name="valor" id="hor2" placeholder="Valor Ex.: 0.00" type="text">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- LINK DE PAGAMENTO -->
        <table class="w-[100%]">
            <tr>
                <td>
                    <input class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]" name="link" placeholder="Link de pagamento" type="text">
                </td>
            </tr>
        </table>
        <!--  -->
        <button class="w-[100%] h-[40px] rounded-[5px] mt-[20px] bg-[#313131] text-[#ffffff]">Incluir evento</button>
    </form>
  </div>
</div>
<!-- BUTTON NOVO EVENTO -->
<button id="bt_add_evv" class="px-[30px] h-[40px] rounded-[5px] mb-[40px] ml-[13px] bg-[#313131] text-[#ffffff]">Add novo evento</button>
<!--  -->
<div class="w-[100%] h-[480px] bg-white float-left overflow-auto">
    <!--  -->
    <div class="inline-block p-[30px] w-[100%]">
        <table class="w-[100%]">
            <tr>
                <td class="w-[38%]"><p class="text-[12px] text-[#212121] font-bold">Evento</p></td>
                <td class="w-[10%]"><p class="text-[12px] text-[#212121] font-bold">Data</p></td>
                <td class="w-[10%]"><p class="text-[12px] text-[#212121] font-bold">Horário</p></td>
                <td class="w-[10%]"><p class="text-[12px] text-[#212121] font-bold">Quant.</p></td>
                <td class="w-[18%]"><p class="text-[12px] text-[#212121] font-bold">Status</p></td>
                <td class="w-[10%]"><p class="text-[12px] text-[#212121] font-bold"></p></td>
            </tr>
        </table>
        <hr class="mt-[10px]" size="1px">
        <!--  -->
        @foreach($eventos as $evento)
        <table class="w-[100%]">
            <tr>
                <td class="w-[38%]"><p class="text-[12px] text-[#212121]">{{ $evento->titulo }}</p></td>
                <td class="w-[10%]"><p class="text-[12px] text-[#212121]">{{ $evento->datas }}</p></td>
                <td class="w-[10%]"><p class="text-[12px] text-[#212121]">{{ $evento->hora }}</p></td>
                <td class="w-[10%]"><p class="text-[12px] text-[#212121]">{{ $evento->quantidade }}</p></td>
                <td class="w-[18%]"><p class="text-[12px] text-[#212121]">{{ $evento->stts }}</p></td>
                <td class="w-[10%]"><a href="{{ route('exb_eventos', ['id' => $evento->id]) }}"><button class="w-[100%] font-bold text-[10px] h-[25px] mt-[10px] rounded-[5px] bg-[#c5908f] text-[#ffffff]">Editar evento</button></a></td>
            </tr>
        </table>
        <hr class="mt-[10px]" size="1px">
        @endforeach
    </div>  
</div>
@endsection
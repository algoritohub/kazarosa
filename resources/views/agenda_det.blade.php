@extends('layout.main_vantagens')
@section('title', 'Kaza Rosa | Agendamento')
@section('titulo_max', 'Coworking')
@section('titulo_min', 'Espaço')
@section('imagem', '{{ $sala->img1 }}')

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
    <div class="w-[90%] mx-[5%] inline-block mb-[20px]">
        <p class="text-[22px] float-left">{{ $sala->nome }}</p>
    </div>
    <!-- FOTO -->
    <div class="w-[90%] inline-block mx-[5%]">
        <div class="w-[100%] inline-block">
            <!-- IMG1 -->
            @if($sala->img1)
            <div class="w-[100%] float-left h-[150px] rounded-[10px] mb-[10px] bg-[#eeeeee] cursor-pointer" style="background: url(/img/salas/{{ $sala->img1 }}); background-size: 100%; background-position: center;"></div>
            @endif
        </div>
    </div>
    <!--  -->
    <div class="w-[90%] mt-[20px] mx-[5%] inline-block">
        <!--  -->
        <p class="text-[13px]">{{ $sala->descricao }}</p>
        <!--  -->
        <!-- FORMULÁRIO DE AGENDAMENTO -->
        <div class="w-[100%] mt-[30px] inline-block">
            <div class="w-[100%] p-[20px] inline-block bg-[#fafafa] border-[#cdcdcd] mb-[10px] rounded-[20px] border-[1px]">
                @if(session('usuario'))
                <form action="{{ route('agendar_sala') }}" method="POST">
                    @csrf
                    <!--  -->
                    <table class="w-[100%]">
                        <tr>
                            <td>
                                <!--  -->
                                @if($sala->minimo == 1)
                                <div class="bg-[#fafafa] float-left mr-[10px] mb-[10px] inline-block border-[1px] border-[#cdcdcd] rounded-[50px] py-[8px] px-[10px]">
                                    <input class="float-left" name="tempo" type="radio" value="1"><p class="float-left text-[12px] ml-[3px] mt-[-2px]">1 hora</p>
                                </div>
                                <!--  -->
                                <div class="bg-[#fafafa] float-left mr-[10px] mb-[10px] inline-block border-[1px] border-[#cdcdcd] rounded-[50px] py-[8px] px-[10px]">
                                    <input class="float-left" name="tempo" type="radio" value="2"><p class="float-left text-[12px] ml-[3px] mt-[-2px]">2 horas</p>
                                </div>
                                @endif
                                <!--  -->
                                @if($sala->minimo == 2)
                                <div class="bg-[#fafafa] float-left mr-[10px] mb-[10px] inline-block border-[1px] border-[#cdcdcd] rounded-[50px] py-[8px] px-[10px]">
                                    <input class="float-left" name="tempo" type="radio" value="2"><p class="float-left text-[12px] ml-[3px] mt-[-2px]">2 horas</p>
                                </div>
                                @endif
                                <!--  -->
                                <div class="bg-[#fafafa] float-left mr-[10px] mb-[10px] inline-block border-[1px] border-[#cdcdcd] rounded-[50px] py-[8px] px-[10px]">
                                    <input class="float-left" name="tempo" type="radio" value="4"><p class="float-left text-[12px] ml-[3px] mt-[-2px]">Turno (4 horas)</p>
                                </div>
                                <!--  -->
                                <div class="bg-[#fafafa] float-left mr-[10px] mb-[10px] inline-block border-[1px] border-[#cdcdcd] rounded-[50px] py-[8px] px-[10px]">
                                    <input class="float-left" name="tempo" type="radio" value="8"><p class="float-left text-[12px] ml-[3px] mt-[-2px]">Diária (8 horas)</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <!--  -->
                    <div class="w-[49%] mr-[1%] inline-block float-left">
                        <!--  -->
                        <table class="w-[100%]">
                            <tr>
                                <td><input class="w-[100%] pl-[10px] border-[1px] outline-none h-[40px] rounded-[8px] text-[12px] border-[#cdcdcd]" type="text" id="hor1" name="horario" placeholder="Horário"></td>
                            </tr>
                        </table>
                    </div>
                    <!--  -->
                    <div class="w-[49%] ml-[1%] inline-block float-left">
                        <!--  -->
                        <table class="w-[100%]">
                            <tr>
                                <td><input class="w-[100%] pl-[10px] border-[1px] outline-none h-[40px] rounded-[8px] text-[12px] border-[#cdcdcd]" type="text" name="dia" id="date" placeholder="Dia"></td>
                            </tr>
                        </table>
                    </div>
                    <!--  -->
                    <input type="hidden" value="{{ $sala->id }}" name="sala">
                    <!--  -->
                    <button class="w-[100%] float-left h-[40px] mt-[10px] cursor-pointer text-[#ffffff] font-bold rounded-[10px] bg-[#A35554]"><center>Agendar espaço</center></button>
                </form>
                @endif
                <!--  -->
                @if(!session('usuario'))
                <center><p class="text-[11px] text-[#A35554] mb-[10px]">Você está deslogado ou não possui uma conta!</p></center>
                <!--  -->
                <a href="{{ route('login') }}"><button class="w-[100%] float-left h-[50px] p-[15px] cursor-pointer text-[#ffffff] font-bold rounded-[10px] bg-[#A35554]">Entrar para agendar</button></a>
                @endif
            </div>
        </div>
        <!--  -->
    </div>
</section>
@endsection

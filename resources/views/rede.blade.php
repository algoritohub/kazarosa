@extends('layout.main_rede')
@section('title', 'Kaza Rosa | Redes')
@section('titulo_pack', 'Redes')
@section('sub_titulo_pack', 'Escolha seu melhor pacote')

@section('content')
<!-- ESPAÇOS -->
<section class="md:hidden">
    <div class="w-[100%] my-[0px]">
        <div class="w-[100%] px-[5%] inline-block">
            <!-- CONTEÚDO -->
            <div class="mt-[100px] w-[100%] inline-block">
                <!-- CARD -->
                <div class="w-[29.3%] cursor-pointer float-left mx-[2%] h-[100px] bg-[#ffffff] rounded-[10px] p-[10px] shadow-lg">
                    <div class="w-[100%] inline-block border-b-[1px] border-[#212121]">
                        <center><p class="text-[30px] font-bold m-[0px]">0</p></center>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <center><p class="text-[10px]">Seguidores</p></center>
                    </div>
                </div>
                <!-- CARD -->
                <div class="w-[29.3%] cursor-pointer float-left mx-[2%] h-[100px] bg-[#ffffff] rounded-[10px] p-[10px] shadow-lg">
                    <div class="w-[100%] inline-block border-b-[1px] border-[#212121]">
                        <center><p class="text-[30px] font-bold m-[0px]">0</p></center>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <center><p class="text-[10px]">Postagens</p></center>
                    </div>
                </div>
                <!-- CARD -->
                <div class="w-[29.3%] cursor-pointer float-left mx-[2%] h-[100px] bg-[#ffffff] rounded-[10px] p-[10px] shadow-lg">
                    <div class="w-[100%] inline-block border-b-[1px] border-[#212121]">
                        <center><p class="text-[30px] font-bold m-[0px]">0</p></center>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <center><p class="text-[10px]">Agendamentos</p></center>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="w-[100%] mt-[30px] inline-block">
                <button class="w-[47%] float-left h-[50px] mb-[15px] shadow-lg p-[15px] cursor-pointer text-[#ffffff] font-bold rounded-[10px] bg-[green] mx-[1.5%]"><center>Nova postagem</center></button>
                <button class="w-[47%] float-left h-[50px] mb-[15px] shadow-lg p-[15px] cursor-pointer text-[#ffffff] font-bold rounded-[10px] bg-[green] mx-[1.5%]"><center>Nova postagem</center></button>
                <button class="w-[47%] float-left h-[50px] mb-[15px] shadow-lg p-[15px] cursor-pointer text-[#ffffff] font-bold rounded-[10px] bg-[green] mx-[1.5%]"><center>Indicações</center></button>
                <button class="w-[47%] float-left h-[50px] mb-[15px] shadow-lg p-[15px] cursor-pointer text-[#ffffff] font-bold rounded-[10px] bg-[green] mx-[1.5%]"><center>Mensagens</center></button>
            </div>
            <!--  -->
            <div class="w-[100%] mt-[40px] inline-block">
                <a href=""><button class="w-[97%] float-left h-[50px] mb-[15px] shadow-lg p-[15px] cursor-pointer text-[#ffffff] font-bold rounded-[10px] bg-[red] mx-[1.5%]"><center>Visualizar meu perfil</center></button></a>
            </div>
        </div>
    </div>
</section>
@endsection

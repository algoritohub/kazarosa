@extends('layout.main_post')
@section('title', 'Kaza Rosa | Perfil')
@section('titulo_pack', 'Perfil')
@section('sub_titulo_pack', 'Escolha seu melhor pacote')

@section('content')
<!-- ESPAÇOS -->
<section class="md:hidden">
    <div class="w-[100%] my-[0px]">
        <div class="w-[100%] px-[5%] inline-block">
            <!-- CONEXÃO PDO -->
            <div class="w-[100%] inline-block">
                <!--  -->
                <p class="mt-[30px] ml-[5px] text-[12px]">{{ session('usuario')['nome'] }} publicou</p>
                <!-- IMGAEM -->
                <img class="mt-[10px] mb-[20px]" src="/img/feed/{{ $post->postagem }}" alt="">
                <!-- BUTTONS -->
                <div class="w-[100%] inline-block">
                    <ul>
                        <li class="inline-block"><p class="">❤</p></li>
                        <li class="inline-block"><p class="">{{ $post->curtidas }}</p></li>
                    </ul>
                </div>
                <!-- COMENTÁRIOS -->
                <div class="w-[100%] mt-[20px] inline-block">
                    <p>{{ $post->descricao }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

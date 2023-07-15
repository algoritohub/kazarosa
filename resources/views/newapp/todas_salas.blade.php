@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    {{-- SALAS --}}
    <section class="w-[100%] mt-[20px] inline-block">
        <div class="w-[90%] mx-[5%] inline-block">
            <div class="w-[10%] inline-block float-left"><p class="text-[25px]"><i class="fi fi-sr-add"></i></p></div>
            <div class="w-[90%] inline-block float-left"><p class="font-bold text-[20px]">Coworking</p></div>
        </div>
        {{--  --}}
        <div style="scrollbar-width: none;" class="w-[100%] overflow-scroll inline-block">
            <div class="w-[100%] px-[5%] inline-block">

                @foreach($salas as $sala)
                @php
                    $descricao_resumo = mb_strimwidth($sala->descricao, 0, 40, "...");
                @endphp
                <a href="{{ route('app.coworking.detalhe', ['id' => $sala->id]) }}">
                    <div class="card" style="width: 100%; float: left; margin: 0px 0px 30px 0px; border: 0px;">
                        <img class="card-img-top" src="/img/salas/{{ $sala->img1 }}" style="border-radius: 15px;" alt="sem imagem!">
                        <div class="card-body" style="padding: 0px;">
                            <h5 class="font-bold mt-[15px] text-[20px] mb-[10px]">{{ $sala->nome }}</h5>
                            <p class="mt-[10px] leading-[20px]">{{ $descricao_resumo }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    $('.carousel').carousel({
        interval: 2000;
    })
</script>
@endsection

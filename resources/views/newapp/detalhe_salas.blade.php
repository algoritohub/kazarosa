@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[60px]">
    {{-- CARROSSEL BANNERS --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="z-index: 1001;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img class="d-block w-100" src="/img/salas/{{ $sala->img1 }}" alt="First slide">
            </div>

            @if($sala->img2 != "nulla"))
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/salas/{{ $sala->img2 }}" alt="Second slide">
            </div>
            @endif

            @if($sala->img3 != "nulla"))
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/salas/{{ $sala->img3 }}" alt="Second slide">
            </div>
            @endif

            @if($sala->img4 != "nulla"))
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/salas/{{ $sala->img4 }}" alt="Second slide">
            </div>
            @endif

            @if($sala->img5 != "nulla"))
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/salas/{{ $sala->img5 }}" alt="Second slide">
            </div>
            @endif

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    {{--  --}}
    <div class="w-[100%] h-[130px] mt-[-130px] absolute inline-block box-degrade" style="z-index: 1001;"></div>
    {{--  --}}
    <section>
        <div class="w-[90%] mx-[5%] py-[20px] inline-block">
            {{--  --}}
            <div class="w-[100% pb-[20px] inline-block">
                <p class="font-bold text-[25px]">{{ $sala->nome }}</p></p>
            </div>
            {{--  --}}
            <div class="w-[100%] inline-block">
                <div class="w-[50%] inline-block float-left">
                    <p class="font-bold mt-[10px] text-[18px]">Turno R${{ $valor }}</p>
                </div>
                <div class="w-[50%] inline-block float-left">
                    <a href="{{ route('app.reserva', ['id' => $sala->id]) }}"><button class="w-[90%] float-right h-[50px] bg-[blue] border-[0] text-[#ffffff] font-bold rounded-[5px]">Agendar espaço</button></a>
                </div>
            </div>
            {{--  --}}
            <div class="w-[100% pt-[20px] inline-block">
                <p class="text-[14px]">{{ $sala->descricao }}</p></p>
            </div>
        </div>
    </section>
</main>

@endsection

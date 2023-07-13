@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[110px]">

    {{-- CARROSSEL BANNERS --}}
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="w-[90%] mx-[5%] mx-[20px] h-[110px] rounded-[2px] bg-[#C5908F]"></div>
            </div>
            <div class="carousel-item">
                <div class="w-[90%] mx-[5%] mx-[20px] h-[110px] rounded-[2px] bg-[red]"></div>
            </div>
            <div class="carousel-item">
                <div class="w-[90%] mx-[5%] mx-[20px] h-[110px] rounded-[2px] bg-[blue]"></div>
            </div>
        </div>
    </div>

    {{-- PLANOS --}}
    <section class="w-[100%] mt-[20px] inline-block">
        <div class="w-[90%] mx-[5%] inline-block">
            <div class="w-[10%] inline-block float-left"><p class="text-[25px]"><i class="fi fi-sr-check-circle"></i></p></div>
            <div class="w-[90%] inline-block float-left"><p class="font-bold text-[20px]">Planos</p></div>
        </div>
        {{--  --}}
        <div style="scrollbar-width: none;" class="w-[100%] overflow-scroll inline-block">
            <div class="w-[270%] px-[2%] inline-block">

                <a href="">
                <div class="card" style="width: 18%; float: left; margin: 0px 1% 0px 1%; border: 0px;">
                    <img class="card-img-top" src="/img/newapp/imagem1.jpg" style="border-radius: 15px;" alt="Card image cap">
                    <div class="card-body" style="padding: 0px;">
                        <h5 class="font-bold mt-[15px] mb-[10px]">Plan Basic</h5>
                        <p class="mt-[10px] leading-[20px]">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                </a>

                <a href="">
                <div class="card" style="width: 18%; float: left; margin: 0px 1% 0px 1%; border: 0px;">
                    <img class="card-img-top" src="/img/newapp/imagem1.jpg" style="border-radius: 15px;" alt="Card image cap">
                    <div class="card-body" style="padding: 0px;">
                        <h5 class="font-bold mt-[15px] mb-[10px]">Plan Executive</h5>
                        <p class="mt-[10px] leading-[20px]">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                </a>

                <a href="">
                <div class="card" style="width: 18%; float: left; margin: 0px 1% 0px 1%; border: 0px;">
                    <img class="card-img-top" src="/img/newapp/imagem1.jpg" style="border-radius: 15px;" alt="Card image cap">
                    <div class="card-body" style="padding: 0px;">
                        <h5 class="font-bold mt-[15px] mb-[10px]">Plan Private</h5>
                        <p class="mt-[10px] leading-[20px]">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                </a>

                <a href="">
                <div class="card" style="width: 18%; float: left; margin: 0px 1% 0px 1%; border: 0px;">
                    <img class="card-img-top" src="/img/newapp/imagem1.jpg" style="border-radius: 15px;" alt="Card image cap">
                    <div class="card-body" style="padding: 0px;">
                        <h5 class="font-bold mt-[15px] mb-[10px]">Card title</h5>
                        <p class="mt-[10px] leading-[20px]">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                </a>

                <div class="w-[18%] mx-[1%] h-[160px] rounded-[2px] inline-block float-left">
                    <center>
                        <button id="button-position" class="px-[20px] h-[40px] mx-auto text-[18px] rounded-[5px] bg-[blue] text-[#ffffff]">ver todos</button>
                    </center>
                </div>
            </div>
        </div>
    </section>

    {{-- SALAS --}}
    <section class="w-[100%] mt-[20px] inline-block">
        <div class="w-[90%] mx-[5%] inline-block">
            <div class="w-[10%] inline-block float-left"><p class="text-[25px]"><i class="fi fi-sr-add"></i></p></div>
            <div class="w-[90%] inline-block float-left"><p class="font-bold text-[20px]">Coworking</p></div>
        </div>
        {{--  --}}
        <div style="scrollbar-width: none;" class="w-[100%] overflow-scroll inline-block">
            <div class="w-[270%] px-[2%] inline-block">

                @foreach($salas as $sala)
                @php
                    $descricao_resumo = mb_strimwidth($sala->descricao, 0, 40, "...");
                @endphp
                <a href="{{ route('app.coworking.detalhe', ['id' => $sala->id]) }}">
                    <div class="card" style="width: 18%; float: left; margin: 0px 1% 0px 1%; border: 0px;">
                        <img class="card-img-top" src="/img/salas/{{ $sala->img1 }}" style="border-radius: 15px;" alt="Card image cap">
                        <div class="card-body" style="padding: 0px;">
                            <h5 class="font-bold mt-[15px] mb-[10px]">{{ $sala->nome }}</h5>
                            <p class="mt-[10px] leading-[20px]">{{ $descricao_resumo }}</p>
                        </div>
                    </div>
                </a>
                @endforeach

                <div class="w-[18%] mx-[1%] h-[160px] rounded-[2px] inline-block float-left">
                    <center>
                        <button id="button-position" class="px-[20px] h-[40px] mx-auto text-[18px] rounded-[5px] bg-[blue] text-[#ffffff]">ver todos</button>
                    </center>
                </div>
            </div>
        </div>
    </section>

    {{-- SALAS --}}
    <section class="w-[100%] mt-[20px] inline-block">
        <div class="w-[90%] mx-[5%] inline-block">
            <div class="w-[10%] inline-block float-left"><p class="text-[25px]"><i class="fi fi-sr-add"></i></p></div>
            <div class="w-[90%] inline-block float-left"><p class="font-bold text-[20px]">Eventos</p></div>
        </div>
        {{--  --}}
        <div style="scrollbar-width: none;" class="w-[100%] overflow-scroll inline-block">
            <div class="w-[270%] px-[2%] inline-block">
                <div class="w-[18%] mx-[1%] h-[160px] rounded-[2px] inline-block bg-[#cdcdcd] float-left"></div>
                <div class="w-[18%] mx-[1%] h-[160px] rounded-[2px] inline-block bg-[#cdcdcd] float-left"></div>
                <div class="w-[18%] mx-[1%] h-[160px] rounded-[2px] inline-block bg-[#cdcdcd] float-left"></div>
                <div class="w-[18%] mx-[1%] h-[160px] rounded-[2px] inline-block bg-[#cdcdcd] float-left"></div>
                <div class="w-[18%] mx-[1%] h-[160px] rounded-[2px] inline-block float-left">
                    <center>
                        <button id="button-position" class="px-[20px] h-[40px] mx-auto text-[18px] rounded-[5px] bg-[blue] text-[#ffffff]">ver todos</button>
                    </center>
                </div>
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

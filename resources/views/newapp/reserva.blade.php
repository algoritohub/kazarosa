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
                <img class="d-block w-100" src="/img/salas/{{ $reserva->img1 }}" alt="First slide">
            </div>

            @if($reserva->img2 != "nulla")
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/salas/{{ $reserva->img2 }}" alt="Second slide">
            </div>
            @endif

            @if($reserva->img3 != "nulla")
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/salas/{{ $reserva->img3 }}" alt="Second slide">
            </div>
            @endif

            @if($reserva->img4 != "nulla")
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/salas/{{ $reserva->img4 }}" alt="Second slide">
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

    <section>
        <div class="w-[90%] mx-[5%] py-[20px] inline-block">
            {{--  --}}
            <div class="w-[100% pb-[20px] inline-block">
                <p class="font-bold text-[25px]">{{ $reserva->nome }}</p></p>
                @if ($reserva->minimo == 1)
                <p class="text-[15px]">Mínimo {{ $reserva->minimo }} hora</p></p>
                @else
                <p class="text-[15px]">Mínimo {{ $reserva->minimo }} horas</p></p>
                @endif
            </div>

            <div class="w-[100%] inline-block">
                <form action="{{ route('app.agendamento_sala') }}" method="POST">
                    @csrf
                    <div class="my-1">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">Tempo</label>
                        <select class="custom-select mr-sm-2" name="tempo" id="inlineFormCustomSelect">
                            <option selected>...</option>
                            <option value="1">1 hora</option>
                            <option value="2">2 horas</option>
                            <option value="3">3 horas</option>
                            <option value="4">Turno</option>
                            <option value="8">Diária</option>
                        </select>
                    </div>
                    <div class="w-[100%] inline-block">
                        <div class="float-left w-[49%] mr-[1%]">
                            <label for="exampleInputEmail1">Data</label>
                            <input type="date" class="form-control" name="dia" id="exampleInputEmail1">
                        </div>
                        <div class="float-left w-[49%] ml-[1%]">
                            <label for="exampleInputEmail1">Hora</label>
                            <input type="time" class="form-control" name="horario" id="exampleInputEmail1">
                        </div>
                    </div>
                    <input type="hidden" value="{{ $reserva->id }}" name="sala">
                    <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] mb-[30px] mt-[20px] text-[#ffffff]">Verificar Reserva</button>
                </form>
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

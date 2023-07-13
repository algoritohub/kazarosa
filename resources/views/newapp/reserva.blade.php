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
                <img class="d-block w-100" src="/img/newapp/imagem1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/newapp/imagem2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/newapp/imagem3.jpg" alt="Third slide">
            </div>
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
                <p class="font-bold text-[25px]">Nome da Sala Selecionada</p></p>
                <p class="text-[15px]">Mínimo 1 hora</p></p>
            </div>

            <div class="w-[100%] inline-block">
                <form action="{{ route('app.agendamento_sala') }}" method="POST">
                    @csrf
                    <div class="my-1">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">Tempo</label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                            <option selected>Choose...</option>
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
                            <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="float-left w-[49%] ml-[1%]">
                            <label for="exampleInputEmail1">Hora</label>
                            <input type="time" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                    </div>
                    <input type="hidden" value="" name="sala">
                    <button class="w-[100%] h-[40px] rounded-[5px] bg-[blue] mt-[20px] text-[#ffffff]">Verificar Reserva</button>
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

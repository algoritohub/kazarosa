@extends('newapp.layout.main_feed')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    <div class="w-[100%] mb-[30px] inline-block">
        <div class="w-[90%] mx-[5%] inline-block">

            <div class="w-[100%] mb-[20px] inline-block">
                <div class="w-[49%] mr-[1%] inline-block float-left">
                    <button id="btn-recebidas" class="w-[100%] rounded-[5px] h-[40px] bg-[#C5908F] text-[#ffffff]">Recebidas</button>
                </div>
                <div class="w-[49%] ml-[1%] inline-block float-left">
                    <button id="btn-enviadas" class="w-[100%] rounded-[5px] h-[40px] bg-[#C5908F] text-[#ffffff]">Enviadas</button>
                </div>
            </div>

            <div id="box-recebidas" class="w-[100%] inline-block">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="w-[100%] inline-block">
                            <div class="w-[15%] inline-block float-left">
                                <div class="w-[40px] h-[40px] rounded-[100px] bg-[silver]"></div>
                            </div>
                            <div class="w-[65%] inline-block float-left">
                                <p class="font-bold">Fulano</p>
                                <p class="mt-[-5px]">Cras justo odio</p>
                            </div>
                            <div class="w-[20%] inline-block float-left">
                                <button class="w-[100%] h-[40px] rounded-[5px] text-[#ffffff] text-[13px] bg-[#C5908F]">Ver</button>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="w-[100%] inline-block">
                            <div class="w-[15%] inline-block float-left">
                                <div class="w-[40px] h-[40px] rounded-[100px] bg-[silver]"></div>
                            </div>
                            <div class="w-[65%] inline-block float-left">
                                <p class="font-bold">Ciclano</p>
                                <p class="mt-[-5px]">Cras justo odio</p>
                            </div>
                            <div class="w-[20%] inline-block float-left">
                                <a href="{{ route('app.mensagens.detalhe') }}"><button class="w-[100%] h-[40px] rounded-[5px] text-[#ffffff] text-[13px] bg-[#C5908F]">Ver</button></a>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="w-[100%] inline-block">
                            <div class="w-[15%] inline-block float-left">
                                <div class="w-[40px] h-[40px] rounded-[100px] bg-[silver]"></div>
                            </div>
                            <div class="w-[65%] inline-block float-left">
                                <p class="font-bold">Beltrano</p>
                                <p class="mt-[-5px]">Cras justo odio</p>
                            </div>
                            <div class="w-[20%] inline-block float-left">
                                <button class="w-[100%] h-[40px] rounded-[5px] text-[#ffffff] text-[13px] bg-[#C5908F]">Ver</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div id="box-enviadas" style="display: none;" class="w-[100%] inline-block">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="w-[100%] inline-block">
                            <div class="w-[15%] inline-block float-left">
                                <div class="w-[40px] h-[40px] rounded-[100px] bg-[silver]"></div>
                            </div>
                            <div class="w-[65%] inline-block float-left">
                                <p class="font-bold">Fulano</p>
                                <p class="mt-[-5px]">Cras justo odio</p>
                            </div>
                            <div class="w-[20%] inline-block float-left">
                                <button class="w-[100%] h-[40px] rounded-[5px] text-[#ffffff] text-[13px] bg-[#C5908F]">Ver</button>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="w-[100%] inline-block">
                            <div class="w-[15%] inline-block float-left">
                                <div class="w-[40px] h-[40px] rounded-[100px] bg-[silver]"></div>
                            </div>
                            <div class="w-[65%] inline-block float-left">
                                <p class="font-bold">Ciclano</p>
                                <p class="mt-[-5px]">Cras justo odio</p>
                            </div>
                            <div class="w-[20%] inline-block float-left">
                                <a href="{{ route('app.mensagens.detalhe') }}"><button class="w-[100%] h-[40px] rounded-[5px] text-[#ffffff] text-[13px] bg-[#C5908F]">Ver</button></a>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>

        </div>
    </div>

</main>

@endsection

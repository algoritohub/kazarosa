<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- ICONES -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-straight/css/uicons-bold-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="/css/bootstrap-utilities.min.css"> --}}
    <!-- CSS -->
    <link rel="stylesheet" href="/css/estilo.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SCRIPT -->
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.3.2.js"></script>
    <script src="/js/function-mask.js"></script>
    <script src="/js/script.js"></script>
</head>
{{-- PHP --}}
@php
    $usuaria = session('usuario');
@endphp

{{-- BODY --}}
<body>
    {{-- DESKTOP --}}
    <main class="w-[100%] h-[100vh] bg-[blue]" id="desktop-page">

    </main>
    {{-- MOBILE --}}
    <main class="w-[100%] h-[100vh] inline-block" id="mobile-page">
        {{--  --}}
        <header class="w-[100%] py-[10px] inline-block mt-[-30px] bg-[#A35554] fixed" style="z-index: 1002;">
            <div class="w-[90%] mx-[5%] inline-block">
                <div class="w-[60%] float-left inline-block">
                    <a href="{{ route('app.principal') }}"><img class="w-[150px] mt-[15px]" src="/img/Ativo 12.png" alt="Kaza Rosa"></a>
                </div>
                <div class="w-[40%] float-left inline-block">
                    {{--  --}}
                    <div class="w-[100%] mt-[8px] inline-block">
                        <div class="w-[25.3%] mx-[1.5%] inline-block float-left">
                            <p class="text-center text-[#212121] text-[20px] mt-[16px]"><i class="fi fi-bs-search"></i></p>
                        </div>
                        {{--  --}}
                        <div class="w-[25.3%] mx-[1.5%] inline-block float-left">
                            <p class="text-center text-[#212121] text-[22px] mt-[14px]"><i class="fi fi-bs-bells"></i></p>
                        </div>
                        {{--  --}}
                        <div class="w-[40.3%] mx-[1.5%] inline-block float-left">
                            <div class="w-[45px] h-[45px] mt-[5px] rounded-[100px] border-[1px] float-right" style="background: url(/img/usuario/{{ $usuaria->imagem }}); background-size: 100%;" title="{{ $usuaria->nome }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- LOADING -->
        <div id="carregando" class="mod_loader">
            <center>
            <div id="load_mob" class="mt-[310px] rounded-[10px] inline-block px-[19px] py-[15px]">
                <img src="/img/load.png" class="w-[50px] mt-[8px] ml-[5px] absolute">
                <span class="loader"></span>
            </div>
            </center>
        </div>
        {{--  --}}
        <section id="conteudo" class="w-[100%] inline-block" style="display: none;">
            @yield('content')
        </section>
        {{--  --}}
        <footer>
            <div id="navegate" class="h-[120px] degrade">
                <div class="w-[90%] mx-[5%] inline-block">
                    <div class="w-[100%] mt-[50px] inline-block">
                        {{--  --}}
                        <div class="w-[20%] mx-[2.5%] float-left inline-block">
                            <a href="{{ route('app.agendamento') }}">
                                <p class="text-center text-[30px] text-[#212121]"><i class="fi fi-sr-calendar"></i></p>
                                <p class="text-[10px] text-[#212121] text-center mt-[-2px]">Agenda</p>
                            </a>
                        </div>
                        {{--  --}}
                        <div class="w-[20%] mx-[2.5%] float-left inline-block">
                            <a href="{{ route('app.meu_plano') }}">
                                <p class="text-center text-[30px] text-[#212121]"><i class="fi fi-sr-badge-check"></i></p>
                                <p class="text-[10px] text-[#212121] text-center mt-[-2px]">Meu plano</p>
                            </a>
                        </div>
                        {{--  --}}
                        <div class="w-[20%] mx-[2.5%] float-left inline-block">
                            <a href="{{ route('app.feed') }}">
                                <p class="text-center text-[30px] text-[#212121]"><i class="fi fi-sr-heart"></i></p>
                                <p class="text-[10px] text-[#212121] text-center mt-[-2px]">Feed</p>
                            </a>
                        </div>
                        {{--  --}}
                        <div class="w-[20%] mx-[2.5%] float-left inline-block">
                            <p class="text-center text-[30px] text-[#212121]"><i class="fi fi-sr-settings"></i></p>
                            <p class="text-[10px] text-[#212121] text-center mt-[-2px]">Configurações</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

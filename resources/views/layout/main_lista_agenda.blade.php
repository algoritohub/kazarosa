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
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;500&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/estilo.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SCRIPT -->
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.3.2.js"></script>
    <script src="/js/function-mask.js"></script>
    <script src="/js/script.js"></script>
</head>
<!-- BODY -->
<body class="">
    <!-- DIVISOR GERAL -->
    <div class="w-[100%] h-[100%] inline-block">
        <!-- DIVISOR HEADER -->
        <div class="w-[100%] h-[25%] inline-block" style="background: url(/img/fundo_app2.png); background-size: 120%; background-position: center;">
            <!--  -->
            <header class="md:hidden">
                <div class="w-[100%] h-[25vh] mt-[0px]">
                    <!--  -->
                    <div class="w-[90%] mx-[5%] mt-[10px] inline-block">
                        <!--  -->
                        <div class="w-[50%] float-left h-[20px] inline-block"></div>
                        <!--  -->
                        <div class="w-[50%] float-left inline-block">
                            <!--  -->
                            <ul class="mt-[10px] float-right">
                                <!--  -->
                            </ul>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[90%] h-[100%] mx-[auto]">
                        <!--  -->
                        <div class="w-[100%] mt-[60px] inline-block">
                            <p class="text-[30px] text-[#ffffff] font-bold drop-shadow-md">@yield('titulo_max')</p>
                            <p class="text-[16px] text-[#ffffff] drop-shadow-md">@yield('titulo_min')</p>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <!-- CARREGAMENTO -->
        <div id="carregando" class="mod_loader">
            <center>
            <div class="mt-[250px] rounded-[10px] inline-block px-[19px] py-[15px]">
                <img src="/img/load.png" class="w-[50px] mt-[8px] ml-[5px] absolute">
                <span class="loader"></span>
            </div>
            </center>
        </div>
        <!-- CONTAINER -->
        <div id="conteudo" style="display: none;">
            <div class="w-[100%] h-[66vh] inline-block overflow-scroll">
                @yield('content')
            </div>
        </div>
        <!-- DIVISOR FOOTER -->
        <div class="w-[100%] h-[8vh] inline-block bg-transparent">
            <!-- NAV -->
            <nav class="w-[100%] inline-block">
                <div class="w-[100%]">
                    <center><a href="{{ route('principal') }}"><p class="mt-[20px]"></p> Voltar</a></center>
                </div>
            </nav>
        </div>
    </div>
</body>
</html>
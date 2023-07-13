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
    <script src="/js/script.js"></script>
</head>
<!-- BODY -->
<body>
    <!-- LOADING -->
    <div id="carregando" class="mod_loader">
        <center>
        <div id="load_mob" class="mt-[310px] rounded-[10px] inline-block px-[19px] py-[15px]">
            <img src="/img/load.png" class="w-[50px] mt-[8px] ml-[5px] absolute">
            <span class="loader"></span>
        </div>
        </center>
    </div>
    <!-- CONTAINER -->
    <div class="w-[100%] inline-block" id="conteudo" style="display: none;">
        <!-- HEADER -->
        <header class="w-[100%] inline-block">
            <div class="w-[90%] my-[0px] inline-block">
                <div class="w-[100%] mt-[0px] px-[5%] h-[90px] absolute z-40" id="id_topo">
                    <!-- LOGO -->
                    <div id="bloco_top1" class="w-[23.3%] h-[100px] py-[20px] inline-block float-left">
                        <a href=""><img class="w-[100px] mt-[5px]" src="/img/Ativo 21.png" alt="Kasa Rosa"></a>
                    </div>
                    <!-- MENU -->
                    <div id="menu_geral" class="w-[63.3%] h-[100px] py-[20px] inline-block float-left">
                        <ul class="mt-[20px] ml-[140px]">
                            <a href="#um"><li class="inline-block mr-[30px]"><p class="text-[14px] text-[#333333] uppercase opacity-[0.9] border-b-[0px] pb-[10px] border-[#333333] hover:border-b-[1px] hover:opacity-[0.7]">Espaço</p></li></a>
                            <a href="#dois"><li class="inline-block mr-[30px]"><p class="text-[14px] text-[#333333] uppercase opacity-[0.9] border-b-[0px] pb-[10px] border-[#333333] hover:border-b-[1px] hover:opacity-[0.7]">CoWomen</p></li></a>
                            <a href="#tres"><li class="inline-block mr-[30px]"><p class="text-[14px] text-[#333333] uppercase opacity-[0.9] border-b-[0px] pb-[10px] border-[#333333] hover:border-b-[1px] hover:opacity-[0.7]">Serviço</p></li></a>
                            <a href="#ultra"><li class="inline-block mr-[30px]"><p class="text-[14px] text-[#333333] uppercase opacity-[0.9] border-b-[0px] pb-[10px] border-[#333333] hover:border-b-[1px] hover:opacity-[0.7]">Programação</p></li></a>
                            <a href="#quatro"><li class="inline-block mr-[30px]"><p class="text-[14px] text-[#333333] uppercase opacity-[0.9] border-b-[0px] pb-[10px] border-[#333333] hover:border-b-[1px] hover:opacity-[0.7]">Apps</p></li></a>
                        </ul>
                    </div>
                    <!-- NAVEGATION -->
                    {{-- <div id="bloco_top3" class="w-[33.3%] h-[100px] pt-[35px] inline-block float-left">
                        <a href="{{ route('principal') }}"><button id="bt_version" class="float-right w-[120px] h-[36px] rounded-[10px] bg-[#874645] text-[#ffffff] md:hidden">Web Version</button></a>
                    </div> --}}
                </div>
            </div>
        </header>
        @yield('content')
        <!-- FOOTER -->
        <footer class="bg-[#ffffff]">
            <div class="w-[90%] mx-auto my-[0px]">
                <div class="w-[100%] inline-block float-left">
                    <!-- LOGO -->
                    <div id="footer_menu1" class="w-[10.3%] h-[80px] float-left">
                        <img src="/img/logo_kasa.png" class="w-[60px] mt-[20px]" alt="Kasa Rosa">
                    </div>
                    <!-- MENU -->
                    <div id="footer_menu2" class="w-[56.3%] h-[80px] float-left">
                        <ul class="mt-[30px]">
                            <a href="#um"><li class="inline-block mr-[30px]"><p class="13px text-[#212121] uppercase">Espaço</p></li></a>
                            <a href="#dois"><li class="inline-block mr-[30px]"><p class="13px text-[#212121] uppercase">CoWomen</p></li></a>
                            <a href="#tres"><li class="inline-block mr-[30px]"><p class="13px text-[#212121] uppercase">Serviços</p></li></a>
                            <a href="#ultra"><li class="inline-block mr-[30px]"><p class="13px text-[#212121] uppercase">Programação</p></li></a>
                            <a href="#quatro"><li class="inline-block mr-[30px]"><p class="13px text-[#212121] uppercase">Apps</p></li></a>
                            <a href="{{ route('dashboard') }}"><li class="inline-block mr-[30px]"><p class="13px text-[#212121] uppercase"></p></li></a>
                        </ul>
                    </div>
                    <!-- NAVEGATION -->
                    <div id="footer_menu3" class="w-[33.3%] h-[80px] float-left">
                        <ul class="float-right mt-[30px]">
                            <a href="#dois"><li class="inline-block mr-[18px]"><img class="w-[20px]" src="/img/instagram.png" alt="Instagram"></li></a>
                            <a href="#tres"><li class="inline-block mr-[18px]"><img class="w-[20px]" src="/img/whatsapp.png" alt="Whatsapp"></li></a>
                        </ul>
                    </div>
                </div>
                <!-- DIREITOS -->
                <div class="w-[100%] inline-block float-left">
                    <div class="w-[100%] h-[40px]">
                        <center><p class="text-[10px] mt-[15px] leading-[11px]">Todos os direitos reservados a kaza Rosa &copy; 2022 - Desenvolvido por Algorito Tech</p></center>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

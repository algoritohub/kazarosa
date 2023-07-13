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
        <div class="w-[100%] h-[25%] inline-block" style="background: url(/img/fundo_app2.png); background-size: 115%; background-position: center;">
            <section class="w-[100%]">
                <!-- PÁGINA DE ALERTA PARA DOWNLOAD -->
                <div id="exibir" class="w-[90%] px-[5%] h-[100vh] bg-[#fafafa]">
                    <div id="padding_bloco" class="w-[100%] inline-block">
                        <!-- LADO GERAL -->
                        <div class="w-[100%] h-[660px] float-left">
                            <div class="w-[100%] inline-block">
                                <!--  -->
                                <div id="total_w" class="w-[70%] float-left h-[660px] inline-block">
                                    <div class="w-[100%] h-[560px] inline-block">
                                        <!--  -->
                                        <div id="total_w" class="w-[50%] mt-[140px] float-left inline-block">
                                            <!--  -->
                                            <div class="mb-[30px] mt-[-30px] font-bold">Disponível para download em breve!</div>
                                            <p class="font-bold mt-[10px] text-[40px] leading-[38px]">Facilidades na palma da mão. </p>
                                            <p class="mt-[30px] text-[16px]">Nós acreditamos que sozinhas somos fortes, sim! Mas juntas, nos tornamos imbatíveis, imparáveis. Iremos ressignificar a forma como muitas mulheres fazem negócios. Com uma visão global e colaborativa, entendemos que a conexão genuína cria laços afetivos, alicerça a confiança e impulsiona os resultados.</p>
                                            <img class="w-[70%] mt-[30px] float-left w-[160px]" src="/img/android.png" alt="">
                                            <img class="w-[70%] mt-[30px] float-left w-[160px]" src="/img/apple.png" alt="">
                                        </div>
                                        <!--  -->
                                        <div id="total_ws" class="w-[50%] float-left inline-block">
                                            <img class="mt-[80px]" src="/img/celular.png" alt="">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="w-[80%] h-[100px] mx-[10%]">

                                    </div>
                                </div>
                                <!--  -->
                                <div id="qr" class="w-[30%] float-left h-[660px] px-[30px] inline-block">
                                    <div class="w-[100%] h-[560px] rounded-[20px] p-[40px] mt-[70px] bg-[#ffffff]">
                                        <!-- <button class="w-[150px] h-[40px] ml-[60px] mt-[110px] z-40 absolute text-[#ffffff] shadow-lg bg-[#333333]">Disponível em breve!</button> -->
                                        <img class="w-[100%]" src="/img/frame.png" alt="">
                                        <center>
                                            <p class="text-[13px] leading-[14px]">Experimente a vesão web mobile direto do seu celular, e aproveite todos os recusos do App!</p>
                                            <p class="mt-[20px] text-[#c5908f] font-bold text-[18px]">Agendamentos online</p>
                                            <p class="mt-[3px] text-[#c5908f] font-bold text-[18px]">Carteira virtual</p>
                                            <p class="mt-[3px] text-[#c5908f] font-bold text-[18px]">Eventos exclusivos</p>
                                            <p class="mt-[3px] text-[#c5908f] font-bold text-[18px]">Rede social exclusiva</p>
                                            <p class="mt-[20px] text-[10px] leading-[9px]">Aponte a câmera do seu celular e aproveite!</p>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  -->
            <header class="md:hidden">
                <div class="w-[100%] h-[41vh] mt-[0px]">
                    <!--  -->
                    <div class="w-[90%] mx-[5%] mt-[10px] inline-block">
                        <!--  -->
                        <div class="w-[50%] float-left h-[20px] inline-block"></div>
                        <!--  -->
                        <div class="w-[50%] float-left inline-block">
                            <!--  -->
                            <ul class="mt-[10px] float-right">
                                <!-- <li class="ml-[30px] inline-block"><button class="w-[20px] text-[10px] text-[#ffffff] ml-[10px] bg-[#A35554] h-[20px] mt-[-10px] rounded-[5px] absolute">1</button><img class="w-[22px] cursor-pointer" src="/img/carrinho.png"></li> -->
                            </ul>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[90%] h-[100%] mx-[auto]">
                        <!-- LOGO -->
                        <center><img class="w-[110px] mt-[10px] mb-[30px]" src="/img/Ativo 6.png" alt="Kasa Rosa"></center>
                        <!-- BUSCA GERAL -->
                        <form action="">
                            <input class="shadow-md w-[100%] h-[40px] outline-none rounded-[5px] pl-[15px] border-[1px]" type="text" name="buscador" placeholder="Busque por algo">
                            <input class="w-[18px] mt-[12px] ml-[-35px] absolute" type="image" src="/img/search.png">
                        </form>
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
        <div id="conteudo" class="w-[100%] h-[50vh] inline-block bg-[#fafafa] overflow-scroll md:hidden">
            @yield('content')
        </div>
        <!-- DIVISOR FOOTER -->
        <div class="w-[100%] h-[8vh] inline-block bg-transparent md:hidden">
            <!-- NAV -->
            <nav class="w-[100%] inline-block">
                <div class="w-[100%]">
                    <div class="w-[100%] px-[5%]">
                        <div class="w-[100%] mt-[15px] inline-block">
                            <!-- CARTEIRA -->
                            <div class="w-[20%] float-left inline-block"><a href="{{ route('agenda_lista') }}"><img class="w-[25px] mx-[auto]" src="/img/despertador.png" alt="Carteira"></a></div>
                            <!-- LISTA DE PACOTES -->
                            <div class="w-[20%] float-left inline-block"><a href="{{ route('meu_plano') }}"><img class="w-[25px] mx-[auto]" src="/img/estrela1.png" alt="Plano"></a></div>
                            <!-- HOME -->
                            <div class="w-[20%] float-left inline-block"><a href="{{ route('principal') }}"><img class="w-[25px] mx-[auto]" src="/img/aplicativos.png" alt="Home"></a></div>
                            <!-- FEED SOCIAL -->
                            <div class="w-[20%] float-left inline-block"><a href="{{ route('redes') }}"><img class="w-[25px] mx-[auto]" src="/img/coracao.png" alt="Rede"></a></div>
                            <!-- PERFIL -->
                            <div class="w-[20%] float-left inline-block"><a href="{{ route('perfil') }}"><img class="w-[25px] mx-[auto]" src="/img/do-utilizador.png" alt="Perfil"></a></div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</body>
</html>

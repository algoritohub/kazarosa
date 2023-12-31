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
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
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

{{-- BODY --}}
<body>
    {{-- DESKTOP --}}
    <main class="w-[100%] h-[100vh] bg-[blue]" id="desktop-page">
        <section class="modal-desktop">
            <div class="w-[90%] pt-[0px] mx-auto my-[0px]">
                <div id="padding_bloco" class="w-[100%] inline-block">
                    <!-- LADO GERAL -->
                    <div class="w-[100%] h-[100vh] float-left">
                        <div class="w-[100%] inline-block">
                            <!--  -->
                            <div id="total_wf" class="w-[70%] float-left h-[660px] inline-block">
                                <div class="w-[100%] h-[100vh] inline-block">
                                    <!--  -->
                                    <div id="total_wf" class="w-[50%] mt-[140px] float-left inline-block">
                                        <!--  -->
                                        <p class="font-bold mt-[10px] text-[40px] leading-[38px]">Facilidades na palma da mão. </p>
                                        <p class="mt-[30px] text-[16px]">Nós acreditamos que sozinhas somos fortes, sim! Mas juntas, nos tornamos imbatíveis, imparáveis. Iremos ressignificar a forma como muitas mulheres fazem negócios. Com uma visão global e colaborativa, entendemos que a conexão genuína cria laços afetivos, alicerça a confiança e impulsiona os resultados.</p>
                                        <div class="mt-[100px] font-bold">Instale a nova versão diretamente em seu dispositivo!</div>
                                        <div class="w-[100%] ml-[-10px] inline-block">
                                            <div class="w-[50%] float-left inline-block">
                                                <img class="mt-[30px] float-left w-[90%]" src="/img/android.png" alt="">
                                            </div>
                                            <div class="w-[50%] float-left inline-block">
                                                <img class="mt-[30px] float-left w-[90%]" src="/img/apple.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div id="total_ws" class="w-[50%] float-left inline-block">
                                        <img class="w-[85%] mt-[80px] mx-auto" src="/img/mockup_kaza_rosa_rodape.png" alt="">
                                    </div>
                                </div>
                                <!--  -->
                                <div class="w-[80%] h-[100px] mx-[10%]">

                                </div>
                            </div>
                            <!--  -->
                            <div id="qr" class="w-[30%] float-left h-[700px] px-[30px] inline-block">
                                <div class="w-[100%] inline-block border-[1px] rounded-[20px] p-[40px] mt-[70px] bg-[#ffffff]">
                                    <!-- <button class="w-[150px] h-[40px] ml-[60px] mt-[110px] z-40 absolute text-[#ffffff] shadow-lg bg-[#333333]">Disponível em breve!</button> -->
                                    <img class="w-[100%] border-[1px]" src="/img/frame.png" alt="">
                                    <center>
                                        <p class="text-[13px] mt-[20px] leading-[14px]">Experimente a nova vesão do app direto do seu celular, e aproveite todos os recusos do App!</p>
                                        <p class="mt-[20px] text-[#c5908f] font-bold text-[18px]">Muito mais leve</p>
                                        <p class="mt-[3px] text-[#c5908f] font-bold text-[18px]">Novos Recursos</p>
                                        <p class="mt-[3px] text-[#c5908f] font-bold text-[18px]">Coworking</p>
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
    </main>
    {{-- MOBILE --}}
    <main class="w-[100%] h-[100vh] inline-block" id="mobile-page">
        {{--  --}}
        <header class="w-[100%] py-[10px] inline-block mt-[-30px] bg-[#a55858] fixed" style="z-index: 1002;">
            <div class="w-[90%] mx-[5%] inline-block">
                <div class="w-[60%] float-left inline-block">
                    <a href="{{ route('app.principal') }}"><img class="w-[150px] mt-[15px]" src="/img/Ativo 12.png" alt="Kaza Rosa"></a>
                </div>
                <div class="w-[40%] float-left inline-block">
                    {{--  --}}
                    <div class="w-[100%] mt-[8px] inline-block">
                        {{-- <div class="w-[25.3%] mx-[1.5%] inline-block float-left">
                            <p class="text-center text-[#212121] text-[20px] mt-[16px]"><i class="fi fi-bs-search"></i></p>
                        </div> --}}
                        {{--  --}}
                        {{-- <div class="w-[25.3%] mx-[1.5%] inline-block float-left">
                            <p class="text-center text-[#212121] text-[22px] mt-[14px]"><i class="fi fi-bs-bells"></i></p>
                        </div> --}}
                        {{--  --}}
                        <div class="w-[100%] mx-[1.5%] inline-block float-left">
                            <a href="{{ route('app.perfil_now', ['id' => $user->nickname]) }}"><div class="w-[45px] h-[45px] mt-[5px] rounded-[100px] border-[1px] float-right" style="background: url('/img/usuario/{{ $user->imagem }}'); background-size: cover;"></div></a>
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
                            <a href="{{ route('app.configuracao') }}">
                                <p class="text-center text-[30px] text-[#212121]"><i class="fi fi-sr-settings"></i></p>
                                <p class="text-[10px] text-[#212121] text-center mt-[-2px]">Configurações</p>
                            </a>
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

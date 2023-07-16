<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <title>@yield('title')</title>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
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
<body class="bg-[#c5908f]">
    {{-- DESKTOP --}}
    <main class="w-[100%] h-[100vh] bg-[blue]" id="desktop-page">
        <!-- BLOCO DOWNLOAD -->
        <section class="bg-[#f1f1f1]">
            <div class="w-[90%] pt-[0px] mx-auto my-[0px]">
                <div id="padding_bloco" class="w-[100%] inline-block">
                    <!-- LADO GERAL -->
                    <div class="w-[100%] h-[700px] float-left">
                        <div class="w-[100%] inline-block">
                            <!--  -->
                            <div id="total_wf" class="w-[70%] float-left h-[660px] inline-block">
                                <div class="w-[100%] h-[560px] inline-block">
                                    <!--  -->
                                    <div id="total_wf" class="w-[50%] mt-[140px] float-left inline-block">
                                        <!--  -->
                                        <div class="mb-[30px] mt-[-30px] font-bold">Disponível para download em breve!</div>
                                        <p class="font-bold mt-[10px] text-[40px] leading-[38px]">Facilidades na palma da mão. </p>
                                        <p class="mt-[30px] text-[16px]">Nós acreditamos que sozinhas somos fortes, sim! Mas juntas, nos tornamos imbatíveis, imparáveis. Iremos ressignificar a forma como muitas mulheres fazem negócios. Com uma visão global e colaborativa, entendemos que a conexão genuína cria laços afetivos, alicerça a confiança e impulsiona os resultados.</p>
                                        <img class="w-[70%] mt-[30px] float-left w-[160px]" src="/img/android.png" alt="">
                                        <img class="w-[70%] mt-[30px] float-left w-[160px]" src="/img/apple.png" alt="">
                                    </div>
                                    <!--  -->
                                    <div id="total_ws" class="w-[50%] float-left inline-block">
                                        <img class="mt-[80px]" src="img/mockup_kaza_rosa_rodape.png" alt="">
                                    </div>
                                </div>
                                <!--  -->
                                <div class="w-[80%] h-[100px] mx-[10%]">

                                </div>
                            </div>
                            <!--  -->
                            <div id="qr" class="w-[30%] float-left h-[700px] px-[30px] inline-block">
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
    </main>
    {{-- MOBILE --}}
    <main class="bg-[#C5908F] mt-[-30px] w-[100%] px-[5%] h-[100vh] inline-block" id="mobile-page">
        <section class="w-[100%] h-[100vh] inline-block">
            @yield('content')
        </section>
    </main>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>
</body>
</html>




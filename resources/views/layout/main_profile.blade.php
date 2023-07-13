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
<body class="">
    <!-- DIVISOR GERAL -->
    <div class="w-[100%] h-[100%] inline-block">
        <!-- DIVISOR HEADER -->
        <div class="w-[100%] h-[25%] inline-block" style="background: linear-gradient(to bottom, #ffffff, #ffffff);">
            <section class="w-[100%]">
                <!-- PÁGINA DE ALERTA PARA DOWNLOAD -->
                <div class="w-[90%] mx-[auto]">
                    <div class="exibir">
                        <center><p class="mt-[200px]">Baixe nosso aplicativo para Android e IOS.</p></center>
                    </div>
                </div>
            </section>
            <!--  -->
            <header class="md:hidden">
                <div class="w-[100%] inline-block mb-[15px] mt-[0px]">
                    @php
                        // INFORMAÇÃO DO USUÁRIO
                        @$usuario = $nickname;
                        $info_usuario = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE nickname = '$usuario'");

                        $id_user  = $info_usuario[0]->id;

                        // INFORMAÇÃO NETWORKS
                        $info_net = Illuminate\Support\Facades\DB::select("SELECT * FROM networks WHERE usuario = '$id_user'");
                        $cont_pst = count($info_net);

                        // VERIFICAR SEGUIDOS
                        $info_seg = Illuminate\Support\Facades\DB::select("SELECT * FROM conexao_seguirs WHERE seguidor = '$id_user'");
                        $cont_seg = count($info_seg);

                        // VERIFICAR SEGUIDORES
                        $info_ser = Illuminate\Support\Facades\DB::select("SELECT * FROM conexao_seguirs WHERE usuario = '$id_user'");
                        $cont_ser = count($info_ser);

                    @endphp
                    <div class="w-[90%] mx-[5%] inline-block">
                        <!--  -->
                        <div class="w-[100%] inline-block">
                            <center><p class="font-bold text-[15px] mt-[20px]">{{ $info_usuario[0]->nickname }}</p></center>
                            <hr class="my-[15px]">
                        </div>
                        <!--  -->
                        <div class="w-[100%] inline-block">
                            <!--  -->
                            <div class="w-[30%] float-left">
                                <!--  -->
                                <div id="add_img" class="w-[100px] cursor-pointer h-[100px] bg-[#eeeeee] border-[3px] border-[#C5908F] rounded-[100px]" style="background: url(/img/usuario/{{ $info_usuario[0]->imagem }}); background-size: 100%;"></div>
                            </div>
                            <!--  -->
                            <div class="w-[70%] float-left">
                                <!--  -->
                                <div class="w-[100%] mt-[25px] inline-block">
                                    <!--  -->
                                    <div class="w-[33.3%] inline-block float-left">
                                        <!--  -->
                                        <center>
                                            <!--  -->
                                            <p class="font-bold text-[18px]">{{ $cont_pst }}</p>
                                            <!--  -->
                                            <p class="text-[12px]">Posts</p>
                                        </center>
                                    </div>
                                    <!--  -->
                                    <div class="w-[33.3%] inline-block float-left">
                                        <!--  -->
                                        <center>
                                            <!--  -->
                                            <p class="font-bold text-[18px]">{{ $cont_ser }}</p>
                                            <!--  -->
                                            <p class="text-[12px]">Seguidoras</p>
                                        </center>
                                    </div>
                                    <!--  -->
                                    <div class="w-[33.3%] inline-block float-left">
                                        <!--  -->
                                        <center>
                                            <!--  -->
                                            <p class="font-bold text-[18px]">{{ $cont_seg }}</p>
                                            <!--  -->
                                            <p class="text-[12px]">Seguindo</p>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="w-[100%] mt-[10px] inline-block">
                            <!--  -->
                            <p class="text-[17px] font-bold">{{ $info_usuario[0]->nome }}</p>
                            <!--  -->
                            @if($info_usuario[0]->atuacao)
                            <p class="text-[12px] mt-[-4px] text-[#C5908F]">{{ $info_usuario[0]->atuacao }}</p>
                            @endif
                            <!--  -->
                            @if($info_usuario[0]->bio)
                            <p class="text-[13px]">{{ $info_usuario[0]->bio }}</p>
                            @endif
                            <!--  -->
                            @if($info_usuario[0]->link)
                            <a href="https://{{ $info_usuario[0]->link }}" target="_blank"><p class="text-[13px] text-[#C5908F]">{{ $info_usuario[0]->link }}</p></a>
                            @endif
                        </div>
                        <!--  -->
                        <div class="w-[100%]">
                            <!--  -->
                            @php
                                // VERIFICAR SEGUIDOS
                                $user_session = session('usuario')['id'];

                                $ver_seguir = Illuminate\Support\Facades\DB::select("SELECT * FROM conexao_seguirs WHERE seguidor = '$user_session' AND usuario = '$id_user'");
                            @endphp
                            <!--  -->
                            <ul class="w-[100%] mt-[20px]">
                                @if ($user_session != $id_user)
                                    @if(!$ver_seguir)
                                    <li class="inline-block mr-[10px] w-[100%]"><a href="{{ route('seguir', ['id' => $id_user]) }}"><button class="w-[100%] h-[35px] rounded-[8px] border-[1px] bg-[#eeeeee] text-[#333333]">Seguir</button></a></li>
                                    @elseif($ver_seguir)
                                    <li class="inline-block mr-[10px] w-[100%]"><a href="{{ route('deixarDeSeguir', ['id' => $ver_seguir[0]->id]) }}"><button class="w-[100%] h-[35px] rounded-[8px] border-[1px] bg-[#eeeeee] text-[#333333]">Deixar de seguir</button></a></li>
                                    @endif
                                @else
                                    <li class="inline-block mr-[10px] w-[100%]"><button class="w-[100%] h-[35px] rounded-[8px] border-[1px] bg-[#eeeeee] text-[#333333]">Aqui é você</button></li>
                                @endif
                            </ul>
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
        <div id="conteudo" class="w-[100%] h-[40vh] inline-block bg-[#fafafa] overflow-scroll">
            @yield('content')
        </div>
        <!-- DIVISOR FOOTER -->
        <div class="w-[100%] h-[8vh] inline-block bg-transparent">
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

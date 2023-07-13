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
        <div class="w-[100%] h-[25%] inline-block" style="background: linear-gradient(to bottom, #C5908F, #ffffff);">
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
                <div class="w-[100%] h-[12vh] mt-[0px]">
                    <div class="w-[90%] mx-[5%] inline-block">
                        <div class="w-[100%] mt-[20px] inline-block">
                            <!--  -->
                            <div class="w-[70%] float-left">
                                <img src="/img/cowoman.png" class="w-[40px] float-left mr-[5px]"><p class="font-bold text-[25px] text-[#333333] float-left">Co-Women</p>
                            </div>
                            <!--  -->
                            <div class="w-[30%] float-left">
                                <!--  -->
                                <img src="/img/adicionar.png" id="publicar" class="float-right cursor-pointer mt-[4px] w-[25px]">
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div style="scrollbar-width: none;" class="w-[100%] inline-block mt-[50px] mb-[5px] overflow-scroll">
                        <!-- CONEXÃO PDO -->
                        @php

                        $sessao_id    = session('usuario')['id'];

                        // RESGATE DE INFORMAÇÕES DO ADMINISTRADOR
                        $info_usuario = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id != '$sessao_id'");
                        $contagem_usr = count($info_usuario);

                        // RESGATAR USUARIO PRINCIPAL
                        $prin_usuario = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$sessao_id'");
                        $contagem_pnc = count($prin_usuario);

                        $nomexh       = $prin_usuario[0]->nome;
                        $new_nomexh   = explode(" ", $nomexh);
                        $prim_nomexh  = $new_nomexh[0];

                        // DEFININDO LARGURA DINÂMICA
                        $tamanho = ($contagem_usr * 73) + 146;

                        @endphp
                        <!--  -->
                        <div style="width: <?php echo $tamanho; ?>px; padding: 0px 15px;" class="inline-block">
                            <ul>
                                <li class='inline-block mr-[10px]'>
                                    <a href="{{ route('profile', ['id' => $prin_usuario[0]->nickname]) }}">
                                    <div class='w-[60px] h-[60px] rounded-[100px] border-[3px] border-[#C5908F] bg-[#333333]' title="{{ $prin_usuario[0]->nome }}" style="background: url(/img/usuario/{{ $prin_usuario[0]->imagem }}); background-size: 100%;">
                                        <!--  -->
                                        <center><p class="text-[9px] mt-[60px]">{{ $prim_nomexh }}</p></center>
                                    </div></a>
                                </li>
                                @if($contagem_usr > 0)
                                    @foreach($info_usuario as $usuario_list)
                                    @php
                                        $nomek     = $usuario_list->nome;
                                        $new_nome  = explode(" ", $nomek);
                                        $prim_nome = $new_nome[0];
                                    @endphp
                                    <!--  -->
                                    <li class='inline-block mr-[10px]'>
                                        <!--  -->
                                        <a href="{{ route('profile', ['id' => $usuario_list->nickname]) }}">
                                        <div class='w-[60px] h-[60px] rounded-[100px] border-[3px] border-[#C5908F] bg-[#333333]' title="{{ $usuario_list->nome }}" style="background: url(/img/usuario/{{ $usuario_list->imagem }}); background-size: 100%;">
                                            <!--  -->
                                            <center><p class="text-[9px] mt-[60px]">{{ $prim_nome }}</p></center>
                                        </div></a>
                                    </li>
                                    @endforeach
                                @else
                                    <li class='inline-block mr-[10px]'><div class='w-[60px] h-[60px] rounded-[100px] bg-[#333333]'><center><p class="text-[#ffffff] text-[35px]">+</p></center></div></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    {{-- MODAL DE BLOQUEIO --}}
                    @if (isset($block) AND !empty($block))
                    {{--  --}}
                    <div class="modal_bloqueio">
                        {{--  --}}
                        <center>
                            {{--  --}}
                            <div class="w-[100%] mx-auto inline-block p-[40px]">
                                {{--  --}}
                                <img src="/img/Ativo 6.png" class="w-[50%] mt-[30%] mr-[5px]">
                                {{--  --}}
                                <p class="text-[#ffffff] mt-[30%]">Parabéns por você fazer parte do nosso Ecossistema Empreendedor Feminino. Acesse agora mesmo a nossa Rede de Negócios Digital Co-Women e se conecte com mulheres empreendedoras..</p>
                                {{--  --}}
                                <p class="text-[#ffffff] mt-[15px]">Escolha um de nossos planos para ter acesso a Rede Co-woman.</p>
                                {{--  --}}
                                <a href="{{ route('principal') }}"><button class="w-[100%] inline-block bg-[#ffffff] mt-[30px] h-[40px] rounded-[8px]">Escolha seu plano</button></a>
                            </div>
                        </center>
                    </div>
                    @endif
                    {{-- MODAL DE BLOQUEIO --}}
                    @if (isset($block_plan) AND !empty($block_plan))
                    {{--  --}}
                    <div class="modal_bloqueio">
                        {{--  --}}
                        <center>
                            {{--  --}}
                            <div class="w-[100%] mx-auto inline-block p-[40px]">
                                {{--  --}}
                                <img src="/img/Ativo 6.png" class="w-[50%] mt-[30%] mr-[5px]">
                                {{--  --}}
                                <p class="text-[#ffffff] text-[16px] leading-[18px] mt-[40%]">Você já pode ter acesso a nossa rede exclusiva.</p>
                                {{--  --}}
                                {{-- <p class="text-[#333333] mt-[30px]">Acesse o painel do seu plano para desbloquear.</p> --}}
                                {{--  --}}
                                <a href="{{ route('meu_plano') }}"><button class="w-[100%] inline-block bg-[#ffffff] mt-[25px] h-[40px] rounded-[8px]">Desbloquear acesso</button></a>
                            </div>
                        </center>
                    </div>
                    @endif
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
        <div id="conteudo" class="w-[100%] h-[66vh] inline-block bg-[#fafafa] overflow-scroll">
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

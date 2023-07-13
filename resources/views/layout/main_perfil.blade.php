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
                    <!-- CONEXÃO PDO -->
                    <?php

                    $name_banco = env('PDO_BANCO');
                    $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
                    $name_user = env('PDO_USER');
                    $pass_banco = env('PDO_SENHA');

                    $conn = new PDO($conectDB, $name_user, $pass_banco);

                    @$usuario = session('usuario')['id'];

                    $stmt = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
                    $stmt->execute(array('id' => $usuario));
                    $result = $stmt->fetchAll();

                    foreach($result as $user) {};

                    //
                    $stmt5 = $conn->prepare('SELECT * FROM networks WHERE usuario = :id');
                    $stmt5->execute(array('id' => $usuario));
                    $result5 = $stmt5->fetchAll();
                    $contagem5 = count($result5);

                    // VERIFICAR SEGUIDOS
                    $stmt6 = $conn->prepare('SELECT * FROM conexao_seguirs WHERE seguidor = :id');
                    $stmt6->execute(array('id' => $user['id']));
                    $result6 = $stmt6->fetchAll();
                    $contagem6 = count($result6);

                    // VERIFICAR SEGUIDORES
                    $stmt33 = $conn->prepare('SELECT * FROM conexao_seguirs WHERE usuario = :id');
                    $stmt33->execute(array('id' => $user['id']));
                    $result33 = $stmt33->fetchAll();
                    $contagem33 = count($result33);

                    ?>
                    <div class="w-[90%] mx-[5%] inline-block">
                        <!--  -->
                        <div class="w-[100%] inline-block">
                            <center><p class="font-bold text-[15px] mt-[20px]">{{ $user['nickname'] }}</p></center>
                            <hr class="my-[15px]">
                        </div>
                        <!--  -->
                        <div class="w-[100%] inline-block">
                            <!--  -->
                            <div class="w-[30%] float-left">
                                <!--  -->
                                <div id="add_img" class="w-[100px] cursor-pointer h-[100px] bg-[#eeeeee] border-[3px] border-[#C5908F] rounded-[100px]" style="background: url(/img/usuario/{{ $user['imagem'] }}); background-size: 100%;"></div>
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
                                            <p class="font-bold text-[18px]">{{ $contagem5 }}</p>
                                            <!--  -->
                                            <p class="text-[12px]">Posts</p>
                                        </center>
                                    </div>
                                    <!--  -->
                                    <div class="w-[33.3%] inline-block float-left">
                                        <!--  -->
                                        <center>
                                            <!--  -->
                                            <p id="seguidoras" class="font-bold text-[18px] cursor-pointer">{{ $contagem33 }}</p>
                                            <!--  -->
                                            <p class="text-[12px]">Seguidoras</p>
                                        </center>
                                    </div>
                                    <!--  -->
                                    <div class="w-[33.3%] inline-block float-left">
                                        <!--  -->
                                        <center>
                                            <!--  -->
                                            <p id="seguindo" class="font-bold text-[18px] cursor-pointer">{{ $contagem6 }}</p>
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
                            <p class="text-[17px] font-bold">{{ $user['nome'] }}</p>
                            <!--  -->
                            @if($user['atuacao'])
                            <p class="text-[12px] mt-[-4px] text-[#C5908F]">{{ $user['atuacao'] }}</p>
                            @endif
                            <!--  -->
                            @if($user['bio'])
                            <p class="text-[13px]">{{ $user['bio'] }}</p>
                            @endif
                            <!--  -->
                            @if($user['link'])
                            <p class="text-[13px] text-[#C5908F]">{{ $user['link'] }}</p>
                            @endif
                        </div>
                        <!--  -->
                        <div class="w-[100%] mt-[20px] inline-block">
                            <!--  -->
                            <div class="w-[49%] mr-[1%] inline-block float-left">
                                <!--  -->
                                <button id="bt_edtr" class="w-[100%] h-[40px] rounded-[8px] border-[1px] bg-[#eeeeee] text-[#333333]">Editar</button>
                            </div>
                            <!--  -->
                            <div class="w-[49%] ml-[1%] inline-block float-left">
                                <!--  -->
                                <a href="{{ route('logout') }}"><button class="w-[100%] h-[40px] rounded-[8px] border-[1px] bg-[#eeeeee] text-[#333333]">Sair</button></a>
                            </div>
                            <!--  -->
                            <button id="inform" class="w-[100%] h-[40px] rounded-[10px] border-[1px] bg-[#eeeeee] mt-[10px]">Adicionar informações</button>
                        </div>
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
                            <p class="text-[#ffffff] mt-[30%]">Parabéns por você fazer parte do nosso Ecossistema Empreendedor Feminino. Acesse agora mesmo a nossa Rede de Negócios Digital Co-Women e se conecte com mulheres empreendedoras.</p>
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
                            <p class="text-[#ffffff] text-[14px] leading-[15px] mt-[40%]">Você já pode ter acesso a nossa rede exclusiva.</p>
                            {{--  --}}
                            <a href="{{ route('meu_plano') }}"><button class="w-[100%] inline-block bg-[#ffffff] mt-[25px] h-[40px] rounded-[8px]">Desbloquear acesso</button></a>
                        </div>
                    </center>
                </div>
                @endif
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
        <div id="conteudo" class="w-[100%] h-[36vh] inline-block bg-[#fafafa] overflow-scroll">
            @yield('content')
        </div>
        <!-- DIVISOR FOOTER -->
        <div class="w-[100%] h-[8vh] inline-block bg-transparent">
            <!-- NAV -->
            <nav class="w-[100%] inline-block">
                <!--  -->
                <div class="w-[100%]">
                    <!--  -->
                    <div class="w-[100%] px-[5%]">
                        <!--  -->
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

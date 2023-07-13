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
        <div class="w-[100%] h-[25%] inline-block bg-[#C5908F]">
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
                <div class="w-[100%] h-[30vh] mt-[0px]">
                    <div class="w-[90%] h-[100%] mx-[auto]">
                        <!-- PDO -->
                        <?php  

                        $usuario_carrinho = session('usuario')['id']; 
                        $usuario_imagem = session('usuario')['imagem']; 

                        ?>
                        <div class="w-[100%] h-[60px]"></div>
                        <!-- AVATAR -->
                        <div id="new_img" class="w-[120px] h-[120px] rounded-[100px] bg-[#333333]" style="background: url(/img/usuario/{{ $usuario_imagem }}); background-size: 100%;"></div>
                        <!-- NOME -->
                        <p class="font-bold absolute mt-[-75px] ml-[130px] text-[17px]">{{ session('usuario')['nome'] }}</p>
                        <p class="absolute mt-[-55px] ml-[130px] text-[14px]">{{ session('usuario')['cidade'] }}-{{ session('usuario')['estado'] }}</p>
                    </div> 
                </div>
                <!-- MODAL -->
                <div class="modal_img">
                    <!--  -->
                    <div class="w-[80%] p-[30px] mx-[10%] inline-block shadow-lg bg-[#ffffff] mt-[20%]">
                        <div class="w-[100%] inline-block">
                            <!--  -->
                            <p id="fechar" class="float-right cursor-pointer">✕</p>
                            <!--  -->
                            <div id="new_img" class="w-[120px] mx-[auto] cursor-pointer h-[120px] rounded-[100px] bg-[#333333]" style="background: url(/img/usuario/{{ $usuario_imagem }}); background-size: 100%;"></div>
                            <!-- TROCAR FOTO -->
                            <center>
                                <p class="mt-[10px]">Carregue uma nova imagem de perfil!</p>
                                 <!--  -->
                                <form action="/php/upload_img.php" method="POST" enctype="multipart/form-data">
                                    <br><br>
                                    <label for="foto" class="px-[30px] py-[10px] bg-[#333333] text-[#ffffff] rounded-[10px]">Procurar imagem</label>
                                    <input style="display: none;" id="foto" type="file" name="imagem">
                                    <!--  -->
                                    <input type="hidden" value="{{ $usuario_carrinho }}" name="id">
                                    <br><br>
                                    <!--  -->
                                    <button class="w-[100%] h-[40px] text-[#212121]">Trocar imagem</button>
                                </form>
                            </center>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <!-- DIVISOR BODY -->
        <div class="w-[100%] h-[60vh] inline-block overflow-scroll">
            @yield('content')
        </div>
        <!-- DIVISOR FOOTER -->
        <div class="w-[100%] h-[8vh] inline-block bg-transparent">
            <!-- NAV -->
            <nav class="w-[100%] inline-block">
                <div class="w-[100%]">
                    <div class="w-[100%] px-[5%]">
                        <a href="/feed"><button class="w-[100%] h-[40px] rounded-[10px] bg-[#333333] text-[#ffffff]">Voltar</button></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</body>
</html>
@extends('layout.main_profile')
@section('title', 'Kaza Rosa | Perfil')
@section('titulo_pack', 'Perfil')

@section('content')
<!-- ESPAÇOS -->
<section class="md:hidden">
    <!--  -->
    <div class="w-[100%] my-[0px]">
        <!--  -->
        <?php

        $name_banco = env('PDO_BANCO');
        $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
        $name_user = env('PDO_USER');
        $pass_banco = env('PDO_SENHA');

        $conn = new PDO($conectDB, $name_user, $pass_banco);

        @$usuario = $nickname;

        $stmt = $conn->prepare('SELECT * FROM usuarios WHERE nickname = :id');
        $stmt->execute(array('id' => $usuario));
        $result = $stmt->fetchAll();

        foreach($result as $user) {};

        ?>
        <!--  -->
        <div class="w-[90%] py-[10px] mx-[5%] inline-block">
            <!--  -->
            <ul>
                <!--  -->
                <li id="pub" class="inline-block mr-[30px] cursor-pointer"><img src="/img/rede.png" class="mt-[1px] w-[16px] float-left"><p class="float-left ml-[10px]">Publicações</p></li>
            </ul>
        </div>
        <!--  -->
        <div id="publics" class="w-[100%] inline-block">
            <?php

            $stmt1 = $conn->prepare('SELECT * FROM networks WHERE usuario = :id ORDER BY datas DESC');
            $stmt1->execute(array('id' => $user['id']));
            $result1 = $stmt1->fetchAll();
            $contagem1 = count($result1);

            ?>
            <!--  -->
            @if($contagem1 > 0)
            @foreach($result1 as $user1)
            <!--  -->
            <a href="{{ route('post_profile', ['id' => $nickname, 'post' => $user1['id']]) }}"><div class="w-[32.5%] mb-[3px] h-[110px] mx-[0.4%] float-left bg-[silver]" style="background: url(/img/feed/{{ $user1['postagem'] }}); background-size: 130%; background-position: center;"></div></a>
            @endforeach
            @else
            <center>
                <p class="mt-[25%]">{{ $user['nome'] }} ainda não publicou!</p>
            </center>
            @endif
        </div>
        <!--  -->
        <div class="w-[100%] inline-block">
            @if(isset($post) AND !empty($post))
            <div class="modal_post_ver">
                <div style="border-radius: 0px 0px 25px 25px;" class="w-[100%] pb-[20px] overflow-scroll bg-[#ffffff] shadow-lg mt-[0%] h-[550px]">
                    <!-- POSTAGEM -->
                    <?php

                    $postagem = $post;

                    $stmtx = $conn->prepare('SELECT * FROM networks WHERE id = :idx');
                    $stmtx->execute(array('idx' => $postagem));
                    $resultx = $stmtx->fetchAll();

                    foreach($resultx as $row) {}

                    ?>
                    <!--  -->
                    <div class="w-[100%] mt-[20px] mb-[10px] inline-block">
                        <!--  -->
                        <div class="w-[90%] mb-[10px] mx-[5%]">
                            <!--  -->
                            <div class="w-[60%] float-left inline-block">
                                <!--  -->
                                <div class="w-[45px] h-[45px] border-[3px] border-[#C5908F] rounded-[100px] bg-[silver] float-left" style="background: url(/img/usuario/{{ $user['imagem'] }}); background-size: 100%;"></div>
                                <!--  -->
                                <p class="float-left ml-[10px] mt-[13px] text-[13px]">{{ $user['nome'] }}</p>
                            </div>
                            <!--  -->
                            <div class="w-[40%] float-left inline-block"><p class="mt-[15px] float-right"></p></div>
                        </div>
                        <!--  -->
                        <div class="w-[100%] mt-[10px] inline-block">
                            <img src="/img/feed/{{ $row['postagem'] }}" class="w-[100%]">
                        </div>
                        <!--  -->
                        <div class="w-[90%] mx-[5%] pt-[5px] inline-block">
                            <!--  -->
                            <div class="w-[30%] float-left inline-block">
                                <!--  -->
                                <a href="{{ route('curtidas_feed', ['id' => $row['id']]) }}">
                                    <button class="float-left px-[10px] py-[5px] border-[1px] bg-[#eeeeee] rounded-[5px]">
                                        <img src="/img/coracao.png" class="float-left cursor-pointer mr-[5px] w-[20px]">
                                        <p class="float-left">{{ $row['curtidas'] }}</p>
                                    </button>
                                </a>
                                <!--  -->
                            </div>
                            <!--  -->
                            <div class="w-[70%] float-left inline-block">
                                <!--  -->
                                <?php

                                $data_pub = $row['datas'];
                                $separar_data = explode(" ", $data_pub);
                                $dia_separado = $separar_data[0];
                                $new_data = explode("-", $dia_separado);

                                $new_ano = $new_data[0];
                                $new_mes = $new_data[1];
                                $new_dia = $new_data[2];

                                if ($new_mes == "01") {
                                    $nome_mes = "janeiro";
                                }

                                if ($new_mes == "02") {
                                    $nome_mes = "fevereiro";
                                }

                                if ($new_mes == "03") {
                                    $nome_mes = "março";
                                }

                                if ($new_mes == "04") {
                                    $nome_mes = "abril";
                                }

                                if ($new_mes == "05") {
                                    $nome_mes = "maio";
                                }

                                if ($new_mes == "06") {
                                    $nome_mes = "junho";
                                }

                                if ($new_mes == "07") {
                                    $nome_mes = "julho";
                                }

                                if ($new_mes == "08") {
                                    $nome_mes = "agosto";
                                }

                                if ($new_mes == "09") {
                                    $nome_mes = "setembro";
                                }

                                if ($new_mes == "10") {
                                    $nome_mes = "outubro";
                                }

                                if ($new_mes == "11") {
                                    $nome_mes = "novembro";
                                }

                                if ($new_mes == "12") {
                                    $nome_mes = "dezembro";
                                }

                                ?>
                                <p class="text-[11px] text-[#333333] float-right">{{ $new_dia }} de {{ $nome_mes }} de {{ $new_ano }}</p>
                            </div>
                        </div>
                        <!--  -->
                        <div class="w-[90%] mx-[5%] mt-[10px] inline-block">
                            <!--  -->
                            <p class="text-[12px]">{{ $row['descricao'] }}</p>
                        </div>
                    </div>
                    <!--  -->
                    @if($row['usuario'] == session('usuario')['id'])
                    <a href="{{ route('deletar_post', ['id' => $row['id']]) }}"><button class="w-[90%] mt-[10px] mx-[5%] h-[40px] rounded-[8px] border-[1px] bg-[#333333] text-[#ffffff]">Excluir publicação</button></a>
                    @endif
                    <!--  -->
                    <center><a href="{{ route('profile', ['id' => $nickname]) }}"><p class="text-[14px] mt-[15px]">Voltar</p></a></center>
                </div>
            </div>
            @endif
        </div>
        <!--  -->
        <div id="vantags" style="display: none;" class="w-[90%] mx-[5%] inline-block">
            <!--  -->
            <div class="w-[100%] mt-[20px] inline-block">
                <!--  -->
                <div class="w-[24%] float-left inline-block">
                    <!--  -->
                    <div class="w-[60px] h-[60px] rounded-[100px] bg-[#cdcdcd]"></div>
                </div>
                <!--  -->
                <div class="w-[76%] float-left inline-block">
                    <!--  -->
                    <p class="text-[17px] font-bold mt-[10px]">30% de desconto</p>
                    <!--  -->
                    <p class="text-[10px]">Vantagem exclusivas para mulheres do RN</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

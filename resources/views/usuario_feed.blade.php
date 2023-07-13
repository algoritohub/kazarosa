@extends('layout.main_post')
@section('title', 'Kaza Rosa | Feed')
@section('titulo_pack', 'Alterar senha')
@section('sub_titulo_pack', 'Kênia')

@section('content')
<!-- ESPAÇOS -->
<section class="md:hidden">
    <div class="w-[100%] my-[0px]">
        <!-- CONEXÃO PDO -->
        <?php

        $name_banco = env('PDO_BANCO');
        $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
        $name_user = env('PDO_USER');
        $pass_banco = env('PDO_SENHA');

        $conn = new PDO($conectDB, $name_user, $pass_banco);

        $url = $_SERVER["REQUEST_URI"];
        $xxx = explode("/", $url);

        $usuario_feed = $xxx[2];

        $stmt = $conn->prepare('SELECT * FROM networks WHERE usuario = :id');
        $stmt->execute(array('id' => $usuario_feed));

        $result = $stmt->fetchAll();

        if (count($result)) {
            foreach($result as $row) {

                $usuario   = $row['usuario'];

                $stmtx = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
                $stmtx->execute(array('id' => $usuario));

                $resultx = $stmtx->fetchAll();

                foreach($resultx as $rowx) {}
            }
        }
        ?>

        @if(count($result))
        <div class="w-[100%] px-[5%] inline-block">
            <!-- CONTEÚDO -->
            <div class="w-[100%] mt-[30px] inline-block">
                <!--  -->
                <div class="float-left inline-block w-[10%]">
                    <div class="w-[30px] h-[30px] rounded-[100px]" style="background: url(/img/usuario/{{ $rowx['imagem'] }}); background-size: 100%;"></div>
                </div>
                <!--  -->
                <div class="float-left inline-block w-[88%] mt-[5px] pl-[2%]">
                    <p class="text-[#212121]">{{ $rowx['nome'] }}</p>
                </div>
            </div>
            <!--  -->
            <!-- IMGAEM -->
            <div class="w-[100%] h-[220px] mb-[10px] bg-[#ffffff] mt-[10px] rounded-[5px]" style="background: url(/img/feed/{{ $row['postagem'] }}); background-size: 100%;"></div>
            <!-- BUTTONS -->
            <div class="w-[100%] inline-block">
                <ul>
                    <li class="inline-block"><a href="/php/like.php?id={{ $row['id'] }}"><p>❤</p></a></li>
                    <li class="inline-block"><p class="">{{ $row['curtidas'] }}</p></li>
                </ul>
            </div>
            <!-- COMENTÁRIOS -->
            <div class="w-[100%] mt-[20px] inline-block">
                <p>{{ $row['descricao'] }}</p>
            </div>
        </div>
        @else
        <center><p class='mt-[250px]'>Sem postagens recentes deste usuário!</p></center>
        @endif
    </div>
</section>
@endsection

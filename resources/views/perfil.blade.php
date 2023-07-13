@extends('layout.main_perfil')
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

        @$usuario = session('usuario')['id'];

        $stmt = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
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
                <!--  -->
                <li id="van" style="display: none;" class="inline-block mr-[30px] cursor-pointer"><img src="/img/brilhos.png" class="mt-[1px] w-[16px] float-left"><p class="float-left ml-[10px]">Vantagens</p></li>
            </ul>
        </div>
        <!--  -->
        <div id="publics" class="w-[100%] inline-block">
            <?php

            $stmt1 = $conn->prepare('SELECT * FROM networks WHERE usuario = :id ORDER BY datas DESC');
            $stmt1->execute(array('id' => $usuario));
            $result1 = $stmt1->fetchAll();
            $contagem1 = count($result1);

            ?>
            <!--  -->
            @if($contagem1 > 0)
            @foreach($result1 as $user1)
            <!--  -->
            <a href="{{ route('ver_post', ['id' => $user1['id']]) }}"><div class="w-[32.5%] mb-[3px] h-[110px] mx-[0.4%] float-left bg-[silver]" style="background: url(/img/feed/{{ $user1['postagem'] }}); background-size: 130%; background-position: center;"></div></a>
            @endforeach
            @else
            <center>
                <p class="mt-[20%]">Publique sua primeira postagem</p>
                <!--  -->
                <a href="{{ route('redes') }}"><button class="px-[30px] mt-[20px] h-[40px] bg-[#333333] text-[#ffffff] rounded-[8px]">publicar agora</button></a>
            </center>
            @endif
        </div>
        <!--  -->
        <div class="w-[100%] inline-block">
            @if(isset($ver) AND !empty($ver))
            <div class="modal_post_ver">
                <div style="border-radius: 0px 0px 25px 25px;" class="w-[100%] h-[500px] overflow-scroll bg-[#ffffff] shadow-lg mt-[0%] inline-block pb-[30px]">
                    <!-- POSTAGEM -->
                    <?php

                    $postagem = $ver;

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
                            <div class="w-[100%] inline-block">
                                <!--  -->
                                <div class="w-[45px] h-[45px] border-[3px] border-[#C5908F] rounded-[100px] bg-[silver] float-left" style="background: url(/img/usuario/{{ $user['imagem'] }}); background-size: 100%;"></div>
                                <!--  -->
                                <p class="float-left ml-[10px] mt-[13px] text-[13px]">{{ $user['nome'] }}</p>
                            </div>
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
                                <a href=""><img src="/img/coracao.png" class="float-left cursor-pointer w-[20px]"></a>
                                <!--  -->
                                <p class="mt-[2px] float-left text-[11px] ml-[10px]">{{ $row['curtidas'] }} curtidas</p>
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
                    <a href="{{ route('deletar_post', ['id' => $row['id']]) }}"><button class="w-[90%] mt-[10px] mx-[5%] h-[40px] rounded-[8px] border-[1px] bg-[#333333] text-[#ffffff]">Excluir publicação</button></a>
                    <!--  -->
                    <center><a href="{{ route('perfil') }}"><p class="text-[14px] mt-[15px]">Voltar</p></a></center>
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
        <!--  -->
        <div class="modal_inform">
            <!--  -->
            <div style="border-radius: 0px 0px 25px 25px;" class="w-[100%] px-[30px] pt-[30px] pb-[60px] bg-[#ffffff] shadow-md mt-[0%] inline-block">
                <!--  -->
                <div class="w-[100%] inline-block"><p id="fechar_inform" class="float-right cursor-pointer">✕</p></div>
                <!--  -->
                <p class="font-bold text-[20px]">Informações do perfil</p>
                <!--  -->
                <p class="text-[15px] mt-[20px] leading-[17px] text-[#cdcdcd]">Adiocione informações como, atuação profissional, biografia e links.</p>
                <!--  -->
                <div class="w-[100%] mt-[40px] inline-block">
                    <!--  -->
                    <form action="{{ route('informacao', ['id' => $user['id']]) }}" method="POST">
                        @csrf
                        <table class="w-[100%]">
                            <!--  -->
                            <tr>
                                <td>
                                    <input class="w-[100%] h-[40px] bg-[#eeeeee] pl-[10px] mb-[10px] outline-none rounded-[10px] border-[1px]" placeholder="Atuação profissional (opcional)" type="text" value="{{ $user['atuacao'] }}" name="atuacao">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <textarea class="w-[100%] mt-[5px] border-[1px] h-[100px] mb-[5px] p-[10px] outline-none bg-[#eeeeee] rounded-[8px]" placeholder="Escreva uma biografia " name="bio">{{ $user['bio'] }}</textarea>
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <input class="w-[100%] h-[40px] bg-[#eeeeee] mt-[10px] pl-[10px] outline-none rounded-[10px] border-[1px]" placeholder="Link externo EX.: www.exemplo.com" type="text" value="{{ $user['link'] }}" name="link">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <input class="w-[100%] h-[40px] bg-[#eeeeee] mt-[10px] pl-[10px] outline-none rounded-[10px] border-[1px]" placeholder="Telefone" type="text" value="{{ $user['telefone'] }}" name="telefone">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <button class="w-[100%] h-[40px] rounded-[8px] bg-[#874645] text-[#ffffff] mt-[10px]">Adicionar informações</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <!-- MODAL ADD FOTO -->
        <div class="modal_add_foto">
            <!--  -->
            <div style="border-radius: 0px 0px 25px 25px;" class="w-[100%] px-[30px] pt-[30px] pb-[60px] bg-[#ffffff] shadow-md mt-[0%]">
                <!--  -->
                <div class="w-[100%] inline-block"><p id="fechar_add_img" class="float-right cursor-pointer">✕</p></div>
                <!--  -->
                <p class="font-bold text-[20px]">Adicionar nova imagem</p>
                <!--  -->
                <p class="text-[15px] mt-[20px] leading-[17px] text-[#cdcdcd]">Sua foto é sua principal identidade, inclua uma imagem que represente seu perfil!</p>
                <!--  -->
                <div class="w-[100%] mt-[40px] inline-block">
                    <!--  -->
                    <form action="/php/upload_img.php" method="post" enctype="multipart/form-data">
                        @csrf
                        <table class="w-[100%]">
                            <tr>
                                <td>
                                <label for="imagem" class="w-[100%] h-[40px] text-[#333333] cursor-pointer mt-[10px] rounded-[10px] pt-[10px] bg-[#eeeeee] border-[#cdcdcd] border-[1px] float-right mb-[10px]"><center>Carregar imagem</center></label>
                                <input id="imagem" class="hidden" type="file" name="imagem">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <input type="hidden" value="{{ session('usuario')['id'] }}" name="id">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <button class="w-[100%] h-[40px] rounded-[8px] bg-[#874645] text-[#ffffff] mt-[10px]">Alterar imagem</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <!-- MODAL EDITAR -->
        <div class="modal_editar">
            <!--  -->
            <div style="border-radius: 0px 0px 25px 25px;" class="w-[100%] h-[550px] overflow-scroll px-[30px] pt-[30px] pb-[60px] bg-[#ffffff] shadow-md mt-[0%]">
                <!--  -->
                <div class="w-[100%] inline-block"><p id="fechar_md_edt" class="float-right cursor-pointer">✕</p></div>
                <!--  -->
                <p class="font-bold text-[20px]">Editar</p>
                <!--  -->
                <p class="text-[15px] mt-[20px] leading-[17px] text-[#cdcdcd]">Altere suas informações mais importantes!</p>
                <!--  -->
                <form action="{{ route('editar_perfil', ['id' => $user['id']]) }}" class="mt-[30px]" method="POST">
                    @csrf
                    <!--  -->
                    <p class="mb-[5px]">Nome</p>
                    <!--  -->
                    <input class="w-[100%] mb-[10px] bg-[#fafafa] h-[40px] rounded-[8px] outline-none border-[1px] pl-[10px]" type="text" value="{{ $user['nome'] }}" name="nome">
                    <!--  -->
                    <p class="mb-[5px]">Nickname</p>
                    <!--  -->
                    <input class="w-[100%] bg-[#fafafa] h-[40px] rounded-[8px] outline-none border-[1px] pl-[10px]" type="text" value="{{ $user['nickname'] }}" name="nickname">
                    <!--  -->
                    <button class="w-[100%] h-[40px] mt-[10px] rounded-[10px] text-[#ffffff] bg-[#A35554]">Alterar informações</button>
                </form>
                <!--  -->
                <form action="{{ route('alt_email', ['id' => $user['id']]) }}" method="GET">
                    @csrf
                    <table class="w-[100%]">
                        <!--  -->
                        <p class="font-bold mt-[30px] text-[20px]">Alterar e-mail de acesso</p>
                        <!--  -->
                        <tr>
                            <td>
                                <p class="text-[15px] mt-[20px] leading-[17px] text-[#cdcdcd]">Aletere seu e-mail de acesso para um novo sempre que precisar, ao realizar essa alteração você será deslogado e redirecionado a página de login.</p>
                                <p class="text-[13px] font-bold mt-[10px] mb-[30px]">{{ $user['email'] }}</p>
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <input class="w-[100%] h-[40px] bg-[#eeeeee] pl-[10px] mb-[10px] outline-none rounded-[10px] border-[1px]" placeholder="Novo e-mail" type="text" name="email">
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <input class="w-[100%] h-[40px] bg-[#eeeeee] mt-[10px] pl-[10px] outline-none rounded-[10px] border-[1px]" placeholder="Senha atual" type="password" name="novasenha">
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <button class="w-[100%] h-[40px] rounded-[8px] bg-[#874645] text-[#ffffff] mt-[20px]">Alterar e-mail</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <!--  -->
                <form action="{{ route('alt_senha', ['id' => $user['id']]) }}" method="GET">
                    @csrf
                    <table class="w-[100%]">
                        <!--  -->
                        <p class="font-bold mt-[30px] text-[20px]">Alterar senha de acesso</p>
                        <!--  -->
                        <tr>
                            <td>
                                <p class="text-[15px] mt-[20px] leading-[17px] text-[#cdcdcd]">Aletere sua senha de acesso por uma nova, ao realizar essa alteração você será deslogado e redirecionado a página de login.</p>
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <input class="w-[100%] h-[40px] bg-[#eeeeee] mt-[30px] pl-[10px] outline-none rounded-[10px] border-[1px]" placeholder="Nova senha" type="password" name="novasenha">
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <input class="w-[100%] h-[40px] bg-[#eeeeee] mt-[10px] pl-[10px] outline-none rounded-[10px] border-[1px]" placeholder="Confirme nova senha" type="password" name="confsenha">
                            </td>
                        </tr>
                         <!--  -->
                         <tr>
                            <td>
                                <input class="w-[100%] h-[40px] bg-[#eeeeee] mt-[10px] pl-[10px] outline-none rounded-[10px] border-[1px]" placeholder="Sua senha atual" type="password" name="senha">
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <button class="w-[100%] h-[40px] rounded-[8px] bg-[#874645] text-[#ffffff] mt-[20px]">Alterar senha</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <!--  -->
                <p class="font-bold mt-[30px] text-[20px]">Excluir conta</p>
                <!--  -->
                <p class="text-[15px] mt-[20px] leading-[17px] text-[#cdcdcd]">Ao excluir sua conta, você também apagará seus registros de agendamentos executados ou pendentendes, postagens e informações de seu perfil.</p>
                <!--  -->
                <a href="/php/delete.php?id={{ $user['id'] }}"><p class="font-bold mt-[20px]">Excluir conta</p></a>
            </div>
        </div>
        <!-- MODAL LISTA DE SEGUIDOS -->
        <div class="modal_seguidos">
            <?php

            // VERIFICAR SEGUIDOS
            $stmtne = $conn->prepare('SELECT * FROM conexao_seguirs WHERE seguidor = :id');
            $stmtne->execute(array('id' => $user['id']));
            $resultne = $stmtne->fetchAll();

            ?>
            <!--  -->
            <div style="border-radius: 0px 0px 25px 25px;" class="w-[100%] px-[30px] pt-[30px] pb-[60px] bg-[#ffffff] shadow-md mt-[0%]">
                <!--  -->
                <div class="w-[100%] inline-block"><p id="fechar_md_seg" class="float-right cursor-pointer">✕</p></div>
                <!--  -->
                <p class="font-bold text-[20px]">Lista de seguidos</p>
                <!--  -->
                <p class="text-[15px] mt-[20px] leading-[17px] text-[#cdcdcd]">Acompanhe a lista de seus perfís favoritos</p>
                <!--  -->
                <div class="w-[100%] mt-[30px] h-[200px] overflow-scroll inline-block">
                    <!--  -->
                    @foreach($resultne as $segs)
                    <?php

                    // VERIFICAR SEGUIDOS
                    $stmtnx = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
                    $stmtnx->execute(array('id' => $segs['usuario']));
                    $resultnx = $stmtnx->fetchAll();

                    foreach($resultnx as $usernx) {};

                    ?>
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[20%] inline-block float-left">
                            <!--  -->
                            <a href="{{ route('profile', ['id' => $usernx['nickname']]) }}"><div class="w-[50px] h-[50px] rounded-[100px] bg-[silver] inline-block" style="background: url(/img/usuario/{{ $usernx['imagem'] }}); background-size: 100%;"></div></a>
                        </div>
                        <!--  -->
                        <div class="w-[70%] pl-[5px] inline-block float-left">
                            <!--  -->
                            <p class="font-bold text-[15px] mt-[5px]">{{ $usernx['nome'] }}</p>
                            <p class="text-[12px] text-[#cdcdcd]">{{ $usernx['nickname'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- MODAL LISTA DE SEGUIDOS -->
        <div class="modal_seguidoras">
            <?php

            // VERIFICAR SEGUIDOS
            $stmtrn = $conn->prepare('SELECT * FROM conexao_seguirs WHERE usuario = :id');
            $stmtrn->execute(array('id' => $user['id']));
            $resultrn = $stmtrn->fetchAll();

            ?>
            <!--  -->
            <div style="border-radius: 0px 0px 25px 25px;" class="w-[100%] px-[30px] pt-[30px] pb-[60px] bg-[#ffffff] shadow-md mt-[0%]">
                <!--  -->
                <div class="w-[100%] inline-block"><p id="fechar_md_segrn" class="float-right cursor-pointer">✕</p></div>
                <!--  -->
                <p class="font-bold text-[20px]">Lista de seguidoras</p>
                <!--  -->
                <p class="text-[15px] mt-[20px] leading-[17px] text-[#cdcdcd]">Acompanhe a lista de suas seguidoras fieis.</p>
                <!--  -->
                <div class="w-[100%] mt-[30px] h-[200px] overflow-scroll inline-block">
                    <!--  -->
                    @foreach($resultrn as $segrn)
                    <?php

                    // VERIFICAR SEGUIDOS
                    $stmtnh = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
                    $stmtnh->execute(array('id' => $segrn['seguidor']));
                    $resultnh = $stmtnh->fetchAll();

                    foreach($resultnh as $usernh) {};

                    ?>
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[20%] inline-block float-left">
                            <!--  -->
                            <a href="{{ route('profile', ['id' => $usernh['nickname']]) }}"><div class="w-[50px] h-[50px] rounded-[100px] bg-[silver] inline-block" style="background: url(/img/usuario/{{ $usernh['imagem'] }}); background-size: 100%;"></div></a>
                        </div>
                        <!--  -->
                        <div class="w-[70%] pl-[5px] inline-block float-left">
                            <!--  -->
                            <p class="font-bold text-[15px] mt-[5px]">{{ $usernh['nome'] }}</p>
                            <p class="text-[12px] text-[#cdcdcd]">{{ $usernh['nickname'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- MODAL EDITAR CONTA -->
        <div class="modal_configura">
            <!--  -->
            <div style="border-radius: 0px 0px 25px 25px;" class="w-[100%] px-[30px] pt-[30px] pb-[60px] bg-[#ffffff] shadow-md mt-[0%]">
                <!--  -->
                <div class="w-[100%] inline-block">
                    <!--  -->
                    <form action="{{ route('alt_email', ['id' => $user['id']]) }}" method="POST">
                        @csrf
                        <table class="w-[100%]">
                            <!--  -->
                            <div class="w-[100%] inline-block"><p id="fechar_md_segrn" class="float-right cursor-pointer">✕</p></div>
                            <!--  -->
                            <p class="font-bold text-[20px]">Alterar e-mail de acesso</p>
                            <!--  -->
                            <tr>
                                <td>
                                    <p class="text-[12px] mt-[10px]">Aletere seu e-mail de acesso para um novo sempre que precisar, ao realizar essa alteração você será deslogado e redirecionado a página de login.</p>
                                    <p class="text-[13px] font-bold mt-[10px] mb-[30px]">{{ $user['email'] }}</p>
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <input class="w-[100%] h-[40px] bg-[#eeeeee] pl-[10px] mb-[10px] outline-none rounded-[10px] border-[1px]" placeholder="Novo e-mail" type="text" name="email">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <input class="w-[100%] h-[40px] bg-[#eeeeee] mt-[10px] pl-[10px] outline-none rounded-[10px] border-[1px]" placeholder="Senha atual" type="text" name="novasenha">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <button class="w-[100%] h-[40px] rounded-[8px] bg-[#874645] text-[#ffffff] mt-[20px]">Alterar e-mail</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

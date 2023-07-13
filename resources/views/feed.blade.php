@extends('layout.main_feed')
@section('title', 'Kaza Rosa | Feed')
@section('titulo_pack', 'Alterar senha')
@section('sub_titulo_pack', 'Kênia')

@section('content')
<!-- ESPAÇOS -->
<section class="md:hidden">
    {{--  --}}
    <div class="w-[100%] my-[0px]">
        <!-- CONEXÃO PDO -->
        @php

        // RESGATE DE USUÁRIO
        @$session = session('admin')['id'];

        // RESGATE DE INFORMAÇÕES DO ADMINISTRADOR
        $info_network = Illuminate\Support\Facades\DB::select("SELECT * FROM networks ORDER BY datas DESC");
        $contagem_ntw = count($info_network);

        @endphp
        <!--  -->
        <div class="w-[100%] inline-block fixed">
            <!--  -->
            <center><a href="{{ route('redes') }}"><button class="px-[30px] mt-[20px] h-[35px] rounded-[100px] bg-[#eeeeee] opacity-[0.8] border-[#cdcdcd] border-[1px] ">Atualizar feed</button></a></center>
        </div>
        <!--  -->
        <div class="w-[100%] h-[50px]"></div>
        @if($contagem_ntw > 0)
            {{--  --}}
            @foreach($info_network as $network)
            <!-- POSTAGEM -->
            @php
                $postador = $network->usuario;

                // RESGATE DE INFORMAÇÕES DO POSTADOR
                $info_postador = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$postador'");
                $contagem_post = count($info_postador);
            @endphp
            <!--  -->
            <div id="post_{{ $network->id }}" class="w-[100%] mt-[20px] mb-[10px] inline-block">
                <!--  -->
                <div class="w-[90%] mb-[10px] mx-[5%]">
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <a  href="{{ route('profile', ['id' => $info_postador[0]->nickname]) }}"><div class="w-[45px] cursor-pointer h-[45px] border-[3px] border-[#C5908F] rounded-[100px] bg-[silver] float-left" style="background: url(/img/usuario/{{ $info_postador[0]->imagem }}); background-size: 100%;"></div></a>
                        <!--  -->
                        <p class="float-left ml-[10px] mt-[13px] text-[13px]">{{ $info_postador[0]->nome }}</p>
                    </div>
                </div>
                <!--  -->
                <div class="w-[100%] inline-block">
                    <a href="{{ route('post_profile', ['id' => $info_postador[0]->nickname, 'post' => $network->id]) }}"><img src="/img/feed/{{ $network->postagem }}" class="w-[100%]"></a>
                </div>
                <!--  -->
                <div class="w-[90%] mx-[5%] pt-[5px] inline-block">
                    <!--  -->
                    <div class="w-[30%] float-left inline-block">
                        <!--  -->
                        <a href="{{ route('curtidas_feed', ['id' => $network->id]) }}"><img src="/img/coracao.png" class="float-left cursor-pointer w-[20px]"></a>
                        <!--  -->
                        <p class="mt-[2px] float-left text-[11px] ml-[10px]">{{ $network->curtidas }} curtidas</p>
                    </div>
                    <!--  -->
                    <div class="w-[70%] float-left inline-block">
                        <!--  -->
                        @php
                            // FORMATAÇÃO DA SEMANA
                            $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
                            $diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");

                            $variavel        = $network->datas;
                            $variavel        = str_replace('/','-',$variavel);

                            $hoje            = getdate(strtotime($variavel));

                            $dia             = $hoje["mday"];
                            $mes             = $hoje["mon"];
                            $nomemes         = $meses[$mes];
                            $ano             = $hoje["year"];
                            $diadasemana     = $hoje["wday"];
                            $nomediadasemana = $diasdasemana[$diadasemana];
                        @endphp
                        {{--  --}}
                        <p class="text-[11px] text-[#333333] float-right">{{ $dia }} de {{ $nomemes }} de {{ $ano }}</p>
                    </div>
                </div>
                <!--  -->
                <div class="w-[90%] mx-[5%] mt-[10px] inline-block">
                    <!--  -->
                    <p class="text-[12px]">{{ $network->descricao }}</p>
                </div>
            </div>
            @endforeach
        @else
        <center><p class="mt-[40%]">sem postagens recentes</p></center>
        @endif
        <!--  -->
        <div class="modal_curtidas">
            <!--  -->
            <div style="border-radius: 25px 25px 0px 0px;" class="w-[100%] p-[30px] bg-[#ffffff] shadow-lg mt-[90%] h-[500px]">
                <!--  -->
                <div class="inline-block w-[100%]">
                    <center>
                    <p class="text-[30px] font-bold">Curtiram!</p>
                    <!--  -->
                    <p class="text-[16px] mt-[10px] mb-[10px] leading-[16px] text-[#cdcdcd] font-bold">35 pessoas adoraram essa postagem!</p>
                    </center>
                </div>
                <!--  -->
                <hr class="my-[10px]">
                <!--  -->
                <div class="w-[100%] h-[320px] overflow-scroll inline-block">
                    <!--  -->
                    <div class="inline-block w-[100%] mt-[15px]">
                        <!--  -->
                        <div class="w-[25%] float-left inline-block">
                            <!--  -->
                            <div class="w-[60px] h-[60px] rounded-[100px] bg-[#cdcdcd]"></div>
                        </div>
                        <!--  -->
                        <div class="w-[75%] float-left inline-block">
                            <!--  -->
                            <p class="text-[15px] mt-[10px]">Nome do usuário</p>
                            <!--  -->
                            <p class="text-[11px]">nomeusuario</p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="inline-block w-[100%] mt-[15px]">
                        <!--  -->
                        <div class="w-[25%] float-left inline-block">
                            <!--  -->
                            <div class="w-[60px] h-[60px] rounded-[100px] bg-[#cdcdcd]"></div>
                        </div>
                        <!--  -->
                        <div class="w-[75%] float-left inline-block">
                            <!--  -->
                            <p class="text-[15px] mt-[10px]">Nome do usuário</p>
                            <!--  -->
                            <p class="text-[11px]">nomeusuario</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="modal_postar">
            <!--  -->
            <div style="border-radius: 0px 0px 25px 25px;" class="w-[100%] px-[30px] pt-[30px] pb-[60px] bg-[#ffffff] shadow-md mt-[0%]">
                <!--  -->
                <div class="w-[100%] inline-block"><p id="fechar_publicar" class="float-right cursor-pointer">✕</p></div>
                <!--  -->
                <p class="font-bold text-[20px]">Nova postagem</p>
                <!--  -->
                <p class="text-[15px] mt-[20px] leading-[17px] text-[#cdcdcd]">Publique algo novo. Inspire, engaje, motive suas seguidoras!</p>
                <!--  -->
                <div class="w-[100%] mt-[40px] inline-block">
                    <!--  -->
                    <form action="/php/publicar.php" method="post" enctype="multipart/form-data">
                        @csrf
                        <table class="w-[100%]">
                            <tr>
                                <td>
                                <label for="imagem" class="w-[100%] h-[40px] text-[#333333] cursor-pointer mt-[10px] rounded-[10px] pt-[10px] bg-[#eeeeee] border-[#cdcdcd] border-[1px] float-right mb-[10px]"><center>Carregar imagem</center></label>
                                <input id="imagem" class="hidden" type="file" name="postagem">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <textarea class="w-[100%] mt-[5px] border-[1px] h-[100px] p-[10px] outline-none bg-[#eeeeee] rounded-[8px]" placeholder="Escreva uma descrição para sua postagem" maxlength="1000" name="descricao"></textarea>
                                </td>
                            </tr>
                            <!--  -->
                            <?php $mytime = Carbon\Carbon::now(); ?>
                            <tr>
                                <td>
                                    <input type="hidden" value="{{ $mytime }}" name="datas">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <input type="hidden" value="{{ session('usuario')['id'] }}" name="usuario">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <button class="w-[100%] h-[40px] rounded-[8px] bg-[#874645] text-[#ffffff] mt-[10px]">Publicar agora</button>
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

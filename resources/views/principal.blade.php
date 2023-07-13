@extends('layout.main_principal')
@section('title', 'Kaza Rosa | Principal')

@section('content')
<!--  -->
<section>
    <!-- CONEXÃO PDO -->
    <?php

    $name_banco = env('PDO_BANCO');
    $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
    $name_user = env('PDO_USER');
    $pass_banco = env('PDO_SENHA');

    $conn = new PDO($conectDB, $name_user, $pass_banco);

    @$usuario_carrinho = session('usuario')['id'];

    $stmt = $conn->prepare('SELECT * FROM carrinhos WHERE user = :id AND stts = "pago"');
    $stmt->execute(array('id' => $usuario_carrinho));

    $result = $stmt->fetchAll();

    $contagem = count($result);

    if($contagem){
        foreach($result as $row) {

            $ident = $row['id'];
            // 14 nesse exemplo é o valor em reais da hora
            $value = $row['valor'] / 14;
            $sttsx = $row['stts'];

            // ATUALIZAR VALOR
            $stmtx = $conn->prepare('UPDATE carteiras SET horas = horas + :valor WHERE user = :idx');
            $stmtx->execute(array('valor' => $value, 'idx' => $usuario_carrinho));

            // ATUALIZAR STATUS
            $stmtx = $conn->prepare('UPDATE carrinhos SET stts = :valor WHERE id = :ids');
            $stmtx->execute(array('valor' => 'usado', 'ids' => $ident));
        }
    }

    // VERIFICAR SE JÁ TENHO UM PLANO
    $stmtx1 = $conn->prepare('SELECT * FROM clubes WHERE id_user = :id AND stts = "autorizado"');
    $stmtx1->execute(array('id' => $usuario_carrinho));
    $resultx1 = $stmtx1->fetchAll();
    $contadox1 = count($resultx1);

    $busca_info_usuario = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$usuario_carrinho'");
    @$telefone_user     = $busca_info_usuario[0]->telefone;

    ?>
    <div class="w-[100%] inline-block">
        <!-- BANNER -->
        <div class="w-[100%] h-[120px] bg-[#eeeeee] rounded-[8px] mt-[0px] mb-[20px]"></div>
    </div>
    {{--  --}}
    @if (!empty($usuario_carrinho))
        {{--  --}}
        @if (!isset($telefone_user) AND empty($telefone_user))
        {{--  --}}
        <div class="w-[100%] inline-block">
            {{--  --}}
            <div class="banner_telefone">
                {{--  --}}
                <div class="w-[90%] inline-block mx-[5%] mt-[25%] shadow-lg p-[30px] rounded-[20px] bg-[#ffffff] h-[300px]">
                    {{--  --}}
                    <div class="w-[100%] inline-block">
                        {{--  --}}
                        <div class="w-[70%] inline-block float-left">
                            {{--  --}}
                            <p class="font-bold text-[16px]">Cadastre seu telefone!</p>
                        </div>
                        {{--  --}}
                        <div class="w-[30%] inline-block float-left">
                            {{--  --}}
                            <p id="bt_fechar_modal_tel" class="float-right cursor-pointer">✕</p>
                        </div>
                    </div>
                    {{--  --}}
                    <p class="mt-[15px] leading-[16px]">Cadastre seu telefone para receber novidades, e ter um atendimento ainda mais personalizado, vai levar um minuto!</p>
                    {{--  --}}
                    <div class="w-[100%] inline-block">
                        {{--  --}}
                        <form action="{{ route('cadastrar_telefone') }}" method="POST">
                            @csrf
                            {{--  --}}
                            <input id="phone1" class="w-[100%] outline-none h-[40px] border-[1px] mt-[30px] bg-[#eeeeee] border-[#cdcdcd] rounded-[10px] pl-[10px]" name="telefone" type="text">
                            {{--  --}}
                            <button class="w-[100%] h-[40px] mt-[10px] font-bold rounded-[10px] bg-[#A35554] text-[#ffffff]">Incluir telefone</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{--  --}}
    @endif
</section>
<!-- ESPAÇOS -->
<section id="tutor">
    <!-- CONTAGEM -->
    @foreach($salas as $sala)
    <?php $contx = $loop->count; ?>
    @endforeach
    <?php
    if($contx >= 2){
        $valor = $contx * 208 + 208;
    }
    else{
        $valor = 2 * 208;
    }
    ?>
    <!-- CONTAGEM -->
    <div id="suma1" class="w-[100%] inline-block">
        <!-- TÍTULO -->
        <img class="w-[30px] ml-[13px] float-left mr-[10px]" src="/img/angulo-para-baixo.png"><p class="font-bold text-[20px] text-[#212121]">Nosso espaço</p>
        <!-- RULE -->
        <hr class="mt-[28px] mb-[10]">
    </div>
    <!--  -->
    <div style="scrollbar-width: none;" id="suma2" class="w-[100%] inline-block py-[20px] overflow-scroll">
        @if(empty($contx))
        <center><p class="text-[11px] mt-[30px]">Não existem espaços para locação!</p></center>
        @else
        <div style="width: <?php echo $valor; ?>px; padding: 0px 12px;" class="inline-block">
            @foreach($salas as $sala)
            <!-- CARD -->
            <div class="w-[200px] float-left h-[300px] bg-[#ffffff] rounded-[5px] shadow-md border-[1px] mx-[4px]">
                <!-- IMAGEM -->
                <div class="w-[100%] h-[100px]" style="border-radius: 5px 5px 0px 0px; background: url(/img/salas/{{ $sala->img1 }}); background-size: 100%; background-position: center;">
                    <!-- DISPONÍVEL -->
                    <button class="py-[3px] px-[8px] shadow-md mt-[10px] ml-[0px] bg-[#333333] text-[#ffffff] text-[10px]">Disponível</button>
                </div>
                <!-- INFORMAÇÕES -->
                <div class="w-[100%] p-[10px] h-[200px] bg-[#ffffff]" style="border-radius: 0px 0px 5px 5px;">
                    <!--  -->
                    <div class="w-[100%] h-[150px]">
                        <!-- TÍTULO -->
                        <p class="text-[#212121] text-[16px] font-bold">{{ $sala->nome }}</p>
                        <!--  -->
                        <p class="text-[12px] mt-[5px]">A partir de</p>
                        <!--  -->
                        <?php

                        if ($sala->valor != "0.00") {
                            $salavalor = number_format($sala->valor,2,",",".");
                        }
                        elseif($sala->valor == "0.00" AND $sala->dual == "0.00"){
                            $salavalor = number_format($sala->turno,2,",",".");
                        }
                        else{
                            $salavalor = number_format($sala->dual,2,",",".");
                        }

                        ?>
                        <p class="text-[#212121] mt-[0px] font-bold text-[18px]">R${{ $salavalor }}</p>
                        <!--  -->
                        <div class="w-[100%] h-[20px] mt-[5px]">
                            <?php

                            // RESGATAR DE AVALIAÇÕES
                            $stmt_1 = $conn->prepare('SELECT * FROM avalias WHERE espaco = :id AND estrela = 1');
                            $stmt_1->execute(array('id' => $sala->id));
                            $result_1 = $stmt_1->fetchAll();
                            $contagem_1 = count($result_1);

                            $stmt_2 = $conn->prepare('SELECT * FROM avalias WHERE espaco = :id AND estrela = 2');
                            $stmt_2->execute(array('id' => $sala->id));
                            $result_2 = $stmt_2->fetchAll();
                            $contagem_2 = count($result_2);

                            $stmt_3 = $conn->prepare('SELECT * FROM avalias WHERE espaco = :id AND estrela = 3');
                            $stmt_3->execute(array('id' => $sala->id));
                            $result_3 = $stmt_3->fetchAll();
                            $contagem_3 = count($result_3);

                            $stmt_4 = $conn->prepare('SELECT * FROM avalias WHERE espaco = :id AND estrela = 4');
                            $stmt_4->execute(array('id' => $sala->id));
                            $result_4 = $stmt_4->fetchAll();
                            $contagem_4 = count($result_4);

                            $stmt_5 = $conn->prepare('SELECT * FROM avalias WHERE espaco = :id AND estrela = 5');
                            $stmt_5->execute(array('id' => $sala->id));
                            $result_5 = $stmt_5->fetchAll();
                            $contagem_5 = count($result_5);

                            ?>
                            <!-- ESTRELAS -->
                            @if($contagem_1 > $contagem_2 AND $contagem_1 > $contagem_3 AND $contagem_1 > $contagem_4 AND $contagem_1 > $contagem_5)
                            <ul class="mt-[10px]">
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[13px] inline-block">({{ $contagem_1 }})</li>
                            </ul>
                            @elseif($contagem_2 > $contagem_1 AND $contagem_2 > $contagem_3 AND $contagem_2 > $contagem_4 AND $contagem_2 > $contagem_5)
                            <ul class="mt-[10px]">
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[13px] inline-block">({{ $contagem_2 }})</li>
                            </ul>
                            @elseif($contagem_3 > $contagem_1 AND $contagem_3 > $contagem_2 AND $contagem_3 > $contagem_4 AND $contagem_3 > $contagem_5)
                            <ul class="mt-[10px]">
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[13px] inline-block">({{ $contagem_3 }})</li>
                            </ul>
                            @elseif($contagem_4 > $contagem_1 AND $contagem_4 > $contagem_2 AND $contagem_4 > $contagem_3 AND $contagem_4 > $contagem_5)
                            <ul class="mt-[10px]">
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[13px] inline-block">({{ $contagem_4 }})</li>
                            </ul>
                            @elseif($contagem_5 > $contagem_1 AND $contagem_5 > $contagem_2 AND $contagem_5 > $contagem_3 AND $contagem_5 > $contagem_4)
                            <ul class="mt-[10px]">
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela1.png"></li>
                                <li class="text-[13px] inline-block">({{ $contagem_5 }})</li>
                            </ul>
                            @else
                            <ul class="mt-[10px]">
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                                <li class="text-[13px] inline-block">({{ $contagem_5 }})</li>
                            </ul>
                            @endif
                        </div>
                    </div>
                    <!-- BUTTON -->
                    <a href="{{ route('sala', ['id' => $sala->id]) }}"><button class="w-[100%] h-[30px] mt-[0px] text-[12px] text-[#ffffff] font-bold rounded-[5px] bg-[#A35554]">Quero agendar</button></a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
<!-- CLUB DE NEGÓCIO -->
<?php
    $valorax = 4 * 208 + 208;
?>
@if($contadox1 == 0)
<section>
    <!-- CONTAGEM -->
    <div id="suma5" class="w-[100%] inline-block">
        <!-- TÍTULO -->
        <img class="w-[30px] ml-[13px] float-left mr-[10px]" src="/img/angulo-para-baixo.png"><p class="font-bold text-[20px] text-[#212121]">Club de negócio</p>
        <!-- RULE -->
        <hr class="mt-[28px] mb-[10]">
    </div>
    <!--  -->
    <div style="scrollbar-width: none;" id="suma6" class="w-[100%] inline-block py-[20px] overflow-scroll">

        <div style="width: <?php echo $valorax; ?>px; padding: 0px 12px;" class="inline-block">
            <!-- CARD -->
            <div class="w-[200px] float-left h-[300px] bg-[#ffffff] rounded-[5px] shadow-md border-[1px] mx-[4px]">
                <!-- IMAGEM -->
                <div class="w-[100%] h-[100px]" style="border-radius: 5px 5px 0px 0px; background: url(/img/estacao.png); background-size: 100%; background-position: center;">
                    <!-- DISPONÍVEL -->
                    <button class="py-[3px] px-[8px] shadow-md mt-[10px] ml-[0px] bg-[#333333] text-[#ffffff] text-[10px]">Últimas vagas</button>
                </div>
                <!-- INFORMAÇÕES -->
                <div class="w-[100%] p-[10px] h-[200px] bg-[#ffffff]" style="border-radius: 0px 0px 5px 5px;">
                    <!--  -->
                    <div class="w-[100%] h-[150px]">
                        <!-- TÍTULO -->
                        <p class="text-[#212121] text-[17px] font-bold">Basic Plan</p>
                        <!--  -->
                        <p class="text-[#212121] mt-[3px] font-bold text-[18px]">R$167,00</p>
                        <!--  -->
                        <div class="w-[100%] h-[20px] mt-[5px]">
                            <ul class="mt-[20px]">
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">12 horas nas Estações Compartilhadas</li>
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">Rede de Negócio</li>
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">10% nas Salas Privada e Executiva</li>
                            </ul>
                        </div>
                    </div>
                    <!-- BUTTON -->
                    @if(isset($usuario_carrinho) AND !empty($usuario_carrinho))
                    <a href="{{ route('plano_app', ['id' => 1]) }}"><button class="w-[100%] h-[30px] mt-[0px] text-[12px] text-[#ffffff] font-bold rounded-[5px] bg-[#A35554]">Assinar</button></a>
                    @else
                    <a href="{{ route('login') }}"><button class="w-[100%] h-[30px] mt-[0px] text-[12px] text-[#ffffff] font-bold rounded-[5px] bg-[#A35554]">Assinar</button></a>
                    @endif
                </div>
            </div>
            <!-- CARD -->
            <div class="w-[200px] float-left h-[300px] bg-[#ffffff] rounded-[5px] shadow-md border-[1px] mx-[4px]">
                <!-- IMAGEM -->
                <div class="w-[100%] h-[100px]" style="border-radius: 5px 5px 0px 0px; background: url(/img/social.png); background-size: 100%; background-position: center;">
                    <!-- DISPONÍVEL -->
                    <button class="py-[3px] px-[8px] shadow-md mt-[10px] ml-[0px] bg-[#333333] text-[#ffffff] text-[10px]">Últimas vagas</button>
                </div>
                <!-- INFORMAÇÕES -->
                <div class="w-[100%] p-[10px] h-[200px] bg-[#ffffff]" style="border-radius: 0px 0px 5px 5px;">
                    <!--  -->
                    <div class="w-[100%] h-[150px]">
                        <!-- TÍTULO -->
                        <p class="text-[#212121] text-[17px] font-bold">Vip Plan</p>
                        <!--  -->
                        <p class="text-[#212121] mt-[3px] font-bold text-[18px]">R$257,00</p>
                        <!--  -->
                        <div class="w-[100%] h-[20px] mt-[5px]">
                            <ul class="mt-[20px]">
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">12h mensais nas Estações Privadas</li>
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">Rede de Negócio</li>
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">10% na Locação das Salas Privada e Executiva</li>
                            </ul>
                        </div>
                    </div>
                    <!-- BUTTON -->
                    @if(isset($usuario_carrinho) AND !empty($usuario_carrinho))
                    <a href="{{ route('plano_app', ['id' => 2]) }}"><button class="w-[100%] h-[30px] mt-[0px] text-[12px] text-[#ffffff] font-bold rounded-[5px] bg-[#A35554]">Assinar</button></a>
                    @else
                    <a href="{{ route('login') }}"><button class="w-[100%] h-[30px] mt-[0px] text-[12px] text-[#ffffff] font-bold rounded-[5px] bg-[#A35554]">Assinar</button></a>
                    @endif
                </div>
            </div>
            <!-- CARD -->
            <div class="w-[200px] float-left h-[300px] bg-[#ffffff] rounded-[5px] shadow-md border-[1px] mx-[4px]">
                <!-- IMAGEM -->
                <div class="w-[100%] h-[100px]" style="border-radius: 5px 5px 0px 0px; background: url(/img/privativa.png); background-size: 100%; background-position: center;">
                    <!-- DISPONÍVEL -->
                    <button class="py-[3px] px-[8px] shadow-md mt-[10px] ml-[0px] bg-[#333333] text-[#ffffff] text-[10px]">Últimas vagas</button>
                </div>
                <!-- INFORMAÇÕES -->
                <div class="w-[100%] p-[10px] h-[200px] bg-[#ffffff]" style="border-radius: 0px 0px 5px 5px;">
                    <!--  -->
                    <div class="w-[100%] h-[150px]">
                        <!-- TÍTULO -->
                        <p class="text-[#212121] text-[17px] font-bold">Private Plan</p>
                        <!--  -->
                        <p class="text-[#212121] mt-[3px] font-bold text-[18px]">R$420,00</p>
                        <!--  -->
                        <div class="w-[100%] h-[20px] mt-[5px]">
                            <ul class="mt-[20px]">
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">16h mensais na Sala Privativa</li>
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">Rede de Negócio</li>
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">10% na Locação da Sala Executiva</li>
                            </ul>
                        </div>
                    </div>
                    <!-- BUTTON -->
                    @if(isset($usuario_carrinho) AND !empty($usuario_carrinho))
                    <a href="{{ route('plano_app', ['id' => 4]) }}"><button class="w-[100%] h-[30px] mt-[0px] text-[12px] text-[#ffffff] font-bold rounded-[5px] bg-[#A35554]">Assinar</button></a>
                    @else
                    <a href="{{ route('login') }}"><button class="w-[100%] h-[30px] mt-[0px] text-[12px] text-[#ffffff] font-bold rounded-[5px] bg-[#A35554]">Assinar</button></a>
                    @endif
                </div>
            </div>
            <!-- CARD -->
            <div class="w-[200px] float-left h-[300px] bg-[#ffffff] rounded-[5px] shadow-md border-[1px] mx-[4px]">
                <!-- IMAGEM -->
                <div class="w-[100%] h-[100px]" style="border-radius: 5px 5px 0px 0px; background: url(/img/auditorio.png); background-size: 100%; background-position: center;">
                    <!-- DISPONÍVEL -->
                    <button class="py-[3px] px-[8px] shadow-md mt-[10px] ml-[0px] bg-[#333333] text-[#ffffff] text-[10px]">Últimas vagas</button>
                </div>
                <!-- INFORMAÇÕES -->
                <div class="w-[100%] p-[10px] h-[200px] bg-[#ffffff]" style="border-radius: 0px 0px 5px 5px;">
                    <!--  -->
                    <div class="w-[100%] h-[150px]">
                        <!-- TÍTULO -->
                        <p class="text-[#212121] text-[17px] font-bold">Executive Plan</p>
                        <!--  -->
                        <p class="text-[#212121] mt-[3px] font-bold text-[18px]">R$637,00</p>
                        <!--  -->
                        <div class="w-[100%] h-[20px] mt-[5px]">
                            <ul class="mt-[20px]">
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">16h mensais na Sala Privada</li>
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">Rede de Negócio</li>
                                <li class="mb-[3px] text-[10px] pl-[10px] border-l-[3px] border-l-[#C5908F]">20% na Locação de qualquer espaço</li>
                            </ul>
                        </div>
                    </div>
                    <!-- BUTTON -->
                    @if(isset($usuario_carrinho) AND !empty($usuario_carrinho))
                    <a href="{{ route('plano_app', ['id' => 3]) }}"><button class="w-[100%] h-[30px] mt-[0px] text-[12px] text-[#ffffff] font-bold rounded-[5px] bg-[#A35554]">Assinar</button></a>
                    @else
                    <a href="{{ route('login') }}"><button class="w-[100%] h-[30px] mt-[0px] text-[12px] text-[#ffffff] font-bold rounded-[5px] bg-[#A35554]">Assinar</button></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- EVENTOS -->
<section>
    <!-- CONTAGEM -->
    @foreach($eventos as $evento)
    <?php $contxa = $loop->count; ?>
    @endforeach
    <?php
    if(isset($contxa) AND $contxa >= 2){
        $valora = $contxa * 208 + 208;
    }
    else{
        $valora = 2 * 208;
    }
    ?>
    <!-- CONTAGEM -->
    <div id="suma3" class="w-[100%] inline-block">
        <!-- TÍTULO -->
        <img class="w-[30px] ml-[13px] float-left mr-[10px]" src="/img/angulo-para-baixo.png"><p class="font-bold text-[20px] text-[#212121]">Eventos</p>
        <!-- RULE -->
        <hr class="mt-[28px] mb-[10]">
    </div>
    <!--  -->
    <div style="scrollbar-width: none;" id="suma4" class="w-[100%] inline-block py-[20px] overflow-scroll">
        @if(empty($contx))
        <center><p class="text-[11px] mt-[30px]">Não existem eventos!</p></center>
        @else
        <div style="width: <?php echo $valor; ?>px; padding: 0px 12px;" class="inline-block">
            @foreach($eventos as $evento)
            <!-- CARD -->
            <div class="w-[200px] float-left h-[300px] bg-[#ffffff] rounded-[5px] shadow-md border-[1px] mx-[4px]">
                <!-- IMAGEM -->
                <div class="w-[100%] h-[100px]" style="border-radius: 5px 5px 0px 0px; background: url(/img/eventos/{{ $evento->imagem }}); background-size: 100%; background-position: center;">
                    <!-- DISPONÍVEL -->
                    <button class="py-[3px] px-[8px] shadow-md mt-[10px] ml-[0px] bg-[#333333] text-[#ffffff] text-[10px]">Últimas vagas</button>
                </div>
                <!-- INFORMAÇÕES -->
                <div class="w-[100%] p-[10px] h-[200px] bg-[#ffffff]" style="border-radius: 0px 0px 5px 5px;">
                    <!--  -->
                    <div class="w-[100%] h-[150px]">
                        <!-- TÍTULO -->
                        <p class="text-[#212121] text-[17px] font-bold">{{ $evento->titulo }}</p>
                        <!-- ESTRELAS -->
                        <ul class="mt-[10px]">
                            <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                            <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                            <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                            <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                            <li class="text-[18px] inline-block mr-[2px]"><img class="w-[10px]" src="/img/estrela.png"></li>
                            <li class="text-[13px] inline-block">(0)</li>
                        </ul>
                        <!--  -->
                        <?php $eventovalor = number_format($evento->valor,2,",",".");?>
                        <p class="text-[#212121] mt-[3px] font-bold text-[18px]">R${{ $eventovalor }}</p>
                        <!--  -->
                        <div class="w-[100%] h-[20px] mt-[5px]">
                            Kaza Rosa
                        </div>
                    </div>
                    <!-- BUTTON -->
                    <a href=""><button class="w-[100%] h-[30px] mt-[0px] text-[12px] text-[#ffffff] font-bold rounded-[5px] bg-[#A35554]">Quero agendar</button></a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection

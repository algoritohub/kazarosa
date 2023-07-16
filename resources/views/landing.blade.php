@extends('layout.main_landing')
@section('title', 'Kaza Rosa | Explore')
@section('content')
<!-- BLOCO1 -->
<section class="bg-[#ffffff]" id="um">
    <div class="w-[90%] pt-[0px] mx-auto my-[0px]">
        <div id="padding_bloco" class="w-[100%] pr-[40px] inline-block">
            <!-- LADO A -->
            <div id="total_w" class="w-[50%] h-[700px] float-left">
                <p id="titulo_xx" class="font-bold text-[85px] mt-[180px] text-[#ffffff] leading-[78px]">O futuro é feminino e colaborativo.</p>
            </div>
            <!-- LADO B -->
            <div id="total_x" class="w-[50%] h-[700px] float-left"></div>
            <!-- MODAL LATERAL -->
            <div class="modal_lateral">
                <div id="modal1" class="w-[30%] float-right h-[100vh] bg-[#ffffff] p-[50px] shadow-lg overflow-scroll">
                    <div class="w-[100%] inline-block mb-[20px]">
                        <!--  -->
                        <div class="w-[50%] inline-block float-left">
                            <p class="font-bold text-[20px]">Espaço</p>
                        </div>
                        <!--  -->
                        <div class="w-[50%] inline-block float-left">
                            <p id="box1" class="cursor-pointer float-right text-[20px]">✕</p>
                        </div>
                        <!--  -->
                    </div>
                    <!-- CARROSSEL -->
                    <div class="carrossel">
                        <!-- CONTAINER -->
                        <div class="container">
                            <img id="img1" class="w-[19%] h-[40px] mx-[0.5%] cursor-pointer rounded-[5px] float-left" src="/img/hall.png" alt="">
                            <!--  -->
                            <img id="img2" class="w-[19%] h-[40px] mx-[0.5%] cursor-pointer rounded-[5px] float-left" src="/img/1.TÉRREO.png" alt="">
                            <!--  -->
                            <img id="img3" class="w-[19%] h-[40px] mx-[0.5%] cursor-pointer rounded-[5px] float-left" src="/img/estacao.png" alt="">
                            <!--  -->
                            <img id="img4" class="w-[19%] h-[40px] mx-[0.5%] cursor-pointer rounded-[5px] float-left" src="/img/terrio.png" alt="">
                            <!--  -->
                            <img id="img5" class="w-[19%] h-[40px] mx-[0.5%] cursor-pointer rounded-[5px] float-left" src="/img/4.TÉRREO.png" alt="">
                            <!--  -->
                            <img id="img7" class="w-[19%] h-[40px] mx-[0.5%] cursor-pointer rounded-[5px] float-left" src="/img/cadeira.png" alt="">
                        </div>
                    </div>
                    <!-- EXIBIR -->
                    <div class="w-[100%] inline-block mb-[30px]">
                        <!--  -->
                        <img id="imgx1" class="w-[100%] rounded-[5px] mb-[30px]" src="/img/hall.png" alt="">
                        <!--  -->
                        <img id="imgx2" style="display: none;" class="w-[100%] rounded-[5px] mb-[30px]" src="/img/1.TÉRREO.png" alt="">
                        <!--  -->
                        <img id="imgx3" style="display: none;" class="w-[100%] rounded-[5px] mb-[30px]" src="/img/estacao.png" alt="">
                        <!--  -->
                        <img id="imgx4" style="display: none;" class="w-[100%] rounded-[5px] mb-[30px]" src="/img/terrio.png" alt="">
                        <!--  -->
                        <img id="imgx5" style="display: none;" class="w-[100%] rounded-[5px] mb-[30px]" src="/img/4.TÉRREO.png" alt="">
                        <!--  -->
                        <img id="imgx7" style="display: none;" class="w-[100%] rounded-[5px] mb-[30px]" src="/img/cadeira.png" alt="">
                    </div>
                    <!--  -->
                    <p class="mt-[10px] text-[16px]">Em um espaço físico bem localizado, com segurança e amplo estacionamento, a Kaza Rosa disponibiliza para a mulher empreendedora uma estrutura funcional e feminina, com estações de trabalho compartilhadas e privativas; auditório para eventos intimistas, com essência feminina e sofisticação; sala para atendimentos especiais e uma área de socialização.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="base">
    <div class="outro">
        <img class="w-[120%]" src="/img/fundo_tri.png">
    </div>
</section>
<div class="w-[100%] h-[10px] z-[1px] mt-[-5px] bg-[#C5908F]"></div>
<!-- BLOCO1 -->
<section class="bg-[#C5908F]">
    <div class="w-[90%] pt-[0px] mx-auto my-[0px]">
        <div id="padding_bloco" class="w-[100%] pr-[40px] inline-block">
            <!-- LADO A -->
            <div style="z-index: 120;" id="total_bm" class="w-[50%] h-[500px] float-left">
                <video class="w-[450px] mt-[-100px] shadow-lg" controls="controls">
                    <source src="/img/video_kaza.mp4" type="video/mp4">
                </video>
            </div>
            <!-- LADO B -->
            <div id="total_mb" class="w-[50%] h-[500px] float-left">
                <p class="mt-[40px] text-[16px] text-[#ffffff]">Um ecossistema empreendedor que irá impulsionar a carreira e os negócios de mulheres no mercado. Através de uma proposta inovadora, que visa conectar e diferenciar mulheres no mercado, a Kaza Rosa tem como propósito fomentar o empreendedorismo feminino, combinando o poder das conexões presenciais e o dinamismo do universo digital.</p>
                <p class="mt-[20px] text-[16px] text-[#ffffff]">Além das ações e estrutura para fomentar o protagonismo da mulher no mercado, teremos ainda a Escola de Diferenciação Feminina, que vem para apoiar o desenvolvimento de profissionais através cursos rápidos e atualizados com as necessidades do mercado, mentorias em grupo e formações especiais, em parceria com referências de diferentes áreas e instituições educacionais sediadas no Brasil e Exterior.</p>
                <button id="verMais1" class="w-[200px] h-[40px] mt-[40px] rounded-[100px] bg-[#874645] text-[#ffffff] text-[15px] shadow-lg">Conheça</button>
            </div>
            <!--  -->

        </div>
    </div>
</section>
<!-- BLOCO2 -->
<section class="bg-[#fafafa]" id="dois">
    <!-- MODAL -->
    <?php @$modal = $_GET['plan']; ?>
    <!--  -->
    @if(isset($modal) AND !empty($modal))
    <div style="display: show;" class="modal_planos_especial">
        <!--  -->
        <div id="modal_mobile" class="w-[1000px] h-[660px] shadow-lg mt-[2.5%] mx-[auto] bg-[#ffffff] overflow-scroll p-[50px] rounded-[30px]">
            <!--  -->
            <div id="ouwer" class="float-left inline-block border-r-[1px] border-[#cdcdcd] w-[50%] pr-[60px]">
                <!--  -->
                <p class="text-[20px] mb-[25px] font-bold uppercase">Crie uma conta nova!</p>
                <!--  -->
                <form action="{{ route('cadastro_plano') }}" method="POST">
                    @csrf
                    <!--  -->
                    <table class="w-[100%]">
                        <tr>
                            <td><p class="text-[16px]">Nome</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] pl-[10px] outline-none mt-[5px] bg-[#eeeeee] rounded-[10px] h-[45px] border-[1px] mb-[10px] border-[#cdcdcd]" name="nome" type="text"></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><p class="text-[16px]">E-mail</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] pl-[10px] outline-none mt-[5px] bg-[#eeeeee] rounded-[10px] h-[45px] border-[1px] mb-[10px] border-[#cdcdcd]" name="email" type="text"></td>
                        </tr>
                    </table>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        {{--  --}}
                        <div class="w-[29%] inline-block float-left mr-[1%]">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="text-[16px]">Nascimento</p></td>
                                </tr>
                                <!--  -->
                                <tr>
                                    <td><input class="w-[100%] pl-[10px] outline-none mt-[5px] bg-[#eeeeee] rounded-[10px] h-[45px] border-[1px] mb-[10px] border-[#cdcdcd]" id="date1" name="nascimento" type="text"></td>
                                </tr>
                            </table>
                        </div>
                        {{--  --}}
                        <div class="w-[69%] inline-block float-left ml-[1%]">
                            {{--  --}}
                            <table class="w-[100%]">
                                {{--  --}}
                                <tr>
                                    <td><p class="text-[16px]">Telefone</p></td>
                                </tr>
                                <!--  -->
                                <tr>
                                    <td><input class="w-[100%] pl-[10px] outline-none mt-[5px] bg-[#eeeeee] rounded-[10px] h-[45px] border-[1px] mb-[10px] border-[#cdcdcd]" id="phone1" name="telefone" type="text"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{--  --}}
                    <table class="w-[100%]">
                        <!--  -->
                        <tr>
                            <td><p class="text-[16px]">Senha</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] pl-[10px] outline-none mt-[5px] bg-[#eeeeee] rounded-[10px] h-[45px] border-[1px] mb-[10px] border-[#cdcdcd]" name="senha" type="password"></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><p class="text-[16px]">Confirme sua senha</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] pl-[10px] outline-none mt-[5px] bg-[#eeeeee] rounded-[10px] h-[45px]" name="confsenha" type="password"></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                @if($modal == "basic")
                                <input type="hidden" name="plano" value="1">
                                @elseif($modal == "vip")
                                <input type="hidden" name="plano" value="2">
                                @elseif($modal == "private")
                                <input type="hidden" name="plano" value="4">
                                @elseif($modal == "executive")
                                <input type="hidden" name="plano" value="3">
                                @endif
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <!--  -->
                                <?php

                                $inicio = date('d/m/Y');

                                ?>
                                <input type="hidden" name="inicio" value="{{ $inicio }}">
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            @if($modal == "basic")
                            <td><button class="w-[100%] mt-[20px] h-[45px] rounded-[10px] bg-[#313131] text-[#ffffff]">Cadastrar com Plan Basic</button></td>
                            @elseif($modal == "vip")
                            <td><button class="w-[100%] mt-[20px] h-[45px] rounded-[10px] bg-[#313131] text-[#ffffff]">Cadastrar com Plan Vip</button></td>
                            @elseif($modal == "private")
                            <td><button class="w-[100%] mt-[20px] h-[45px] rounded-[10px] bg-[#313131] text-[#ffffff]">Cadastrar com Plan Private</button></td>
                            @elseif($modal == "executive")
                            <td><button class="w-[100%] mt-[20px] h-[45px] rounded-[10px] bg-[#313131] text-[#ffffff]">Cadastrar com Plan Executive</button></td>
                            @endif
                        </tr>
                    </table>
                </form>
            </div>
            <!--  -->
            <div id="inner" class="float-left inline-block h-[200px] pl-[50px] w-[50%]">
                <!--  -->
                <img class="w-[95%] mx-[auto]" src="/img/celular_redesocial.png">
                <!--  -->
                <center><p class="text-[13px]">Acesse sua conta e encontre esse e outros planos exclusivos!</p></center>
                <!--  -->
                <a href="{{ route('login') }}"><button class="w-[100%] mt-[18px] h-[45px] rounded-[10px] bg-[#313131] text-[#ffffff]">Sou de Kasa? Continuar pelo celular</button></a>
                <!--  -->
                <center><a href="/"><p class="text-[13px] mt-[20px] font-bold">Voltar mais tarde</p></a></center>
            </div>
        </div>
    </div>
    @endif
    <!--  -->
    <div class="w-[90%] pt-[0px] mx-auto my-[0px]">
        <div id="padding_bloco" class="w-[100%] inline-block">
            <!-- LADO A -->
            <div id="total_y" class="w-[50%] h-[700px] float-left">
                <!-- ALTERAR IMAGEM APP + ESPAÇO -->
                <img id="cw" src="/img/mockup_kaza_rosa.png" class="w-[480px] mt-[60px] ml-[20px]" alt="">
            </div>
            <!-- LADO B -->
            <div id="total_w" class="w-[50%] h-[700px] float-left inline-block">
                <p id="titulo" class="font-bold text-[55px] mt-[80px] float-right leading-[50px]">Um clube de negócio para mulheres empreendedoras.</p>
                <p class="mt-[30px] text-[16px] float-right">Uma estrutura feminina e funcional, ações de conexão entre mulheres empreendedoras e uma rede digital de negócios exclusiva. O Clube de Negócios Co-Women irá unir o melhor dos dois mundos, disponibilizando ainda um ambiente colaborativo e compartilhando de trabalho.</p>
                <p class="mt-[30px] text-[16px] float-right">Saiba como ser uma sócia da Kaza Rosa e tenha benefícios diferenciados para ultilizar os nossos espaços e promover a sua marca, usufruindo do poder das conexões presenciais e da força do digital.</p>
                <a href="#quatro"><button class="w-[250px] h-[40px] mt-[30px] rounded-[100px] bg-[#874645] text-[#ffffff] text-[15px]">Conheça nossos planos</button></a>
            </div>
            <!--  -->
            <div id="quatro" class="w-[100%] mb-[60px] inline-block h-[40px]">
                <center>
                    <p class="text-[25px] font-bold uppercase pb-[15px] mb-[15px] border-b-[2px] border-b-[#eeeeee]">Clube de negócio</p>
                    <p class="text-[15px] text-[#874645] uppercase">nossos planos</p>
                </center>
            </div>
            <!--  -->
            <div class="w-[100%] mt-[40px] mb-[80px] inline-block">
                <!--  -->
                <div id="cola2" class="w-[23%] mx-[1%] float-left h-[500px] border-[#cdcdcd] border-[1px] p-[30px] rounded-[20px] border-[1px]">
                    <div class="w-[100%] h-[400px] inline-block">
                        <center>
                            <p class="font-bold text-[17px] uppercase text-[#874645]">Basic Plan</p>
                            <p class="mt-[5px] text-[25px] text-[#333333] mt-[10px] font-bold leading-[18px]">R$167,00/mês</p>
                        </center>
                        <hr class="mt-[20px] mb-[10px]">
                        <ul class="mt-[50px]">
                            <li class="mb-[15px] text-[14px] font-bold">✔ 12h mensais nas Estações Compartilhadas;</li>
                            <li class="mb-[15px] text-[14px] font-bold">✔ Rede de Negócio Exclusiva para Marcas Femininas e Mulheres Empreendedora;</li>
                            <li class="mb-[15px] text-[14px] font-bold">✔ 10% na Locação das Salas Privada e Executiva.</li>
                        </ul>
                    </div>
                    <!--  -->
                    <div class="w-[100%] h-[100px] inline-block">
                        <a href="?plan=basic"><button class="w-[100%] h-[40px] rounded-[100px] bg-[#874645] text-[#ffffff]">Escolher este!</button></a>
                    </div>
                </div>
                <!--  -->
                <div id="cola2" class="w-[23%] mx-[1%] float-left h-[500px] border-[#cdcdcd] border-[1px] p-[30px] rounded-[20px] border-[1px]">
                    <div class="w-[100%] h-[400px] inline-block">
                        <center>
                            <p class="font-bold text-[17px] uppercase text-[#874645]">Vip Plan</p>
                            <p class="mt-[5px] text-[25px] text-[#333333] mt-[10px] font-bold leading-[18px]">R$257,00/mês</p>
                        </center>
                        <hr class="mt-[20px] mb-[10px]">
                        <ul class="mt-[50px]">
                            <li class="mb-[15px] text-[14px] font-bold">✔ 12h mensais nas Estações Privadas (Sofá Executivo ou Penteadeira Lux);</li>
                            <li class="mb-[15px] text-[14px] font-bold">✔ Rede de Negócio Exclusiva para Marcas Femininas e Mulheres Empreendedora;</li>
                            <li class="mb-[15px] text-[14px] font-bold">✔ 10% na Locação das Salas Privada e Executiva.</li>
                        </ul>
                    </div>
                    <!--  -->
                    <div class="w-[100%] h-[100px] inline-block">
                        <a href="?plan=vip"><button class="w-[100%] h-[40px] rounded-[100px] bg-[#874645] text-[#ffffff]">Escolher este!</button></a>
                    </div>
                </div>
                <!--  -->
                <div id="cola2" class="w-[23%] mx-[1%] float-left h-[500px] border-[#cdcdcd] border-[1px] p-[30px] rounded-[20px] border-[1px]">
                    <div class="w-[100%] h-[400px] inline-block">
                        <center>
                            <p class="font-bold text-[17px] uppercase text-[#874645]">Private Plan</p>
                            <p class="mt-[5px] text-[25px] text-[#333333] mt-[10px] font-bold leading-[18px]">R$420,00/mês</p>
                        </center>
                        <hr class="mt-[20px] mb-[10px]">
                        <ul class="mt-[50px]">
                            <li class="mb-[15px] text-[14px] font-bold">✔ 16h mensais na Sala Privativa (reservas para mínimo de 4h);</li>
                            <li class="mb-[15px] text-[14px] font-bold">✔ Rede de Negócio Exclusiva para Marcas Femininas e Mulheres Empreendedora;</li>
                            <li class="mb-[15px] text-[14px] font-bold">✔ 10% na Locação da Sala Executiva.</li>
                        </ul>
                    </div>
                    <!--  -->
                    <div class="w-[100%] h-[100px] inline-block">
                        <a href="?plan=private"><button class="w-[100%] h-[40px] rounded-[100px] bg-[#874645] text-[#ffffff]">Escolher este!</button></a>
                    </div>
                </div>
                <!--  -->
                <div id="cola2" class="w-[23%] mx-[1%] float-left h-[500px] border-[#cdcdcd] border-[1px] p-[30px] rounded-[20px] border-[1px]">
                    <div class="w-[100%] h-[400px] inline-block">
                        <center>
                            <p class="font-bold text-[17px] uppercase text-[#874645]">Executive Plan</p>
                            <p class="mt-[5px] text-[25px] text-[#333333] mt-[10px] font-bold leading-[18px]">R$637,00/mês</p>
                        </center>
                        <hr class="mt-[20px] mb-[10px]">
                        <ul class="mt-[50px]">
                            <li class="mb-[15px] text-[14px] font-bold">✔ 16h mensais na Sala Privada (reservas com no mínimo de 4h);</li>
                            <li class="mb-[15px] text-[14px] font-bold">✔ Rede de Negócio Exclusiva para Marcas Femininas e Mulheres Empreendedora;</li>
                            <li class="mb-[15px] text-[14px] font-bold">✔ 20% na Locação de qualquer espaço da Kaza.</li>
                        </ul>
                    </div>
                    <!--  -->
                    <div class="w-[100%] h-[100px] inline-block">
                        <a href="?plan=executive"><button class="w-[100%] h-[40px] rounded-[100px] bg-[#874645] text-[#ffffff]">Escolher este!</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- BLOCO3 (Kazarosa2022) -->
<section class="bg-[green]" id="tres">
    <div class="w-[90%] pt-[0px] mx-auto my-[0px]">
        <div id="padding_bloco" class="w-[100%] inline-block">
            <!-- LADO A -->
            <div id="total_w" class="w-[50%] h-[700px] float-left">
                <p id="titulo" class="font-bold text-[70px] mt-[150px] text-[#ffffff] leading-[60px]">Conexão & Colaboração & Cocriação.</p>
                <p class="mt-[30px] text-[16px] text-[#ffffff]">Nós acreditamos que sozinhas somos fortes, mas juntas nos tornamos grandes e imparáveis. “Iremos ressignificar a forma como muitas mulheres fazem negócios. Com uma visão global e colaborativa, entendemos que a conexão genuína cria laços afetivos, alicerça a confiança e impulsiona os resultados” ressalta nossa CEO, Kênia Raissa.</p>
                <a href="#service"><button class="w-[200px] h-[40px] mt-[30px] rounded-[100px] bg-[#874645] text-[#ffffff] text-[15px]">Nossos serviços</button></a>
            </div>
            <!-- LADO B -->
            <div id="total_x" class="w-[50%] h-[700px] float-left"></div>
        </div>
    </div>
</section>
<!-- BLOCO45 -->
<section id="service" class="bg-[#ffffff]">
    <div class="w-[90%] pt-[0px] mx-auto my-[0px]">
        <div id="padding_bloco" class="w-[100%] inline-block">
            <!--  -->
            <div class="w-[100%] mt-[90px] mb-[40px]">
                <center><p id="rots" class="w-[500px] text-center font-bold text-[20px] uppercase">Conheça nossos espaços</p></center>
            </div>
            <!--  -->
            <div class="w-[100%] inline-block">
                <!--  -->
                <div id="total_g" class="w-[30%] rounded-[8px] shadow-lg border-[1px] mx-[1.5%] mb-[20px] inline-block float-left">
                    <div class="w-[100%] mb-[10px] inline-block">
                        <!--  -->
                        <div class="w-[100%] inline-block h-[300px] rounded-[8px] bg-[red] float-left" style="background: url(img/1.TÉRREO.png); background-size: 100%; background-position: center;"></div>
                        <!--  -->
                        <div id="xpp" class="w-[100%] inline-block h-[350px] p-[30px] float-left">
                            <p class="text-[20px] mb-[20px] text-[#C5908F]">Salão principal</p>
                            <p class="text-[16px] mb-[20px] text-[#333333]">Salão principal para eventos noturnos especiais, como lançamento de livros, exposições, desfiles de moda, encontros profissionais de empreendedoras, entre outros</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div id="total_g" class="w-[30%] rounded-[8px] shadow-lg border-[1px] mx-[1.5%] mb-[20px] inline-block float-left">
                    <div class="w-[100%] mb-[10px] inline-block">
                        <!--  -->
                        <div class="w-[100%] inline-block h-[300px] rounded-[8px] bg-[red] float-left" style="background: url(img/estacao.png); background-size: 100%; background-position: center;"></div>
                        <!--  -->
                        <div id="xpp" class="w-[100%] inline-block h-[350px] p-[30px] float-left">
                            <p class="text-[20px] mb-[20px] text-[#C5908F]">Estações de trabalho compartilhadas</p>
                            <p class="text-[16px] mb-[20px] text-[#333333]">Dispomos de uma estrutura de coworking exclusiva para mulheres, que combina beleza e funcionalidade, com internet de alta velocidade, autosserviço para lanches e refeições, secretárias solicitas e preparadas, em uma excelente localização.</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div id="total_g" class="w-[30%] rounded-[8px] shadow-lg border-[1px] mx-[1.5%] mb-[20px] inline-block float-left">
                    <div class="w-[100%] mb-[10px] inline-block">
                        <!--  -->
                        <div class="w-[100%] inline-block h-[300px] rounded-[8px] bg-[red] float-left" style="background: url(img/social.png); background-size: 100%; background-position: center;"></div>
                        <!--  -->
                        <div id="xpp" class="w-[100%] inline-block h-[350px] p-[30px] float-left">
                            <p class="text-[20px] mb-[20px] text-[#C5908F]">Estações Privativas</p>
                            <p class="text-[16px] mb-[20px] text-[#333333]">Local especialmente desenvolvido para receber clientes e parcerias para reuniões rápidas. Em um espaço aconchegante, reservado e com atendimento especial.</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div id="total_g" class="w-[30%] rounded-[8px] shadow-lg border-[1px] mx-[1.5%] mb-[20px] inline-block float-left">
                    <div class="w-[100%] mb-[10px] inline-block">
                        <!-- ALTERA IMAGEM - APP + ESTRUTURA FÍSICA -->
                        <div class="w-[100%] inline-block h-[300px] rounded-[8px] bg-[red] float-left" style="background: url(img/privativa.png); background-size: 100%; background-position: center;"></div>
                        <!--  -->
                        <div id="xpp" class="w-[100%] inline-block h-[350px] p-[30px] float-left">
                            <p class="text-[20px] mb-[20px] text-[#C5908F]">Sala Privativa</p>
                            <p class="text-[16px] mb-[20px] text-[#333333]">Uma sala individual que combina charme e funcionalidade. Com tratamento acústico, além de atender clientes especiais, é ideal para a gravação de vídeos e podcasts para redes sociais.</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div id="total_g" class="w-[30%] rounded-[8px] shadow-lg border-[1px] mx-[1.5%] mb-[20px] inline-block float-left">
                    <div class="w-[100%] mb-[10px] inline-block">
                        <!--  -->
                        <div class="w-[100%] inline-block h-[300px] rounded-[8px] bg-[red] float-left" style="background: url(img/espaco11.jpeg); background-size: 100%; background-position: center;"></div>
                        <!--  -->
                        <div id="xpp" class="w-[100%] inline-block h-[350px] p-[30px] float-left">
                            <p class="text-[20px] mb-[20px] text-[#C5908F]">Sala Executiva</p>
                            <p class="text-[16px] mb-[20px] text-[#333333]">Auditório especialmente projetado para eventos intimistas e treinamentos, como cursos, workshops e mentorias em grupo, com capacidade para 16 profissionais, em diferentes formatos.</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div style="display: none;" id="total_g" class="w-[30%] rounded-[8px] shadow-lg border-[1px] mx-[1.5%] mb-[20px] inline-block float-left">
                    <div class="w-[100%] mb-[10px] inline-block">
                        <!--  -->
                        <div class="w-[100%] inline-block h-[300px] rounded-[8px] bg-[red] float-left" style="background: url(img/espaco11.jpeg); background-size: 100%; background-position: center;"></div>
                        <!--  -->
                        <div id="xpp" class="w-[100%] inline-block h-[350px] p-[30px] float-left">
                            <p class="text-[20px] mb-[20px] text-[#C5908F]">Escola de Diferenciação Feminina</p>
                            <p class="text-[16px] mb-[20px] text-[#333333]">Cursos rápidos e formações especializadas para diferenciar o posicionamento de mulheres no mercado. Com um time de  profissionais de peso em áreas como Personal Branding, Imagem Estratégica, Mídias Digitais, Comunicação e Oratória, Gestão e Liderança.</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div style="display: none;" id="total_g" class="w-[30%] rounded-[8px] shadow-lg border-[1px] mx-[1.5%] mb-[20px] inline-block float-left">
                    <div class="w-[100%] mb-[10px] inline-block">
                        <!--  -->
                        <div class="w-[100%] inline-block h-[300px] rounded-[8px] bg-[red] float-left" style="background: url(img/apps_service.png); background-size: 100%; background-position: center;"></div>
                        <!--  -->
                        <div id="xpp" class="w-[100%] inline-block h-[350px] p-[30px] float-left">
                            <p class="text-[20px] mb-[20px] text-[#C5908F]">Clube de Negócios</p>
                            <p class="text-[16px] mb-[20px] text-[#333333]">Um espaço de visibilidade para marcas pessoais e corporativas que desejam trabalhar o público feminino. Combinado ações presenciais em eventos, acesso à rede social CoWomen, além da divulgação de condições especiais em um clube de vantagens para clientes da Kaza Rosa e Associadas da Rede Mulheres que Marcam.</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div id="total_g" class="w-[30%] rounded-[8px] shadow-lg border-[1px] mx-[1.5%] mb-[20px] inline-block float-left">
                    <div class="w-[100%] mb-[10px] inline-block">
                        <!--  -->
                        <div class="w-[100%] inline-block h-[300px] rounded-[8px] bg-[red] float-left" style="background: url(img/cadeira.png); background-size: 100%; background-position: center;"></div>
                        <!--  -->
                        <div id="xpp" class="w-[100%] inline-block h-[350px] p-[30px] float-left">
                            <p class="text-[20px] mb-[20px] text-[#C5908F]">Penteadeira Luxo</p>
                            <p class="text-[16px] mb-[20px] text-[#333333]">Um espaço ideal para ações de marcas que trabalham com beleza e cuidados especiais. Integrada ao nosso salão principal, a Penteadeira Luxo é uma vitrine para promover produtos e gerar vendas junto ao público que frequenta a Kaza Rosa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  -->
<section style="display:none" class="bg-[#874645] mt-[40px]" style="background-image: linear-gradient(to right, #C5908F, #BDA06F);">
    <div id="eps" class="w-[50%] mx-[25%] inline-block">
        <div class="w-[100%] py-[40px] inline-block">
            <center>
                <img src="/img/email.png" class="w-[60px] mb-[20px]" alt="">
                <p class="text-[20px] leading-[20px] font-bold text-[#ffffff]">Receba nossas principais novidades em seu e-mail!</p>
                <form action="{{ route('newslatter') }}" method="POST">
                    @csrf
                    <table class="w-[100%]">
                        <tr>
                            <td class="w-[80%]"><input id="iptx" placeholder="Cadastre seu e-mail e aproveite!" name="email" class="mt-[20px] mx-auto pl-[20px] text-[16px] w-[100%] h-[50px] rounded-[100px] shadow-lg outline-none mb-[20px]" type="text"></td>
                            <td class="w-[20%]"><button id="xx1" class="w-[100%] ml-[10px] rounded-[100px] bg-[#313131] text-[#ffffff] h-[50px]">Assinar</button></td>
                        </tr>
                    </table>
                    <!--  -->
                </form>
            </center>
        </div>
    </div>
</section>
{{-- CAPTURA DE INFORMAÇÕES DE CONTATO --}}
<section class="w-[100%] inline-block">
    {{--  --}}
    <div style="background-image: url('/img/fundo_app2.png'); background-size: 100%; background-position: center;" class="w-[100%] inline-block bg-[#C5908f] mt-[60px] py-[160px]">
        {{--  --}}
        <div class="w-[80%] mx-[10%]">
            <center>
                {{--  --}}
                <p class="font-bold text-[30px] text-[#ffffff]">Saiba mais informações sobre nosso espaço.</p>
                {{--  --}}
                <button id="button_form" class="px-[50px] shadow-lg h-[50px] mt-[20px] text-[16px] text-[#ffffff] bg-[#212121] rounded-[100px] mb-[30px]">Entramos em contato com você!</button>
                <!-- EXIBIR ERROS DE VALIDAÇÃO -->
                @if($errors->any())
                <div style="display: none;" class="w-[100%] my-[30px]">
                    <center>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="text-[13px] mb-[5px] text-[#ffffff]">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </center>
                </div>
                @endif
                <form id="toggle_form" style="display: none;" action="{{ route('contato_cliente') }}" method="POST">
                    @csrf
                    <table class="w-[100%]">
                        <tr>
                            <td class="w-[23%]"><input class="w-[98%] text-[16px] pl-[20px] outline-none h-[50px] mx-[1%] rounded-[100px]" name="nome" placeholder="Seu nome" type="text"></td>
                            <td class="w-[23%]"><input class="w-[98%] text-[16px] pl-[20px] outline-none h-[50px] mx-[1%] rounded-[100px]" name="email" placeholder="Seu e-mail" type="text"></td>
                            <td class="w-[23%]"><input class="w-[98%] text-[16px] pl-[20px] outline-none h-[50px] mx-[1%] rounded-[100px]" name="telefone" placeholder="Seu número" id="phone2" type="text"></td>
                            <td class="w-[23%]">>
                                {{--  --}}
                                <button class="px-[50px] shadow-lg h-[50px] mx-[1%] text-[16px] text-[#ffffff] bg-[#A35554] rounded-[100px]">Enviar contato!</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </center>
        </div>
    </div>
</section>
<!-- BLOCO4 -->
<section id="ultra" class="bg-[#ffffff]">
    <div class="w-[90%] pt-[0px] mx-auto my-[0px]">
        <div id="padding_bloco" class="w-[100%] inline-block">
            <!-- LADO A -->
            <div id="total_g" class="w-[100%] inline-block float-left">
                <!-- TITULO -->
                <div class="w-[100%] inline-block">
                    <center>
                        <p class="font-bold text-[30px] mt-[70px]">PROGRAMAÇÃO</p>
                    </center>
                </div>
                <!--  -->
                <div class="w-[100%] mt-[50px] inline-block">
                    <!-- CONEXÃO PDO -->
                    <?php

                    $name_banco = env('PDO_BANCO');
                    $host       = env('PDO_HOST');
                    $conectDB   = 'mysql:host='.$host.';dbname='.$name_banco;
                    $name_user  = env('PDO_USER');
                    $pass_banco = env('PDO_SENHA');

                    $conn = new PDO($conectDB, $name_user, $pass_banco);

                    // VERIFICAÇÃO DE CONTAS
                    $stmtxx = $conn->prepare('SELECT * FROM clubes');
                    $stmtxx->execute();
                    $resultxx = $stmtxx->fetchAll();

                    // VERIFICAÇÃO DE CONTAS
                    $admin = $conn->prepare('SELECT * FROM admins');
                    $admin->execute();
                    $resadm = $admin->fetchAll();
                    foreach ($resadm as $emin) {}

                    if ($resultxx) {
                        if ($emin['log'] != date('d/m/Y')) {

                            // REDUZIR DATA
                            $stmtxy = $conn->prepare('UPDATE clubes SET dias = dias -1');
                            $stmtxy->execute();

                            // REDUZIR DATA
                            $stmtxy = $conn->prepare('UPDATE admins SET log = :datax');
                            $stmtxy->execute(array('datax' => date('d/m/Y')));
                        }
                    }

                    @$get_modal = $_GET['variante'];

                    $stmt = $conn->prepare('SELECT * FROM eventos ORDER BY datas ASC');
                    $stmt->execute();

                    $result = $stmt->fetchAll();

                    $contagem = count($result);

                    ?>
                    <!--  -->
                    @if($contagem > 0)
                    @foreach($result as $row)
                    <div id="rn1" class="w-[23%] mb-[40px] inline-block shadow-lg border-t-[5px] border-t-[#C5908F] mx-[1%] rounded-[8px] bg-[#fafafa] float-left border-[1px]">
                        <!-- BLOCO DE IMAGEM -->
                        <div class="w-[100%] bg-[silver] inline-block">
                            <img class="w-[100%]" src="/img/eventos/{{ $row['imagem'] }}" alt="evento">
                        </div>
                        <!-- VLOCO DE INFORMAÇÃO -->
                        <div class="w-[100%] p-[40px] h-[380px]">
                            <!--  -->
                            <p class="text-[18px] font-bold mb-[20px] text-[#c5908f]">{{ $row['titulo'] }}</p>
                            <p class="font-bold">{{ $row['descricao'] }}</p>
                            <div class="w-[100%] mt-[20px] inline-block">
                                <!--  -->
                                <div class="w-[30%] float-left">
                                    <p class="font-bold">{{ $row['hora'] }}</p>
                                </div>
                                <!--  -->
                                <div class="w-[70%] float-left">
                                    @if($row['entrada'] == 1)
                                    <p class="font-bold float-right">Evento aberto</p>
                                    @elseif($row['entrada'] == 2)
                                    <p class="font-bold float-right">R${{ $row['valor'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <?php

                        // VERIFICAR SE EXISTEM VARIAVEIS PARA ESSE EVENTO
                        $stmtx = $conn->prepare('SELECT * FROM variants WHERE evento = :id');
                        $stmtx->execute(array('id' => $row['id']));

                        $resultx = $stmtx->fetchAll();

                        $contagemx = count($resultx);

                        if($contagem){
                            foreach($resultx as $rowx) {
                                $quant = $rowx['quantidade'];
                            }
                        }

                        if($contagemx > 0){

                            if($quant > 0){

                                echo '

                                <div class="w-[100%] h-[130px] p-[40px] inline-block">
                                    <a href="?variante='.$row['id'].'#ultra"><button class="w-[100%] h-[40px] rounded-[100px] mt-[15px] bg-[#874645] text-[#ffffff]">Compre agora</button></a>
                                </div>

                                ';
                            }

                            else{
                                echo '

                                <div class="w-[100%] h-[130px] p-[40px] inline-block">
                                    <button class="w-[100%] h-[40px] rounded-[100px] mt-[15px] bg-[#874645] text-[#ffffff]">Evento em breve</button>
                                </div>

                                ';
                            }
                        }
                        else{
                            if($row['entrada'] == 1){
                                echo '

                                <div class="w-[100%] h-[130px] p-[40px] inline-block">
                                    <button class="w-[100%] h-[40px] rounded-[100px] mt-[15px] bg-[#874645] text-[#ffffff]">Evento aberto</button>
                                </div>

                                ';
                            }
                            else{

                                if($row['quantidade'] > 0){

                                    echo '

                                    <div class="w-[100%] h-[130px] p-[40px] inline-block">
                                        <a href="/php/payment_links.php?event='.$row['id'].'"><button class="w-[100%] h-[40px] rounded-[100px] mt-[15px] bg-[#874645] text-[#ffffff]">Compre agora</button></a>
                                    </div>

                                    ';
                                }

                                else{
                                    echo '

                                    <div class="w-[100%] h-[130px] p-[40px] inline-block">
                                        <button class="w-[100%] h-[40px] rounded-[100px] mt-[15px] bg-[#874645] text-[#ffffff]">Evento em breve</button>
                                    </div>

                                     ';
                                }
                            }
                        }

                        ?>
                        <!-- MODAL -->
                        @if($get_modal == $row['id'])
                        <div class="modal_compra">
                            <div class="w-[400px] shadow-lg h-[600px] rounded-[8px] bg-[#ffffff] mx-[auto] p-[40px] mt-[50px]">
                                <!--  -->
                                <div class="w-[100%] inline-block">
                                    <!--  -->
                                    <div class="w-[70%] inline-block float-left">
                                        <p class="text-[18px] font-bold mb-[20px] text-[#c5908f]">{{ $row['titulo'] }}</p>
                                    </div>
                                    <!--  -->
                                    <div class="w-[30%] inline-block float-left">
                                        <a href="/#ultra"><p class="float-right cursor-pointer">✕</p></a>
                                    </div>
                                </div>
                                <!--  -->
                                @foreach($resultx as $rowx)
                                <div class="w-[100%] mb-[10px] inline-block">
                                    <!--  -->
                                    <div class="w-[70%] inline-block float-left">
                                        <p class="text-[13px] mt-[8px]">
                                            {{ $rowx['data'] }} -
                                            @if($rowx['turno'] == 1)
                                            Manhã
                                            @elseif($rowx['turno'] == 2)
                                            Tarde
                                            @elseif($rowx['turno'] == 3)
                                            Noite
                                            @endif
                                        </p>
                                    </div>
                                    <!--  -->
                                    <div class="w-[30%] inline-block float-left">
                                        @if($rowx['entrada'] == 1)
                                        <button class="w-[100%] float-right h-[35px] rounded-[10px] bg-[#874645] text-[#ffffff]">Evento aberto</button>
                                        @else
                                        <a href="/php/payment_links.php?event={{ $row['id'] }}&variant={{ $rowx['id'] }}"><button class="w-[100%] float-right h-[35px] rounded-[10px] bg-[#874645] text-[#ffffff]">R$ {{ $rowx['valor'] }}</button></a>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                    @else
                    <center><p class="mt-[200px] mb-[300px] text-[18px]">Não temos programação de eventos no momento!</p></center>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- BLOCO DOWNLOAD -->
<section class="bg-[#fafafa]">
    <div class="w-[90%] pt-[0px] mx-auto my-[0px]">
        <div id="padding_bloco" class="w-[100%] inline-block">
            <!-- LADO GERAL -->
            <div class="w-[100%] h-[100vh] float-left">
                <div class="w-[100%] inline-block">
                    <!--  -->
                    <div id="total_wf" class="w-[70%] float-left h-[660px] inline-block">
                        <div class="w-[100%] h-[100vh] inline-block">
                            <!--  -->
                            <div id="total_wf" class="w-[50%] mt-[140px] float-left inline-block">
                                <!--  -->
                                <p class="font-bold mt-[10px] text-[40px] leading-[38px]">Facilidades na palma da mão. </p>
                                <p class="mt-[30px] text-[16px]">Nós acreditamos que sozinhas somos fortes, sim! Mas juntas, nos tornamos imbatíveis, imparáveis. Iremos ressignificar a forma como muitas mulheres fazem negócios. Com uma visão global e colaborativa, entendemos que a conexão genuína cria laços afetivos, alicerça a confiança e impulsiona os resultados.</p>
                                <div class="mt-[100px] font-bold">Instale a nova versão diretamente em seu dispositivo!</div>
                                <div class="w-[100%] ml-[-10px] inline-block">
                                    <div class="w-[50%] float-left inline-block">
                                        <img class="mt-[30px] float-left w-[90%]" src="/img/android.png" alt="">
                                    </div>
                                    <div class="w-[50%] float-left inline-block">
                                        <img class="mt-[30px] float-left w-[90%]" src="/img/apple.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <div id="total_ws" class="w-[50%] float-left inline-block">
                                <img class="w-[85%] mt-[80px] mx-auto" src="/img/mockup_kaza_rosa_rodape.png" alt="">
                            </div>
                        </div>
                        <!--  -->
                        <div class="w-[80%] h-[100px] mx-[10%]">

                        </div>
                    </div>
                    <!--  -->
                    <div id="qr" class="w-[30%] float-left h-[700px] px-[30px] inline-block">
                        <div class="w-[100%] inline-block border-[1px] rounded-[20px] p-[40px] mt-[70px] bg-[#ffffff]">
                            <!-- <button class="w-[150px] h-[40px] ml-[60px] mt-[110px] z-40 absolute text-[#ffffff] shadow-lg bg-[#333333]">Disponível em breve!</button> -->
                            <img class="w-[100%] border-[1px]" src="/img/frame.png" alt="">
                            <center>
                                <p class="text-[13px] mt-[20px] leading-[14px]">Experimente a nova vesão do app direto do seu celular, e aproveite todos os recusos do App!</p>
                                <p class="mt-[20px] text-[#c5908f] font-bold text-[18px]">Muito mais leve</p>
                                <p class="mt-[3px] text-[#c5908f] font-bold text-[18px]">Novos Recursos</p>
                                <p class="mt-[3px] text-[#c5908f] font-bold text-[18px]">Coworking</p>
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
@endsection

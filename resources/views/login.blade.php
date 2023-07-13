@extends('layout.main_ws')
@section('title', 'Kaza Rosa | Login')

@section('content')
<section class="w-[100%]">
    <!-- PÁGINA DE ALERTA PARA DOWNLOAD -->
    <div id="exibir" class="w-[90%] px-[5%] h-[100vh] bg-[#ffffff]">
        <div id="padding_bloco" class="w-[100%] inline-block">
            <!-- LADO GERAL -->
            <div class="w-[100%] h-[660px] float-left">
                <div class="w-[100%] inline-block">
                    <!--  -->
                    <div id="total_w" class="w-[70%] float-left h-[660px] inline-block">
                        <div class="w-[100%] h-[560px] inline-block">
                            <!--  -->
                            <div id="total_w" class="w-[50%] mt-[140px] float-left inline-block">
                                <!--  -->
                                <div class="mb-[30px] mt-[-30px] font-bold">Disponível para download em breve!</div>
                                <p class="font-bold mt-[10px] text-[40px] leading-[38px]">Facilidades na palma da mão. </p>
                                <p class="mt-[30px] text-[16px]">Nós acreditamos que sozinhas somos fortes, sim! Mas juntas, nos tornamos imbatíveis, imparáveis. Iremos ressignificar a forma como muitas mulheres fazem negócios. Com uma visão global e colaborativa, entendemos que a conexão genuína cria laços afetivos, alicerça a confiança e impulsiona os resultados.</p>
                                <img class="w-[70%] mt-[30px] float-left w-[160px]" src="/img/android.png" alt="">
                                <img class="w-[70%] mt-[30px] float-left w-[160px]" src="/img/apple.png" alt="">
                            </div>
                            <!--  -->
                            <div id="total_ws" class="w-[50%] float-left inline-block">
                                <img class="mt-[80px]" src="/img/celular.png" alt="">
                            </div>
                        </div>
                        <!--  -->
                        <div class="w-[80%] h-[100px] mx-[10%]">

                        </div>
                    </div>
                    <!--  -->
                    <div id="qr" class="w-[30%] float-left h-[660px] px-[30px] inline-block">
                        <div class="w-[100%] h-[560px] rounded-[20px] p-[40px] mt-[70px] bg-[#ffffff]">
                            <!-- <button class="w-[150px] h-[40px] ml-[60px] mt-[110px] z-40 absolute text-[#ffffff] shadow-lg bg-[#333333]">Disponível em breve!</button> -->
                            <img class="w-[100%]" src="/img/frame.png" alt="">
                            <center>
                                <p class="text-[13px] leading-[14px]">Experimente a vesão web mobile direto do seu celular, e aproveite todos os recusos do App!</p>
                                <p class="mt-[20px] text-[#c5908f] font-bold text-[18px]">Agendamentos online</p>
                                <p class="mt-[3px] text-[#c5908f] font-bold text-[18px]">Carteira virtual</p>
                                <p class="mt-[3px] text-[#c5908f] font-bold text-[18px]">Eventos exclusivos</p>
                                <p class="mt-[3px] text-[#c5908f] font-bold text-[18px]">Rede social exclusiva</p>
                                <p class="mt-[20px] text-[10px] leading-[9px]">Aponte a câmera do seu celular e aproveite!</p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <div id="carregando" class="mod_loader">
        <center>
        <div class="mt-[250px] rounded-[10px] inline-block px-[19px] py-[15px]">
            <img src="/img/load.png" class="w-[50px] mt-[8px] ml-[5px] absolute">
            <span class="loader"></span>
        </div>
        </center>
    </div>
    <!-- CONTAINER -->
    <div id="conteudo" style="display: none;">
        <div class="w-[90%] mx-[auto] h-[60px] md:hidden">
            <div class="w-[100%] inline-block">
                {{-- ALERTA DE CADASTRO --}}
                @if(isset($stts) AND !empty($stts))
                    <div class="p-[5%] w-[90%] bg-[#c5908f] shadow-lg mt-[50px] absolute rounded-[10px] opacity-[0.8]">
                        <center><p class="text-[10px] text-[#333333] uppercase">{{ $stts }}</p></center>
                    </div>
                @endif
                <!-- LOGO -->
                <div class="w-[100%] mt-[150px] mb-[80px] float-left inline-block">
                    <center>
                        <img class="w-[160px]" src="/img/Ativo 6.png" alt="Kasa Rosa">
                    </center>
                </div>
                <!-- FORM LOGIN -->
                <div class="w-[100%] float-left inline-block">
                    <div class="w-[100%] mt-[50px] bg-[#ffffff] shadow-lg p-[20px] rounded-[20px]">
                        <form action="{{ route('logar') }}" method="POST">
                            @csrf
                            <!-- EMAIL -->
                            @if(isset($mail) AND !empty($mail))
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="text" value="{{ $mail }}" name="email" placeholder="E-mail"><img src="/img/at.png" class="w-[16px] mt-[-42px] opacity-[0.5] ml-[16px] absolute"/>
                            @else
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="text" name="email" placeholder="E-mail"><img src="/img/at.png" class="w-[16px] mt-[-42px] opacity-[0.5] ml-[16px] absolute"/>
                            @endif
                            <!-- SENHA -->
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="password" name="senha" placeholder="Senha"><img src="/img/lock.png" class="w-[16px] mt-[-42px] opacity-[0.5] ml-[16px] absolute"/>
                            <!-- SUBMIT -->
                            <input class="w-[100%] h-[45px] rounded-[8px] bg-[#A35554] text-[#ffffff] text-[15px] font-bold mb-[10px] cursor-pointer" type="submit" value="Entrar">
                        </form>
                        <!-- BOTÃO DE CADASTRO -->
                        <div class="w-[100%] mt-[10px] inline-block">
                            {{--  --}}
                            <div class="w-[50%] float-left inline-block">
                                {{--  --}}
                                <a href="{{ route('cadastro') }}"><p class="text-[13px] text-[#a35554]">Criar uma conta</p></a>
                            </div>
                            {{--  --}}
                            <div class="w-[50%] float-left inline-block">
                                {{--  --}}
                                <a href="{{ route('recuperar') }}"><p class="float-right text-[13px] text-[#a35554]">Recupera senha</p></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- NAVEGATIONS -->
                <div class="w-[100%] mb-[30px] float-left inline-block">
                    <center>
                        <a href="{{ route('home') }}"><p class="text-[14px] mt-[30px] text-[#ffffff]">Conheça a nossa Kasa</p></a>
                    </center>
                </div>
                <!-- EXIBIR ERROS DE VALIDAÇÃO -->
                @if($errors->any())
                <div class="w-[100%] mt-[30px]">
                    <center>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="text-[10px] mb-[5px] text-[#ffffff]">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </center>
                </div>
                @endif
                <!-- EXIBIR ERROS DE ACESSO -->
                @if(isset($erro))
                <div class="w-[100%] mt-[30px]">
                    <center>
                        <p class="text-[10px] mb-[5px] text-[#ffffff]">{{ $erro }}</p>
                    </center>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

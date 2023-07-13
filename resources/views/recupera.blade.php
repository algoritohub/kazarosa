@extends('layout.main_ws')
@section('title', 'Kaza Rosa | Recuparar senha')

@section('content')
<section class="w-[100%]">
    <!-- PÁGINA DE ALERTA PARA DOWNLOAD -->
    <div id="exibir" class="w-[90%] px-[5%] h-[100vh] bg-[#fafafa]">
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
    <div class="w-[90%] mx-[auto] h-[60px] md:hidden">
        <div class="w-[100%] inline-block">
            <!-- LOGO -->
            <div class="w-[100%] mt-[140px] mb-[50px] float-left inline-block">
                <center>
                    <img class="w-[160px]" src="/img/Ativo 6.png" alt="Kaza Rosa">
                </center>
            </div>
            <!-- VERIFICAR E-MAIL -->
            @if (!isset($stts) AND empty($stts))
            <div class="inline-block w-[100%]" class="w-[100%] float-left inline-block">
                <!--  -->
                <center><p class="w-[290px] mb-[30px] text-[#ffffff] text-[12px]">Caso tenha esquecido seu acesso, informe o e-mail cadastrado abaixo, com ele você receberá instruções para recuperar sua senha.</p></center>
                <!--  -->
                <form action="{{ route('verificar_rec') }}" method="POST">
                    @csrf
                    <!-- CODIGO -->
                    <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] bg-[#ffffff] pl-[10px] mb-[10px] text-[13px] outline-none" type="text" name="email_rec" placeholder="E-mail">
                    <!-- SUBMIT -->
                    <input class="w-[100%] h-[45px] rounded-[8px] mt-[10px] bg-[#A35554] text-[#ffffff] font-bold mb-[30px] cursor-pointer" type="submit" value="Recuperar acesso">
                </form>
            </div>
            @else
            {{-- VERIFICAR CODIGO --}}
            <div class="inline-block w-[100%]">
                <!--  -->
                <center><p class="w-[290px] mb-[30px] text-[#ffffff] text-[12px]">Informe o código que enviamos para o e-mail {{ $email_ver }}, em seguda digite e confirme sua nova senha.</p></center>
                <!--  -->
                <form action="{{ route('recuperar_senha') }}" method="POST">
                    @csrf
                    <!-- CODIGO -->
                    <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] bg-[#ffffff] pl-[10px] mb-[10px] text-[16px] text-center outline-none" type="text" name="codigo" placeholder="- - - - - -">
                    <!-- CODIGO -->
                    <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] bg-[#ffffff] pl-[10px] mb-[10px] text-[13px] outline-none" type="password" name="senha" placeholder="Senha">
                    <!-- CODIGO -->
                    <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] bg-[#ffffff] pl-[10px] mb-[10px] text-[13px] outline-none" type="password" name="confsenha" placeholder="Senha">
                    <!-- HIDDEN -->
                    <input type="hidden" name="email" value="{{ $email_ver }}">
                    <input type="hidden" name="id_user" value="{{ $id_user }}">
                    <!-- SUBMIT -->
                    <input class="w-[100%] h-[45px] rounded-[8px] mt-[10px] bg-[#A35554] text-[#ffffff] font-bold mb-[30px] cursor-pointer" type="submit" value="Recuperar acesso">
                </form>
            </div>
            @endif
            <!-- NAVEGATIONS -->
            <div class="w-[100%] float-left inline-block">
                <center>
                    <ul>
                        <li><a href="{{ route('login') }}"><p class="text-[#ffffff] text-[13px]">Lembrei minha senha</p></a></li>
                    </ul>
                </center>
            </div>
        </div>
    </div>
</section>
@endsection

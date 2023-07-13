@extends('layout.main_ws')
@section('title', 'Kaza Rosa | Registro')

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
        <!--  -->
        <div class="w-[90%] mx-[auto] h-[60px] md:hidden">
            <div class="w-[100%] inline-block">
                <!-- LOGO -->
                <div class="w-[100%] mt-[80px] mb-[50px] float-left inline-block">
                    <center>
                        <img class="w-[160px]" src="/img/Ativo 6.png" alt="Kasa Rosa">
                    </center>
                </div>
                <!-- FORM LOGIN -->
                <div class="w-[100%] float-left inline-block">
                    <div class="w-[100%] bg-[#ffffff] shadow-lg p-[20px] rounded-[20px]">
                        <form action="{{ route('registrar') }}" method="POST">
                            @csrf
                            <!-- NOME -->
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="text" name="nome" placeholder="Nome"><img src="/img/user.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
                            <!-- EMAIL -->
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="text" name="email" placeholder="E-mail"><img src="/img/at.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
                            <!-- NASCIMENTO -->
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="text" id="date1" name="nascimento" placeholder="Nascimento"><img src="/img/user.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
                            <!--  -->
                            <div style="display: none;" class="w-[69%] mr-[1%] float-left">
                                <!-- CIDADE -->
                                <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="text" name="cidade" placeholder="Cidade"><img src="/img/marker.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
                            </div>
                            <!--  -->
                            <div style="display: none;" class="w-[29%] ml-[1%] float-left">
                                <!-- ESTADO -->
                                <select class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[10px] bg-[#fafafa] mb-[10px] outline-none" name="estado">
                                    <option value="null">UF</option>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AM">AM</option>
                                    <option value="AP">AP</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MG">MG</option>
                                    <option value="MS">MS</option>
                                    <option value="MT">MT</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="PR">PR</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="RS">RS</option>
                                    <option value="SC">SC</option>
                                    <option value="SE">SE</option>
                                    <option value="SP">SP</option>
                                    <option value="TO">TO</option>
                                </select>
                            </div>
                            <!-- SENHA -->
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="password" name="senha" placeholder="Senha"><img src="/img/lock.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
                            <!-- CONFI_SENHA -->
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="password" name="confsenha" placeholder="Confirme senha"><img src="/img/lock.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
                            {{-- HIDDEN --}}
                            <input type="hidden" value="3" name="tipo">
                            <!-- SUBMIT -->
                            <input class="w-[100%] h-[45px] rounded-[8px] mt-[20px] bg-[#A35554] text-[#ffffff] font-bold cursor-pointer" type="submit" value="Registrar conta">
                        </form>
                        <!--  -->
                        <a href="{{ route('login') }}"><button class="w-[100%] h-[45px] bg-[#C5908F] mt-[10px] text-[#ffffff] font-bold rounded-[8px]">Já tenho uma conta</button></a>
                    </div>
                </div>
                <!-- NAVEGATIONS -->
                <div class="w-[100%] float-left inline-block">
                    <center>
                        <a href="{{ route('home') }}"><p class="text-[14px] mt-[30px] text-[#ffffff]">Conheça a nossa Kasa</p></a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

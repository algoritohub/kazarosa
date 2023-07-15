@extends('layout.main_ws')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<section class="w-[100%]">
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
                        <form action="{{ route('app.new_cadastro') }}" method="POST">
                            @csrf
                            <!-- NOME -->
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="text" name="nome" placeholder="Nome"><img src="/img/user.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
                            <!-- EMAIL -->
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="text" name="email" placeholder="E-mail"><img src="/img/at.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
                            <!-- TELEFONE -->
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="text" id="tel" name="telefone" placeholder="Telefone"><img src="/img/user.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
                            <!-- NASCIMENTO -->
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="text" id="nas" name="nascimento" placeholder="Nascimento"><img src="/img/user.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
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
                            <input class="w-[100%] h-[45px] rounded-[8px] border-[1px] pl-[40px] bg-[#fafafa] mb-[10px] outline-none" type="password" name="conf_senha" placeholder="Confirme senha"><img src="/img/lock.png" class="w-[16px] opacity-[0.5] mt-[-42px] ml-[15px] absolute"/>
                            {{-- HIDDEN --}}
                            <input type="hidden" value="" name="tipo">
                            <!-- SUBMIT -->
                            <input class="w-[100%] h-[45px] rounded-[8px] mt-[20px] bg-[#A35554] text-[#ffffff] font-bold cursor-pointer" type="submit" value="Registrar conta">
                        </form>
                        <!--  -->
                        <center>
                            <a href="{{ route('app.login') }}"><p class="text-[13px] mt-[25px] mb-[15px] text-[#a35554]">Já tenho uma conta!</p></a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
    $("#tel").mask("(00) 00000-0000");
    $("#nas").mask("00/00/0000");
</script>

@endsection

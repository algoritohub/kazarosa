@extends('layout.main_ws')
@section('title', 'Kaza Rosa | Login')

@section('content')
<section class="w-[100%]">
    <!-- CONTAINER -->
    <div>
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
                    <div class="w-[100%] bg-[#ffffff] shadow-lg p-[20px] rounded-[20px]">
                        <form action="{{ route('app.new_logar') }}" method="POST">
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
                                <a href="{{ route('app.cadastro.page') }}"><p class="text-[13px] text-[#a35554]">Criar uma conta</p></a>
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
                        <p class="text-[10px] text-[#ffffff] mt-[30px]">Versão 1.0.2</p>
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

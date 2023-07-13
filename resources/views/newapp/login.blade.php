@extends('newapp.layout.main_app')
@section('title', 'Kaza Rosa | Login')

@section('content')
<section>
    <center>
        <div class="mt-[40%]">
            <img class="w-[180px]" src="/img/Ativo 6.png" alt="Kaza Rosa">
            {{--  --}}
            <p class="text-[20px] my-[50px]">Entre e fique à vontande!</p>
            <div class="w-[80%] inline-block">
                <form action="{{ route('app.new_logar') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="E-mail">
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <input type="password" class="form-control" name="senha" placeholder="Senha">
                    </div>
                    {{--  --}}
                    <button class="w-[100%] h-[40px] bg-[#212121] text-[#ffffff] rounded-[5px] mt-[20px]">Entrar</button>
                </form>
                <a href=""><p class="font-bold mt-[20px]">Esqueci minha senha</p></a>
            </div>
        </div>
    </center>
</section>
@endsection

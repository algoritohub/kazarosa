@extends('newapp.layout.main_app')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main>
    <div class="mt-[30%]">
        <center>
            <img class="w-[150px]" src="/img/Ativo 6.png" alt="Kaza Rosa">
            {{--  --}}
            <p class="text-[20px] my-[50px]">Faça parte da nossa Kaza!</p>
            <div class="w-[80%] inline-block">
                <form action="{{ route('app.new_cadastro') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="nome" placeholder="Nome completo">
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="E-mail">
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <input type="text" class="form-control" name="telefone" id="tel" placeholder="Telefone">
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <input type="text" class="form-control" name="nascimento" id="nas" placeholder="Nacimento">
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <input type="password" class="form-control" name="senha" placeholder="Senha" maxlength="16">
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <input type="password" class="form-control" name="conf_senha" placeholder="Confirme sua senha" maxlength="16">
                    </div>
                    {{--  --}}
                    <button class="w-[100%] h-[40px] bg-[#212121] text-[#ffffff] rounded-[5px] mt-[20px]">Entrar</button>
                </form>
                <a href="{{ route('app.login') }}"><p class="font-bold mt-[20px]">Já tenho uma conta!</p></a>
            </div>
        </center>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
    $("#tel").mask("(00) 00000-0000");
    $("#nas").mask("00/00/0000");
</script>

@endsection

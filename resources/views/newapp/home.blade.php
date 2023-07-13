@extends('newapp.layout.main_app')
@section('title', 'Kaza Rosa | App')

@section('content')
<section>
    <center>
        <div class="mt-[50%]">
            <img class="w-[180px]" src="/img/Ativo 6.png" alt="Kaza Rosa">
            {{--  --}}
            <p class="text-[30px] my-[50px]">Olá, bem-vinda!</p>
            {{--  --}}
            <div class="w-[100%] inline-block">
                <a href="{{ route('app.login') }}"><button class="w-[80%] h-[40px] bg-[#212121] text-[#ffffff] rounded-[5px] mb-[10px]">Já tenho uma conta!</button></a>
                <a href="{{ route('app.cadastro.page') }}"><button class="w-[80%] h-[40px] bg-[#212121] text-[#ffffff] rounded-[5px] mb-[10px]">Quero fazer parte!</button></a>
            </div>
        </div>
    </center>
</section>
@endsection

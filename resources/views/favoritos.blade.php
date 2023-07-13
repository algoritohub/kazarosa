@extends('layout.main_lista_agenda')
@section('title', 'Kaza Rosa | Agendamento')
@section('titulo_max', 'Favoritos')
@section('titulo_min', 'Lista de desejos')

@section('content')
<!--  -->
<section class="md:hidden">
    <div class="w-[100%] inline-block">
        <!-- BANNER -->
    </div>
</section>
<!-- ESPAÇOS -->
<section class="md:hidden">
    <div class="w-[100%] inline-block mt-[10px] overflow-scroll">
        <div class="w-[90%] mx-[5%] inline-block">
            <!-- CONEXÃO PDO -->
            <?php

            @$session = session('favorito');

            ?>
            @if(isset($session) AND !empty($session))
            @foreach($session as $favoritos)
                <p class="">{{ $favoritos }}</p>
            @endforeach
            @else
                <center><p class="mt-[25%] text-[12px] leading-[12px]">Use essa sessão para salvar seus itens favoritos, como espaços, eventos ou produtos!</p></center>
            @endif
            <!--  -->
        </div>
    </div>
</section>
@endsection

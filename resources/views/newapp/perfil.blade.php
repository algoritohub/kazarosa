@extends('newapp.layout.main_feed')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    <header>

        {{-- primeira linha --}}
        <div class="w-[90%] mx-[5%] inline-block">
            {{--  --}}
            <div class="w-[100%] mb-[10px] inline-block">
                {{--  --}}
                <div class="w-[80%] inline-block float-left">
                    <p class="font-bold text-[30px]">{{ $perfil->nickname }}</p>
                </div>
                {{--  --}}
                <div class="w-[20%] inline-block float-left">
                    {{--  --}}
                    <a href="{{ route('app.logout.conta') }}"><p class="font-bold text-[#a55858] float-right mt-[15px]">Sair</p></a>
                </div>
            </div>

            {{-- segunda linha --}}
            <div class="w-[100%] my-[10px] inline-block">
                {{--  --}}
                <div class="w-[30%] inline-block float-left">
                    <div style="background: url('/img/usuario/{{ $perfil->imagem }}'); background-size: cover;" class="w-[100px] h-[100px] rounded-[100px] border-[#cdcdcd] border-[1px] bg-[silver]"></div>
                </div>
                {{--  --}}
                <div class="w-[70%] inline-block float-left">
                    <div class="w-[100%] mt-[30px]">
                        <div class="w-[33.3%] inline-block float-left">
                            <center>
                                <p class="text-[20px]">{{ $numb_post }}</p>
                                <p class="font-bold text-[13px]">Posts</p>
                            </center>
                        </div>
                        <div class="w-[33.3%] inline-block float-left">
                            <center>
                                <p class="text-[20px]">{{ $numb_seguidor }}</p>
                                <p class="font-bold text-[13px]">Seguidoras</p>
                            </center>
                        </div>
                        <div class="w-[33.3%] inline-block float-left">
                            <center>
                                <p class="text-[20px]">{{ $numb_seguindo }}</p>
                                <p class="font-bold text-[13px]">Seguidas</p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            {{-- terceira linha --}}
            <div class="w-[100%] inline-block">
                <p class="font-bold text-[20px]">{{ $perfil->nome }}</p>
                @if (isset($perfil->bio) AND !empty($perfil->bio) AND $perfil->bio != "null")
                    <p class="">{{ $perfil->bio }}</p>
                @endif
            </div>

            @if ($user->id == $perfil->id)

            {{-- quarta linha --}}
            <div class="w-[100%] my-[20px] inline-block">
                {{--  --}}
                <div class="w-[69%] mr-[1%] inline-block float-left">
                    <button class="w-[100%] h-[40px] font-bold rounded-[5%] border-[1px] border-[#cdcdcd] bg-[#eeeeee]">Editar Perfil</button>
                </div>
                {{--  --}}
                <div class="w-[29%] ml-[1%] inline-block float-left">
                    <a href="{{ route('app.mensagens') }}"><button class="w-[100%] h-[40px] font-bold rounded-[5%] border-[1px] border-[#cdcdcd] bg-[#eeeeee]"><i class="fi fi-rr-envelope"></i></button></a>
                </div>
            </div>

            @else

                {{-- outro usuario sem seguir --}}
                @if (!$seguir)
                <div class="w-[100%] my-[20px] inline-block">
                    {{--  --}}
                    <div class="w-[49%] mr-[1%] inline-block float-left">
                        <a href="{{ route('app.seguir_user', ['id' => $perfil->id]) }}"><button class="w-[100%] h-[40px] font-bold rounded-[5%] border-[1px] border-[#cdcdcd] bg-[#eeeeee]">Seguir</button></a>
                    </div>
                    {{--  --}}
                    <div class="w-[49%] ml-[1%] inline-block float-left">
                        <button class="w-[100%] h-[40px] font-bold rounded-[5%] border-[1px] border-[#cdcdcd] bg-[#eeeeee]"><i class="fi fi-rr-envelope"></i></button>
                    </div>
                </div>

                @else

                {{-- outro usuario seguindo --}}
                <div class="w-[100%] my-[20px] inline-block">
                    {{--  --}}
                    <a href="{{ route('app.deixar_seguir_user', ['id' => $seguir->id]) }}"><div class="w-[69%] mr-[1%] inline-block float-left">
                        <button class="w-[100%] h-[40px] font-bold rounded-[5%] border-[1px] border-[#cdcdcd] bg-[#eeeeee]">Deixar de Seguir</button></a>
                    </div>
                    {{--  --}}
                    <div class="w-[29%] ml-[1%] inline-block float-left">
                        <button class="w-[100%] h-[40px] font-bold rounded-[5%] border-[1px] border-[#cdcdcd] bg-[#eeeeee]"><i class="fi fi-rr-envelope"></i></button>
                    </div>
                </div>

                @endif

            @endif

        </div>
    </header>

    <section>
        <div class="w-[90%] mx-[5%]">
            <hr class="mb-[20px]">
            <div class="inline-block w-[100%]" style="display: none;">
                <div class="w-[80%] inline-block float-left"><button id="btn-bloco-feed" class="w-[50px] border-[1px] border-[#cdcdcd] rounded-[5px] mb-[20px] bg-[#eeeeee] float-right pt-[5px] h-[40px] inline-block"><i class="fi fi-ss-apps"></i></button></div>
                <div class="w-[20%] inline-block float-left"><button id="btn-bloco-list" class="w-[50px] border-[1px] border-[#cdcdcd] rounded-[5px] mb-[20px] bg-[#eeeeee] float-right pt-[5px] h-[40px] inline-block"><i class="fi fi-bs-menu-burger"></i></button></div>
            </div>
        </div>
    </section>


    {{-- FEED LIST --}}
    <div id="feed-lista" style="display: none;" class="w-[100%] inline-block">

        <div class="card" style="width: 100%; margin-bottom: 30px; border: 0px;">
            <img class="card-img-top" src="/img/newapp/imagem1.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="font-bold">Card title</h5>
                <p class="mt-[10px] leading-[20px]">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <div class="w-[100%] mt-[20px] inline-block">
                    <div class="w-[20%] float-left inline-block">
                        <p id="size-icon" class="float-left"><i class="fi fi-rr-heart"></i></p>
                        <p id="size-text" class="float-left ml-[5px]">21</p>
                    </div>
                    <div class="w-[20%] float-left inline-block">
                        <p id="size-icon" class="float-left"><i class="fi fi-rr-comment-alt-middle"></i></p>
                        <p id="size-text" class="float-left ml-[5px]">32</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- FEED BLOCOS --}}
    <div id="feed-bloco" class="w-[100%] inline-block">

        @foreach ($posts as $post)
        <a href="{{ route('app.pag_postagem', ['id' => $post->id]) }}"><div style="background-image: url('/img/feed/{{ $post->postagem }}'); background-size: cover; background-position: center;" class="w-[32.3%] mx-[0.5%] mb-[5px] h-[130px] inline-block float-left border-[1px]"></div></a>
        @endforeach

    </div>
</main>

@endsection

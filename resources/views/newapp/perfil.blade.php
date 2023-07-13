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
                    <p class="font-bold text-[30px]">nome_usuario</p>
                </div>
                {{--  --}}
                <div class="w-[20%] inline-block float-left">
                    {{--  --}}
                </div>
            </div>

            {{-- segunda linha --}}
            <div class="w-[100%] my-[10px] inline-block">
                {{--  --}}
                <div class="w-[30%] inline-block float-left">
                    <div class="w-[100px] h-[100px] rounded-[100px] border-[#cdcdcd] border-[1px] bg-[silver]"></div>
                </div>
                {{--  --}}
                <div class="w-[70%] inline-block float-left">
                    <div class="w-[100%] mt-[30px]">
                        <div class="w-[33.3%] inline-block float-left">
                            <center>
                                <p class="text-[20px]">0</p>
                                <p class="font-bold text-[13px]">Posts</p>
                            </center>
                        </div>
                        <div class="w-[33.3%] inline-block float-left">
                            <center>
                                <p class="text-[20px]">0</p>
                                <p class="font-bold text-[13px]">Seguidoras</p>
                            </center>
                        </div>
                        <div class="w-[33.3%] inline-block float-left">
                            <center>
                                <p class="text-[20px]">0</p>
                                <p class="font-bold text-[13px]">Seguidas</p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            {{-- terceira linha --}}
            <div class="w-[100%] inline-block">
                <p class="font-bold text-[20px]">Nome Usuario</p>
                <p class="">Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur.</p>
            </div>
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

            {{-- outro usuario sem seguir --}}
            <div style="display:none;" class="w-[100%] my-[20px] inline-block">
                {{--  --}}
                <div class="w-[49%] mr-[1%] inline-block float-left">
                    <button class="w-[100%] h-[40px] font-bold rounded-[5%] border-[1px] border-[#cdcdcd] bg-[#eeeeee]">Seguir</button>
                </div>
                {{--  --}}
                <div class="w-[49%] ml-[1%] inline-block float-left">
                    <button class="w-[100%] h-[40px] font-bold rounded-[5%] border-[1px] border-[#cdcdcd] bg-[#eeeeee]"><i class="fi fi-rr-envelope"></i></button>
                </div>
            </div>

            {{-- outro usuario seguindo --}}
            <div style="display:none;" class="w-[100%] my-[20px] inline-block">
                {{--  --}}
                <div class="w-[69%] mr-[1%] inline-block float-left">
                    <button class="w-[100%] h-[40px] font-bold rounded-[5%] border-[1px] border-[#cdcdcd] bg-[#eeeeee]">Deixar de Seguir</button>
                </div>
                {{--  --}}
                <div class="w-[29%] ml-[1%] inline-block float-left">
                    <button class="w-[100%] h-[40px] font-bold rounded-[5%] border-[1px] border-[#cdcdcd] bg-[#eeeeee]"><i class="fi fi-rr-envelope"></i></button>
                </div>
            </div>
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

    {{-- ABA DE POSTAGEM --}}
    <div class="w-[90%] mx-[5%]">

        <!-- Button trigger modal -->
        <p id="newpost" style="display: none;" class="text-[50px] h-[40px] text-[blue]" data-toggle="modal" data-target="#exampleModal"><i class="fi fi-sr-add"></i></p>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content" style="padding: 20px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nova postagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Example textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>

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

        <a href=""><div class="w-[32.3%] mx-[0.5%] mb-[5px] h-[130px] inline-block float-left bg-[#eeeeee]"></div></a>
        <div class="w-[32.3%] mx-[0.5%] mb-[5px] h-[130px] inline-block float-left bg-[#eeeeee]"></div>
        <div class="w-[32.3%] mx-[0.5%] mb-[5px] h-[130px] inline-block float-left bg-[#eeeeee]"></div>
        <div class="w-[32.3%] mx-[0.5%] mb-[5px] h-[130px] inline-block float-left bg-[#eeeeee]"></div>
        <div class="w-[32.3%] mx-[0.5%] mb-[5px] h-[130px] inline-block float-left bg-[#eeeeee]"></div>

    </div>
</main>

@endsection

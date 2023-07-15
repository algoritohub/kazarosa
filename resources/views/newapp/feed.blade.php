@extends('newapp.layout.main_feed')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    {{-- usuarios top 10 --}}
    <div class="w-[100%] inline-block mb-[20px]">
        <div style="scrollbar-width: none;" class="w-[100%] overflow-scroll inline-block">
            <div class="w-[270%] px-[2%] inline-block">
                @foreach ($usuarias as $usuaria)
                <a href="{{ route('app.perfil_now', ['id' => $usuaria->nickname]) }}">
                    <div title="{{ $usuaria->nome }}" style="background-image: url('/img/usuario/{{ $usuaria->imagem }}'); background-size: cover;" class="w-[7%] mx-[1%] h-[65px] rounded-[100px] inline-block float-left"></div>
                </a>
                @endforeach
                <div class="w-[7%] mx-[1%] h-[65px] rounded-[100px] inline-block bg-[#212121] float-left"></div>
            </div>
        </div>
    </div>

    {{-- ABA DE POSTAGEM --}}
    <div class="w-[90%] mx-[5%]">

        <!-- Button trigger modal -->
        <p id="newpost" class="text-[50px] h-[40px] text-[#C5908F]" data-toggle="modal" data-target="#exampleModal"><i class="fi fi-sr-add"></i></p>

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
                    <form action="{{ route("app.new_postar") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="imagem" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Example textarea</label>
                            <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <button class="w-[100%] inline-block mt-[30px] h-[40px] mb-[20px] text-[#ffffff] rounded-[5px] bg-[#C5908F]">Comentar</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="w-[100%] inline-block">
        @foreach($feed as $public)

        <div class="card" style="width: 100%; margin-bottom: 30px; border: 0px;">
            {{--  --}}
            <a href="{{ route('app.pag_postagem', ['id' => $public->id]) }}">
                <img class="card-img-top" src="/img/feed/{{ $public->postagem }}" alt="Card image cap">
            </a>
            {{--  --}}
            <div class="card-body">
                @php
                    $id_user   = $public->usuario;
                    $id_post   = $public->id;
                    $info_user = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$id_user'");
                    $info_curt = Illuminate\Support\Facades\DB::select("SELECT * FROM curtirs WHERE post = '$id_post'");
                    $count_crt = count($info_curt);
                    $info_cmnt = Illuminate\Support\Facades\DB::select("SELECT * FROM comentarios WHERE postagem = '$id_post'");
                    $count_cmt = count($info_cmnt);
                @endphp
                <h5 class="font-bold">{{ $info_user[0]->nome }}</h5>
                <p class="mt-[10px] leading-[20px]">{{ $public->descricao }}</p>
                <div class="w-[100%] mt-[20px] inline-block">
                    <div class="w-[20%] float-left inline-block">
                        <a href="{{ route('app.curtir_post', ['id' => $public->id]) }}">
                            <p id="size-icon" class="float-left"><i class="fi fi-rr-heart"></i></p>
                            <p id="size-text" class="float-left ml-[5px]">{{ $count_crt }}</p>
                        </a>
                    </div>
                    <div class="w-[20%] float-left inline-block">
                        <a href="{{ route('app.pag_postagem', ['id' => $public->id]) }}">
                            <p id="size-icon" class="float-left"><i class="fi fi-rr-comment-alt-middle"></i></p>
                            <p id="size-text" class="float-left ml-[5px]">{{ $count_cmt }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</main>

@endsection

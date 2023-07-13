@extends('newapp.layout.main_feed')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[60px]">

    {{-- ABA DE POSTAGEM --}}
    <div class="w-[90%] mx-[5%]">
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

    <div class="card" style="width: 100%; margin-bottom: 30px; border: 0px;">
        <img class="card-img-top" src="/img/feed/{{ $postagem->postagem }}" alt="Card image cap">
        <div class="card-body">
            @php
                $id_user   = $postagem->usuario;
                $info_user = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$id_user'");
            @endphp
            <h5 class="font-bold">{{ $info_user[0]->nome }}</h5>
            <p class="mt-[10px] leading-[20px]">{{ $postagem->descricao }}</p>
            <div class="w-[100%] mt-[20px] inline-block">
                <div class="w-[20%] float-left inline-block">
                    <p id="size-icon" class="float-left"><i class="fi fi-rr-heart"></i></p>
                    <p id="size-text" class="float-left ml-[5px]">{{ $numb_crt }}</p>
                </div>
                <div class="w-[20%] float-left inline-block">
                    <p id="size-icon" class="float-left"><i class="fi fi-rr-comment-alt-middle"></i></p>
                    <p id="size-text" class="float-left ml-[5px]">{{ $numb_cmt }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-[100%] inline-block">
        <div class="w-[90%] mx-[5%] inline-block">

            <div class="w-[100%] inline-block">
                <form action="{{ route('app.comentario_post', ['id' => $postagem->id]) }}" method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Comente a postagem</label>
                        <textarea class="form-control" name="comentario" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button class="w-[100%] inline-block h-[40px] mb-[20px] text-[#ffffff] rounded-[5px] bg-[blue]">Comentar</button>
                </form>
            </div>

            <div class="w-[100%] mb-[30px] inline-block">
                <ul class="list-group">
                    @foreach ($comentar as $coment)
                    @php
                        $id_user   = $coment->usuario;
                        $cmnt_user = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$id_user'");
                    @endphp
                    <li class="list-group-item">
                        <p class="font-bold">{{ $cmnt_user[0]->nome }}</p>
                        <p>{{ $coment->comentario }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</main>

@endsection

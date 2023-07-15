@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    <section>

        <div class="w-[90%] mx-[5%] pt-[10px] mb-[20px] inline-block">
            <div class="card" style="margin: 20px 0px;">
                <div class="card-header">Configurações de Acesso</div>

                <div class="card-body">
                    <h5 class="text-[17px] font-bold mb-[20px]">E-mail</h5>
                    <div class="inline-block w-[100%]">
                        <p class="text-[15px] mb-[10px] float-right">{{ $user->email }}</p>
                    </div>
                    <button type="button" class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]" data-toggle="modal" data-target="#exampleModal">Alterar E-mail</button>
                </div>

                <div class="card-body">
                    <h5 class="text-[17px] font-bold mb-[20px]">Senha</h5>
                    <div class="inline-block w-[100%]">
                        <p class="text-[15px] mb-[10px] float-right">*********</p>
                    </div>
                    <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]" data-toggle="modal" data-target="#exampleModal1">Alterar Senhal</button>
                </div>
            </div>

            <div class="card" style="margin: 20px 0px;">
                <div class="card-header">Perfil</div>

                <div class="card-body">
                    <h5 class="text-[17px] font-bold mb-[20px]">Imagem de Perfil</h5>
                    <div class="w-[100%] inline-block">
                        <center>
                            <div style="background-image: url('/img/usuario/{{ $user->imagem }}'); background-size: cover;" class="w-[120px] h-[120px] bg-[silver] mb-[20px] rounded-[100px]"></div>
                        </center>
                    </div>
                    <button type="button" class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]" data-toggle="modal" data-target="#exampleModal2">Alterar Imagem</button>
                </div>

                <div class="card-body">
                    <h5 class="text-[17px] font-bold mb-[20px]">Nome no Perfil</h5>
                    <div class="inline-block w-[100%]">
                        <p class="text-[15px] mb-[10px] float-right">{{ $user->nome }}</p>
                    </div>
                    <button type="button" class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]" data-toggle="modal" data-target="#exampleModal3">Alterar Nome no Perfil</button>
                </div>

                <div class="card-body">
                    <h5 class="text-[17px] font-bold mb-[20px]">Nome de Usuário</h5>
                    <div class="inline-block w-[100%]">
                        <p class="text-[15px] mb-[10px] float-right">{{ $user->nickname }}</p>
                    </div>
                    <button type="button" class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]" data-toggle="modal" data-target="#exampleModal4">Alterar Nome de Usuário</button>
                </div>

                <div class="card-body">
                    <h5 class="text-[17px] font-bold mb-[20px]">Bio</h5>
                    @if (isset($user->bio) AND !empty($user->bio) AND $user->bio != "null")
                        <p class="py-[20px]">{{ $user->bio }}</p>
                        <button type="button" class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]" data-toggle="modal" data-target="#exampleModal6">Editar Biografia</button>
                    @else
                        <button type="button" class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]" data-toggle="modal" data-target="#exampleModal5">Add Biografia</button>
                    @endif
                </div>
            </div>

            <div class="card" style="margin: 20px 0px;">
                <div class="card-header">Geral</div>

                <div class="card-body">
                    <h5 class="text-[17px] font-bold mb-[20px]">Deletar Conta</h5>
                    <p class="my-[20px]">Ao deletar sua conta, você perderá todos os benefícios de planos, postagens, curtidas e comentários de sua rede, tem certeza que deseja excluir?</p>
                    <button type="button" class="w-[100%] h-[40px] rounded-[5px] bg-[red] text-[#ffffff]" data-toggle="modal" data-target="#exampleModal7">Deletar Conta</button>
                </div>
            </div>
        </div>

        {{-- MODAIS --}}
        <div class="w-[90%] mx-[5%] inline-block">

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aterar E-mail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('app.alterar.email') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Senha Atual</label>
                                <input type="password" name="senha" class="form-control" maxlength="16" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]">Alterar</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aterar Senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('app.alterar.senha') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nova Senha</label>
                                <input type="password" name="senha_nova" class="form-control" maxlength="16" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirme Senha</label>
                                <input type="password" name="conf_senha" class="form-control" maxlength="16" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Senha Atual</label>
                                <input type="password" name="senha" class="form-control" maxlength="16" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]">Alterar</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aterar Imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('app.alterar.imagem') }}" method="GET" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file" style="margin-bottom: 15px;">
                                <input type="file" class="custom-file-input" name="imagem" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Senha Atual</label>
                                <input type="password" name="senha" class="form-control" maxlength="16" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]">Alterar</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aterar Nome no Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('app.alterar.nome_perfil') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome no Perfil</label>
                                <input type="text" class="form-control" name="nome" value="{{ $user->nome }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Senha Atual</label>
                                <input type="password" name="senha" class="form-control" maxlength="16" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]">Alterar</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aterar Nome de Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('app.alterar.nome_usuario') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome de Usuario</label>
                                <input type="text" class="form-control" name="nickname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Senha Atual</label>
                                <input type="password" name="senha" class="form-control" maxlength="16" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]">Alterar</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Bio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('app.adicionar.bio') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Example textarea</label>
                                <textarea class="form-control" name="bio" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]">Alterar</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alterar Bio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('app.alterar.bio') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Example textarea</label>
                                <textarea class="form-control" name="bio" id="exampleFormControlTextarea1" rows="3">{{ $user->bio }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Senha Atual</label>
                                <input type="password" name="senha" class="form-control" maxlength="16" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]">Alterar</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deletar Conta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('app.delete.conta') }}" method="GET">
                            @csrf
                            <p class="mb-[20px]">Você perderá todas as suas informações nesta aplicação, insira sua senha para excluir sua conta.</p>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Senha Atual</label>
                                <input type="password" name="senha" class="form-control" maxlength="16" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button class="w-[100%] h-[40px] rounded-[5px] bg-[red] text-[#ffffff]">Deletar</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

        </div>

    </section>

</main>

<script>
    document.getElementById('execCopy').addEventListener('click', execCopy);
    function execCopy() {
        document.querySelector("#input").select();
        document.execCommand("copy");
    }
</script>
@endsection

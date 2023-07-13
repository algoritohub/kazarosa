@extends('dashboard.layout.main')
@section('title', 'Dashboard - Evento detalhe')
@section('titulo', 'Evento detalhe')
@section('imagem', 'apresentacao.png')

@section('content')
<!-- SOBRE -->
<div class="w-[100%] h-[480px] bg-white float-left overflow-auto">
    <!--  -->
    <div class="inline-block p-[30px] w-[100%]">
        <!--  -->
        <div class="w-[60%] float-left inline-block">
            <!-- FORMULÁRIO -->
            <form action="{{ route('atl_evento', ['id' => $eventos->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="w-[100%]">
                    <!--  -->
                    <tr>
                        <td><p class="font-bold">Nome completo do evento</p></td>
                    </tr>
                    <!--  -->
                    <tr>
                        <td><input class="w-[100%] h-[50px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="titulo" value="{{ $eventos->titulo }}" type="text"></td>
                    </tr>
                    <!--  -->
                    <tr>
                        <td><p class="font-bold">Descrição</p></td>
                    </tr>
                    <!--  -->
                    <tr>
                        <td>
                            <textarea class="w-[100%] p-[20px] h-[100px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="descricao">{{ $eventos->descricao }}</textarea>
                        </td>
                    </tr>
                </table>
                <!--  -->
                <div class="w-[49%] mr-[1%] inline-block float-left">
                    <table class="w-[100%]">
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Data de exibição</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] h-[50px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="data" id="date1" value="{{ $eventos->datas }}" type="text"></td>
                        </tr>
                    </table>
                </div>
                <!--  -->
                <div class="w-[49%] ml-[1%] inline-block float-left">
                    <table class="w-[100%]">
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Hora de exibição</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] h-[50px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="hora" id="hor1" value="{{ $eventos->hora }}" type="text"></td>
                        </tr>
                    </table>
                </div>
                <!--  -->
                <table class="w-[100%]">
                    <!--  -->
                    <tr>
                        <td><p class="font-bold">Quantidade máxima de participantes</p></td>
                    </tr>
                    <!--  -->
                    <tr>
                        <td><input class="w-[100%] h-[50px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" type="text" name="quantidade" value="{{ $eventos->quantidade }}"></td>
                    </tr>
                </table>
                <!--  -->
                <table class="w-[100%]">
                    <!--  -->
                    <tr>
                        <td><p class="font-bold">Link de pagamento</p></td>
                    </tr>
                    <!--  -->
                    <tr>
                        <td><input class="w-[100%] h-[50px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" type="text" name="link" value="{{ $eventos->link }}"></td>
                    </tr>
                </table>
                <!--  -->
                <div class="w-[49%] mr-[1%] inline-block float-left">
                    <table class="w-[100%]">
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Entrada</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <select class="w-[100%] h-[50px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="entrada">
                                    @if($eventos->quantidade == 1)
                                    <option value="1" selected>Evento aberto</option>
                                    <option value="2">Evento pago</option>
                                    @else($eventos->quantidade == 2)
                                    <option value="1">Evento aberto</option>
                                    <option value="2" selected>Evento pago</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--  -->
                <div class="w-[49%] ml-[1%] inline-block float-left">
                    <table class="w-[100%]">
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Valor</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <!-- FORMATAR PEREÇO -->
                            <?php 
                            
                            $preco = $eventos->valor;
                            $preco_formato = number_format($preco,2,".",".");
                            
                            ?>
                            <td><input class="w-[100%] h-[50px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="valor" placeholder="Incluir valor no formato 0.00" value="{{ $preco_formato }}" type="text"></td>
                        </tr>
                    </table>
                </div>
                <!--  -->
                <div class="w-[49%] mr-[1%] inline-block float-left">
                    <table class="w-[100%]">
                        <tr>
                            <td>
                                <br>
                                <label for="imagem" class="w-[100%] px-[100px] py-[11px] cursor-pointer font-bold mt-[30px] text-white bg-[#884544] mb-[30px]">Alterar imagem</label>
                                <input style="display: none;" id="imagem" type="file" name="imagem">
                                <br><br>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--  -->
                <div class="w-[49%] ml-[1%] inline-block float-left">
                    <table class="w-[100%]">
                        <tr>
                            <td><button class="w-[100%] h-[40px] font-bold mt-[10px] text-white bg-[#C5908F]">Atualizar informações</button></td>
                        </tr>
                    </table>
                </div>
            </form>
            <!--  -->
            <div class="w-[100%] inline-block">
                <!--  -->
                <a href="{{ route('del_evento', ['id' => $eventos->id]) }}"><p class="mt-[15px] text-[13px] font-bold">Excluir evento</p></a>
            </div>
        </div>
        <!--  -->
        <div class="w-[40%] pl-[30px] float-left inline-block">
            <!--  -->
            <div class="w-[100%] mt-[20px] mb-[20px]">
                <p class="font-bold">VARIANTES PARA ESSE EVENTO</p>
                <table class="mt-[20px] mb-[10px] w-[100%]">
                    <!--  -->
                    <tr >
                        <td class="w-[25%]"><p class="font-bold">Data</p></td>
                        <td class="w-[25%]"><p class="font-bold">Turno</p></td>
                        <td class="w-[25%]"><p class="font-bold">Quantid.</p></td>
                        <td class="w-[25%]"></td>
                    </tr>
                </table>
                <!-- CONEXÃO PDO -->
                <?php 

                $name_banco = env('PDO_BANCO');
                $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
                $name_user = env('PDO_USER');
                $pass_banco = env('PDO_SENHA');

                $conn = new PDO($conectDB, $name_user, $pass_banco);
                
                $stmt = $conn->prepare('SELECT * FROM variants WHERE evento = :id');
                $stmt->execute(array('id' => $eventos->id)); 

                $result = $stmt->fetchAll();

                $contagem = count($result);
                
                ?>
                @foreach($result as $row)
                <hr class="my-[5px]">
                <table class="w-[100%]">
                    <tr>
                        <td class="w-[25%]">{{ $row['data'] }}</td>
                        <td class="w-[25%]">{{ $row['turno'] }}</td>
                        <td class="w-[25%]">{{ $row['quantidade'] }}</td>
                        <td class="w-[25%]"><a class="float-right text-[12px]" href="{{ route('del_variacao', ['id' => $row['id']]) }}">excluir variante</a></td>
                    </tr>
                </table>
                @endforeach
            </div>
            <!--  -->
            <div class="p-[40px] mt-[28px] bg-[#fafafa] border-[1px]">
                <p class="mb-[30px]">Use esse formulário para incluir uma variação deste evento, incluindo horários, datas e valores específicos.</p>
                <!--  -->
                <form action="{{ route('new_variacao') }}" method="POST">
                    @csrf
                    <table class="w-[100%]">
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Data</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <!-- HIDDEN -->
                                <input value="{{ $eventos->id }}" name="evento" type="hidden">
                                <!-- DATA -->
                                <input class="w-[100%] h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px]" name="data" id="date2" type="text">
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Hora</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px]" name="hora" id="hor2" type="text"></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Turno</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <select class="w-[100%] h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px]" name="turno">
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                </select>
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Entrada</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td>
                                <select class="w-[100%] h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px]" name="entrada">
                                    <option value="1">Evento aberto</option>
                                    <option value="2">Evento pago</option>
                                </select>
                            </td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Link de pagamento</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px]" name="link" type="text"></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Quantidade</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px]" name="quantidade" type="text"></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Valor (R$)</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px]" name="valor" placeholder="0.00" type="text"></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><button class="w-[100%] h-[40px] font-bold mt-[10px] text-white bg-[#C5908F]">Adicionar variação</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
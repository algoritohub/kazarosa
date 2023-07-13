@extends('dashboard.layout.main')
@section('title', 'Dashboard - Salas')
@section('titulo', 'Espaço')
@section('imagem', 'apresentacao.png')
@section('descricao', 'Use a lista de epaço para gerenciar suas salas.')

@section('content')
<!--  -->
<div class="w-[100%] bg-white float-left overflow-auto">
    <!--  -->
    <div class="w-[100%] inline-block px-[15px] border-b-[1px]">
        <!--  -->
        <div class="w-[50%] float-left inline-block">
            <!-- BUTTON -->
            <button id="add_sala" class="float-left w-[200px] mb-[20px] h-[40px] bg-[#C5908F] text-white font-bold text-[12px] border-[1px] border-solid border-[#C5908F] rounded-[5px]">✚ Adicionar nova sala</button>
        </div>
    </div>
    <!--  -->
    <div class="inline-block px-[15px] py-[30px] w-[100%]">
        <!--  -->
        <?php

        $name_banco = env('PDO_BANCO');
        $conectDB = 'mysql:host=localhost;dbname='.$name_banco;
        $name_user = env('PDO_USER');
        $pass_banco = env('PDO_SENHA');

        $conn = new PDO($conectDB, $name_user, $pass_banco);

        // RESGATE DE SALAS
        $stmt = $conn->prepare('SELECT * FROM salas ORDER BY diaria ASC');
        $stmt->execute();
        $result = $stmt->fetchAll();
        $contagem = count($result);

        ?>
        <!-- LISTAGEM DE SALAS -->
        <div class="w-[100%] inline-block">
            <!--  -->
            <table class="w-[100%]">
                <tr>
                    <td class="w-[28%] font-bold">Espaço</td>
                    <td class="w-[14%] font-bold">Valor/hora</td>
                    <td class="w-[14%] font-bold">Valor/dual</td>
                    <td class="w-[14%] font-bold">Valor/turno</td>
                    <td class="w-[14%] font-bold">valor/diária</td>
                    <td class="w-[16%]"></td>
                </tr>
            </table>
            <!--  -->
            <hr class="my-[15px]">
            <!--  -->
            @foreach($result as $salas)
            <?php

            $valor_hora = number_format($salas['valor'],2,",",".");
            $valor_dual = number_format($salas['dual'],2,",",".");
            $valor_turno = number_format($salas['turno'],2,",",".");
            $valor_diaria = number_format($salas['diaria'],2,",",".");

            ?>
            <table class="w-[100%]">
                <tr>
                    <td class="w-[28%]">{{ $salas['nome'] }}</td>
                    <td class="w-[14%]">{{ $valor_hora }}</td>
                    <td class="w-[14%]">{{ $valor_dual }}</td>
                    <td class="w-[14%]">{{ $valor_turno }}</td>
                    <td class="w-[14%]">{{ $valor_diaria }}</td>
                    <td class="w-[16%]"><a href="{{ route('detalhe_sala', ['id' => $salas['id']]) }}"><button class="w-[100%] h-[35px] rounded-[5px] text-[#ffffff] bg-[#333333]">Editar espaço</button></a></td>
                </tr>
            </table>
            <!--  -->
            <hr class="my-[15px]">
            @endforeach
        </div>
    </div>
    <!-- MODAL ADD SALA -->
    <div class="add_new_sala">
        <!--  -->
        <div class="w-[1000px] h-[600px] p-[40px] shadow-lg border-[1px] overflow-scroll bg-[#ffffff] mx-[auto] mt-[5%]">
            <!-- FORM -->
            <form action="{{ route('new_sala') }}" method="POST">
                @csrf
                <!--  -->
                <div class="w-[100%] inline-block">
                    <!--  -->
                    <div class="w-[50%] inline-block float-left">
                        <!--  -->
                        <p class="text-[23px] font-bold">✚ Adicionar um novo espaço</p>
                    </div>
                    <!--  -->
                    <div class="w-[50%] inline-block float-left">
                        <!--  -->
                        <p id="fechar_mod_add_sala" class="float-right cursor-pointer">✕</p>
                    </div>
                </div>
                <!--  -->
                <div class="w-[100%] mt-[30px] inline-block">
                    <!--  -->
                    <table class="w-[100%]">
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Nome da sala (*)</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><input class="w-[100%] h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="nome" type="text"></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><p class="font-bold">Descrição (*)</p></td>
                        </tr>
                        <!--  -->
                        <tr>
                            <td><textarea class="w-[100%] h-[100px] p-[15px] outline-none mt-[5px] mb-[10px] border-[1px] bg-slate-50" name="descricao"></textarea></td>
                        </tr>
                    </table>
                    <!--  -->
                    <div style="display: none;" class="w-[49%] mr-[1%] mt-[15px] float-left inline-block">
                        <!--  -->
                        <table class="w-[100%]">
                            <!--  -->
                            <tr>
                                <td>
                                    <label for="imagem1" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Carregar imagem 1</center></label>
                                    <input id="imagem1" class="hidden" type="file" name="img1">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <label for="imagem2" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Carregar imagem 2</center></label>
                                    <input id="imagem2" class="hidden" type="file" name="img2">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <label for="imagem3" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Carregar imagem 3</center></label>
                                    <input id="imagem3" class="hidden" type="file" name="img3">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--  -->
                    <div style="display: none;" class="w-[49%] ml-[1%] mt-[15px] float-left inline-block">
                        <!--  -->
                        <table class="w-[100%]">
                            <!--  -->
                            <tr>
                                <td>
                                    <label for="imagem4" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Carregar imagem 4</center></label>
                                    <input id="imagem4" class="hidden" type="file" name="img4">
                                </td>
                            </tr>
                            <!--  -->
                            <tr>
                                <td>
                                    <label for="imagem5" class="font-bold rounded-[5px] w-[100%] h-[40px] text-[#ffffff] cursor-pointer pt-[10px] bg-[#333333] float-right mb-[10px]"><center>Carregar imagem 5</center></label>
                                    <input id="imagem5" class="hidden" type="file" name="img5">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <!--  -->
                                <tr>
                                    <td><p class="font-bold">Mínimo de locação</p></td>
                                </tr>
                                <!--  -->
                                <tr>
                                    <td>
                                        <select name="minimo" class="w-[100%] pl-[5px] h-[40px] outline-none mt-[5px] mb-[10px] border-[1px] bg-slate-50">
                                            <option value="1">1 hora</option>
                                            <option value="2">2 horas</option>
                                            <option value="3">+3 horas</option>
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
                                    <td><p class="font-bold ml-[9px]">Preço/hora</p></td>
                                </tr>
                                <!--  -->
                                <tr>
                                    <td><input class="w-[100%] float-right h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="valor" placeholder="Ex.: 00.00" type="text"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <!--  -->
                                <tr>
                                    <td><p class="font-bold">Valor turno (4 horas)</p></td>
                                </tr>
                                <!--  -->
                                <tr>
                                    <td><input class="w-[100%] float-right h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="turno" placeholder="Ex.: 00.00" type="text"></td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <!--  -->
                                <tr>
                                    <td><p class="font-bold ml-[9px]">Valor diária (8 horas)</p></td>
                                </tr>
                                <!--  -->
                                <tr>
                                    <td><input class="w-[100%] float-right h-[40px] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50" name="diaria" placeholder="Ex.: 00.00" type="text"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    <button class="w-[100%] h-[40px] bg-[#333333] rounded-[5px] text-[12px] font-bold text-[#ffffff]">Adicionar novo espaço</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

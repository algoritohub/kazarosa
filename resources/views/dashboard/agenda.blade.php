@extends('dashboard.layout.main')
@section('title', 'Dashboard - Agendamentos')
@section('titulo', 'Agendamentos')
@section('imagem', 'calendario.png')
@section('descricao', '')

@section('content')
    <!-- BUTTON AGENDAMENTO MANUAL -->
    <ul>
        <li class="inline-block mr-[10px]"><button id="bt_agenda_manual" class="px-[30px] h-[40px] rounded-[5px] mb-[40px] ml-[13px] bg-[#313131] text-[#ffffff]">Agendar manualmente</button></li>
        <li class="inline-block mr-[20px]"><p id="new_expresso" class="font-bold mt-[15px] text-[#a35554] cursor-pointer">Agendamento expresso</p></li>
    </ul>
    <!-- MODAL AGENDAMENTO EXPRESSO-->
    <div class="modal_agenda_manual_expresso">
        <!--  -->
        <div class="w-[1000px] mx-[auto] mt-[4%] h-[600px] p-[50px] bg-[#ffffff] shadow-lg">
            <!--  -->
            <div class="w-[100%] inline-block">
                <!--  -->
                <div class="w-[70%] inline-block float-left">
                    <!--  -->
                    <p class="font-bold text-[25px] mb-[30px] text-[#313131]">Agendamento expresso</p>
                </div>
                <!--  -->
                <div class="w-[30%] inline-block float-left">
                    <!--  -->
                    <p id="fechar_new_expresso" class="float-right text-[18px] cursor-pointer">✕</p>
                </div>
            </div>
            <p class="my-[15px] text-[13px]">Agendamento expresso não necessita de consulta pelo sistema, e pode ser usado para agendamentos específicos ou com horários próximos. Atenção: consulte sua lista de agendamentos antes de realiza esse tipo de marcação. Exclusivo para agendamentos recorrentes.</p>
            <!--  -->
            <div class="w-[100%] inline-block">
                <form action="{{ route('new.agendamento.expresso') }}" method="POST">
                    @csrf
                    <div class="w-[100%] inline-block">
                        @php
                            $recorrentes  = Illuminate\Support\Facades\DB::select("SELECT * FROM agendamentos");
                            $array_client = array();

                            foreach($recorrentes as $cliente){

                                $id_client  = $cliente->user;
                                $res_client = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$id_client'");
                                $inf_client = $res_client[0]->email;

                                if (in_array($inf_client, $array_client)) {
                                    // NÃO INSERE O ID PORQUE ELE JÁ EXISTE
                                }
                                else{
                                    // INCREMENTA O ID
                                    array_push($array_client, $inf_client);
                                }
                            }

                        @endphp
                        <!--  -->
                        <div class="w-[100%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <select
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="cliente">
                                            @foreach($array_client as $usuaria_inf)
                                            @php
                                                $res_names = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE email = '$usuaria_inf'");
                                            @endphp
                                            <option value="{{ $usuaria_inf }}">{{ $res_names[0]->nome }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <select
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="sala">
                                            <!-- PHP -->
                                            <?php

                                            $resultx1 = Illuminate\Support\Facades\DB::select("SELECT * FROM salas");

                                            // RESGATE DE VARIAVEL DE FILTRO
                                            @$filter = $_GET['filter'];

                                            ?>
                                            @foreach ($resultx1 as $rowx1)
                                                @if ($rowx1->minimo == 3)
                                                    <option value="{{ $rowx1->id }}">{{ $rowx1->nome }} (Apenas turno ou
                                                        diária)</option>
                                                @else
                                                    <option value="{{ $rowx1->id }}">{{ $rowx1->nome }} (Locação mínima:
                                                        {{ $rowx1->minimo }}/Hs)</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <select
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="tempo">
                                            <option value="1">1 hora</option>
                                            <option value="2">2 horas</option>
                                            <option value="3">3 horas</option>
                                            <option value="4">Turno</option>
                                            <option value="8">Diária</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <input
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] h-[50px] outline-none rounded-[5px] border-[1px]"
                                            id="hor2" name="horario" placeholder="Horário" type="text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <input
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] h-[50px] outline-none rounded-[5px] border-[1px]"
                                            id="date2" name="dia" placeholder="dia" type="text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <button class="w-[100%] h-[40px] rounded-[5px] mt-[20px] bg-[#313131] text-[#ffffff]">Realizar agendamento</button>
                        <!--  -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL AGENDAMENTO MANUAL -->
    <div class="modal_agenda_manual">
        <!--  -->
        <div class="w-[1000px] mx-[auto] mt-[4%] h-[600px] p-[50px] bg-[#ffffff] shadow-lg">
            <!--  -->
            <div class="w-[100%] inline-block">
                <!--  -->
                <div class="w-[70%] inline-block float-left">
                    <!--  -->
                    <p class="font-bold text-[25px] mb-[30px] text-[#313131]">Agendamento manual</p>
                </div>
                <!--  -->
                <div class="w-[30%] inline-block float-left">
                    <!--  -->
                    <p id="fechar_md" class="float-right text-[18px] cursor-pointer">✕</p>
                </div>
            </div>
            {{--  --}}
            <div class="w-[100%] inline-block">
                {{--  --}}
                <div class="w-[49%] mr-[1%] float-left inline-block">
                    {{--  --}}
                    <a href=""><button id="new_agenda" class="w-[100%] h-[40px] mt-[30px] rounded-[5px] bg-[#212121] text-[#ffffff]">Novo agendamento</button></a>
                </div>
                {{--  --}}
                <div class="w-[49%] ml-[1%] float-left inline-block">
                    {{--  --}}
                    <a href=""><button id="rec_agenda" class="w-[100%] h-[40px] mt-[30px] rounded-[5px] bg-[#a35554] text-[#ffffff]">Agendamento recorrente</button></a>
                </div>
            </div>
            <!--  -->
            <div id="novo" class="w-[100%] inline-block">
                <form action="{{ route('new.agendamento.manual') }}" method="POST">
                    @csrf
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <input
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="nome" placeholder="Nome do cliente (*)" type="text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <input
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="email" placeholder="Email (*)" type="text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <input
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="atuacao" placeholder="Profissão (*)" type="text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <!-- ESTE E-MAIL SERVIRÁ COMO VERIFICAÇÃO SE EXISTE CADASTRO -->
                                        <input
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="nascimento" id="date1" placeholder="Nascimento (*)" type="text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <select
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="sala">
                                            <!-- PHP/PDO -->
                                            <?php

                                            $name_banco = env('PDO_BANCO');
                                            $conectDB = 'mysql:host=localhost;dbname=' . $name_banco;
                                            $name_user = env('PDO_USER');
                                            $pass_banco = env('PDO_SENHA');

                                            $conn = new PDO($conectDB, $name_user, $pass_banco);

                                            // RESGATE DE VARIAVEL DE FILTRO
                                            @$filter = $_GET['filter'];

                                            $stmtx1 = $conn->prepare('SELECT * FROM salas');
                                            $stmtx1->execute();
                                            $resultx1 = $stmtx1->fetchAll();

                                            ?>
                                            @foreach ($resultx1 as $rowx1)
                                                @if ($rowx1['minimo'] == 3)
                                                    <option value="{{ $rowx1['id'] }}">{{ $rowx1['nome'] }} (Apenas turno ou
                                                        diária)</option>
                                                @else
                                                    <option value="{{ $rowx1['id'] }}">{{ $rowx1['nome'] }} (Locação mínima:
                                                        {{ $rowx1['minimo'] }}/Hs)</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <select
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="tempo">
                                            <option value="1">1 hora</option>
                                            <option value="2">2 horas</option>
                                            <option value="3">3 horas</option>
                                            <option value="4">Turno</option>
                                            <option value="8">Diária</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <input
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] h-[50px] outline-none rounded-[5px] border-[1px]"
                                            id="hor3" name="horario" placeholder="Horário" type="text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <input
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] h-[50px] outline-none rounded-[5px] border-[1px]"
                                            id="date3" name="dia" placeholder="dia" type="text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <button class="w-[100%] h-[40px] rounded-[5px] mt-[20px] bg-[#313131] text-[#ffffff]">Verificar
                            disponibilidade</button>
                        <!--  -->
                        <div style="display:none;" class="w-[100%] mt-[20px] rounded-[5px] inline-block p-[20px] border-[1px] border-[#cdcdcd]">
                            <!--  -->
                            <p class="leading-[14px]"><b>Informações para o cliente:</b> caso o cliente não possua cadastro no
                                sistema, uma senha temporária será gerada e enviada para o e-mail informado, com esse senha, o
                                cliente poderá acessar a rede social ou realizar agendamento pelo app.</p>
                        </div>
                    </div>
                </form>
            </div>
            {{--  --}}
            <div id="recorrente" style="display: none;" class="w-[100%] inline-block">
                <form action="{{ route('new.agendamento.manual') }}" method="POST">
                    @csrf
                    <div class="w-[100%] inline-block">
                        @php
                            $recorrentes  = Illuminate\Support\Facades\DB::select("SELECT * FROM agendamentos");
                            $array_client = array();

                            foreach($recorrentes as $cliente){

                                $id_client  = $cliente->user;
                                $res_client = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$id_client'");
                                $inf_client = $res_client[0]->email;

                                if (in_array($inf_client, $array_client)) {
                                    // NÃO INSERE O ID PORQUE ELE JÁ EXISTE
                                }
                                else{
                                    // INCREMENTA O ID
                                    array_push($array_client, $inf_client);
                                }
                            }

                        @endphp
                        <!--  -->
                        <div class="w-[100%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <select
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="cliente">
                                            @foreach($array_client as $usuaria_inf)
                                            @php
                                                $res_names = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE email = '$usuaria_inf'");
                                            @endphp
                                            <option value="{{ $usuaria_inf }}">{{ $res_names[0]->nome }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <select
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="sala">
                                            <!-- PHP -->
                                            <?php

                                            $resultx1 = Illuminate\Support\Facades\DB::select("SELECT * FROM salas");

                                            // RESGATE DE VARIAVEL DE FILTRO
                                            @$filter = $_GET['filter'];

                                            ?>
                                            @foreach ($resultx1 as $rowx1)
                                                @if ($rowx1->minimo == 3)
                                                    <option value="{{ $rowx1->id }}">{{ $rowx1->nome }} (Apenas turno ou
                                                        diária)</option>
                                                @else
                                                    <option value="{{ $rowx1->id }}">{{ $rowx1->nome }} (Locação mínima:
                                                        {{ $rowx1->minimo }}/Hs)</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <select
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] outline-none h-[50px] rounded-[5px] border-[1px]"
                                            name="tempo">
                                            <option value="1">1 hora</option>
                                            <option value="2">2 horas</option>
                                            <option value="3">3 horas</option>
                                            <option value="4">Turno</option>
                                            <option value="8">Diária</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <input
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] h-[50px] outline-none rounded-[5px] border-[1px]"
                                            id="hor4" name="horario" placeholder="Horário" type="text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <table class="w-[100%]">
                                <tr>
                                    <td>
                                        <input
                                            class="w-[100%] mt-[5px] mb-[10px] pl-[15px] h-[50px] outline-none rounded-[5px] border-[1px]"
                                            id="date4" name="dia" placeholder="dia" type="text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--  -->
                        <button class="w-[100%] h-[40px] rounded-[5px] mt-[20px] bg-[#313131] text-[#ffffff]">Verificar
                            disponibilidade</button>
                        <!--  -->
                        <div style="display:none;" class="w-[100%] mt-[20px] rounded-[5px] inline-block p-[20px] border-[1px] border-[#cdcdcd]">
                            <!--  -->
                            <p class="leading-[14px]"><b>Informações para o cliente:</b> caso o cliente não possua cadastro no
                                sistema, uma senha temporária será gerada e enviada para o e-mail informado, com esse senha, o
                                cliente poderá acessar a rede social ou realizar agendamento pelo app.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL AGENDAMENTO MANUAL -->
    @if (isset($simulacao))
        <div class="modal_agenda_resumo">
            <!--  -->
            <div class="w-[1000px] mx-[auto] mt-[4%] h-[600px] p-[50px] bg-[#ffffff] shadow-lg">
                <!--  -->
                <div class="w-[100%] inline-block">
                    <!--  -->
                    <div class="w-[70%] inline-block float-left">
                        <!--  -->
                        <p class="font-bold text-[25px] mb-[30px] text-[#313131]">Resumo de agendamento</p>
                    </div>
                    <!--  -->
                    <div class="w-[30%] inline-block float-left">
                        <!--  -->
                        <p style="display: none;" id="fechar_md" class="float-right text-[18px] cursor-pointer">✕</p>
                    </div>
                </div>
                <!--  -->
                @if ($simulacao == "disponivel")

                    @php
                        $agendamento_resg   = Illuminate\Support\Facades\DB::select("SELECT * FROM agendamentos WHERE codigo = '$cod_agnd'");
                        $identificador_sala = $agendamento_resg[0]->sala;
                        $identificador_user = $agendamento_resg[0]->user;

                        $informacoes_sala   = Illuminate\Support\Facades\DB::select("SELECT * FROM salas WHERE id = '$identificador_sala'");
                        $informacoes_user   = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$identificador_user'");
                    @endphp

                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <p class="text-[20px] pl-[15px] border-l-[4px] border-l-[green]">{{ $informacoes_sala[0]->nome }} (disponível)
                        </p>
                        <!--  -->
                        <div class="w-[100%] mt-[30px] inline-block">
                            <!--  -->
                            <div class="w-[49%] mr-[1%] inline-block float-left">
                                <!--  -->
                                <p class="text-[13px] font-bold">Agendado para:</p>
                                <!--  -->
                                <p class="text-[18px] mt-[3px]">{{ $informacoes_user[0]->nome }}</p>
                            </div>
                            <!--  -->
                            <div class="w-[49%] ml-[1%] inline-block float-left">
                                <!--  -->
                                <p class="text-[13px] font-bold">E-mail:</p>
                                <!--  -->
                                <p class="text-[18px] mt-[3px]">{{ $informacoes_user[0]->email }}</p>
                            </div>
                        </div>
                        <!--  -->
                        <div class="w-[100%] mt-[20px] inline-block">
                            <!--  -->
                            <div class="w-[49%] mr-[1%] inline-block float-left">
                                <!--  -->
                                <p class="text-[13px] font-bold">Entrada:</p>
                                <!--  -->
                                <p class="text-[16px] mt-[3px]">{{ $agendamento_resg[0]->dia }} - {{ $agendamento_resg[0]->horario }}</p>
                            </div>
                            <!--  -->
                            <div class="w-[49%] ml-[1%] inline-block float-left">
                                <!-- PHP/VERIFICAÇÂO DE SAÍDA -->
                                <?php

                                $horario_entrada = $agendamento_resg[0]->horario;
                                $explode_hora    = explode(':', $horario_entrada);
                                $hora_quebrada   = $explode_hora[0];
                                $mint_quebrada   = $explode_hora[1];

                                $nova_hora       = $hora_quebrada + $agendamento_resg[0]->tempo;
                                $nova_saida      = $nova_hora . ':' . $mint_quebrada;

                                ?>
                                <!--  -->
                                <p class="text-[13px] font-bold">Saída:</p>
                                <!--  -->
                                <p class="text-[16px] mt-[3px]">{{ $agendamento_resg[0]->dia}} - {{ $nova_saida }}
                                    ({{ $agendamento_resg[0]->tempo }}Hs)</p>
                            </div>
                        </div>
                        <!--  -->
                        <div class="w-[100%] mt-[20px] inline-block">
                            <!--  -->
                            <div class="w-[100%] inline-block float-left">
                                <!--  -->
                                <p class="text-[13px] font-bold">Valor:</p>
                                <!-- PHP/VERIFICAÇÃO DE VALOR -->
                                <?php

                                $min_sala     = $informacoes_sala[0]->minimo;
                                $format_valor = number_format($agendamento_resg[0]->desconto, 2, ',', '.');

                                ?>
                                <!--  -->
                                @if ($agendamento_resg[0]->desconto == $agendamento_resg[0]->valor)
                                    <p class="text-[20px] mt-[3px]">R${{ $format_valor }}</p>
                                @else
                                    <p class="text-[20px] mt-[3px]">R${{ $format_valor }} (com clube de vantagens)</p>
                                @endif
                                <!--  -->
                                <p class="text-[13px] mt-[3px]">Gichê de atendimento (cartão ou dinheiro)</p>
                            </div>
                        </div>
                        <!--  -->
                        <div class="w-[100%] mt-[80px] inline-block">
                            <!--  -->
                            <div class="w-[49%] mr-[1%] inline-block float-left">
                                <!--  -->
                                <a href="{{ route('agenda_confirma', ['id' => $agendamento_resg[0]->id]) }}"><button class="w-[100%] h-[40px] rounded-[5px] bg-[green] text-[#ffffff]">Confirmar agendamento</button></a>
                            </div>
                            <!--  -->
                            <div class="w-[49%] ml-[1%] inline-block float-left">
                                <!--  -->
                                <a href="{{ route('agenda_dispensar', ['id' => $agendamento_resg[0]->id]) }}"><button class="w-[100%] h-[40px] rounded-[5px] bg-[#212121] text-[#ffffff]">Dispensar consulta</button></a>
                            </div>
                        </div>
                    </div>
                @elseif($simulacao == 'verificar')
                    <!-- RESPOSTA DE INDISPONIBILIDADE -->
                    <div class="w-[100%] inline-block">
                        <!--  -->
                        <div class="w-[100%] mt-[0px] inline-block">
                            <!--  -->
                            <center>
                                <p class="text-[20px] font-bold">Agendamento indisponível!</p>
                                <!-- PHP/PDO -->
                                <?php

                                // RESGATE DE SALA
                                $rowmf = Illuminate\Support\Facades\DB::select("SELECT * FROM salas WHERE id = '$return_sala'");

                                ?>
                                <!--  -->
                                <p class="w-[600px] leading-[15px] mt-[20px]">O espaço {{ $rowmf[0]->nome }}, está indisponível para o dia {{ $return_dia }} às {{ $return_horario }}, por favor tente outro horário, dia, ou selecione outro espaço disponível!</p>
                                {{--  --}}
                                <a href="{{ route('agendamento') }}"><button class="w-[100%] h-[40px] mt-[30px] rounded-[5px] bg-[#212121] text-[#ffffff]">Refazer agendamento</button></a>
                            </center>
                        </div>
                    </div>
                @elseif($simulacao == 'erro')
                    <div class="w-[100%] inline-block">
                        <p class="mt-[50px] text-[18px] font-bold">{{ $msn }}</p>
                        {{--  --}}
                        <a href="{{ route('agendamento') }}"><button class="w-[100%] h-[40px] mt-[30px] rounded-[5px] bg-[#212121] text-[#ffffff]">Refazer agendamento</button></a>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <!-- DADOS -->
    @php
        $dataLocal = date('d/m/Y');

        // DEFINIR NUMEROS DE AGENDAMENTOS NO DIA PARA AS SALAS ABAIXO
    @endphp
    <div class="w-[100%] inline-block">
        <!--  -->
        <div class="w-[20%] float-left pl-[15px] pr-[10px] border-r-2">
            <p class="text-xs">Estações</p>
            <p title="" class="text-xl font-bold cursor-pointer">0</p>
        </div>
        <!--  -->
        <div class="w-[20%] float-left pl-[30px] pr-[10px] border-r-2">
            <p class="text-xs">Estações privativas</p>
            <p title="" class="text-xl font-bold cursor-pointer">0</p>
        </div>
        <!--  -->
        <div class="w-[20%] float-left pl-[30px] pr-[10px] border-r-2">
            <p class="text-xs">Penteadeira</p>
            <p title="" class="text-xl font-bold cursor-pointer">0</p>
        </div>
        <!--  -->
        <div class="w-[20%] float-left pl-[30px] pr-[10px] border-r-2">
            <p class="text-xs">Sala privada</p>
            <p title="" class="text-xl font-bold cursor-pointer">0</p>
        </div>
        <!--  -->
        <div class="w-[20%] float-left pl-[30px] pr-[10px]">
            <p class="text-xs">Sala executiva</p>
            <p title="" class="text-xl font-bold cursor-pointer">0</p>
        </div>
    </div>
    {{--  --}}
    <div class="w-[98%] mx-[1%] mt-[30px] py-[20px] inline-block overflow-scroll">
        @php
            $now_dia = date('d');
            $now_mes = date('m');
            $now_ano = date('Y');

            $meses = array(
                1  => "JAN",
                2  => "FEV",
                3  => "MAR",
                4  => "ABR",
                5  => "MAI",
                6  => "JUN",
                7  => "JUL",
                8  => "AGO",
                9  => "SET",
                10 => "OUT",
                11 => "NOV",
                12 => "DEZ"
            );
        @endphp
        {{--  --}}
        <div class="w-[1200px] inline-block">
            <ul>
                @for ($i = 1; $i < 13; $i++)

                    @php
                        $count_mes = strlen($i);

                        if ($count_mes == 1) {
                            $new_mes = "0".$i;
                        }else{
                            $new_mes = $i;
                        }
                    @endphp

                    @if ($i == intval($now_mes))
                    <li class="inline-block mr-[10px]"><a href="?filter={{ $new_mes }}-{{ $now_ano }}"><button class="px-[30px] h-[30px] rounded-[20px] bg-[#a35554] text-[#ffffff]" title="{{ $meses[$i] }}/{{ $now_ano }}">{{ $meses[$i] }}</button></a></li>
                    @else
                    <li class="inline-block mr-[10px]"><a href="?filter={{ $new_mes }}-{{ $now_ano }}"><button class="px-[30px] h-[30px] rounded-[20px] bg-[#212121] text-[#ffffff]" title="{{ $meses[$i] }}/{{ $now_ano }}">{{ $meses[$i] }}</button></a></li>
                    @endif

                @endfor
            </ul>
        </div>
    </div>
    <!-- REGISTROS -->
    <div class="w-[100%] inline-block px-[15px] mt-[30px]">
        <table class="w-[100%]">
            <tr class="w-[100%]">
                <td class="w-[15%]">
                    <p class="font-bold">Cod.</p>
                </td>
                <td class="w-[25%]">
                    <p class="font-bold">Nome</p>
                </td>
                <td class="w-[15%]">
                    <p class="font-bold">Sala</p>
                </td>
                <td class="w-[15%]">
                    <p class="font-bold">Entrada</p>
                </td>
                <td class="w-[10%]">
                    <p class="font-bold">Status</p>
                </td>
                <td class="w-[20%]"></td>
            </tr>
        </table>
        <hr class="my-[10px]">
        <!-- NOVA CONEXÃO EM PDO -->
        @php

        $stmt1 = $conn->prepare('SELECT * FROM agendamentos ORDER BY dia ASC');
        $stmt1->execute();
        $result1 = $stmt1->fetchAll();
        $contagem1 = count($result1);

        @endphp
        @if (!isset($filter) AND empty($filter))
            <!-- FAZER UM FOREACH COM ORDER BY -->
            @foreach ($result1 as $agendamento)
                @php
                    // RESGATE DE DATA
                    $mes_atual = date('m');
                    $ano_atual = date('Y');

                    $dia_agent = $agendamento['dia'];
                    $exp_atual = explode('/', $dia_agent);

                    $mes_agent = $exp_atual[1];
                    $ano_agent = $exp_atual[2];
                @endphp
                @if ($agendamento['stts'] != 'simulando')
                    @if ($mes_agent == $mes_atual AND $ano_agent == $ano_atual)
                        <table class="w-[100%]">
                            <tr class="w-[100%]">
                                <td class="w-[15%]">
                                    <p class="font-bold text-[#884544]">{{ $agendamento['codigo'] }}</p>
                                </td>
                                <!-- PDO -->
                                <?php

                                // RESGATE DE NOME
                                $id_usuario = $agendamento['user'];
                                $stmt = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
                                $stmt->execute(['id' => $id_usuario]);

                                $result = $stmt->fetchAll();
                                foreach ($result as $row) {
                                }

                                // RESGATE DE SALA
                                $id_sala = $agendamento['sala'];
                                $stmx = $conn->prepare('SELECT * FROM salas WHERE id = :id ');
                                $stmx->execute(['id' => $id_sala]);

                                $resultx = $stmx->fetchAll();
                                foreach ($resultx as $rowx) {
                                }

                                ?>
                                <td class="w-[25%]">
                                    <p class="">{{ $row['nome'] }}</p>
                                </td>
                                <td class="w-[15%]">
                                    <p class="">{{ $rowx['nome'] }}</p>
                                </td>
                                <td class="w-[15%]">
                                    <p class="">{{ $agendamento['dia'] }} - {{ $agendamento['horario'] }}</p>
                                </td>
                                <td class="w-[10%]">
                                    <p class="text-[#884544] font-bold text-xs cursor-pointer" title="Horário de saída">
                                        {{ $agendamento['stts'] }}</p>
                                </td>
                                <td class="w-[20%]">
                                    <a href="{{ route('informacoes', ['id' => $agendamento['id']]) }}"><button
                                            class="float-left w-[80px] py-[5px] ml-[20px] border-[1px] bg-stone-200 text-[12px] border-zinc-300 font-bold">ver</button></a>
                                    <button
                                        class="float-left w-[80px] py-[5px] ml-[20px] border-[1px] bg-[#884544] text-white border-[#884544] text-[12px] font-bold">{{ $agendamento['stts'] }}</button></a>
                                </td>
                            </tr>
                        </table>
                        <hr class="my-[10px]">
                    @endif
                @endif
            @endforeach
        @else
            <!-- FAZER UM FOREACH COM ORDER BY -->
            @foreach ($result1 as $agendamento)
                @php
                    $res_filter = $filter;
                    $exp_filter = explode('-', $res_filter);

                    // RESGATE DE DATA
                    $mes_resgt = $exp_filter[0];
                    $ano_resgt = $exp_filter[1];

                    $dia_agent = $agendamento['dia'];
                    $exp_atual = explode('/', $dia_agent);

                    $mes_agent = $exp_atual[1];
                    $ano_agent = $exp_atual[2];

                @endphp
                @if ($agendamento['stts'] != 'simulando')
                    @if ($mes_agent == $mes_resgt AND $ano_agent == $ano_resgt)
                        <table class="w-[100%]">
                            <tr class="w-[100%]">
                                <td class="w-[15%]">
                                    <p class="font-bold text-[#884544]">{{ $agendamento['codigo'] }}</p>
                                </td>
                                <!-- PDO -->
                                <?php

                                // RESGATE DE NOME
                                $id_usuario = $agendamento['user'];
                                $stmt = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
                                $stmt->execute(['id' => $id_usuario]);

                                $result = $stmt->fetchAll();
                                foreach ($result as $row) {
                                }

                                // RESGATE DE SALA
                                $id_sala = $agendamento['sala'];
                                $stmx = $conn->prepare('SELECT * FROM salas WHERE id = :id ');
                                $stmx->execute(['id' => $id_sala]);

                                $resultx = $stmx->fetchAll();
                                foreach ($resultx as $rowx) {
                                }

                                ?>
                                <td class="w-[25%]">
                                    <p class="">{{ $row['nome'] }}</p>
                                </td>
                                <td class="w-[15%]">
                                    <p class="">{{ $rowx['nome'] }}</p>
                                </td>
                                <td class="w-[15%]">
                                    <p class="">{{ $agendamento['dia'] }} - {{ $agendamento['horario'] }}</p>
                                </td>
                                <td class="w-[10%]">
                                    <p class="text-[#884544] font-bold text-xs cursor-pointer" title="Horário de saída">
                                        {{ $agendamento['stts'] }}</p>
                                </td>
                                <td class="w-[20%]">
                                    <a href="{{ route('informacoes', ['id' => $agendamento['id']]) }}"><button
                                            class="float-left w-[80px] py-[5px] ml-[20px] border-[1px] bg-stone-200 text-[12px] border-zinc-300 font-bold">ver</button></a>
                                    <button
                                        class="float-left w-[80px] py-[5px] ml-[20px] border-[1px] bg-[#884544] text-white border-[#884544] text-[12px] font-bold">{{ $agendamento['stts'] }}</button></a>
                                </td>
                            </tr>
                        </table>
                        <hr class="my-[10px]">
                    @endif
                @endif
            @endforeach
        @endif
    </div>
    <!--  -->
    @if (isset($info) and !empty($info))
        <?php

        $agendamentos_edt = Illuminate\Support\Facades\DB::select("SELECT * FROM agendamentos WHERE id = '$info'");
        $usuario_agenda   = $agendamentos_edt[0]->user;
        $sala_agenda      = $agendamentos_edt[0]->sala;

        $usuario_edt      = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$usuario_agenda'");
        $salas_edt        = Illuminate\Support\Facades\DB::select("SELECT * FROM salas WHERE id = '$sala_agenda'");

        // CALCULO DE VALOR
        $tempo            = $agendamentos_edt[0]->tempo;
        $val_sala         = $salas_edt[0]->valor;
        $total            = $tempo * $val_sala;
        $novo_total       = number_format($total, 2, ',', '.');

        ?>
        <div class="modal_inform_agenda">
            <!--  -->
            <div class="w-[1000px] mx-[auto] mt-[4%] h-[600px] p-[50px] bg-[#ffffff] shadow-lg">
                <!--  -->
                <div class="w-[100%] mb-[30px] inline-block">
                    <!--  -->
                    <div class="w-[50%] float-left inline-block">
                        {{--  --}}
                        <p class="text-[25px] font-bold">Informações do agendamento</p>
                    </div>
                    <!--  -->
                    <div class="w-[50%] float-left inline-block">
                        {{--  --}}
                        <a href="{{ route('agendamento') }}">
                            <p class="float-right cursor-pointer">✕</p>
                        </a>
                    </div>
                </div>
                <!--  -->
                <div class="w-[100%] inline-block">
                    <!--  -->
                    <p class="text-[20px] pl-[15px] border-l-[4px] border-l-[green]">{{ $salas_edt[0]->nome }}</p>
                    <!--  -->
                    <div class="w-[100%] mt-[30px] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <!--  -->
                            <p class="text-[13px] font-bold">Agendado para:</p>
                            <!--  -->
                            <p class="text-[18px] mt-[3px]">{{ $usuario_edt[0]->nome }}</p>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <!--  -->
                            <p class="text-[13px] font-bold">E-mail:</p>
                            <!--  -->
                            <p class="text-[18px] mt-[3px]">{{ $usuario_edt[0]->email }}</p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] mt-[20px] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <!--  -->
                            <p class="text-[13px] font-bold">Entrada:</p>
                            <!--  -->
                            <p class="text-[16px] mt-[3px]">{{ $agendamentos_edt[0]->dia }} - {{ $agendamentos_edt[0]->horario }}</p>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <!-- PHP/VERIFICAÇÂO DE SAÍDA -->
                            <?php

                            $horario_entrada1 = $agendamentos_edt[0]->horario;
                            $explode_hora1    = explode(':', $horario_entrada1);
                            $hora_quebrada1   = $explode_hora1[0];
                            $mint_quebrada1   = $explode_hora1[1];

                            $nova_hora1       = $hora_quebrada1 + $agendamentos_edt[0]->tempo;
                            $nova_saida1      = $nova_hora1 . ':' . $mint_quebrada1;

                            ?>
                            <!--  -->
                            <p class="text-[13px] font-bold">Saída:</p>
                            <!--  -->
                            <p class="text-[16px] mt-[3px]">{{ $agendamentos_edt[0]->dia }} - {{ $nova_saida1 }} ({{ $agendamentos_edt[0]->tempo }}Hs)</p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] mt-[20px] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <!--  -->
                            <p class="text-[13px] font-bold">Valor:</p>
                            <!-- PHP/VERIFICAÇÃO DE VALOR -->
                            @php
                                $code_log_finc = $agendamentos_edt[0]->codigo;
                                // $verifica_log  = Illuminate\Support\Facades\DB::select("SELECT * FROM log_financeiros WHERE codigo = '$code_log_finc'");
                                $verifica_log  = Illuminate\Support\Facades\DB::select("SELECT * FROM agendamentos WHERE codigo = '$code_log_finc'");
                                $format_valor1 = number_format($verifica_log[0]->desconto, 2, ',', '.');
                            @endphp
                            <!--  -->
                            <p class="text-[20px] mt-[3px]">R${{ $format_valor1 }}</p>
                            <!--  -->
                            @if ($agendamentos_edt[0]->stts == 'pagamento')
                                <!--  -->
                                <p class="text-[13px] mt-[3px] text-[orange]">Receber pagamento (cartão ou dinheiro)</p>
                            @elseif($agendamentos_edt[0]->stts != 'pagamento')
                                <!--  -->
                                <p class="text-[13px] mt-[3px] text-[green]">Agendamento pago</p>
                            @endif
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] float-left inline-block">
                            <!--  -->
                            <p class="font-bold">Código de agendamento:</p>
                            <!--  -->
                            <p class="text-[30px] border-l-[3px] border-[#333333] pl-[20px] mt-[15px]">
                                {{ $agendamentos_edt[0]->codigo }}</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="w-[100%] mt-[50px] inline-block">
                    <!--  -->
                    @if ($agendamentos_edt[0]->stts == 'pagamento')
                    <a href="{{ route('liberar', ['id' => $info]) }}">
                        <button class="w-[200px] float-left h-[50px] rounded-[5px] bg-[#333333] text-[#ffffff]">Autorizar</button>
                    </a>
                    @elseif($agendamentos_edt[0]->stts == 'encerrado' or $agendamentos_edt[0]->stts == 'avaliar')
                    <a href="{{ route('agendamento') }}">
                        <button class="w-[200px] float-left h-[50px] rounded-[5px] bg-[#333333] text-[#ffffff]">Voltar a lista</button>
                    </a>
                    @else
                    <a href="{{ route('encerrar', ['id' => $info]) }}">
                        <button class="w-[200px] float-left h-[50px] rounded-[5px] bg-[#333333] text-[#ffffff]">Checkout</button>
                    </a>
                    @endif
                    {{--  --}}
                    <a href="{{ route('agendamento_edit', ['id' => $info]) }}"><p class="float-left ml-[20px] mt-[15px]">Editar informações</p></a>
                    {{--  --}}
                    <a href="{{ route('agenda_delete', ['id' => $info]) }}"><p class="float-left ml-[20px] mt-[15px]">Excluir agendamento</p></a>
                </div>
            </div>
        </div>
    @endif
    {{--  --}}
    @if (isset($miami) and !empty($miami))
        <?php

        $agendamentos_edt = Illuminate\Support\Facades\DB::select("SELECT * FROM agendamentos WHERE id = '$miami'");
        $usuario_agenda   = $agendamentos_edt[0]->user;
        $sala_agenda      = $agendamentos_edt[0]->sala;
        $valor_agenda     = $agendamentos_edt[0]->desconto;

        $usuario_edt      = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$usuario_agenda'");
        $salas_edt        = Illuminate\Support\Facades\DB::select("SELECT * FROM salas WHERE id = '$sala_agenda'");

        $total_sala       = Illuminate\Support\Facades\DB::select("SELECT * FROM salas");

        // CALCULO DE VALOR
        $tempo            = $agendamentos_edt[0]->tempo;
        $val_sala         = $salas_edt[0]->valor;
        $total            = $tempo * $val_sala;
        $novo_total       = number_format($valor_agenda, 2, ',', '.');

        ?>
        <div class="modal_inform_agenda">
            <!--  -->
            <div class="w-[1000px] mx-[auto] mt-[4%] h-[600px] p-[50px] bg-[#ffffff] shadow-lg">
                <!--  -->
                <div class="w-[100%] mb-[30px] inline-block">
                    <!--  -->
                    <div class="w-[50%] float-left inline-block">
                        {{--  --}}
                        <p class="text-[25px] font-bold">Editar informações do agendamento</p>
                    </div>
                    <!--  -->
                    <div class="w-[50%] float-left inline-block">
                        {{--  --}}
                        <a href="{{ route('agendamento') }}">
                            <p class="float-right cursor-pointer">✕</p>
                        </a>
                    </div>
                </div>
                <!--  -->
                <div class="w-[100%] inline-block">
                    <!-- CAMPO DE EDIÇÃO -->
                    <form action="{{ route('agenda_editando', ['id' => $miami]) }}" method="POST">
                    @csrf
                    {{--  --}}
                    <select class="w-[100%] pl-[10px] border-[1px] text-[16px] border-[#212121] bg-[#ffffff] inline-block h-[50px] rounded-[10px]" name="sala">
                        @foreach ($total_sala as $salax)
                        {{--  --}}
                            @if ($sala_agenda == $salax->id)
                                {{--  --}}
                                <option value="{{ $salax->id }}" selected="selected">{{ $salax->nome }} (selecionada)</option>
                            @else
                                {{--  --}}
                                <option value="{{ $salax->id }}">{{ $salax->nome }}</option>
                            @endif
                        @endforeach
                    </select>
                    <!--  -->
                    <div class="w-[100%] mt-[30px] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <!--  -->
                            <p class="text-[13px] font-bold">Agendado para:</p>
                            <!--  -->
                            <p class="text-[18px] mt-[3px]">{{ $usuario_edt[0]->nome }}</p>
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            <!--  -->
                            <p class="text-[13px] font-bold">E-mail:</p>
                            <!--  -->
                            <p class="text-[18px] mt-[3px]">{{ $usuario_edt[0]->email }}</p>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="w-[100%] mt-[20px] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <!--  -->
                            <p class="text-[13px] font-bold">Data:</p>
                            <!--  -->
                            {{-- <p class="text-[16px] mt-[3px]">{{ $agendamentos_edt[0]->dia }} - {{ $agendamentos_edt[0]->horario }}</p> --}}
                            <input class="w-[80%] mt-[10px] h-[50px] text-[16px] border-[1px] border-[#212121] pl-[10px] rounded-[10px]" value="{{ $agendamentos_edt[0]->dia }}" name="dia" type="text">
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] inline-block float-left">
                            {{--  --}}
                            <p class="text-[13px] font-bold">Horario:</p>
                            <!--  -->
                            {{-- <p class="text-[16px] mt-[3px]">{{ $agendamentos_edt[0]->dia }} - {{ $agendamentos_edt[0]->horario }}</p> --}}
                            <input class="w-[80%] mt-[10px] h-[50px] text-[16px] border-[1px] border-[#212121] pl-[10px] rounded-[10px]" value="{{ $agendamentos_edt[0]->horario }}" name="horario" type="text">
                        </div>
                    </div>
                    <!--  -->
                    <div class="w-[100%] mt-[20px] inline-block">
                        <!--  -->
                        <div class="w-[49%] mr-[1%] inline-block float-left">
                            <!--  -->
                            <p class="text-[13px] font-bold">Valor:</p>
                            <!--  -->
                            {{-- <input type="hidden" value="{{ $verifica_log[0]->id }}" name="log"> --}}
                            {{--  --}}
                            <input class="w-[80%] mt-[10px] h-[50px] text-[16px] border-[1px] border-[#212121] pl-[10px] rounded-[10px]" value="{{ $novo_total }}" name="vantagem" type="text">
                        </div>
                        <!--  -->
                        <div class="w-[49%] ml-[1%] float-left inline-block">
                            <!--  -->
                            <p class="font-bold">Código de agendamento:</p>
                            <!--  -->
                            <p class="text-[30px] border-l-[3px] border-[#333333] pl-[20px] mt-[15px]">{{ $agendamentos_edt[0]->codigo }}</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="w-[100%] mt-[30px] inline-block">
                    <!--  -->
                    <button class="w-[200px] float-left h-[50px] rounded-[5px] bg-[#333333] text-[#ffffff]">Alterar</button>
                    {{--  --}}
                    </form>
                    {{--  --}}
                    <a href="{{ route('agenda_delete', ['id' => $miami]) }}"><p class="float-left ml-[20px] mt-[15px]">Excluir agendamento</p></a>
                </div>
            </div>
        </div>
    @endif
@endsection

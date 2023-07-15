@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    <section>
        <div class="w-[90%] mx-[5%] py-[30px] inline-block">

            @if (isset($status) AND !empty($status))

                @if ($status == "pagamento")
                {{-- AGUARDANDO --}}
                <div class="w-[100%] inline-block">
                    <div class="w-[100%] inline-block">
                        @if ($status == "pagamento")
                            <center>
                                <p class="text-[70px] text-[orange]"><i class="fi fi-sr-question-square"></i></p>
                                <p class="text-[20px] font-bold mt-[-20px] text-[orange]">Aguardando Pagamento!</p>
                                <p class="text-[14px] mt-[30px]">seu número de agendamento</p>
                                <p class="text-[50px] font-bold mt-[0px]">{{ $agenda->codigo }}</p>
                            </center>
                        @endif
                    </div>

                    <div class="card" style="margin: 20px 0px;">
                        <div class="card-header">Detalhes da Reserva</div>
                        @php
                            $id_sala = $agenda->sala;
                            $info_sala = Illuminate\Support\Facades\DB::select("SELECT * FROM salas WHERE id = '$id_sala'");
                            $preco_final = number_format($agenda->desconto,2,",",".");
                        @endphp
                        <div class="card-body">
                            <h5 class="text-[20px] font-bold">Espaço Selecionado</h5>
                            <p class="mt-[30px] leading-[20px]">Espaço agendado para o dia <b>{{ $agenda->dia }}</b> às <b>{{ $agenda->horario }}Hs.</b></p>
                            <p class="mt-[10px] leading-[20px]">O valor da reserva de <b>R${{ $preco_final }}</b>, deverá ser pago no gichê de atendimento.</b></p>
                            <a href="{{ route('app.agendamento') }}"><button class="w-[100%] h-[40px] float-right text-[#ffffff] font-bold bg-[#C5908F] mt-[20px] rounded-[5px]">Voltar a lista</button></a>
                        </div>
                    </div>
                    <center>
                        <div class="w-[100%] inline-block mt-[30px]">
                            <a href="{{ route('app.cancela_reserva', ['id' => $agenda->id]) }}" class="text-[red] text-[14px]">Cancelar Reserva</a>
                        </div>
                    </center>
                </div>

                @elseif ($status != "pagamento" OR $status != "simulando")
                {{-- AVALIAR ESPAÇO --}}
                <div class="w-[100%] inline-block">
                    <div class="w-[100%] inline-block">
                        @if ($status == "yellow")
                            <center>
                                <p class="text-[70px] text-[green]"><i class="fi fi-sr-heart"></i></p>
                                <p class="text-[20px] font-bold mt-[-20px] text-[green]">Avalie o Espaço!</p>
                            </center>
                        @endif
                    </div>

                    <div class="card" style="margin: 20px 0px;">
                        <div class="card-header">Detalhes da Reserva</div>
                        <div class="card-body">
                            <h5 class="text-[20px] font-bold">Espaço Selecionado</h5>
                            <p class="mt-[30px] leading-[20px]">Você usou esse espaço no dia <b>12 de Agosto de 2023</b> às <b>13:00Hs.</b></p>
                            <p class="mt-[10px] leading-[20px]">Abaixo avalie esse espaço.</b></p>
                        </div>
                    </div>

                    <form action="" method="">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Example textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Opcional" rows="3"></textarea>
                        </div>
                        <div class="my-1">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Preference</label>
                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                <option selected>Choose...</option>
                                <option value="5">Exelente</option>
                                <option value="4">Ótimo</option>
                                <option value="3">Bom</option>
                                <option value="2">Ruim</option>
                                <option value="1">Péssimo</option>
                            </select>
                        </div>
                        <button class="w-[200px] h-[40px] float-right text-[#ffffff] font-bold bg-[#C5908F] mt-[20px] rounded-[5px]">Avaliar</button>
                    </form>
                </div>
                @endif

            @endif

            @if (isset($detalhe) AND !empty($detalhe))

                @if ($agendamento == "verificar")
                <div class="w-[100%] inline-block">
                    <div class="w-[100%] inline-block">
                        <center>
                            <p class="text-[70px] text-[red]"><i class="fi fi-sr-message-xmark"></i></p>
                            <p class="text-[20px] font-bold mt-[-20px] text-[red]">Reserva Recusada!</p>
                            <p class="mt-[30px] leading-[20px]">A Sala selecionada pode já está reservada para esse dia e horário, tente seleciona um outro horário ou dia.</p>
                        </center>
                    </div>

                    <div class="w-[100%] mt-[50px] inline-block">
                        <form action="{{ route('app.agendamento_sala') }}" method="POST">
                            @csrf
                            <div class="my-1">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Tempo</label>
                                <select class="custom-select mr-sm-2" name="tempo" id="inlineFormCustomSelect">
                                    <option selected>...</option>
                                    <option value="1">1 hora</option>
                                    <option value="2">2 horas</option>
                                    <option value="3">3 horas</option>
                                    <option value="4">Turno</option>
                                    <option value="8">Diária</option>
                                </select>
                            </div>
                            <div class="w-[100%] inline-block">
                                <div class="float-left w-[49%] mr-[1%]">
                                    <label for="exampleInputEmail1">Data</label>
                                    <input type="date" class="form-control" name="dia" id="exampleInputEmail1">
                                </div>
                                <div class="float-left w-[49%] ml-[1%]">
                                    <label for="exampleInputEmail1">Hora</label>
                                    <input type="time" class="form-control" name="horario" id="exampleInputEmail1">
                                </div>
                            </div>
                            <input type="hidden" value="{{ $sala_retorno }}" name="sala">
                            <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] mb-[30px] mt-[20px] text-[#ffffff]">Verificar Reserva</button>
                        </form>
                    </div>
                </div>

                @elseif($agendamento == "disponivel")
                <div class="w-[100%] inline-block">

                    <div class="w-[100%] inline-block">
                        <center>
                            <p class="text-[70px] text-[green]"><i class="fi fi-sr-comment-alt-check"></i></p>
                            <p class="text-[20px] font-bold mt-[-20px] text-[green]">Reserva Confirmada!</p>
                            <p class="text-[14px] mt-[30px]">seu número de agendamento</p>
                            <p class="text-[50px] font-bold mt-[0px]">{{ $codigo_agenda }}</p>
                        </center>
                    </div>

                    @php
                        $reserva_conf = Illuminate\Support\Facades\DB::select("SELECT * FROM agendamentos WHERE codigo = '$codigo_agenda'");
                        $id_sala      = $reserva_conf[0]->sala;
                        $info_sala    = Illuminate\Support\Facades\DB::select("SELECT * FROM salas WHERE id = '$id_sala'");
                        $preco_final  = number_format($discount_value,2,",",".");
                    @endphp

                    <div class="card" style="margin: 20px 0px;">
                        <div class="card-header">Detalhes da Reserva</div>
                        <div class="card-body">
                            <h5 class="text-[20px] font-bold">{{ $info_sala[0]->nome }}</h5>
                            <p class="mt-[30px] leading-[20px]">Espaço agendado para o dia <b>{{ $reserva_conf[0]->dia }}</b> às <b>{{ $reserva_conf[0]->horario }}Hs.</b></p>
                            <p class="mt-[10px] leading-[20px]">O valor da reserva de <b>R${{ $preco_final }}</b>, deverá ser pago no gichê de atendimento.</b></p>
                        </div>
                    </div>
                    <center>
                        <a href="{{ route('app.confirmar_reserva', ['id' => $reserva_conf[0]->id]) }}"><button class="w-[100%] h-[40px] float-right text-[#ffffff] font-bold bg-[#C5908F] mt-[20px] rounded-[5px]">Confirmar Reserva</button></a>
                        <div class="w-[100%] inline-block mt-[30px]">
                            <a href="{{ route('app.cancela_reserva', ['id' => $reserva_conf[0]->id]) }}" class="text-[red] text-[14px]">Cancelar Reserva</a>
                        </div>
                    </center>
                </div>
                @endif

            @endif

        </div>
    </section>

</main>

<script>
    $('.carousel').carousel({
        interval: 2000;
    })
</script>
@endsection

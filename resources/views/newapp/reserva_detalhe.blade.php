@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    <section>
        <div class="w-[90%] mx-[5%] py-[30px] inline-block">

            @if (isset($status) AND !empty($status))

                {{-- AGUARDANDO --}}
                <div class="w-[100%] inline-block" style="display: none;">
                    <div class="w-[100%] inline-block">
                        @if ($status == "yellow")
                            <center>
                                <p class="text-[70px] text-[orange]"><i class="fi fi-sr-question-square"></i></p>
                                <p class="text-[20px] font-bold mt-[-20px] text-[orange]">Aguardando Pagamento!</p>
                                <p class="text-[14px] mt-[30px]">seu número de agendamento</p>
                                <p class="text-[50px] font-bold mt-[0px]">000808302</p>
                            </center>
                        @endif
                    </div>

                    <div class="card" style="margin: 20px 0px;">
                        <div class="card-header">Detalhes da Reserva</div>
                        <div class="card-body">
                            <h5 class="text-[20px] font-bold">Espaço Selecionado</h5>
                            <p class="mt-[30px] leading-[20px]">Espaço agendado para o dia <b>12 de Agosto de 2023</b> às <b>13:00Hs.</b></p>
                            <p class="mt-[10px] leading-[20px]">O valor da reserva de <b>R$120,00</b>, deverá ser pago no gichê de atendimento.</b></p>
                            <button class="w-[200px] h-[40px] float-right text-[#ffffff] font-bold bg-[blue] mt-[20px] rounded-[5px]">Ver na lista</button>
                        </div>
                    </div>
                    <center>
                        <a href="" class="text-[red] text-[14px]">Cancelar Reserva</a>
                    </center>
                </div>

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
                        <button class="w-[200px] h-[40px] float-right text-[#ffffff] font-bold bg-[blue] mt-[20px] rounded-[5px]">Avaliar</button>
                    </form>
                </div>

            @endif

            @if (isset($detalhe) AND !empty($detalhe))
                <div class="w-[100%] inline-block" style="display: none;">

                    <div class="w-[100%] inline-block">
                        <center>
                            <p class="text-[70px] text-[green]"><i class="fi fi-sr-comment-alt-check"></i></p>
                            <p class="text-[20px] font-bold mt-[-20px] text-[green]">Reserva Confirmada!</p>
                            <p class="text-[14px] mt-[30px]">seu número de agendamento</p>
                            <p class="text-[50px] font-bold mt-[0px]">000808302</p>
                        </center>
                    </div>

                    <div class="card" style="margin: 20px 0px;">
                        <div class="card-header">Detalhes da Reserva</div>
                        <div class="card-body">
                            <h5 class="text-[20px] font-bold">Espaço Selecionado</h5>
                            <p class="mt-[30px] leading-[20px]">Espaço agendado para o dia <b>12 de Agosto de 2023</b> às <b>13:00Hs.</b></p>
                            <p class="mt-[10px] leading-[20px]">O valor da reserva de <b>R$120,00</b>, deverá ser pago no gichê de atendimento.</b></p>
                            <button class="w-[200px] h-[40px] float-right text-[#ffffff] font-bold bg-[blue] mt-[20px] rounded-[5px]">Ver na lista</button>
                        </div>
                    </div>
                    <center>
                        <a href="" class="text-[red] text-[14px]">Cancelar Reserva</a>
                    </center>
                </div>

                <div class="w-[100%] inline-block">
                    <div class="w-[100%] inline-block">
                        <center>
                            <p class="text-[70px] text-[red]"><i class="fi fi-sr-message-xmark"></i></p>
                            <p class="text-[20px] font-bold mt-[-20px] text-[red]">Reserva Recusada!</p>
                            <p class="mt-[30px] leading-[20px]">A Sala selecionada pode já está reservada para esse dia e horário, tente seleciona um outro horário ou dia.</p>
                        </center>
                    </div>

                    <div class="w-[100%] mt-[50px] inline-block">
                        <form action="{{ route('app.detalhe.reserva') }}" method="POST">
                            @csrf
                            <div class="my-1">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Tempo</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option selected>Choose...</option>
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
                                    <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="float-left w-[49%] ml-[1%]">
                                    <label for="exampleInputEmail1">Hora</label>
                                    <input type="time" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                            </div>
                            <button class="w-[100%] h-[40px] rounded-[5px] bg-[blue] mt-[20px] text-[#ffffff]">Verificar Reserva</button>
                        </form>
                    </div>
                </div>
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

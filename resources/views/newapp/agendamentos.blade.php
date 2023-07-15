@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    <section>
        <div class="w-[90%] mx-[5%] py-[20px] inline-block">
            {{--  --}}
            <div class="w-[100% pb-[20px] inline-block">
                <p class="font-bold text-[25px]">Meus agendamentos</p></p>
            </div>

            <div class="w-[100%] inline-block">
                <form action="{{ route('app.filtrar_reserva') }}" method="POST">
                    @csrf
                    <div class="w-[100%] inline-block">
                        <div class="float-left w-[100%]">
                            <label for="exampleInputEmail1">Buscar agendamentos</label>
                            <input type="date" class="form-control" name="dia" id="exampleInputEmail1">
                        </div>
                        <div class="float-left w-[100%] mt-[10px]">
                            <button class="w-[100%] h-[39px] rounded-[5px] bg-[#C5908F] mt-[0px] text-[#ffffff]">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>

            <p class="text-[11px] mt-[30px]">OBS.: Clique no espaço para ver detalhes da reserva.</p>
            <table class="table table-striped" style="margin-top: 10px;">
                <thead>
                    <tr>
                        <th scope="col">Espaço</th>
                        <th scope="col">Data</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                @if (isset($filtro) AND !empty($filtro))
                <tbody>
                    @foreach ($filtro as $filtragem)
                        @if ($filtragem->stts != "simulando")
                            @php
                                $id_sala   = $filtragem->sala;
                                $info_sala = Illuminate\Support\Facades\DB::select("SELECT * FROM salas WHERE id = '$id_sala'");
                            @endphp
                            <tr>
                                <td><a href="{{ route('app.status.reserva', ['id' => $filtragem->id, 'status' => $filtragem->stts]) }}"><p>{{ $info_sala[0]->nome }}</p></a></td>
                                <td>{{ $filtragem->dia }}</td>
                                @if ($filtragem->stts == "pagamento")
                                <td><p class="text-[20px] text-[orange] text-center" title="Aguardando pagamento"><i class="fi fi-sr-interrogation"></i></p></td>
                                @elseif ($filtragem->stts != "pagamento")
                                <td><p class="text-[20px] text-[green] text-center" title="Espaço usado"><i class="fi fi-sr-check-circle"></i></p></td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                    <div class="w-[100%] inline-block mt-[30px] mb-[20px]">
                        <center>
                            <a href="{{ route('app.agendamento') }}"><p class="text-[#C5908F]">Ver todos</p></a>
                        </center>
                    </div>
                </tbody>
                {{--  --}}

                @else
                <tbody>
                    @foreach ($agenda as $agendamento)
                        @if ($agendamento->stts != "simulando")
                            @php
                                $id_sala   = $agendamento->sala;
                                $info_sala = Illuminate\Support\Facades\DB::select("SELECT * FROM salas WHERE id = '$id_sala'");
                            @endphp
                            <tr>
                                <td><a href="{{ route('app.status.reserva', ['id' => $agendamento->id, 'status' => $agendamento->stts]) }}"><p>{{ $info_sala[0]->nome }}</p></a></td>
                                <td>{{ $agendamento->dia }}</td>
                                @if ($agendamento->stts == "pagamento")
                                <td><p class="text-[20px] text-[orange] text-center" title="Aguardando pagamento"><i class="fi fi-sr-interrogation"></i></p></td>
                                @elseif ($agendamento->stts != "pagamento")
                                <td><p class="text-[20px] text-[green] text-center" title="Espaço usado"><i class="fi fi-sr-check-circle"></i></p></td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
    </section>

</main>

<script>
    $('.carousel').carousel({
        interval: 2000;
    })
</script>
@endsection

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
                <form action="{{ route('app.detalhe.reserva') }}" method="POST">
                    @csrf
                    <div class="w-[100%] inline-block">
                        <div class="float-left w-[100%]">
                            <label for="exampleInputEmail1">Buscar agendamentos</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="float-left w-[100%] mt-[10px]">
                            <button class="w-[100%] h-[39px] rounded-[5px] bg-[blue] mt-[0px] text-[#ffffff]">Filtrar</button>
                        </div>
                    </div>

                </form>
            </div>

            <table class="table table-striped" style="margin-top: 30px;">
                <thead>
                    <tr>
                        <th scope="col">Espaço</th>
                        <th scope="col">Data</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="{{ route('app.status.reserva') }}"><p>Sala Executiva</p></a></td>
                        <td>00/00</td>
                        <td><p class="text-[20px] text-[orange] text-center" title="Aguardando pagamento"><i class="fi fi-sr-interrogation"></i></p></td>
                    </tr>
                    <tr>
                        <td><p>Sala Privativa</p></td>
                        <td>00/00</td>
                        <td><p class="text-[20px] text-[green] text-center" title="Espaço usado"><i class="fi fi-ss-check-circle"></i></p></td>
                    </tr>
                    <tr>
                        <td><p>Penteadeira</p></td>
                        <td>00/00</td>
                        <td><p class="text-[20px] text-[red] text-center" title="Reserva cancelada"><i class="fi fi-sr-cross-circle"></i></p></td>
                    </tr>
                </tbody>
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

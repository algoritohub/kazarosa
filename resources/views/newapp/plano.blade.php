@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    <section>
        <div class="w-[90%] mx-[5%] py-[20px] inline-block">

            <div class="card" style="margin: 20px 0px;">
                <div class="card-header">Meu Plano</div>
                <div class="card-body">
                    <h5 class="text-[20px] font-bold mb-[20px]">Plano Basic</h5>
                    <p class="font-bold mb-[10px]">Tempo de uso</p>
                    <p class="leading-[20px] mb-[20px]">Você poderá usar seu plano para garantir descontos em reservas de espaço no Kaza Rosa e ter acesso ilimitado a rede social de mulheres.</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25 dias</div>
                    </div>
                    <button class="w-[200px] h-[40px] float-right text-[#ffffff] font-bold bg-[blue] mt-[20px] rounded-[5px]">Renovar plano</button>
                </div>
            </div>

            <div class="card" style="margin: 20px 0px;">
                <div class="card-header">Desconto em horas</div>
                <div class="card-body">
                    <p class="leading-[20px] mb-[20px]">Use seu banco de horas e economize em suas reservas.</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 35%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">10 horas</div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin: 20px 0px;">
                <div class="card-header">Desconto em espaços</div>
                <div class="card-body">
                    <p class="leading-[20px] mb-[20px]">Voçe tem desconto nos espaços abaixos: </p>
                    <ul class="list-group">
                        <li class="list-group-item"><b>30%</b> Cras justo odio</li>
                        <li class="list-group-item"><b>10%</b> Dapibus ac facilisis in</li>
                    </ul>
                </div>
            </div>

            <p class="float-right text-[red] text-[14px] cursor-pointer" data-toggle="modal" data-target="#exampleModal">Cancelar meu Plano</p>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-weight: bold;">Deseja cancelar seu plano?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    ...
                    </div>
                </div>
                </div>
            </div>

        </div>
    </section>

</main>

<script>
    $('.carousel').carousel({
        interval: 2000;
    })
</script>
@endsection

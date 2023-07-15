@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    <section>
        @if ($plano)

            @if ($plano->stts == "autorizado")

                @if ($plano->dias <= 0)

                    <div class="w-[90%] mx-[5%] py-[20px] inline-block">
                        <center>
                            <p class="text-[70px] text-[#C5908F]"><i class="fi fi-br-refresh"></i></p>
                            <p class="font-bold mt-[-20px] text-[25px]">Plano suspenso!</p>
                            <p class="mt-[100px] text-[15px] leading-[18px]">Atualize seu plano e tenhas benefícios exclusivos em suas reservas!</p>
                            <a href="{{ route('app.principal') }}"><button class="w-[100%] h-[40px] rounded-[5px] mt-[30px] text-[#ffffff] bg-[#C5908F]">Encontre seu melhor plano</button></a>
                        </center>
                    </div>

                @else

                    <div class="w-[90%] mx-[5%] py-[20px] inline-block">
                        <div class="card" style="margin: 20px 0px;">
                            <div class="card-header">Meu Plano</div>

                            <div class="card-body">
                                <h5 class="text-[20px] font-bold mb-[20px]">{{ $clube->nome }}</h5>
                                <p class="font-bold mb-[10px]">Tempo de uso</p>
                                <p class="leading-[20px] mb-[20px]">Você poderá usar seu plano para garantir descontos em reservas de espaço no Kaza Rosa e ter acesso ilimitado a rede social de mulheres.</p>
                                <div class="w-[100%] border-[1px] bg-[#eeeeee] rounded-[5px] p-[2px]">
                                    <div class="w-[{{ $porcent_dias }}%] py-[2px] bg-[#C5908F] rounded-[5px]">
                                        <center><p class="text-[#ffffff] text-[10px]">{{ $plano->dias }} dias</p></center>
                                    </div>
                                </div>
                                @if ($plano->dias <= 0)
                                <a href="{{ route('app.principal') }}"><button class="w-[200px] h-[40px] float-right text-[#ffffff] font-bold bg-[#C5908F] mt-[20px] rounded-[5px]">Renovar plano</button></a>
                                @endif
                            </div>
                        </div>

                        <div class="card" style="margin: 20px 0px;">
                            <div class="card-header">Desconto em horas</div>
                            <div class="card-body">
                                <p class="leading-[20px] mb-[20px]">Use seu banco de horas e economize em suas reservas.</p>
                                <div class="w-[100%] border-[1px] bg-[#eeeeee] rounded-[5px] p-[2px]">
                                    <div class="w-[{{ $porcent_horas }}%] py-[2px] bg-[#C5908F] rounded-[5px]">
                                        <center><p class="text-[#ffffff] text-[10px]">{{ $plano->horas }} horas</p></center>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="margin: 20px 0px;">
                            <div class="card-header">Desconto em espaços</div>
                            <div class="card-body">
                                <p class="leading-[20px] mb-[20px]">Você tem desconto nos espaços abaixos: </p>
                                @foreach ($salas_desc as $desconto)

                                    @if (isset($desconto) AND !empty($desconto) AND $desconto != " ")

                                        @if ($desconto == "all")

                                        <a href=""><button class="px-[20px] h-[40px] rounded-[5px] bg-[#eeeeee] border-[#cdcdcd] mr-[10px] mb-[10px]">Todos os Espaços</button></a>

                                        @else

                                        @php
                                            $info_sala1 = Illuminate\Support\Facades\DB::select("SELECT * FROM salas WHERE id = '$desconto'");
                                        @endphp
                                        <a href=""><button class="px-[20px] h-[40px] rounded-[5px] bg-[#eeeeee] border-[#cdcdcd] mr-[10px] mb-[10px]">{{ $info_sala1[0]->nome }}</button></a>

                                        @endif

                                    @endif

                                @endforeach
                            </div>
                        </div>

                        <p class="float-right text-[red] text-[14px] cursor-pointer" data-toggle="modal" data-target="#exampleModal">Cancelar meu Plano</p>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content" style="padding: 20px;">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="font-weight: bold;">Deseja cancelar seu plano?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <p>Ao cancelar seu plano, você perderá todos os benefícios relacionados a ele, e não poderá restaurá-los, se tem certeza desta operação continue abaixo.</p>
                                <form action="{{ route('app.cancelar_plano') }}" method="GET" class="mt-[20px]">
                                    @csrf
                                    <div class="form-group">
                                        <input type="password" class="form-control" maxlength="16" name="senha" placeholder="Confirme sua senha">
                                    </div>
                                    <button class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] text-[#ffffff]">Cancelar Plano</button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                @endif

            @else

                <div class="w-[90%] mx-[5%] py-[20px] inline-block">
                    <center>
                        <p class="text-[70px] text-[#C5908F]"><i class="fi fi-rr-time-quarter-past"></i></p>
                        <p class="font-bold mt-[-20px] text-[25px]">Aguardando Aprovação!</p>
                        <p class="mt-[100px] text-[15px] leading-[18px]">Seu plano está aguardando aprovação, caso ainda não tenha realizo seu pagamento use o códico abaixo, ou aguarde a aprovação em até 72h.</p>
                    </center>

                    <div class="card" style="margin-top: 20px;">
                        <div class="card-header">Detalhes do Plano</div>
                        <div class="card-body">
                            <h5 class="text-[20px] font-bold">{{ $clube->nome }}</h5>
                            <p class="mt-[10px] leading-[20px]">O valor mensal deste plano é de <b>R${{ $valor }}</b>. Use o código abaixo em seu aplicativo de pagamento.</b></p>
                            <div class="p-[20px] w-[100%] border-[1px] border-[#cdcdcd] rounded-[5px] mt-[20px] bg-[#fafafa] inline-block">
                                @if ($plano->plano == 1)
                                <input id="input" class="w-[100%] outline-none" type="text" value="00020126500014br.gov.bcb.pix0114393649410001400210Basic Plan5204000053039865406167.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525P8XD04138455167036657286763042771" />
                                @elseif($plano->plano == 2)
                                <input id="input" class="w-[100%] outline-none" type="text" value="00020126480014br.gov.bcb.pix0114393649410001400208Vip Plan5204000053039865406257.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525MDHG0413845516708701884196304B166" />
                                @elseif($plano->plano == 4)
                                <input id="input" class="w-[100%] outline-none" type="text" value="00020126520014br.gov.bcb.pix0114393649410001400212Private Plan5204000053039865406420.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525UXG1041384551672171247851630428F2" />
                                @elseif($plano->plano == 3)
                                <input id="input" class="w-[100%] outline-none" type="text" value="00020126540014br.gov.bcb.pix0114393649410001400214Executive Plan5204000053039865406637.005802BR5925KENIA RAISSA PEREIRA PINT6005Natal610959075-81062290525ZDKX041384551670870337094630444D0" />
                                @endif
                            </div>
                        </div>
                    </div>

                    <button id="execCopy" class="w-[100%] h-[40px] rounded-[5px] bg-[#C5908F] mt-[10px] text-[#ffffff]">Copiar Código</button>
                </div>

            @endif

        @else
        <div class="w-[90%] mx-[5%] py-[20px] inline-block">
            <center>
                <p class="text-[70px] text-[#C5908F]"><i class="fi fi-sr-hexagon-check"></i></p>
                <p class="font-bold mt-[-20px] text-[25px]">Sem plano!</p>
                <p class="mt-[100px] text-[15px] leading-[18px]">Adiquira um de nossos planos e tenhas benefícios exclusivos em suas reservas!</p>
                <a href="{{ route('app.principal') }}"><button class="w-[100%] h-[40px] rounded-[5px] mt-[30px] text-[#ffffff] bg-[#C5908F]">Encontre seu melhor plano</button></a>
            </center>
        </div>
        @endif
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

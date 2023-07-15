@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    <section>
        <div class="w-[90%] mx-[5%] py-[20px] inline-block">
            <center>
                <p class="text-[70px] text-[#C5908F]"><i class="fi fi-sr-hexagon-check"></i></p>
                <p class="font-bold mt-[-20px] text-[25px]">Otima Escolha!</p>
                <p class="mt-[100px] text-[15px] leading-[18px] mb-[30px]">O próximo passo é realizar o pagamento do seu plano, abaixo segue seu código de pagamento e os detalhes do plano escolhido!</p>
            </center>

            <div class="card" style="margin-top: 20px;">
                <div class="card-header">Detalhes do Plano</div>
                <div class="card-body">
                    <h5 class="text-[20px] font-bold">{{ $plano->nome }}</h5>
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

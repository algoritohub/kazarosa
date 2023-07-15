@extends('newapp.layout.main_app_on')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[60px]">
    {{--  --}}
    <div class="w-[100%] h-[130px] mt-[-130px] absolute inline-block box-degrade" style="z-index: 1001;"></div>
    {{--  --}}
    <section>
        <div class="w-[90%] mx-[5%] py-[20px] inline-block">
            {{--  --}}
            <div class="w-[100% pb-[20px] inline-block">
                <p class="font-bold text-[25px]">{{ $plano->nome }}</p></p>
            </div>
            {{--  --}}
            <div class="w-[100%] inline-block">
                <div class="w-[50%] inline-block float-left">
                    <p class="font-bold mt-[10px] text-[18px]">R${{ $valor }}/mensal</p>
                </div>
                <div class="w-[50%] inline-block float-left">
                    <a href="{{ route('app.plano_confirma', ['id' => $plano->plano]) }}"><button class="w-[90%] float-right h-[50px] bg-[#C5908F] border-[0] text-[#ffffff] font-bold rounded-[5px]">Quero este!</button></a>
                </div>
            </div>
            <hr class="my-[20px]">
            {{--  --}}
            <div class="w-[100%] inline-block">
                <p class="text-[20px] float-left"><i class="fi fi-sr-check-circle"></i></p> <p class="text-[18px] font-bold float-left ml-[10px]">Detalhes</p>
            </div>
            {{--  --}}
            <p class="text-[15px] mb-[20px]">Acesso ilimitado a rede social de mulheres MQM.</p>
            {{--  --}}
            <div class="w-[100%] inline-block">
                <p class="text-[20px] float-left"><i class="fi fi-sr-check-circle"></i></p> <p class="text-[18px] font-bold float-left ml-[10px]">Benefícios e Descontos</p>
            </div>
            {{--  --}}
            <div class="w-[100% pt-[15px] inline-block">
                <p class="text-[15px] mb-[20px]">{{ $plano->horas }} Horas extras para usar nos espaços:</p>
                @foreach ($salas_free as $free)

                    @if (isset($free) AND !empty($free))
                        @php
                            $info_sala = Illuminate\Support\Facades\DB::select("SELECT * FROM salas WHERE id = '$free'");
                        @endphp
                        <a href=""><button class="px-[20px] h-[40px] rounded-[5px] bg-[#eeeeee] border-[#cdcdcd] mr-[10px] mb-[10px]">{{ $info_sala[0]->nome }}</button></a>
                    @endif

                @endforeach
            </div>
            <div class="w-[100% pt-[20px] inline-block">
                <p class="text-[15px] mb-[20px]">{{ $plano->desconto }}% de desconto nos espaços:</p>

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
            {{--  --}}
            <a href="{{ route('app.principal') }}"><button class="w-[100%] float-right h-[50px] mt-[30px] bg-[#C5908F] border-[0] text-[#ffffff] font-bold rounded-[5px]">Ver outros planos!</button></a>
        </div>
    </section>
</main>

@endsection

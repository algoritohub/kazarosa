@extends('dashboard.layout.main')
@section('title', 'Dashboard - Clube de Negócios')
@section('titulo', 'Clube de negócios')
@section('imagem', 'apresentacao.png')

@section('content')
<!--  -->
<div class="w-[100%] h-[480px] bg-white float-left overflow-auto">
    <!--  -->
    <div class="inline-block p-[30px] w-[100%]">
        <table class="w-[100%]">
            <tr>
                <td class="w-[30%]"><p class="text-[13px] text-[#212121] font-bold">Nome</p></td>
                <td class="w-[20%]"><p class="text-[13px] text-[#212121] font-bold">Plano</p></td>
                <td class="w-[10%]"><p class="text-[13px] text-[#212121] font-bold">Desconto</p></td>
                <td class="w-[10%]"><p class="text-[13px] text-[#212121] font-bold">Horas extras</p></td>
                <td class="w-[10%]"><p class="text-[13px] text-[#212121] font-bold">Telefone</p></td>
                <td class="w-[20%]"><p class="text-[13px] text-[#212121] font-bold"></p></td>
            </tr>
        </table>
        <hr class="my-[15px]" size="1px">
        <!--  -->
        @foreach($clube as $user)
        {{--  --}}
        @php
            $usuario_id   = $user->id_user;
            $usuario_info = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE id = '$usuario_id' ORDER BY id DESC");
        @endphp
        <table class="w-[100%]">
            <tr>
                <td class="w-[30%]"><p class="text-[13px] text-[#212121]">{{ $usuario_info[0]->nome }}</p></td>
                @if ($user->plano == 1)
                    <td class="w-[20%]"><p class="text-[13px] text-[#212121]">BASIC PLAN</p></td>
                @elseif ($user->plano == 2)
                    <td class="w-[20%]"><p class="text-[13px] text-[#212121]">VIP PLAN</p></td>
                @elseif ($user->plano == 4)
                    <td class="w-[20%]"><p class="text-[13px] text-[#212121]">PRIVATE PLAN</p></td>
                @elseif ($user->plano == 3)
                    <td class="w-[20%]"><p class="text-[13px] text-[#212121]">EXECUTIVE PLAN</p></td>
                @endif
                <td class="w-[10%]"><p class="text-[13px] text-[#212121]">{{ $user->desconto }}%</p></td>
                <td class="w-[10%]"><p class="text-[13px] text-[#212121]">{{ $user->horas }}hs</p></td>
                @if (isset($usuario_info[0]->telefone) AND !empty($usuario_info[0]->telefone))
                    <td class="w-[10%]"><p class="text-[13px] text-[#212121]">{{ $usuario_info[0]->telefone }}</p></td>
                @else
                    <td class="w-[10%]"><p class="text-[13px] text-[#212121]">sem telefone</p></td>
                @endif
                <td class="w-[20%]">
                    @if($user->stts == 'pagamento')
                    <a href="{{ route('autoriza_plano', ['id' => $user->id]) }}"><button title="Em caso de confirmação de pagamento via PIX, libere o plano dete usuário" class="w-[130px] h-[30px] rounded-[5px] bg-[#333333] text-[#ffffff] float-right">Autorizar</button></a>
                    @elseif($user->stts == 'autorizado')
                    <a href="{{ route('suspender_plano', ['id' => $user->id]) }}"><button class="w-[130px] h-[30px] rounded-[5px] bg-[#333333] text-[#ffffff] float-right">Suspender</button></a>
                    @elseif($user->stts == 'suspenso')
                    <a href="{{ route('liberar_plano', ['id' => $user->id]) }}"><button class="w-[130px] h-[30px] rounded-[5px] bg-[#333333] text-[#ffffff] float-right">Liberar</button></a>
                    @endif
                </td>
            </tr>
        </table>
        <hr class="my-[15px]" size="1px">
        @endforeach
    </div>
</div>
@endsection



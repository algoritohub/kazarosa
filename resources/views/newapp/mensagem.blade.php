@extends('newapp.layout.main_feed')
@section('title', 'Kaza Rosa | Cadastro')

@section('content')
<main class="my-[90px]">

    <div class="w-[100%] mb-[30px] inline-block">
        <div class="w-[90%] mx-[5%] inline-block">

            <div class="w-[100%] inline-block">
                <div class="w-[17%] inline-block float-left">
                    <div class="w-[50px] h-[50px] rounded-[100px] bg-[silver]"></div>
                </div>
                <div class="w-[83%] inline-block float-left">
                    <p class="font-bold text-[20px]">Ciclano</p>
                    <p class="mt-[-5px]">Enviado em 27 de agosto</p>
                </div>
            </div>

            <p class="mt-[30px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, vero, labore omnis error numquam reprehenderit consectetur, soluta similique eos hic iure cupiditate reiciendis dolorem quod? Dignissimos eos repellat earum maiores.</p>

            <div class="w-[100%] mt-[30px] inline-block">
                <form action="">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Responder Ciclano</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button class="w-[100%] inline-block h-[40px] mb-[20px] text-[#ffffff] rounded-[5px] bg-[blue]">Responder</button>
                </form>
            </div>

        </div>
    </div>

</main>

@endsection

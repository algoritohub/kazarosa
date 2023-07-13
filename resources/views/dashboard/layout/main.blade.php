<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;500&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="/css/estilo.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- SCRIPT -->
  <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-3.3.2.js"></script>
  <script src="/js/function-mask.js"></script>
  <script src="/js/script.js"></script>
</head>
<!--  -->
<body>
  <section class="w-[100%] h-[99vh] inline-block">
    <!-- SIDEBAR -->
    <div class="w-[20%] h-[100vh] px-[30px] bg-[#a35554] float-left inline-block">
      <!-- LOGO -->
      <center>
          <img class="w-[150px] mt-[50px]" src="/img/Ativo 6.png">
      </center>
      <!-- MENU -->
      <ul class="w-[100%] mt-[50px]">
        <!--  -->
        <li class="mb-[15px] flex w-[100%]"><a href="{{ route('geral') }}"><img class="w-[20px] float-left" src="/img/painel.png"><p class="text-[15px] text-[#ffffff] hover:text-[#000000] float-left ml-[15px]">Painel geral</p></a></li>
        <!--  -->
        <li class="mb-[15px] flex w-[100%]"><a href="{{ route('agendamento') }}"><img class="w-[20px] float-left" src="/img/calendario.png"><p class="text-[15px] text-[#ffffff] hover:text-[#000000] float-left ml-[15px]">Agendamentos</p></a></li>
        <!--  -->
        <li class="mb-[15px] flex w-[100%]"><a href="{{ route('salas') }}"><img class="w-[20px] float-left" src="/img/home.png"><p class="text-[15px] text-[#ffffff] hover:text-[#000000] float-left ml-[15px]">Gerenciar espaço</p></a></li>
        <!--  -->
        <li class="mb-[15px] flex w-[100%]"><a href="{{ route('eventos') }}"><img class="w-[20px] float-left" src="/img/apresentacao.png"><p class="text-[15px] text-[#ffffff] hover:text-[#000000] float-left ml-[15px]">Gerenciar eventos</p></a></li>
        <!--  -->
        <li class="mb-[15px] flex w-[100%]"><a href="{{ route('clube_negocio') }}"><img class="w-[20px] float-left" src="/img/apresentacao.png"><p class="text-[15px] text-[#ffffff] hover:text-[#000000] float-left ml-[15px]">Clube de negócio</p></a></li>
        <!--  -->
        <li class="mb-[15px] flex w-[100%]"><a href="{{ route('pg_financeiro') }}"><img class="w-[20px] float-left" src="/img/apresentacao.png"><p class="text-[15px] text-[#ffffff] hover:text-[#000000] float-left ml-[15px]">Financeiro</p></a></li>
        <!--  -->
        <li class="mb-[15px] flex w-[100%]"><a href="{{ route('entrada_saida') }}"><img class="w-[20px] float-left" src="/img/apresentacao.png"><p class="text-[15px] text-[#ffffff] hover:text-[#000000] float-left ml-[15px]">Entrada e saída</p></a></li>
        <!--  -->
        <li class="mb-[15px] flex w-[100%]"><a href="{{ route('pg_newsletter') }}"><img class="w-[20px] float-left" src="/img/apresentacao.png"><p class="text-[15px] text-[#ffffff] hover:text-[#000000] float-left ml-[15px]">Contato</p></a></li>
      </ul>
      <!--  -->
      <a href="{{ route('logout_adm') }}"><button class="mt-[60px] w-[150px] h-[40px] rounded-[5px] bg-[#ffffff] text-[13px] text-[#333333]">logout</button></a>
      {{-- VERSION --}}
      <p class="text-[#ffffff] text-[13px] mt-[40px]">Versão: 1.3.3</p>
    </div>
    <!-- CONTAINER -->
    <div class="w-[80%] h-[100vh] bg-[#ffffff] float-left inline-block">
      <!--  -->
      <div class="w-[100%] h-[26vh]">
        <!-- TOPO -->
        <div class="w-[100%] p-[30px] bg-[#f1f1f1] inline-block">
          <!--  -->
          <div class="float-left inline-block w-[70%]">
            <!--  -->
            <img class="float-left w-[45px] mr-[20px]" src="/img/@yield('imagem')"><p class="font-bold float-left text-[30px] text-[#333333]">@yield('titulo')</p>
          </div>
          <!--  -->
          <div class="float-left inline-block w-[30%]">
            <!--  -->
            <div class="float-right inline-block">
              <!--  -->
              <p class="float-left mr-[15px] text-[16px] mt-[14px]">{{ session('admin')['nome'] }}</p>
              <!--  -->
              <div class="float-left w-[50px] h-[50px] rounded-[100px] bg-[silver]" style="background: url('/img/usuario.png'); background-size: 100%;"></div>
            </div>
          </div>
        </div>
        <!-- SUBTOPO -->
        <div class="w-[100%] py-[20px] mt-[-5px] border-b-[1px] px-[30px] bg-[#fafafa] inline-block">
          <!--  -->
          <div class="w-[50%] inline-block float-left">
            <!--  -->
            <img class="mt-[12px] w-[15px] float-left mr-[8px]" src="/img/informacoes.png"><p class="mt-[10px] float-left">@yield('descricao')</p>
          </div>
          <!--  -->
          <div class="w-[50%] inline-block float-left">
            <!--  -->
            <form action="" method="">
              <!--  -->
              <input class="w-[300px] pl-[15px] h-[40px] outline-none rounded-[5px] float-right border-[1px] bg-[#ffffff]" placeholder="buscar" type="text" name="">
            </form>
          </div>
        </div>
      </div>
      <!-- CONTEÚDO -->
      <div class="w-[100%] h-[74vh] px-[15px] py-[30px] overflow-scroll bg-[#ffffff]">
        @yield('content')
      </div>
    </div>
  </section>
</body>
</html>

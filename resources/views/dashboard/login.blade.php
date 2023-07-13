<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <section>
    <div class="w-[100%] bg-white inline-block">
      <div class="w-[100%] mx-auto my-[0px]">
        <div class="w-[100%] inline-block">
          <!-- IMAGEM DASHBOARD -->
          <div class="w-[60%] h-[100vh] float-left inline-block" style="background: url('/img/img1.png'); background-size: 200%; background-position: center;"></div>
          <!-- CAIXA LOGIN -->
          <div class="w-[40%] h-[100vh] bg-[#a35554] float-left inline-block">
            <div class="w-[450px] py-[40px] px-[40px] mt-[80px] border-[1px] rounded-[20px] bg-white mx-[auto] shadow-lg">
              <!-- LOGOMARCA -->
              <div class="w-[100%] inline-block">
                <img class="w-[150px] mx-[auto] my-[30px]" src="/img/Ativo 21.png" alt="Meu painel">
              </div>
              <!-- FORMULÁRIO -->
              <div class="w-[100%] inline-block">
                <form action="{{ route('log_adm') }}" method="POST">
                  @csrf
                  <table class="w-[100%]">
                    <!--  -->
                    <tr>
                      <td><input placeholder="E-mail" class="text-[12px] w-[100%] h-[45px] outline-none mb-[10px] mt-[5px] px-[15px] border-[#cdcdcd] border-[1px] bg-slate-50 rounded-[8px]" type="text" name="email"></td>
                    </tr>
                    <!--  -->
                    <tr>
                      <td><input placeholder="Senha" class="text-[12px] w-[100%] h-[45px] border-[#cdcdcd] outline-none mb-[10px] mt-[5px] px-[15px] border-[1px] bg-slate-50 rounded-[8px]" type="password" name="senha"></td>
                      <!-- HIDDEN -->
                      <?php $data_log = date('d/m/Y'); ?>
                      <input type="hidden" name="log" value="{{ $data_log }}">
                    </tr>
                    <!--  -->
                    <tr>
                      <td><input class="w-[100%] h-[45px] mb-[10px] mt-[5px] font-bold text-[12px] text-[#ffffff] shadow-lg rounded-[8px] bg-[#A35554] cursor-pointer" type="submit" value="Acessar painel"></td>
                    </tr>
                  </table>
                </form>
              </div>
              <!--  -->
              <div class="w-[100%] inline-block">
                <!--  -->
                <div class="w-[50%] float-left inline-block">
                  <!-- <a href=""><p class="text-[13px] text-gray-800">Esqueci minha senha</p></a> -->
                </div>
                <!--  -->
                <div class="w-[50%] float-left inline-block">
                  <!-- <a href=""><p class="float-right text-[13px] text-gray-800">Criar novo acesso</p></a> -->
                </div>
              </div>
            </div>
            <!-- EXIBIR ERROS DE VALIDAÇÃO -->
            @if($errors->any())
            <div class="w-[100%] mt-[30px]">
                <center>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-[9px] font-bold mb-[5px] text-[#ffffff]">{{ $error }}</li>
                        @endforeach
                    </ul>
                </center>
            </div>
            @endif
            <!-- EXIBIR ERROS DE ACESSO -->
            @if(isset($erro))
            <div class="w-[100%] mt-[30px]">
                <center>
                    <p class="text-[9px] font-bold mb-[5px] text-[#ffffff]">{{ $erro }}</p>
                </center>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
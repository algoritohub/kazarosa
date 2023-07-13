@php
    // RECUPERAR INFORMAÇÕS DO USUÁRIO
    $codigo  = $info_usuario;
    $usuario = Illuminate\Support\Facades\DB::select("SELECT * FROM usuarios WHERE stts = '$codigo'");
@endphp

<div style="width: 100%; display: inline-block;">
    <!--  -->
    <div style="width: 90%; margin: 0px 5% 0px 5%; display: inline-block;">
        <!--  -->
        <div style="width: 90%; padding: 40px 5% 40px 5%; margin-top: 50px; display: inline-block; border: solid 1px #cdcdcd; border-radius: 20px;">
            <center>
                <img style="width: 150px;" src="https://kazarosa.com/img/Ativo%2021.png">
                <!--  -->
                <p style="margin-top: 20px;font-weight: bold; font-size: 20px;">Olá {{ $usuario[0]->nome }}!</p>
                <!--  -->

                <p style="margin-top: 20px;">Você solicitou uma recuperação de acesso, Caso queira continuar, informe o código de verificação abaixo, no campo informado de sua tela de recupração, em seguida insira e confirme sua nova senha.</p>
                <div style="width: 90%; padding: 30px 5% 30px 5%; border-radius: 20px; border: solid #cdcdcd 1px;">
                    <!--  -->
                    <p style="font-weight: bold; color: #333333; font-size: 30px;">{{ $codigo }}</p>
                </div>
            </center>
        </div>
        <!--  -->
        <center>
            <p style="font-size: 10px; margin-top: 20px;">Todos os direitos reservados a Kaza Rosa &copy; 2022</p>
        </center>
    </div>
</div>

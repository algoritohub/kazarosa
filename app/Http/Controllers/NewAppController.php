<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Network;
use App\Models\Curtir;
use App\Models\Comentario;
use App\Models\Agendamento;
use App\Models\Clube;
use App\Models\Sala;
use App\Models\Plano;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailPaymentPlanBasic;
use App\Mail\EmailPaymentPlanVip;
use app\Mail\EmailPaymentPlanExecutive;
use App\Mail\EmailAutorizadPlan;
use App\Mail\EmailPaymentAppPlan;
use App\Models\ConexaoSeguir;
use File;

class NewAppController extends Controller
{
    public function NewCadastroApp(Request $request)
    {
        $new_email = trim($request->email);
        $new_senha = trim($request->senha);
        $cnf_senha = trim($request->conf_senha);

        // GERENCIAR SENHA
        if ($new_senha != $cnf_senha) {

            session()->flash('erro', 'As senhas não conferem!');
            return redirect()->route('app.cadastro.page');
        }

        $senha_cripto = Hash::make($new_senha);

        // VERIFICAR CADASTRADO
        $find = Usuario::where('email', $new_email)->first();

        if($find) {

            session()->flash('erro', 'O e-mail já foi cadastrado!');
            return redirect()->route('app.cadastro.page');
        }

        // GERAR UM NICKNAME
        $nome_usuario    = $request->nome;
        $explode_nome    = explode(" ", $nome_usuario);
        $count_nome      = count($explode_nome);
        $position_numb   = $count_nome - 1;
        $nome_resumo     = $explode_nome[0]." ".$explode_nome[$position_numb];

        $eliminar_espace = str_replace(' ', '', $nome_resumo);

        // ELIMINAR ALGUM TIPO DE ACENTUAÇÃO
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');

        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

        $sem_acent  = str_replace($comAcentos, $semAcentos, $eliminar_espace);
        $new_nick   = strtolower($sem_acent);

        // DEIXAR AS LETRAS MINÚSCULAS
        $todo_minusculas = strtolower($nome_resumo);

        // PRIMEIRA LETRA DE CADA NOME MAICULAS
        $nome_correto    = ucwords($todo_minusculas);

        $new_cadastro = new Usuario;
        $new_cadastro->nome       = $nome_correto;
        $new_cadastro->email      = $new_email;
        $new_cadastro->senha      = $senha_cripto;
        $new_cadastro->cidade     = "null";
        $new_cadastro->estado     = "null";
        $new_cadastro->bio        = "null";
        $new_cadastro->imagem     = "usuario.png";
        $new_cadastro->stts       = "ativo";
        $new_cadastro->nickname   = $new_nick;
        $new_cadastro->atuacao    = $request->atuacao;
        $new_cadastro->link       = $request->link;
        $new_cadastro->nascimento = $request->nascimento;
        $new_cadastro->tipo       = $request->tipo;
        $new_cadastro->telefone   = $request->telefone;

        $new_cadastro->save();

        return redirect()->route('app.login');
    }

    public function NewLogarApp(Request $request)
    {
        // VERIFICAR SE JÁ EXISTE UMA SESSÃO
        if(session()->has('tutor')){
            return redirect()->route('rota');
        }

        // VALIDAÇÕES
        // $request->validated();

        // verificação de usuário
        $email = trim($request->input('email'));
        $senha = trim($request->input('senha'));

        $user = Usuario::where('email', $email)->first();

        // verificar e-mail
        if(!$user)
        {
            session()->flash('erro', 'O usuário não existe!');
            return redirect()->route('app.login');
        }

        // verificar senha
        if(!Hash::check($senha, $user->senha))
        {
            session()->flash('erro', 'A senha está incorreta!');
            return redirect()->route('app.login');
        }

        // criar a sessão
        session()->put('usuario', $user);
        return redirect()->route('app.principal');
    }

    public function NewPostarApp(Request $request)
    {

        $id_user = session('usuario')['id'];

        $postagem = new Network;
        $postagem->usuario   = $id_user;
        $postagem->descricao = $request->descricao;
        $postagem->curtidas  = 0;
        $postagem->datas     = date('d/m/Y');

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {

            $requestImage = $request->imagem;
            $extension    = $requestImage->extension();
            $imageName    = md5($requestImage->getClientOriginalName()) . strtotime("now") . "." . $extension;
            $requestImage->move(public_path('img/feed'), $imageName);

            $postagem->postagem = $imageName;
        }

        $postagem->save();

        return back();
    }

    public function NewComentarioApp(Request $request, $id)
    {
        $comentario = new Comentario;
        $comentario->usuario    = session('usuario')['id'];
        $comentario->postagem   = $id;
        $comentario->comentario = $request->comentario;

        $comentario->save();

        return back();
    }

    public function NewCurtirApp($id)
    {
        $id_user = session('usuario')['id'];

        $curtir = new Curtir;
        $curtir->post    = $id;
        $curtir->usuario = $id_user;

        $verific_curtida = Curtir::where('usuario', $id_user)->where('post', $id)->first();

        if($verific_curtida){
            session()->flash('alert', 'Você já curtiu essa postagem!');
        }
        else{
            $curtir->save();
            session()->flash('alert', 'Você curtiu essa postagem!');
        }

        $postagem = Network::find($id);
        $user     = session('usuario');

        $comentar = Comentario::where('postagem', $id)->orderBy('id', 'DESC')->get();
        $numb_cmt = count($comentar);

        $curtidas = Curtir::where('post', $id)->where('usuario', $user->id)->get();
        $numb_crt = count($curtidas);

        return view('newapp.postagem_detalhe', compact('postagem', 'user', 'comentar', 'numb_crt', 'numb_cmt'));
    }

    // NOVO AGENDAMENTO PELO GUICHÊ
    public function NewAgendaApp(Request $request)
    {
        $agenda  = new Agendamento;
        $email   = session('usuario')['email'];
        $sala    = $request->sala;
        $tempo   = $request->tempo;
        $horario = $request->horario;
        $diat    = $request->dia;

        $new_data = explode('-', $diat);
        $dia      = "$new_data[2]/$new_data[1]/$new_data[0]";

        // VERIFICAR SE A USUARIAS JÁ EXISTE
        $verificar = Usuario::where('email', $email)->first();

        if($verificar){

            //   +----------------------------+
            //  / A USUÁRIA ESTÁ CADASTRADA  /
            // +----------------------------+

            // VERIFICAR SE ELA TEM UM PLANO ATIVO
            $ident_usuaria   = $verificar->id;
            $verificar_plano = DB::select("SELECT * FROM clubes WHERE id_user = '$ident_usuaria' AND stts = 'autorizado'");

            if ($verificar_plano) {

                //   +----------------------------+
                //  /    A USUÁRIA TEM PLANO     /
                // +----------------------------+

                // AGENDAMENTO COM DESCONTOS

                // VERIFICAR SE O PLANO JÁ EXCEDEU O TEMPO
                if ($verificar_plano[0]->dias <= 0) {

                    // MERGIAR EMAIL
                    $request->merge([ 'id_user' => $verificar->id ]);

                    return $this->noDiscount($request);
                }

                // VERIFCAR SE O TEMPO DE DESCONTO JÁ ACABOU
                if ($verificar_plano[0]->horas > 0) {

                    if ($sala == 9){

                        if ($tempo >= 4){

                            // VERIFICAR QUAL O PLANO DA CLIENTE
                            $number_plan = $verificar_plano[0]->plano;
                            $verplano    = DB::select("SELECT * FROM planos WHERE plano = '$number_plan'");

                            // VERIFICAR SE A SALA TEM DESCONTO DE HORAS
                            $salas_desconto_horas = $verplano[0]->salas_free;
                            $explode_horas_salas  = explode(',', $salas_desconto_horas);
                            $array_desconto_horas = $explode_horas_salas;
                            $quant_array_horas    = count($array_desconto_horas);

                            for ($i=0; $i < $quant_array_horas; $i++) {

                                if ($sala == $array_desconto_horas[$i]) {

                                    // CHECK IF THE ROOM HAS A MINIMUM SCHEDULE
                                    if($sala == 9 AND $tempo >= 4) {

                                        // MERGIAR EMAIL
                                        $request->merge([ 'id_user' => $verificar->id ]);

                                        return $this->discountHours($request);
                                    }
                                }
                            }
                        }
                    }

                    else{
                        // VERIFICAR QUAL O PLANO DA CLIENTE
                        $number_plan = $verificar_plano[0]->plano;
                        $verplano    = DB::select("SELECT * FROM planos WHERE plano = '$number_plan'");

                        // VERIFICAR SE A SALA TEM DESCONTO DE HORAS
                        $salas_desconto_horas = $verplano[0]->salas_free;
                        $explode_horas_salas  = explode(',', $salas_desconto_horas);
                        $array_desconto_horas = $explode_horas_salas;
                        $quant_array_horas    = count($array_desconto_horas);

                        for ($i=0; $i < $quant_array_horas; $i++) {

                            if ($sala == $array_desconto_horas[$i]) {

                                // CHECK IF THE ROOM HAS A MINIMUM SCHEDULE
                                if($sala == 9 AND $tempo >= 4) {

                                    // MERGIAR EMAIL
                                    $request->merge([ 'id_user' => $verificar->id ]);

                                    return $this->discountHours($request);
                                }
                            }
                        }
                    }
                }

                $number_plan = $verificar_plano[0]->plano;
                $verplano    = DB::select("SELECT * FROM planos WHERE plano = '$number_plan'");

                // CHECK IF THE ROOM HAS A VALUE DISCOUNT
                $room_discount_value  = $verplano[0]->salas_desconto;

                if ($room_discount_value == "all") {
                    dd('there is a discount on all rooms');
                    exit();
                }
                else{
                    $explode_hours_room   = explode(',', $room_discount_value);
                    $array_hours_discount = $explode_hours_room;
                    $quant_array_hours    = count($array_hours_discount);

                    for ($i=0; $i < $quant_array_hours; $i++) {

                        if ($sala == $array_hours_discount[$i]) {

                            // MERGIAR EMAIL
                            $request->merge([ 'id_user' => $verificar->id ]);

                            return $this->discountValue($request);
                        }
                    }

                    // MERGIAR EMAIL
                    $request->merge([ 'id_user' => $verificar->id ]);

                    return $this->noDiscount($request);
                }
            }
            else{

                //   +----------------------------+
                //  /  A USUÁRIA NÃO TEM PLANO   /
                // +----------------------------+

                // MERGIAR EMAIL
                $request->merge([ 'id_user' => $verificar->id ]);

                // AGENDAMENTO COM PREÇOS NORMAIS
                return $this->noDiscount($request);
            }
        }
    }

    public function noDiscount($request)
    {
        $id_user = $request->id_user;
        $sala    = $request->sala;
        $tempo   = $request->tempo;
        $horario = $request->horario;
        $diat    = $request->dia;

        $new_data = explode('-', $diat);
        $dia      = "$new_data[2]/$new_data[1]/$new_data[0]";

        // INFORMAÇÕES DA SALA
        $verificar_sala = Sala::where('id', $sala)->first();

        // VALORES MÍNIMOS DE 1 OU 3 HORAS
        if($tempo == 1 OR $tempo == 3){

            // VERIFICANDO O TEMPO MÍNIMO DA SALA
            if($verificar_sala->valor > 0){

                $valor_final = $tempo * $verificar_sala->valor;
            }

            else{

                $status   = "erro";
                $mensagem = "Não aceita o tempo informado!";

                // dd('Não aceita o tempo informado!');
                // exit();

                return view('newapp.app.reserva', compact('status', 'mensagem'));
            }
        }

        // VALORES DE DUAS HORAS
        elseif($tempo == 2){

            // VERIFICANDO O TEMPO DUAL DA SALA
            if($verificar_sala->dual > 0){

                $valor_final = $verificar_sala->dual;
            }

            else{

                $status   = "erro";
                $mensagem = "Não aceita o tempo de 2 horas!";

                // dd('Não aceita o tempo de 2 horas!');
                // exit();

                return view('newapp.app.reserva', compact('status', 'mensagem'));

                // return view('newapp.app.reserva', ['simulacao' => $agendamento, 'msn' => $mensagem]);
            }
        }

        // VALORES DE 4 HORAS
        elseif($tempo == 4){

            // VERIFICANDO O TEMPO TURNO DA SALA
            $valor_final = $verificar_sala->turno;
        }

        // VALORES DE 8 HORAS
        elseif($tempo == 8){

            // VERIFICANDO O TEMPO DIARIA DA SALA
            $valor_final = $verificar_sala->diaria;
        }

        $value_scheduling = $valor_final;

        //   +----------------------------+
        //  /     INICIAR AGENDAMENTO    /
        // +----------------------------+

        $finish_value   = $value_scheduling;
        $discount_value = $value_scheduling;

        // dd('value no discount', $finish_value, $discount_value);
        // exit();

        // VERIFICAR DIA
        $verificar_dia_hora = DB::select("SELECT * FROM agendamentos WHERE dia = '$dia' AND horario = '$horario' AND sala = '$sala'");

        if($verificar_dia_hora){

            $agendamento  = "verificar";
            $sala_retorno = $sala;
            $dia_retorno  = $dia;
            $hor_retorno  = $horario;

            $detalhe = "confirmado";

            $user = session('usuario');

            $detalhe = "confirmado";
            return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'sala_retorno', 'user'));
        }
        else{

            // VERIFICAR DISPONIBILIDADE ÚLTIMAS HORAS DA SALA
            $tempo_max = $tempo + 1;

            $verificar_sala_agenda = DB::select("SELECT * FROM agendamentos WHERE sala = '$sala' AND dia = '$dia'");

            if($verificar_sala_agenda){

                $hora_agendamento = $horario;
                $explode_horario  = explode(':', $hora_agendamento);
                $horas_quebrado   = intval($explode_horario[0]);
                $mints_quebrado   = $explode_horario[1];

                for ($i=1; $i < $tempo_max; $i++){

                    $loop_hora  = $horas_quebrado - $i;
                    $verif_zero = strlen($loop_hora);

                    // VERIFICAR SE O HORÁRIO É PRECEDIDO DE ZERO
                    if($verif_zero > 2){
                        $hora_antes = "0".$loop_hora.":".$mints_quebrado;
                    }
                    else{
                        $hora_antes = $loop_hora.":".$mints_quebrado;
                    }

                    $verificar_horas_antes = DB::select("SELECT * FROM agendamentos WHERE sala = '$sala' AND dia = '$dia' AND horario = '$hora_antes'");

                    if($verificar_horas_antes){

                        $agendamento  = "verificar";
                        $sala_retorno = $sala;
                        $dia_retorno  = $dia;
                        $hor_retorno  = $horario;

                        $detalhe = "confirmado";

                        $user = session('usuario');

                        $detalhe = "confirmado";
                        return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'sala_retorno', 'user'));
                    }
                }

                // VERIFICAR DISPONIBILIDADE PRÓXIMAS HORAS DA SALA
                for ($i=1; $i < $tempo_max; $i++){

                    $loop_hora  = $horas_quebrado + $i;
                    $verif_zero = strlen($loop_hora);

                    // VERIFICAR SE O HORÁRIO É PRECEDIDO DE ZERO
                    if($verif_zero > 2){
                        $hora_depois = "0".$loop_hora.":".$mints_quebrado;
                    }
                    else{
                        $hora_depois = $loop_hora.":".$mints_quebrado;
                    }

                    $verificar_horas_depois = DB::select("SELECT * FROM agendamentos WHERE sala = '$sala' AND dia = '$dia' AND horario = '$hora_depois'");

                    if($verificar_horas_depois){

                        $agendamento  = "verificar";
                        $sala_retorno = $sala;
                        $dia_retorno  = $dia;
                        $hor_retorno  = $horario;

                        $detalhe = "confirmado";

                        $user = session('usuario');

                        $detalhe = "confirmado";
                        return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'sala_retorno', 'user'));
                    }
                }

                $agenda = new Agendamento;

                $agenda->user     = $id_user;
                $agenda->sala     = $sala;
                $agenda->tempo    = $tempo;
                $agenda->horario  = $horario;
                $agenda->dia      = $dia;

                $codigo_agenda    = random_int(100000000, 999999999);
                $agenda->codigo   = $codigo_agenda;

                $agenda->stts     = "simulando";
                $agenda->valor    = $finish_value;
                $agenda->desconto = $discount_value;
                $agenda->tipo     = "null";

                $agenda->save();

                $agendamento = "disponivel";

                $detalhe = "confirmado";

                $user = session('usuario');

                $detalhe = "confirmado";
                return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'user', 'codigo_agenda', 'discount_value'));
            }
            else{

                $agenda = new Agendamento;

                $agenda->user     = $id_user;
                $agenda->sala     = $sala;
                $agenda->tempo    = $tempo;
                $agenda->horario  = $horario;
                $agenda->dia      = $dia;

                $codigo_agenda    = random_int(100000000, 999999999);
                $agenda->codigo   = $codigo_agenda;

                $agenda->stts     = "simulando";
                $agenda->valor    = $finish_value;
                $agenda->desconto = $discount_value;
                $agenda->tipo     = "null";

                $agenda->save();

                $agendamento = "disponivel";

                $detalhe = "confirmado";

                $user = session('usuario');

                $detalhe = "confirmado";
                return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'user', 'codigo_agenda', 'discount_value'));
            }
        }
    }

    public function discountHours($request)
    {
        $id_user = $request->id_user;
        $sala    = $request->sala;
        $tempo   = $request->tempo;
        $horario = $request->horario;
        $diat    = $request->dia;

        $new_data = explode('-', $diat);
        $dia      = "$new_data[2]/$new_data[1]/$new_data[0]";

        //   +----------------------------+
        //  /       DEFINIR VALOR        /
        // +----------------------------+

        // INFORMAÇÕES DA SALA
        $verificar_sala = Sala::where('id', $sala)->first();

        // VALORES MÍNIMOS DE 1 OU 3 HORAS
        if($tempo == 1 OR $tempo == 3){

            // VERIFICANDO O TEMPO MÍNIMO DA SALA
            if($verificar_sala->valor > 0){

                $valor_final  = $tempo * $verificar_sala->valor;
                $unique_hours = $verificar_sala->valor;
            }

            else{

                $status   = "erro";
                $mensagem = "Não aceita o tempo informado!";

                // dd('Não aceita o tempo informado!');
                // exit();

                return view('newapp.app.reserva', compact('status', 'mensagem'));
            }
        }

        // VALORES DE DUAS HORAS
        elseif($tempo == 2){

            // VERIFICANDO O TEMPO DUAL DA SALA
            if($verificar_sala->dual > 0){

                $valor_final  = $verificar_sala->dual;
                $unique_hours = $verificar_sala->valor / 2;
            }

            else{

                $status   = "erro";
                $mensagem = "Não aceita o tempo de 2 horas!";

                // dd('Não aceita o tempo de 2 horas!');
                // exit();
                return view('newapp.app.reserva', compact('status', 'mensagem'));
            }
        }

        // VALORES DE 4 HORAS
        elseif($tempo == 4){

            // VERIFICANDO O TEMPO TURNO DA SALA
            $valor_final  = $verificar_sala->turno;
            $unique_hours = $verificar_sala->valor / 4;
        }

        // VALORES DE 8 HORAS
        elseif($tempo == 8){

            // VERIFICANDO O TEMPO DIARIA DA SALA
            $valor_final  = $verificar_sala->diaria;
            $unique_hours = $verificar_sala->valor / 8;
        }

        $value_scheduling = $valor_final;

        //   +----------------------------+
        //  /      APLICAR DESCONTO      /
        // +----------------------------+

        $check_values_plan = DB::select("SELECT * FROM clubes WHERE id_user = '$id_user'");
        $check_number_plan = $check_values_plan[0]->plano;
        $check_hours_plan  = $check_values_plan[0]->horas;

        if ($check_hours_plan > $tempo) {

            // DEBIT AMOUNT OF HOURS
            $debit_hours = $check_hours_plan - $tempo;

            $debit_hours_club = Clube::find($check_values_plan->id);
            $debit_hours_club->update([
                'horas' => $debit_hours,
            ]);

            // NEW SCHEDULE VALUE
            $finish_value   = $value_scheduling;
            $discount_value = 0;
        }

        else{

            // NEW SCHEDULE VALUE
            $finish_value = $value_scheduling;

            // DEBIT AMOUNT OF HOURS
            $debit_hours = 0;

            $remaining_value = $tempo - $check_hours_plan;

            $debit_hours_club = Clube::find($check_values_plan->id);
            $debit_hours_club->update([
                'horas' => $debit_hours,
            ]);

            // CHECK ROOM VALUE
            $define_remaining_value = $remaining_value * $unique_hours;

            // NEW SCHEDULE VALUE
            $finish_value   = $value_scheduling;
            $discount_value = $define_remaining_value;
        }

        //   +----------------------------+
        //  /   VERIFICAR AGENDAMENTO    /
        // +----------------------------+

        // VERIFICAR DIA
        $verificar_dia_hora = DB::select("SELECT * FROM agendamentos WHERE dia = '$dia' AND horario = '$horario' AND sala = '$sala'");

        if($verificar_dia_hora){

            $agendamento  = "verificar";
            $sala_retorno = $sala;
            $dia_retorno  = $dia;
            $hor_retorno  = $horario;

            $detalhe = "confirmado";

            $user = session('usuario');

            $detalhe = "confirmado";
            return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'sala_retorno', 'user'));
        }
        else{

            // VERIFICAR DISPONIBILIDADE ÚLTIMAS HORAS DA SALA
            $tempo_max = $tempo + 1;

            $verificar_sala_agenda = DB::select("SELECT * FROM agendamentos WHERE sala = '$sala' AND dia = '$dia'");

            if($verificar_sala_agenda){

                $hora_agendamento = $horario;
                $explode_horario  = explode(':', $hora_agendamento);
                $horas_quebrado   = intval($explode_horario[0]);
                $mints_quebrado   = $explode_horario[1];

                for ($i=1; $i < $tempo_max; $i++){

                    $loop_hora  = $horas_quebrado - $i;
                    $verif_zero = strlen($loop_hora);

                    // VERIFICAR SE O HORÁRIO É PRECEDIDO DE ZERO
                    if($verif_zero > 2){
                        $hora_antes = "0".$loop_hora.":".$mints_quebrado;
                    }
                    else{
                        $hora_antes = $loop_hora.":".$mints_quebrado;
                    }

                    $verificar_horas_antes = DB::select("SELECT * FROM agendamentos WHERE sala = '$sala' AND dia = '$dia' AND horario = '$hora_antes'");

                    if($verificar_horas_antes){

                        $agendamento  = "verificar";
                        $sala_retorno = $sala;
                        $dia_retorno  = $dia;
                        $hor_retorno  = $horario;

                        $user = session('usuario');

                        $detalhe = "confirmado";
                        return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'sala_retorno', 'user'));
                    }
                }

                // VERIFICAR DISPONIBILIDADE PRÓXIMAS HORAS DA SALA
                for ($i=1; $i < $tempo_max; $i++){

                    $loop_hora  = $horas_quebrado + $i;
                    $verif_zero = strlen($loop_hora);

                    // VERIFICAR SE O HORÁRIO É PRECEDIDO DE ZERO
                    if($verif_zero > 2){
                        $hora_depois = "0".$loop_hora.":".$mints_quebrado;
                    }
                    else{
                        $hora_depois = $loop_hora.":".$mints_quebrado;
                    }

                    $verificar_horas_depois = DB::select("SELECT * FROM agendamentos WHERE sala = '$sala' AND dia = '$dia' AND horario = '$hora_depois'");

                    if($verificar_horas_depois){

                        $agendamento  = "verificar";
                        $sala_retorno = $sala;
                        $dia_retorno  = $dia;
                        $hor_retorno  = $horario;

                        $user = session('usuario');

                        $detalhe = "confirmado";
                        return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'sala_retorno', 'user'));
                    }
                }

                $agenda = new Agendamento;

                $agenda->user     = $id_user;
                $agenda->sala     = $sala;
                $agenda->tempo    = $tempo;
                $agenda->horario  = $horario;
                $agenda->dia      = $dia;

                $codigo_agenda    = random_int(100000000, 999999999);
                $agenda->codigo   = $codigo_agenda;

                $agenda->stts     = "simulando";
                $agenda->valor    = $finish_value;
                $agenda->desconto = $discount_value;
                $agenda->tipo     = "null";

                $agenda->save();

                $agendamento = "disponivel";

                $user = session('usuario');

                $detalhe = "confirmado";
                return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'codigo_agenda', 'discount_value', 'user'));
            }
            else{

                $agenda = new Agendamento;

                $agenda->user     = $id_user;
                $agenda->sala     = $sala;
                $agenda->tempo    = $tempo;
                $agenda->horario  = $horario;
                $agenda->dia      = $dia;

                $codigo_agenda    = random_int(100000000, 999999999);
                $agenda->codigo   = $codigo_agenda;

                $agenda->stts     = "simulando";
                $agenda->valor    = $finish_value;
                $agenda->desconto = $discount_value;
                $agenda->tipo     = "null";

                $agenda->save();

                $agendamento = "disponivel";

                $user = session('usuario');

                $detalhe = "confirmado";
                return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'codigo_agenda', 'discount_value', 'user'));
            }
        }
    }

    public function discountValue($request)
    {
        $id_user = $request->id_user;
        $sala    = $request->sala;
        $tempo   = $request->tempo;
        $horario = $request->horario;
        $diat    = $request->dia;

        $new_data = explode('-', $diat);
        $dia      = "$new_data[2]/$new_data[1]/$new_data[0]";

        // INFORMAÇÕES DA SALA
        $verificar_sala = Sala::where('id', $sala)->first();

        // VALORES MÍNIMOS DE 1 OU 3 HORAS
        if($tempo == 1 OR $tempo == 3){

            // VERIFICANDO O TEMPO MÍNIMO DA SALA
            if($verificar_sala->valor > 0){

                $valor_final  = $tempo * $verificar_sala->valor;
                $unique_hours = $verificar_sala->valor;
            }

            else{

                $agendamento = "erro";
                $mensagem    = "Não aceita o tempo informado!";

                return view('newapp.app.reserva', ['simulacao' => $agendamento, 'msn' => $mensagem]);
            }
        }

        // VALORES DE DUAS HORAS
        elseif($tempo == 2){

            // VERIFICANDO O TEMPO DUAL DA SALA
            if($verificar_sala->dual > 0){

                $valor_final  = $verificar_sala->dual;
                $unique_hours = $verificar_sala->valor / 2;
            }

            else{

                $agendamento = "erro";
                $mensagem    = "Não aceita o tempo de 2 horas!";

                return view('newapp.app.reserva', ['simulacao' => $agendamento, 'msn' => $mensagem]);
            }
        }

        // VALORES DE 4 HORAS
        elseif($tempo == 4){

            // VERIFICANDO O TEMPO TURNO DA SALA
            $valor_final  = $verificar_sala->turno;
            $unique_hours = $verificar_sala->valor / 4;
        }

        // VALORES DE 8 HORAS
        elseif($tempo == 8){

            // VERIFICANDO O TEMPO DIARIA DA SALA
            $valor_final  = $verificar_sala->diaria;
            $unique_hours = $verificar_sala->valor / 8;
        }

        $value_scheduling = $valor_final;

        //   +----------------------------+
        //  /      APLICAR DESCONTO      /
        // +----------------------------+

        $check_values_plan = DB::select("SELECT * FROM clubes WHERE id_user = '$id_user'");
        $check_number_plan = $check_values_plan[0]->plano;
        $check_discount    = $check_values_plan[0]->desconto;

        // NEW SCHEDULE VALUE
        $value_porcent     = $value_scheduling * $check_discount / 100;

        $finish_value      = $value_scheduling;
        $discount_value    = $finish_value - $value_porcent;

        // dd('discount value', $finish_value, $discount_value);
        // exit();

        //   +----------------------------+
        //  /   VERIFICAR AGENDAMENTO    /
        // +----------------------------+

        // VERIFICAR DIA
        $verificar_dia_hora = DB::select("SELECT * FROM agendamentos WHERE dia = '$dia' AND horario = '$horario' AND sala = '$sala'");

        if($verificar_dia_hora){

            $agendamento  = "verificar";
            $sala_retorno = $sala;
            $dia_retorno  = $dia;
            $hor_retorno  = $horario;

            $detalhe = "confirmado";

            $user = session('usuario');

            // dd('Confirmado!');
            // exit();
            return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'sala_retorno', 'user'));
        }
        else{

            // VERIFICAR DISPONIBILIDADE ÚLTIMAS HORAS DA SALA
            $tempo_max = $tempo + 1;

            $verificar_sala_agenda = DB::select("SELECT * FROM agendamentos WHERE sala = '$sala' AND dia = '$dia'");

            if($verificar_sala_agenda){

                $hora_agendamento = $horario;
                $explode_horario  = explode(':', $hora_agendamento);
                $horas_quebrado   = intval($explode_horario[0]);
                $mints_quebrado   = $explode_horario[1];

                for ($i=1; $i < $tempo_max; $i++){

                    $loop_hora  = $horas_quebrado - $i;
                    $verif_zero = strlen($loop_hora);

                    // VERIFICAR SE O HORÁRIO É PRECEDIDO DE ZERO
                    if($verif_zero > 2){
                        $hora_antes = "0".$loop_hora.":".$mints_quebrado;
                    }
                    else{
                        $hora_antes = $loop_hora.":".$mints_quebrado;
                    }

                    $verificar_horas_antes = DB::select("SELECT * FROM agendamentos WHERE sala = '$sala' AND dia = '$dia' AND horario = '$hora_antes'");

                    if($verificar_horas_antes){

                        $agendamento  = "verificar";
                        $sala_retorno = $sala;
                        $dia_retorno  = $dia;
                        $hor_retorno  = $horario;

                        $detalhe = "confirmado";

                        $user = session('usuario');

                        // dd('Confirmado!');
                        // exit();
                        return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'sala_retorno', 'user'));
                    }
                }

                // VERIFICAR DISPONIBILIDADE PRÓXIMAS HORAS DA SALA
                for ($i=1; $i < $tempo_max; $i++){

                    $loop_hora  = $horas_quebrado + $i;
                    $verif_zero = strlen($loop_hora);

                    // VERIFICAR SE O HORÁRIO É PRECEDIDO DE ZERO
                    if($verif_zero > 2){
                        $hora_depois = "0".$loop_hora.":".$mints_quebrado;
                    }
                    else{
                        $hora_depois = $loop_hora.":".$mints_quebrado;
                    }

                    $verificar_horas_depois = DB::select("SELECT * FROM agendamentos WHERE sala = '$sala' AND dia = '$dia' AND horario = '$hora_depois'");

                    if($verificar_horas_depois){

                        $agendamento  = "verificar";
                        $sala_retorno = $sala;
                        $dia_retorno  = $dia;
                        $hor_retorno  = $horario;

                        $detalhe = "confirmado";

                        $user = session('usuario');

                        // dd('Confirmado!');
                        // exit();
                        return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'sala_retorno', 'user'));
                    }
                }

                $agenda = new Agendamento;

                $agenda->user     = $id_user;
                $agenda->sala     = $sala;
                $agenda->tempo    = $tempo;
                $agenda->horario  = $horario;
                $agenda->dia      = $dia;

                $codigo_agenda    = random_int(100000000, 999999999);
                $agenda->codigo   = $codigo_agenda;

                $agenda->stts     = "simulando";
                $agenda->valor    = $finish_value;
                $agenda->desconto = $discount_value;
                $agenda->tipo     = "null";

                $agenda->save();

                $agendamento = "disponivel";

                $detalhe = "confirmado";

                $user = session('usuario');

                // dd('Confirmado!');
                // exit();
                return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'codigo_agenda', 'discount_value', 'user'));
            }
            else{

                $agenda = new Agendamento;

                $agenda->user     = $id_user;
                $agenda->sala     = $sala;
                $agenda->tempo    = $tempo;
                $agenda->horario  = $horario;
                $agenda->dia      = $dia;

                $codigo_agenda    = random_int(100000000, 999999999);
                $agenda->codigo   = $codigo_agenda;

                $agenda->stts     = "simulando";
                $agenda->valor    = $finish_value;
                $agenda->desconto = $discount_value;
                $agenda->tipo     = "null";

                $agenda->save();

                $agendamento = "disponivel";

                $detalhe = "confirmado";

                $user = session('usuario');

                // dd('Confirmado!');
                // exit();
                return view('newapp.reserva_detalhe', compact('detalhe', 'agendamento', 'codigo_agenda', 'discount_value', 'user'));
            }
        }
    }

    public function NewConfirmarApp($id)
    {
        $status = Agendamento::find($id);
        $status->update([
            'stts' => 'pagamento',
        ]);

        return redirect()->route('app.agendamento');
    }

    public function NewCancelaApp($id)
    {
        Agendamento::findOrFail($id)->delete();

        return redirect()->route('app.principal');
    }

    public function NewFiltraraApp(Request $request)
    {
        $diat     = $request->dia;
        $new_data = explode('-', $diat);
        $dia      = "$new_data[2]/$new_data[1]/$new_data[0]";

        $user     = session('usuario');
        $filtro   = Agendamento::where('dia', $dia)->orderBy('dia', 'ASC')->get();

        return view('newapp.agendamentos', compact('user', 'filtro'));
    }

    // CRIAR PLANO VIA APP
    public function PlanoConfirmaApp($id)
    {
        // localizar usuário pelo e-mail
        $user_id   = session('usuario')['id'];
        $user_mail = session('usuario')['email'];

        // CRIA PLANO
        $plan = new Clube;
        $plan->id_user = $user_id;
        $plan->plano   = $id;
        $plancode      = random_int(100000000, 999999999);

        // PLANO BÁSICO
        if ($id == 1) {
            $plan->desconto = 10;
            $plan->horas    = 12;
            $plan->turno    = 0;

            $plan->stts     = "pagamento";
            $plan->inicio   = date('d/m/Y');
            $plan->dias     = 30;
            $plan->codigo   = $plancode;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO (ALTERAR MAIL PARA RECEBER ID)
            Mail::to($user_mail)->send(new EmailPaymentAppPlan($user_id));
        }

        if ($id == 2) {
            $plan->desconto = 10;
            $plan->horas    = 12;
            $plan->turno    = 0;

            $plan->stts     = "pagamento";
            $plan->inicio   = date('d/m/Y');
            $plan->dias     = 30;
            $plan->codigo   = $plancode;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO
            Mail::to($user_mail)->send(new EmailPaymentAppPlan($user_id));
        }

        if ($id == 4) {
            $plan->desconto = 10;
            $plan->horas    = 16;
            $plan->turno    = 0;

            $plan->stts     = "pagamento";
            $plan->inicio   = date('d/m/Y');
            $plan->dias     = 30;
            $plan->codigo   = $plancode;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO
            Mail::to($user_mail)->send(new EmailPaymentAppPlan($user_id));
        }

        if ($id == 3) {
            $plan->desconto = 20;
            $plan->horas    = 16;
            $plan->turno    = 0;

            $plan->stts     = "pagamento";
            $plan->inicio   = date('d/m/Y');
            $plan->dias     = 30;
            $plan->codigo   = $plancode;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO
            Mail::to($user_mail)->send(new EmailPaymentAppPlan($user_id));
        }

        $user  = session('usuario');
        $plano = Plano::where('plano', $id)->first();
        $valor = number_format($plano->valor,2,",",".");

        return view('newapp.confirma_plano', compact('user', 'plano', 'valor'));
    }

    public function CancelarPlano(Request $request)
    {
        $user  = session('usuario');
        $plano = Clube::where('id_user', $user->id)->first();

        if(Hash::check($request->senha, $user->senha))
        {
            Clube::findOrfail($plano->id)->delete();
        }

        return redirect()->route('app.principal');
    }

    public function SeguirNewUser($id)
    {
        $user   = session('usuario');
        $seguir = new ConexaoSeguir;

        $seguir->seguidor = $user->id;
        $seguir->usuario  = $id;
        $seguir->stts     = "ativo";

        $seguir->save();

        return back();
    }

    public function DeixarSeguirUser($id)
    {
        ConexaoSeguir::findOrFail($id)->delete();

        return back();
    }

    public function ExcluirPost($id)
    {
        Network::findOrFail($id)->delete();

        return redirect()->route('app.feed');
    }

    // VERIFICADO
    public function AlterarEmail(Request $request)
    {
        $user  = session('usuario');
        $email = Usuario::findOrFail($user->id);

        if(Hash::check($request->senha, $user->senha))
        {
            $email->update([
                'email' => $request->email,
            ]);
        }

        session()->forget('usuario');
        return redirect()->route('app.login');
    }

    // VERIFICADO
    public function AlterarSenha(Request $request)
    {

        $user  = session('usuario');
        $senha = Usuario::findOrFail($user->id);

        if(Hash::check($request->senha, $user->senha))
        {
            if($request->senha_nova === $request->conf_senha){

                $senha_cripto = Hash::make($request->senha_nova);

                $senha->update([
                    'senha' => $senha_cripto,
                ]);
            }
        }

        session()->forget('usuario');
        return redirect()->route('app.login');
    }

    // NO OK
    public function AlterarImagem(Request $request)
    {
        $user  = session('usuario');
        $image = Usuario::findOrFail($user->id);

        if(Hash::check($request->senha, $user->senha))
        {
            if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {

                // File::delete('img/usuario/'.$user->imagem);
                dd('sou uma imagem');
                exit();

                $requestImage = $request->imagem;
                $extension    = $requestImage->extension();
                $imageName    = md5($requestImage->getClientOriginalName()) . strtotime("now") . "." . $extension;
                $requestImage->move(public_path('img/usuario'), $imageName);

                $image->update([
                    'imagem' => $imageName,
                ]);
            }
        }

        return back();
    }

    public function AlterarNomePerfil(Request $request)
    {
        $user = session('usuario');
        $nome = Usuario::findOrFail($user->id);

        if(Hash::check($request->senha, $user->senha))
        {
            $nome->update([
                'nome' => $request->nome,
            ]);
        }

        return back();
    }

    public function AlterarNomeUsuario(Request $request)
    {
        $user = session('usuario');
        $nick = Usuario::findOrFail($user->id);

        if(Hash::check($request->senha, $user->senha))
        {
            $nick->update([
                'nickname' => $request->nickname,
            ]);
        }

        return back();
    }

    public function AddBioApp(Request $request)
    {
        $user = session('usuario');
        $bio  = Usuario::findOrFail($user->id);

        $bio->update([
            'bio' => $request->bio,
        ]);

        return back();
    }

    public function AlterarBioApp(Request $request)
    {
        $user = session('usuario');
        $bio  = Usuario::findOrFail($user->id);

        if(Hash::check($request->senha, $user->senha))
        {
            $bio->update([
                'bio' => $request->bio,
            ]);
        }

        return back();
    }

    public function DeleteContaApp(Request $request)
    {
        $user   = session('usuario');

        $agenda = Agendamento::where('user', $user->id)->get();
        $clube  = Clube::where('id_user', $user->id)->first();
        $coment = Comentario::where('usuario', $user->id)->get();
        $sguind = ConexaoSeguir::where('seguidor', $user->id)->get();
        $sguidr = ConexaoSeguir::where('usuario', $user->id)->get();
        $curtds = Curtir::where('usuario', $user->id)->get();
        $posts  = Network::where('usuario', $user->id)->get();
        $conta  = Usuario::where('id', $user->id)->first();

        if(Hash::check($request->senha, $user->senha))
        {
            if($agenda){
                foreach($agenda as $agendamento){
                    Agendamento::findOrFail($agendamento->id)->delete();
                }
            }

            if($clube){
                Clube::findOrFail($clube->id)->delete();
            }

            if($coment){
                foreach($coment as $comentarios){
                    Comentario::findOrFail($comentarios->id)->delete();
                }
            }

            if($sguind){
                foreach($sguind as $seguindo){
                    ConexaoSeguir::findOrFail($seguindo->id)->delete();
                }
            }

            if($sguidr){
                foreach($sguidr as $seguidores){
                    ConexaoSeguir::findOrFail($seguidores->id)->delete();
                }
            }

            if($curtds){
                foreach($curtds as $curtidas){
                    Curtir::findOrFail($curtidas->id)->delete();
                }
            }

            if($posts){
                foreach($posts as $postagens){
                    Network::findOrFail($postagens->id)->delete();
                }
            }

            Usuario::findOrFail($conta->id)->delete();
        }

        session()->forget('usuario');
        return redirect()->route('app.login');
    }

    public function LogoutContaApp()
    {
        session()->forget('usuario');
        return redirect()->route('app.login');
    }
}

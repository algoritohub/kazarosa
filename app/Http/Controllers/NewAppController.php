<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Network;
use App\Models\Curtir;
use App\Models\Comentario;
use Illuminate\Support\Facades\Hash;

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
        $new_cadastro->imagem     = "imagem.png";
        $new_cadastro->stts       = "ativo";
        $new_cadastro->nickname   = $new_nick;
        $new_cadastro->atuacao    = $request->atuacao;
        $new_cadastro->link       = $request->link;
        $new_cadastro->nascimento = $request->nascimento;
        $new_cadastro->tipo       = $request->tipo;
        $new_cadastro->telefone   = $request->telefone;

        $new_cadastro->save();

        dd('cadastrado!');
        exit();
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

        dd('postado');
        exit();
    }

    public function NewComentarioApp(Request $request, $id)
    {
        $comentario = new Comentario;
        $comentario->usuario    = session('usuario')['id'];
        $comentario->postagem   = $id;
        $comentario->comentario = $request->comentario;

        $comentario->save();

        dd('comentado');
        exit();
    }

    public function NewCurtirApp($id)
    {
        $id_user = session('usuario')['id'];

        $curtir = new Curtir;
        $curtir->post    = $id;
        $curtir->usuario = $id_user;

        $curtir->save();

        session()->flash('alert', 'Você curtiu essa postagem!');

        dd('curtit');
        exit();
    }

    // NOVO AGENDAMENTO PELO GUICHÊ
    public function NewAgendaApp(Request $request)
    {
        $agenda = new Agendamento;

        $id_assoc   = session('usuario')['id'];
        $email      = $request->email;
        $sala       = $request->sala;
        $tempo      = $request->tempo;
        $horario    = $request->horario;
        $dia        = $request->dia;

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
        $dia     = $request->dia;

        // INFORMAÇÕES DA SALA
        $verificar_sala = Sala::where('id', $sala)->first();

        // VALORES MÍNIMOS DE 1 OU 3 HORAS
        if($tempo == 1 OR $tempo == 3){

            // VERIFICANDO O TEMPO MÍNIMO DA SALA
            if($verificar_sala->valor > 0){

                $valor_final = $tempo * $verificar_sala->valor;
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

                $valor_final = $verificar_sala->dual;
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
            return view('newapp.reserva_detalhe', compact('detalhe'));
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
                        return view('newapp.reserva_detalhe', compact('detalhe'));
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
                        return view('newapp.reserva_detalhe', compact('detalhe'));
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
                return view('newapp.reserva_detalhe', compact('detalhe'));
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
                return view('newapp.reserva_detalhe', compact('detalhe'));
            }
        }
    }

    public function discountHours($request)
    {
        $id_user = $request->id_user;
        $sala    = $request->sala;
        $tempo   = $request->tempo;
        $horario = $request->horario;
        $dia     = $request->dia;

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

        // dd('discount hours', $finish_value, $discount_value);
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
            return view('newapp.reserva_detalhe', compact('detalhe'));
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
                        return view('newapp.reserva_detalhe', compact('detalhe'));
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
                        return view('newapp.reserva_detalhe', compact('detalhe'));
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
                return view('newapp.reserva_detalhe', compact('detalhe'));
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
                return view('newapp.reserva_detalhe', compact('detalhe'));
            }
        }
    }

    public function discountValue($request)
    {
        $id_user = $request->id_user;
        $sala    = $request->sala;
        $tempo   = $request->tempo;
        $horario = $request->horario;
        $dia     = $request->dia;

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
            return view('newapp.reserva_detalhe', compact('detalhe'));
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
                        return view('newapp.reserva_detalhe', compact('detalhe'));
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
                        return view('newapp.reserva_detalhe', compact('detalhe'));
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
                return view('newapp.reserva_detalhe', compact('detalhe'));
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
                return view('newapp.reserva_detalhe', compact('detalhe'));
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Agendamento;
use App\Models\Usuario;
use App\Models\Avalia;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailAgendamentoManual;
use App\Models\Clube;
use App\Models\Sala;
use App\Models\LogFinanceiro;
use Illuminate\Support\Facades\DB;

class AgendamentoController extends Controller
{
    // EXIBIR AGENDAMENTO NO DASHBOARD
    public function agendamento_adm()
    {
        if(session()->has('admin')){

            return view('dashboard.agenda');
        }
        else{
            return redirect()->route('login_adm');
        }
    }

    // CRIAR CONEXÃO DE AGENDAMENTO
    public function agendar(Request $request)
    {
        $agenda = new Agendamento;

        $id = session('usuario')['id'];

        // RESGATE DE VALOR
        $log_tempo = $request->tempo;
        $log_sala = $request->sala;

        // RESGATAR INFORMAÇÕES DA SALA
        $sql_espaco = DB::select("SELECT * FROM salas WHERE id = '$log_sala'");

        // RESGATE DO VALOR
        if ($log_tempo == 1) {
            $valor = $sql_espaco[0]->valor;
        }
        if ($log_tempo == 2) {
            $valor = $sql_espaco[0]->dual;
        }
        if ($log_tempo == 4) {
            $valor = $sql_espaco[0]->turno;
        }
        if ($log_tempo == 8) {
            $valor = $sql_espaco[0]->diaria;
        }

        // VERIFICAÇÃO DE PLANO
        $sql_plan = DB::select("SELECT * FROM clubes WHERE id_user = '$id'");

        if($sql_plan) {

            $plano_atual = $sql_plan[0]->plano;
            $plano_horas = $sql_plan[0]->horas;

            // PLANO BÁSICO
            if ($plano_atual == 1) {
                // ESTAÇÃO COMPARTILHADA
                if($log_sala == 5){

                    if($plano_horas >= $log_tempo){
                        // CONSUMO TOTAL
                        $valor_finl = 0;
                        $tipo_vantagem = "horas";
                    }
                    elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                        // DECREMENTO DE TEMPO
                        $decr_tempo = $log_tempo - $plano_horas;

                        // VERIFICAR VALOR DE SUBTRAÇÃO
                        if($decr_tempo == 0){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($decr_tempo > 0){
                            // DEDUÇÃO DE PREÇO
                            $deducao = $valor / $log_tempo * $decr_tempo;
                            $valor_finl = $deducao;
                            $tipo_vantagem = "horas";
                        }
                    }
                    // TODAS AS SALAS
                    else{
                        $valor_finl = $valor;
                        $tipo_vantagem = "null";
                    }
                }
                // PARA SALAS PRIVATIVA E EXECUTIVA 10%
                elseif($log_sala == 9 OR $log_sala == 10){
                    // APLICAÇÃO DE DESCONTO DE 10%
                    $valor_porc = $valor * 10 / 100;
                    $valor_desc = $valor - $valor_porc;
                    // VALOR FINAL COM DESCONTO
                    $valor_finl = $valor_desc;
                    $tipo_vantagem = "valor";
                }
                // TODAS AS SALAS
                else{
                    $valor_finl = $valor;
                    $tipo_vantagem = "null";
                }
            }
            // PLANO VIP
            if ($plano_atual == 2) {
                // ESTAÇÃO PRIVADAS POR ID
                if($log_sala == 8){

                    if($plano_horas >= $log_tempo){
                        // CONSUMO TOTAL
                        $valor_finl = 0;
                        $tipo_vantagem = "horas";
                    }
                    elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                        // DECREMENTO DE TEMPO
                        $decr_tempo = $log_tempo - $plano_horas;

                        // VERIFICAR VALOR DE SUBTRAÇÃO
                        if($decr_tempo == 0){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($decr_tempo > 0){
                            // DEDUÇÃO DE PREÇO
                            $deducao = $valor / $log_tempo * $decr_tempo;
                            $valor_finl = $deducao;
                            $tipo_vantagem = "horas";
                        }
                    }
                    // TODAS AS SALAS
                    else{
                        $valor_finl = $valor;
                        $tipo_vantagem = "null";
                    }

                }
                // PENTEADEIRA LUXO
                elseif($log_sala == 11){

                    if($plano_horas >= $log_tempo){
                        // CONSUMO TOTAL
                        $valor_finl = 0;
                        $tipo_vantagem = "horas";
                    }
                    elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                        // DECREMENTO DE TEMPO
                        $decr_tempo = $log_tempo - $plano_horas;

                        // VERIFICAR VALOR DE SUBTRAÇÃO
                        if($decr_tempo == 0){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($decr_tempo > 0){
                            // DEDUÇÃO DE PREÇO
                            $deducao = $valor / $log_tempo * $decr_tempo;
                            $valor_finl = $deducao;
                            $tipo_vantagem = "horas";
                        }
                    }
                    // TODAS AS SALAS
                    else{
                        $valor_finl = $valor;
                        $tipo_vantagem = "null";
                    }
                }
                // PARA SALAS PRIVATIVA E EXECUTIVA 10%
                elseif($log_sala == 9 OR $log_sala == 10){
                    // APLICAÇÃO DE DESCONTO DE 10%
                    $valor_porc = $valor * 10 / 100;
                    $valor_desc = $valor - $valor_porc;
                    // VALOR FINAL COM DESCONTO
                    $valor_finl = $valor_desc;
                    $tipo_vantagem = "valor";
                }
                // TODAS AS SALAS
                else{
                    $valor_finl = $valor;
                    $tipo_vantagem = "null";
                }
            }
            // PLANO PRIVADO
            if ($plano_atual == 4) {
                // SALA PRIVATIVA
                if($log_sala == 9){

                    // VERIFICAR O MÍNIMO DE RESERVA 4/8
                    if ($log_tempo == 4 OR $log_tempo == 8) {

                        if($plano_horas >= $log_tempo){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                            // DECREMENTO DE TEMPO
                            $decr_tempo = $log_tempo - $plano_horas;

                            // VERIFICAR VALOR DE SUBTRAÇÃO
                            if($decr_tempo == 0){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($decr_tempo > 0){
                                // DEDUÇÃO DE PREÇO
                                $deducao = $valor / $log_tempo * $decr_tempo;
                                $valor_finl = $deducao;
                                $tipo_vantagem = "horas";
                            }
                        }
                        // TODAS AS SALAS
                        else{
                            $valor_finl = $valor;
                            $tipo_vantagem = "null";
                        }
                    }
                    // TODAS AS SALAS
                    else{
                        $valor_finl = $valor;
                        $tipo_vantagem = "null";
                    }
                }
                // PARA SALAS PRIVATIVA E EXECUTIVA 10%
                elseif($log_sala == 10){
                    // APLICAÇÃO DE DESCONTO DE 10%
                    $valor_porc = $valor * 10 / 100;
                    $valor_desc = $valor - $valor_porc;
                    // VALOR FINAL COM DESCONTO
                    $valor_finl = $valor_desc;
                    $tipo_vantagem = "valor";
                }
                // TODAS AS SALAS
                else{
                    $valor_finl = $valor;
                    $tipo_vantagem = "null";
                }
            }
            // PLANO EXECUTIVO
            if ($plano_atual == 3) {
                // SALA PRIVATIVA
                if($log_sala == 9){

                    // VERIFICAR O MÍNIMO DE RESERVA 4/8
                    if ($log_tempo == 4 OR $log_tempo == 8) {

                        if($plano_horas >= $log_tempo){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                            // DECREMENTO DE TEMPO
                            $decr_tempo = $log_tempo - $plano_horas;

                            // VERIFICAR VALOR DE SUBTRAÇÃO
                            if($decr_tempo == 0){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($decr_tempo > 0){
                                // DEDUÇÃO DE PREÇO
                                $deducao = $valor / $log_tempo * $decr_tempo;
                                $valor_finl = $deducao;
                                $tipo_vantagem = "horas";
                            }
                        }
                        // CASO O MÍNIMO NÃO SEJA ACEITO
                        elseif($plano_horas == 0){
                            // APLICAÇÃO DE DESCONTO DE 20%
                            $valor_porc = $valor * 20 / 100;
                            $valor_desc = $valor - $valor_porc;
                            // VALOR FINAL COM DESCONTO
                            $valor_finl = $valor_desc;
                            $tipo_vantagem = "valor";
                        }
                    }
                    // CASO O MÍNIMO NÃO SEJA ACEITO
                    else{
                        // APLICAÇÃO DE DESCONTO DE 20%
                        $valor_porc = $valor * 20 / 100;
                        $valor_desc = $valor - $valor_porc;
                        // VALOR FINAL COM DESCONTO
                        $valor_finl = $valor_desc;
                        $tipo_vantagem = "valor";
                    }
                }
                // CASO O MÍNIMO NÃO SEJA ACEITO
                else{
                    // APLICAÇÃO DE DESCONTO DE 20%
                    $valor_porc = $valor * 20 / 100;
                    $valor_desc = $valor - $valor_porc;
                    // VALOR FINAL COM DESCONTO
                    $valor_finl = $valor_desc;
                    $tipo_vantagem = "valor";
                }
            }
        }
        else{
            // VALOR SEM DESCONTO
            $valor_finl = $valor;
            $tipo_vantagem = "null";
        }

        $agenda->user = $id;
        $agenda->sala = $request->sala;
        $agenda->tempo = $request->tempo;
        $agenda->horario = $request->horario;
        $agenda->dia = $request->dia;
        $codigo_agenda = random_int(100000000, 999999999);
        $agenda->codigo = $codigo_agenda;
        $agenda->stts = "simulando";
        $agenda->valor = $valor;
        $agenda->desconto = $valor_finl;
        $agenda->tipo = $tipo_vantagem;

        $code = $agenda->codigo;
        $agenda->save();

        // CRIAR UMA SESSÃO DE AGENDAMENTO TEMPORÁRIO
        session()->put('agendamento', $code);

        // REDIRECIONAR PARA DETALHE DE AGENDAMENTO
        return redirect()->route('agenda_detalhe');
    }

    // CANCELAR AGENDAMENTO
    public function cancelar($id)
    {
        // RECUPERAR TEMPO EXTRA USADO
        $agendado = Agendamento::where('id', $id)->first();

        $logfinanca = DB::select("SELECT * FROM log_financeiros WHERE codigo = '$agendado->codigo'");
        $contador = count($logfinanca);

        if($contador > 0){
            $id_log = $logfinanca[0]->id;
            LogFinanceiro::findOrFail($id_log)->delete();
        }

        session()->forget('agendamento');

        Agendamento::findOrFail($id)->delete();

        return redirect()->route('principal');
    }


    // CONFIRMAR AGENDAMENTO
    public function confirmar($id)
    {
        // DECREMENTAR TEMPO DE CLUBE DE VANTAGENS SE HOUVER
        $ver_agen = DB::select("SELECT * FROM agendamentos WHERE id = '$id' AND stts = 'simulando'");
        $usuario_master = $ver_agen[0]->user;

        // RESGATE DE PLANO
        $ver_plan = DB::select("SELECT * FROM clubes WHERE id_user = '$usuario_master'");

        if($ver_plan){
            // VARIÁVEIS
            $var_tempo = $ver_agen[0]->tempo;
            $var_horas = $ver_plan[0]->horas;

            $clubs = Clube::findOrFail($ver_plan[0]->id);

            if ($ver_agen[0]->tipo == "horas") {

                if ($var_horas > 0) {

                    if($var_tempo > $var_horas){

                        $clubs->update([
                            'horas' => 0,
                        ]);
                    }

                    else{

                        $clubs->update([
                            'horas' => $var_horas - $var_tempo,
                        ]);
                    }
                }
            }
        }

        $agendamento = Agendamento::findOrFail($id);

        $agendamento->update([
            'stts' => 'pagamento',
        ]);

        $ver_agen = DB::select("SELECT * FROM agendamentos WHERE id = '$id'");

        // LOG DE REGISTRO FINANCEIRO
        $log = new LogFinanceiro;
        $log->codigo = $ver_agen[0]->codigo;
        $log->tipo = "agendamento";
        $log->data = date('d/m/Y');
        $log->valor = $ver_agen[0]->valor;
        $log->vantagem = $ver_agen[0]->desconto;
        $log->stts = "pagamento";
        $log->mes = date('m');

        $log->save();

        session()->forget('agendamento');

        // problema no redirecionamento
        return view('agenda');
    }

    // LISTA DE AGENDAMENTOS
    public function lista()
    {
        if(session()->has('usuario')){

            return view('agenda');
        }
        else{
            return redirect()->route('login');
        }
    }

    // COMPROVANTE DE AGENDAMENTO
    public function comprovante($id)
    {
        if(session()->has('usuario')){

            $agenda = Agendamento::where('id', $id)->first();

            return view('comprovante', ['agenda' => $agenda]);
        }
        else{
            return redirect()->route('login_adm');
        }
    }

    // INFORMAÇÕES
    public function informacoes($id)
    {
        return view('dashboard.agenda', ['info' => $id]);
    }

    // LIBERAR AGENDAMENTO
    public function liberar($id)
    {
        $agenda = Agendamento::findOrFail($id);

        $verificar = Agendamento::where('id', $id)->first();

        // +---------------------------------------------------------------------------------+
        // | ATUALIZAÇÃO DE STATUS DE LOG FINANCEIRO                                         |
        // +---------------------------------------------------------------------------------+

        $code_log = $verificar->codigo;

        $log_financ = DB::select("SELECT * FROM log_financeiros WHERE codigo = '$code_log'");

        if($log_financ){

            $id_log = $log_financ[0]->id;

            $altlog = LogFinanceiro::findOrFail($id_log);
            $altlog->update([
                'stts' => 'pago',
            ]);
        }

        if($verificar){

            $hora = $verificar->horario;
            $tempo = $verificar->tempo;

            $tempox = explode(":", $hora);
            $horas = $tempox[0];
            $minut = $tempox[1];

            $hor_var = intval($horas);
            $min_var = intval($minut);

            $hor_max = $hor_var + $tempo;

            $hora_sair = $hor_max.":".$min_var."Hr";
        }

        $agenda->update([
            'stts' => $hora_sair,
        ]);

        return redirect()->route('agendamento');
    }

    public function encerrar($id)
    {
        $agenda = Agendamento::findOrFail($id);

        $agenda->update([
            'stts' => 'avaliar',
        ]);

        return redirect()->route('agendamento');
    }

    public function avaliar(Request $request, $id)
    {
        $avaliar = new Avalia;
        $avaliar->estrela = $request->estrela;
        $avaliar->avaliacao = $request->avaliacao;
        $avaliar->espaco = $request->espaco;
        $avaliar->usuario = $request->usuario;

        $avaliar->save();

        $agenda = Agendamento::findOrFail($id);

        $agenda->update([
            'stts' => 'encerrado',
        ]);

        return redirect()->route('agenda_lista');
    }

    // AGENDAMENTO EXPRESSO
    public function NewAgendamentoExpresso(Request $request)
    {
        $agenda = new Agendamento;

        $cliente = $request->cliente;

        $resgate_cliente = Usuario::where('email', $cliente)->first();

        $nome       = $resgate_cliente->nome;
        $email      = $resgate_cliente->email;
        @$atuacao   = $resgate_cliente->atuacao;
        $nascimento = $resgate_cliente->nascimento;

        $sala       = $request->sala;
        $tempo      = $request->tempo;
        $horario    = $request->horario;
        $dia        = $request->dia;

        // VERIFICAR PREÇO
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'msn' => $mensagem]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'msn' => $mensagem]);
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

        // AGENDAR
        $agenda->user     = $resgate_cliente->id;
        $agenda->sala     = $sala;
        $agenda->tempo    = $tempo;
        $agenda->horario  = $horario;
        $agenda->dia      = $dia;

        $codigo_agenda    = random_int(100000000, 999999999);
        $agenda->codigo   = $codigo_agenda;

        $agenda->stts     = "simulando";
        $agenda->valor    = $value_scheduling;
        $agenda->desconto = $value_scheduling;
        $agenda->tipo     = "null";

        $agenda->save();

        $agendamento = "disponivel";

        return view('dashboard.agenda', ['simulacao' => $agendamento, 'cod_agnd' => $codigo_agenda]);
    }

    // NOVO AGENDAMENTO PELO GUICHÊ
    public function NewAgendamentoManual(Request $request)
    {
        $agenda = new Agendamento;

        if (!empty($request->cliente)) {
           $cliente = $request->cliente;

            $resgate_cliente = Usuario::where('email', $cliente)->first();

            $nome       = $resgate_cliente->nome;
            $email      = $resgate_cliente->email;
            @$atuacao   = $resgate_cliente->atuacao;
            $nascimento = $resgate_cliente->nascimento;
        }

        else{
            $nome       = $request->nome;
            $email      = $request->email;
            $atuacao    = $request->atuacao;
            $nascimento = $request->nascimento;
        }

        $sala    = $request->sala;
        $tempo   = $request->tempo;
        $horario = $request->horario;
        $dia     = $request->dia;

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
        else{

            //   +----------------------------+
            //  /   REALIZAR NOVO CADASTRO   /
            // +----------------------------+

            // REALIZAR CADASTRO PRÉVIO DA USUÁRIA
            $usuaria = new Usuario;

            $new_senha           = random_int(100000, 999999);

            $usuaria->nome       = $nome;
            $usuaria->email      = $email;
            $usuaria->stts       = $new_senha;

            $senha_cripton       = Hash::make($new_senha);

            $usuaria->senha      = $senha_cripton;
            $usuaria->atuacao    = $atuacao;
            $usuaria->nascimento = $nascimento;

            $usuaria->cidade     = "";
            $usuaria->estado     = "";

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

            $usuaria->imagem   = "usuario.png";
            $usuaria->nickname = $new_nick;

            $usuaria->save();

            // NEW USER REDEMPTION
            $user_check = Usuario::where('email', $email)->first();

            // MERGIAR EMAIL
            $request->merge([ 'id_user' => $user_check->id ]);

            return $this->noDiscount($request);

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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'msn' => $mensagem]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'msn' => $mensagem]);
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

            return view('dashboard.agenda', ['simulacao' => $agendamento, 'return_sala' => $sala_retorno, 'return_dia' => $dia_retorno, 'return_horario' => $hor_retorno,]);
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

                        return view('dashboard.agenda', ['simulacao' => $agendamento, 'return_sala' => $sala_retorno, 'return_dia' => $dia_retorno, 'return_horario' => $hor_retorno,]);
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

                        return view('dashboard.agenda', ['simulacao' => $agendamento, 'return_sala' => $sala_retorno, 'return_dia' => $dia_retorno, 'return_horario' => $hor_retorno,]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'cod_agnd' => $codigo_agenda]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'cod_agnd' => $codigo_agenda]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'msn' => $mensagem]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'msn' => $mensagem]);
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

            return view('dashboard.agenda', ['simulacao' => $agendamento, 'return_sala' => $sala_retorno, 'return_dia' => $dia_retorno, 'return_horario' => $hor_retorno,]);
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

                        return view('dashboard.agenda', ['simulacao' => $agendamento, 'return_sala' => $sala_retorno, 'return_dia' => $dia_retorno, 'return_horario' => $hor_retorno,]);
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

                        return view('dashboard.agenda', ['simulacao' => $agendamento, 'return_sala' => $sala_retorno, 'return_dia' => $dia_retorno, 'return_horario' => $hor_retorno,]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'cod_agnd' => $codigo_agenda]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'cod_agnd' => $codigo_agenda]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'msn' => $mensagem]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'msn' => $mensagem]);
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

            return view('dashboard.agenda', ['simulacao' => $agendamento, 'return_sala' => $sala_retorno, 'return_dia' => $dia_retorno, 'return_horario' => $hor_retorno,]);
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

                        return view('dashboard.agenda', ['simulacao' => $agendamento, 'return_sala' => $sala_retorno, 'return_dia' => $dia_retorno, 'return_horario' => $hor_retorno,]);
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

                        return view('dashboard.agenda', ['simulacao' => $agendamento, 'return_sala' => $sala_retorno, 'return_dia' => $dia_retorno, 'return_horario' => $hor_retorno,]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'cod_agnd' => $codigo_agenda]);
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

                return view('dashboard.agenda', ['simulacao' => $agendamento, 'cod_agnd' => $codigo_agenda]);
            }
        }
    }







    // AGENDAMENTO PELO GUICHÊ (733)
    public function agenda_manual(Request $request)
    {
        $agenda = new Agendamento;

        // VERIFICAR SE USUÁRIO JÁ É CADASTRADO
        $email_usuario = $request->email;

        $verificar = Usuario::where('email', $email_usuario)->first();

        if($verificar){

            // RESGATE DE VALOR
            $log_tempo = $request->tempo;
            $log_sala = $request->sala;

            // RESGATAR INFORMAÇÕES DA SALA
            $sql_espaco = DB::select("SELECT * FROM salas WHERE id = '$log_sala'");

            // RESGATE DO VALOR
            if ($log_tempo == 1) {
                $valor = $sql_espaco[0]->valor;
            }
            if ($log_tempo == 2) {
                $valor = $sql_espaco[0]->dual;
            }
            if ($log_tempo == 4) {
                $valor = $sql_espaco[0]->turno;
            }
            if ($log_tempo == 8) {
                $valor = $sql_espaco[0]->diaria;
            }

            // RESGATE DE USUÁRIO
            $usuario_id = $verificar->id;

            // VERIFICAÇÃO DE PLANO
            $sql_plan    = DB::select("SELECT * FROM clubes WHERE id_user = '$usuario_id'");

            if($sql_plan) {

                $plano_atual = $sql_plan[0]->plano;
                $plano_horas = $sql_plan[0]->horas;
                // PLANO BÁSICO
                if ($plano_atual == 1) {
                    // ESTAÇÃO COMPARTILHADA
                    if($log_sala == 5){

                        if($plano_horas >= $log_tempo){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                            // DECREMENTO DE TEMPO
                            $decr_tempo = $log_tempo - $plano_horas;

                            // VERIFICAR VALOR DE SUBTRAÇÃO
                            if($decr_tempo == 0){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($decr_tempo > 0){
                                // DEDUÇÃO DE PREÇO
                                $deducao = $valor / $log_tempo * $decr_tempo;
                                $valor_finl = $deducao;
                                $tipo_vantagem = "horas";
                            }
                        }
                        // TODAS AS SALAS
                        else{
                            $valor_finl = $valor;
                            $tipo_vantagem = "null";
                        }
                    }
                    // PARA SALAS PRIVATIVA E EXECUTIVA 10%
                    elseif($log_sala == 9 OR $log_sala == 10){
                        // APLICAÇÃO DE DESCONTO DE 10%
                        $valor_porc = $valor * 10 / 100;
                        $valor_desc = $valor - $valor_porc;
                        // VALOR FINAL COM DESCONTO
                        $valor_finl = $valor_desc;
                        $tipo_vantagem = "valor";
                    }
                    // TODAS AS SALAS
                    else{
                        $valor_finl = $valor;
                        $tipo_vantagem = "null";
                    }
                }
                // PLANO VIP
                if ($plano_atual == 2) {
                    // ESTAÇÃO PRIVADAS POR ID
                    if($log_sala == 8){

                        if($plano_horas >= $log_tempo){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                            // DECREMENTO DE TEMPO
                            $decr_tempo = $log_tempo - $plano_horas;

                            // VERIFICAR VALOR DE SUBTRAÇÃO
                            if($decr_tempo == 0){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($decr_tempo > 0){
                                // DEDUÇÃO DE PREÇO
                                $deducao = $valor / $log_tempo * $decr_tempo;
                                $valor_finl = $deducao;
                                $tipo_vantagem = "horas";
                            }
                        }
                        // TODAS AS SALAS
                        else{
                            $valor_finl = $valor;
                            $tipo_vantagem = "null";
                        }

                    }
                    // PENTEADEIRA LUXO
                    elseif($log_sala == 11){

                        if($plano_horas >= $log_tempo){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                            // DECREMENTO DE TEMPO
                            $decr_tempo = $log_tempo - $plano_horas;

                            // VERIFICAR VALOR DE SUBTRAÇÃO
                            if($decr_tempo == 0){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($decr_tempo > 0){
                                // DEDUÇÃO DE PREÇO
                                $deducao = $valor / $log_tempo * $decr_tempo;
                                $valor_finl = $deducao;
                                $tipo_vantagem = "horas";
                            }
                        }
                        // TODAS AS SALAS
                        else{
                            $valor_finl = $valor;
                            $tipo_vantagem = "null";
                        }
                    }
                    // PARA SALAS PRIVATIVA E EXECUTIVA 10%
                    elseif($log_sala == 9 OR $log_sala == 10){
                        // APLICAÇÃO DE DESCONTO DE 10%
                        $valor_porc = $valor * 10 / 100;
                        $valor_desc = $valor - $valor_porc;
                        // VALOR FINAL COM DESCONTO
                        $valor_finl = $valor_desc;
                        $tipo_vantagem = "valor";
                    }
                    // TODAS AS SALAS
                    else{
                        $valor_finl = $valor;
                        $tipo_vantagem = "null";
                    }
                }
                // PLANO PRIVADO
                if ($plano_atual == 4) {
                    // SALA PRIVATIVA
                    if($log_sala == 9){

                        // VERIFICAR O MÍNIMO DE RESERVA 4/8
                        if ($log_tempo == 4 OR $log_tempo == 8) {

                            if($plano_horas >= $log_tempo){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                                // DECREMENTO DE TEMPO
                                $decr_tempo = $log_tempo - $plano_horas;

                                // VERIFICAR VALOR DE SUBTRAÇÃO
                                if($decr_tempo == 0){
                                    // CONSUMO TOTAL
                                    $valor_finl = 0;
                                    $tipo_vantagem = "horas";
                                }
                                elseif($decr_tempo > 0){
                                    // DEDUÇÃO DE PREÇO
                                    $deducao = $valor / $log_tempo * $decr_tempo;
                                    $valor_finl = $deducao;
                                    $tipo_vantagem = "horas";
                                }
                            }
                            // TODAS AS SALAS
                            else{
                                $valor_finl = $valor;
                                $tipo_vantagem = "null";
                            }
                        }
                        // TODAS AS SALAS
                        else{
                            $valor_finl = $valor;
                            $tipo_vantagem = "null";
                        }
                    }
                    // PARA SALAS PRIVATIVA E EXECUTIVA 10%
                    elseif($log_sala == 10){
                        // APLICAÇÃO DE DESCONTO DE 10%
                        $valor_porc = $valor * 10 / 100;
                        $valor_desc = $valor - $valor_porc;
                        // VALOR FINAL COM DESCONTO
                        $valor_finl = $valor_desc;
                        $tipo_vantagem = "valor";
                    }
                    // TODAS AS SALAS
                    else{
                        $valor_finl = $valor;
                        $tipo_vantagem = "null";
                    }
                }
                // PLANO EXECUTIVO
                if ($plano_atual == 3) {
                    // SALA PRIVATIVA
                    if($log_sala == 9){

                        // VERIFICAR O MÍNIMO DE RESERVA 4/8
                        if ($log_tempo == 4 OR $log_tempo == 8) {

                            if($plano_horas >= $log_tempo){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                                // DECREMENTO DE TEMPO
                                $decr_tempo = $log_tempo - $plano_horas;

                                // VERIFICAR VALOR DE SUBTRAÇÃO
                                if($decr_tempo == 0){
                                    // CONSUMO TOTAL
                                    $valor_finl = 0;
                                    $tipo_vantagem = "horas";
                                }
                                elseif($decr_tempo > 0){
                                    // DEDUÇÃO DE PREÇO
                                    $deducao = $valor / $log_tempo * $decr_tempo;
                                    $valor_finl = $deducao;
                                    $tipo_vantagem = "horas";
                                }
                            }
                            // CASO O MÍNIMO NÃO SEJA ACEITO
                            elseif($plano_horas == 0){
                                // APLICAÇÃO DE DESCONTO DE 20%
                                $valor_porc = $valor * 20 / 100;
                                $valor_desc = $valor - $valor_porc;
                                // VALOR FINAL COM DESCONTO
                                $valor_finl = $valor_desc;
                                $tipo_vantagem = "valor";
                            }
                        }
                        // CASO O MÍNIMO NÃO SEJA ACEITO
                        else{
                            // APLICAÇÃO DE DESCONTO DE 20%
                            $valor_porc = $valor * 20 / 100;
                            $valor_desc = $valor - $valor_porc;
                            // VALOR FINAL COM DESCONTO
                            $valor_finl = $valor_desc;
                            $tipo_vantagem = "valor";
                        }
                    }
                    // CASO O MÍNIMO NÃO SEJA ACEITO
                    else{
                        // APLICAÇÃO DE DESCONTO DE 20%
                        $valor_porc = $valor * 20 / 100;
                        $valor_desc = $valor - $valor_porc;
                        // VALOR FINAL COM DESCONTO
                        $valor_finl = $valor_desc;
                        $tipo_vantagem = "valor";
                    }
                }
            }
            else{
                // VALOR SEM DESCONTO
                $valor_finl = $valor;
                $tipo_vantagem = "null";
            }

            $agenda->user = $verificar->id;
            $agenda->sala = $request->sala;
            $agenda->tempo = $request->tempo;
            $agenda->horario = $request->horario;
            $agenda->dia = $request->dia;
            $codigo_agenda = random_int(100000000, 999999999);
            $agenda->codigo = $codigo_agenda;
            $agenda->stts = "simulando";
            $agenda->valor = $valor;
            $agenda->desconto = $valor_finl;
            $agenda->tipo = $tipo_vantagem;

            // VERIFICAR AGENDAMENTO
            $nivel1 = Agendamento::where('sala', $request->sala)->first();

            if($nivel1){
                $agendamento = "verificar";
            }

            else{
                $agendamento = "disponivel";
            }
        }

        else{

            // CRIAR UM NOVO USUÁRIO
            $usuario = new Usuario;
            $usuario->nome = $request->nome;
            $usuario->email = trim($request->email);
            $usuario->cidade = ""; // definir padrão null
            $usuario->estado = ""; // definir padrão null
            $usuario->bio = "";
            $usuario->imagem = "usuario.png";

            $nome_user = $request->nome;

            // SEPARAR OS DOIS PRIMEIROS NOMES
            $separador_nome = explode(" ", $nome_user);
            $primeiro_nome = $separador_nome[0];

            if(isset($separador_nome[1]) AND !empty($separador_nome[1])){

                $segundo_nome = $separador_nome[1];

                if($segundo_nome == "de" OR $segundo_nome == "da"){
                    $new_nome_user = $primeiro_nome." ".$separador_nome[2];
                }

                else{
                    $new_nome_user = $primeiro_nome." ".$segundo_nome;
                }
            }

            else{
                $new_nome_user = $primeiro_nome;
            }

            $eliminar_espace = str_replace(' ', '', $new_nome_user);

            // ELIMINAR ALGUM TIPO DE ACENTUAÇÃO
            $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');

            $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

            $sem_acent = str_replace($comAcentos, $semAcentos, $eliminar_espace);

            $nick = strtolower($sem_acent);

            // VERIFICAR SE O NICKNAME JÁ EXISTE
            $nickversion = Usuario::where('nickname', $nick)->first();

            if ($nickversion) {
                $usuario->nickname = $nick.random_int(100, 999);
            }
            else{
                $usuario->nickname = $nick;
            }

            $usuario->atuacao = $request->atuacao;
            $usuario->link = "";
            $usuario->nascimento = $request->nascimento;
            $usuario->telefone = $request->telefone;

            $senha = random_int(10000000, 99999999);

            // CRIPTOGRAFAR SENHA
            $senhax = Hash::make($senha);
            $usuario->senha = $senhax;

            // STATUS DE VERIFICAÇÃO
            $status = $senha;
            $usuario->stts = $status;
            $usuario->save();

            // ENVIAR E-MAIL COM SENHA DO USUARIO CADASTRADO
            $email = $request->email;

            Mail::to($email)->send(new EmailAgendamentoManual($status));

            // REALIZAR CONSULTA PARA ENCONTRAR O USUARIO CADASTRADO
            $encontrar = Usuario::where('stts', $status)->first();

            // +---------------------------------------------------------------------------------+
            // | REFATORAÇÃO DE AGENDAMENTO COM PLANOS                                           |
            // +---------------------------------------------------------------------------------+

            // RESGATE DE VALOR
            $log_tempo = $request->tempo;
            $log_sala = $request->sala;

            // RESGATAR INFORMAÇÕES DA SALA
            $sql_espaco = DB::select("SELECT * FROM salas WHERE id = '$log_sala'");

            // RESGATE DO VALOR
            if ($log_tempo == 1) {
                $valor = $sql_espaco[0]->valor;
            }
            if ($log_tempo == 2) {
                $valor = $sql_espaco[0]->dual;
            }
            if ($log_tempo == 4) {
                $valor = $sql_espaco[0]->turno;
            }
            if ($log_tempo == 8) {
                $valor = $sql_espaco[0]->diaria;
            }

            // VERIFICAÇÃO DE PLANO
            $sql_plan = DB::select("SELECT * FROM clubes WHERE id_user = '$encontrar->id'");

            if($sql_plan) {

                $plano_atual = $sql_plan[0]->plano;
                $plano_horas = $sql_plan[0]->horas;
                // PLANO BÁSICO
                if ($plano_atual == 1) {
                    // ESTAÇÃO COMPARTILHADA
                    if($log_sala == 5){

                        if($plano_horas >= $log_tempo){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                            // DECREMENTO DE TEMPO
                            $decr_tempo = $log_tempo - $plano_horas;

                            // VERIFICAR VALOR DE SUBTRAÇÃO
                            if($decr_tempo == 0){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($decr_tempo > 0){
                                // DEDUÇÃO DE PREÇO
                                $deducao = $valor / $log_tempo * $decr_tempo;
                                $valor_finl = $deducao;
                                $tipo_vantagem = "horas";
                            }
                        }
                        // TODAS AS SALAS
                        else{
                            $valor_finl = $valor;
                            $tipo_vantagem = "null";
                        }
                    }
                    // PARA SALAS PRIVATIVA E EXECUTIVA 10%
                    elseif($log_sala == 9 OR $log_sala == 10){
                        // APLICAÇÃO DE DESCONTO DE 10%
                        $valor_porc = $valor * 10 / 100;
                        $valor_desc = $valor - $valor_porc;
                        // VALOR FINAL COM DESCONTO
                        $valor_finl = $valor_desc;
                        $tipo_vantagem = "valor";
                    }
                    // TODAS AS SALAS
                    else{
                        $valor_finl = $valor;
                        $tipo_vantagem = "null";
                    }
                }
                // PLANO VIP
                if ($plano_atual == 2) {
                    // ESTAÇÃO PRIVADAS POR ID
                    if($log_sala == 8){

                        if($plano_horas >= $log_tempo){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                            // DECREMENTO DE TEMPO
                            $decr_tempo = $log_tempo - $plano_horas;

                            // VERIFICAR VALOR DE SUBTRAÇÃO
                            if($decr_tempo == 0){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($decr_tempo > 0){
                                // DEDUÇÃO DE PREÇO
                                $deducao = $valor / $log_tempo * $decr_tempo;
                                $valor_finl = $deducao;
                                $tipo_vantagem = "horas";
                            }
                        }
                        // TODAS AS SALAS
                        else{
                            $valor_finl = $valor;
                            $tipo_vantagem = "null";
                        }

                    }
                    // PENTEADEIRA LUXO
                    elseif($log_sala == 11){

                        if($plano_horas >= $log_tempo){
                            // CONSUMO TOTAL
                            $valor_finl = 0;
                            $tipo_vantagem = "horas";
                        }
                        elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                            // DECREMENTO DE TEMPO
                            $decr_tempo = $log_tempo - $plano_horas;

                            // VERIFICAR VALOR DE SUBTRAÇÃO
                            if($decr_tempo == 0){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($decr_tempo > 0){
                                // DEDUÇÃO DE PREÇO
                                $deducao = $valor / $log_tempo * $decr_tempo;
                                $valor_finl = $deducao;
                                $tipo_vantagem = "horas";
                            }
                        }
                        // TODAS AS SALAS
                        else{
                            $valor_finl = $valor;
                            $tipo_vantagem = "null";
                        }
                    }
                    // PARA SALAS PRIVATIVA E EXECUTIVA 10%
                    elseif($log_sala == 9 OR $log_sala == 10){
                        // APLICAÇÃO DE DESCONTO DE 10%
                        $valor_porc = $valor * 10 / 100;
                        $valor_desc = $valor - $valor_porc;
                        // VALOR FINAL COM DESCONTO
                        $valor_finl = $valor_desc;
                        $tipo_vantagem = "valor";
                    }
                    // TODAS AS SALAS
                    else{
                        $valor_finl = $valor;
                        $tipo_vantagem = "null";
                    }
                }
                // PLANO PRIVADO
                if ($plano_atual == 4) {
                    // SALA PRIVATIVA
                    if($log_sala == 9){

                        // VERIFICAR O MÍNIMO DE RESERVA 4/8
                        if ($log_tempo == 4 OR $log_tempo == 8) {

                            if($plano_horas >= $log_tempo){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                                // DECREMENTO DE TEMPO
                                $decr_tempo = $log_tempo - $plano_horas;

                                // VERIFICAR VALOR DE SUBTRAÇÃO
                                if($decr_tempo == 0){
                                    // CONSUMO TOTAL
                                    $valor_finl = 0;
                                    $tipo_vantagem = "horas";
                                }
                                elseif($decr_tempo > 0){
                                    // DEDUÇÃO DE PREÇO
                                    $deducao = $valor / $log_tempo * $decr_tempo;
                                    $valor_finl = $deducao;
                                    $tipo_vantagem = "horas";
                                }
                            }
                            // TODAS AS SALAS
                            else{
                                $valor_finl = $valor;
                                $tipo_vantagem = "null";
                            }
                        }
                        // TODAS AS SALAS
                        else{
                            $valor_finl = $valor;
                            $tipo_vantagem = "null";
                        }
                    }
                    // PARA SALAS PRIVATIVA E EXECUTIVA 10%
                    elseif($log_sala == 10){
                        // APLICAÇÃO DE DESCONTO DE 10%
                        $valor_porc = $valor * 10 / 100;
                        $valor_desc = $valor - $valor_porc;
                        // VALOR FINAL COM DESCONTO
                        $valor_finl = $valor_desc;
                        $tipo_vantagem = "valor";
                    }
                    // TODAS AS SALAS
                    else{
                        $valor_finl = $valor;
                        $tipo_vantagem = "null";
                    }
                }
                // PLANO EXECUTIVO
                if ($plano_atual == 3) {
                    // SALA PRIVATIVA
                    if($log_sala == 9){

                        // VERIFICAR O MÍNIMO DE RESERVA 4/8
                        if ($log_tempo == 4 OR $log_tempo == 8) {

                            if($plano_horas >= $log_tempo){
                                // CONSUMO TOTAL
                                $valor_finl = 0;
                                $tipo_vantagem = "horas";
                            }
                            elseif($plano_horas > 0 AND $plano_horas <= $log_tempo){

                                // DECREMENTO DE TEMPO
                                $decr_tempo = $log_tempo - $plano_horas;

                                // VERIFICAR VALOR DE SUBTRAÇÃO
                                if($decr_tempo == 0){
                                    // CONSUMO TOTAL
                                    $valor_finl = 0;
                                    $tipo_vantagem = "horas";
                                }
                                elseif($decr_tempo > 0){
                                    // DEDUÇÃO DE PREÇO
                                    $deducao = $valor / $log_tempo * $decr_tempo;
                                    $valor_finl = $deducao;
                                    $tipo_vantagem = "horas";
                                }
                            }
                            // CASO O MÍNIMO NÃO SEJA ACEITO
                            elseif($plano_horas == 0){
                                // APLICAÇÃO DE DESCONTO DE 20%
                                $valor_porc = $valor * 20 / 100;
                                $valor_desc = $valor - $valor_porc;
                                // VALOR FINAL COM DESCONTO
                                $valor_finl = $valor_desc;
                                $tipo_vantagem = "valor";
                            }
                        }
                        // CASO O MÍNIMO NÃO SEJA ACEITO
                        else{
                            // APLICAÇÃO DE DESCONTO DE 20%
                            $valor_porc = $valor * 20 / 100;
                            $valor_desc = $valor - $valor_porc;
                            // VALOR FINAL COM DESCONTO
                            $valor_finl = $valor_desc;
                            $tipo_vantagem = "valor";
                        }
                    }
                    // CASO O MÍNIMO NÃO SEJA ACEITO
                    else{
                        // APLICAÇÃO DE DESCONTO DE 20%
                        $valor_porc = $valor * 20 / 100;
                        $valor_desc = $valor - $valor_porc;
                        // VALOR FINAL COM DESCONTO
                        $valor_finl = $valor_desc;
                        $tipo_vantagem = "valor";
                    }
                }
            }
            else{
                // VALOR SEM DESCONTO
                $valor_finl = $valor;
                $tipo_vantagem = "null";
            }

            // FAZER AGENDAMENTO DO NOVO USUÁRIO
            $agenda->user = $encontrar->id;
            $agenda->sala = $request->sala;
            $agenda->tempo = $request->tempo;
            $agenda->horario = $request->horario;
            $agenda->dia = $request->dia;
            $codigo_agenda = random_int(100000000, 999999999);
            $agenda->codigo = $codigo_agenda;
            $agenda->stts = "simulando";
            $agenda->valor = $valor;
            $agenda->desconto = $valor_finl;
            $agenda->tipo = $tipo_vantagem;

            // VERIFICAR AGENDAMENTO
            $nivel1 = Agendamento::where('sala', $request->sala)->first();

            if($nivel1){
                $agendamento = "verificar";
            }

            else{
                $agendamento = "disponivel";
            }
        }

        $agenda->save();

        return view('dashboard.agenda', ['simulacao' => $agendamento, 'cod_agnd' => $codigo_agenda]);
    }

    // DISPENSAR O AGENDAMENTO MANUAL
    public function agenda_dispensar($id)
    {
        // RESGATAR LOG FINANCEIRO
        $code_log = DB::select("SELECT * FROM agendamentos WHERE id = '$id'");
        $codigoxx = $code_log[0]->codigo;

        // DELETAR LOG FINANCEIRO
        $delt_log = DB::select("SELECT * FROM log_financeiros WHERE codigo = '$codigoxx'");
        $contagem = count($delt_log);

        if($contagem > 0){
            $idx = $delt_log[0]->id;
            LogFinanceiro::findOrFail($idx)->delete();
        }

        Agendamento::findOrFail($id)->delete();

        return redirect()->route('agendamento');
    }

    // +---------------------------------------------------------------------------------+
    // | ATUALIZAR INFORMAÇÕES DE AGENDAMENTO                                            |
    // +---------------------------------------------------------------------------------+

    public function agendamento_adm_edt($id)
    {
        return view('dashboard.agenda', ['miami' => $id]);
    }

    public function editando_agendamento(Request $request, $id)
    {
        $agenda = Agendamento::findOrFail($id);

        $no_format     = $request->vantagem;
        $no_explode    = explode(',', $no_format);

        $agenda->update([
            'sala'     => $request->sala,
            'horario'  => $request->horario,
            'dia'      => $request->dia,
            'desconto' => $no_explode[0],
        ]);

        // $log = LogFinanceiro::findOrFail($request->log);
        // $log->update([
        //     'vantagem' => $no_explode[0],
        // ]);

        return redirect()->route('agendamento');
    }

    // CONFIRMAR O AGENDAMENTO MANUAL (514)
    public function agenda_confirma($id)
    {
        // DECREMENTAR TEMPO DE CLUBE DE VANTAGENS SE HOUVER
        $ver_agen = DB::select("SELECT * FROM agendamentos WHERE id = '$id' AND stts = 'simulando'");
        $usuario_master = $ver_agen[0]->user;

        // RESGATE DE PLANO
        $ver_plan = DB::select("SELECT * FROM clubes WHERE id_user = '$usuario_master'");

        if($ver_plan){
            // VARIÁVEIS
            $var_tempo = $ver_agen[0]->tempo;
            $var_horas = $ver_plan[0]->horas;

            $clubs = Clube::findOrFail($ver_plan[0]->id);

            if ($ver_agen[0]->tipo == "horas") {

                if ($var_horas > 0) {

                    if($var_tempo > $var_horas){

                        $clubs->update([
                            'horas' => 0,
                        ]);
                    }

                    else{

                        $clubs->update([
                            'horas' => $var_horas - $var_tempo,
                        ]);
                    }
                }
            }
        }

        // LOG DE REGISTRO FINANCEIRO
        $log = new LogFinanceiro;
        $log->codigo = $ver_agen[0]->codigo;
        $log->tipo = "agendamento";
        $log->data = date('d/m/Y');
        $log->valor = $ver_agen[0]->valor;
        $log->vantagem = $ver_agen[0]->desconto;
        $log->stts = "pagamento";
        $log->mes = date('m');

        $log->save();

        $agenda = Agendamento::findOrFail($id);
        $agenda->update([
            'stts' => 'pagamento',
        ]);

        return redirect()->route('agendamento');
    }

    public function agenda_delete($id){

        $agenda = Agendamento::findOrFail($id);

        $agenda->delete();

        return redirect()->route('agendamento');
    }

    // REFAZER O AGENDAMENTO MANUAL
    public function refazer_consulta(Request $request, $id)
    {
        $agenda = Agendamento::findOrFail($id);
        $consulta = Agendamento::where('id', $id)->first();
        $codigo_agenda = $consulta['codigo'];

        $agendamento = "abrir_simulador";

        $agenda->update([
            'sala' => $request->sala,
            'tempo' => $request->tempo,
            'horario' => $request->horario,
            'dia' => $request->dia,
        ]);

        return view('dashboard.agenda', ['simulacao' => $agendamento, 'cod_agnd' => $codigo_agenda]);
    }
}

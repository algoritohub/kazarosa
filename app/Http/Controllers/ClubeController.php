<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clube;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailPaymentPlanBasic;
use App\Mail\EmailPaymentPlanVip;
use app\Mail\EmailPaymentPlanExecutive;
use App\Mail\EmailAutorizadPlan;
use App\Mail\EmailPaymentAppPlan;
use Illuminate\Support\Facades\Hash;
use App\Models\LogFinanceiro;
use Illuminate\Support\Facades\DB;

class ClubeController extends Controller
{
    // CLUBE DE NEGÓCIO
    public function clube_negocio()
    {
        $clube = Clube::all();

        return view('dashboard.clube_negocios', compact('clube'));
    }

    // CRIAR PLANO PARA NÃO CLIENTES
    public function cadastro_plano(Request $request)
    {
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
        $segundo_nome = $separador_nome[1];

        if($segundo_nome == "de" OR $segundo_nome == "da"){
            $new_nome_user = $primeiro_nome." ".$separador_nome[2];
        }

        else{
            $new_nome_user = $primeiro_nome." ".$segundo_nome;
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

        $usuario->atuacao = "";
        $usuario->link = "";
        $usuario->nascimento = $request->nascimento;

        // verificar senha
        $senha = trim($request->senha);
        $conf_senha = trim($request->confsenha);

        if($senha == $conf_senha){
            // criptografar senha
            $senha = Hash::make($senha);
            $usuario->senha = $senha;
        }
        else{
            return view('cadastro', ['erro' => 'A senha não confere']);
        }

        // status de verificação
        $usuario->stts = random_int(100000, 999999);
        $usuario->save();

        // localizar usuário pelo e-mail
        $planeta = Usuario::where('stts', $usuario->stts)->first();

        // echo "$planeta->stts - $request->plano";

        // CRIA PLANO
        $plan = new Clube;
        $plan->id_user = $planeta->id;
        $plan->plano = $request->plano;
        $ger_code = random_int(100000000, 999999999);

        // PLANO BÁSICO
        if ($request->plano == 1) {
            $plan->desconto = 10;
            $plan->horas = 12;
            $plan->turno = 0;
            $plan->stts = "pagamento";
            $plan->inicio = $request->inicio;
            $plan->dias = 30;
            $valor_plan = 167;
            $plan->codigo = $ger_code;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO
            Mail::to($request->email)->send(new EmailPaymentPlanBasic($usuario->stts));

            // ENVIE UM ALERTA PARA ADMIN
        }

        if ($request->plano == 2) {
            $plan->desconto = 10;
            $plan->horas = 12;
            $plan->turno = 0;
            $plan->stts = "pagamento";
            $plan->inicio = $request->inicio;
            $plan->dias = 30;
            $valor_plan = 257;
            $plan->codigo = $ger_code;
            $plan->save();
            // ENVIAR EMAIL COM PAGAMENTO
            Mail::to($request->email)->send(new EmailPaymentPlanBasic($usuario->stts));

            // ENVIE UM ALERTA PARA ADMIN
        }

        if ($request->plano == 4) {
            $plan->desconto = 10;
            $plan->horas = 16;
            $plan->turno = 0;
            $plan->stts = "pagamento";
            $plan->inicio = $request->inicio;
            $plan->dias = 30;
            $valor_plan = 420;
            $plan->codigo = $ger_code;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO
            Mail::to($request->email)->send(new EmailPaymentPlanBasic($usuario->stts));

            // ENVIE UM ALERTA PARA ADMIN
        }

        if ($request->plano == 3) {
            $plan->desconto = 20;
            $plan->horas = 16;
            $plan->turno = 0;
            $plan->stts = "pagamento";
            $plan->inicio = $request->inicio;
            $plan->dias = 30;
            $valor_plan = 637;
            $plan->codigo = $ger_code;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO
            Mail::to($request->email)->send(new EmailPaymentPlanBasic($usuario->stts));

            // ENVIE UM ALERTA PARA ADMIN
        }

        // LOG DE REGISTRO FINANCEIRO
        $log = new LogFinanceiro;
        $log->codigo = $ger_code;
        $log->tipo = "plano";
        $log->data = date('d/m/Y');
        $log->valor = $valor_plan;
        $log->vantagem = 0;
        $log->stts = "pagamento";
        $log->save();

        // PÁGINA DE PAGAMENTO
        return view('payment', ['status_user' => $usuario->stts]);

    }

    // CRIAR PLANO VIA APP
    public function plano_app($id)
    {
        // localizar usuário pelo e-mail
        $planeta_id = session('usuario')['id'];
        $planeta_mail = session('usuario')['email'];

        // CRIA PLANO
        $plan = new Clube;
        $plan->id_user = $planeta_id;
        $plan->plano = $id;
        $ger_code = random_int(100000000, 999999999);

        // PLANO BÁSICO
        if ($id == 1) {
            $plan->desconto = 10;
            $plan->horas = 12;
            $plan->turno = 0;

            $plan->stts = "pagamento";
            $plan->inicio = date('d/m/Y');
            $plan->dias = 30;
            $plan->codigo = $ger_code;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO (ALTERAR MAIL PARA RECEBER ID)
            Mail::to($planeta_mail)->send(new EmailPaymentAppPlan($planeta_id));

            // ENVIE UM ALERTA PARA ADMIN
        }

        if ($id == 2) {
            $plan->desconto = 10;
            $plan->horas = 12;
            $plan->turno = 0;

            $plan->stts = "pagamento";
            $plan->inicio = date('d/m/Y');
            $plan->dias = 30;
            $plan->codigo = $ger_code;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO
            Mail::to($planeta_mail)->send(new EmailPaymentAppPlan($planeta_id));

            // ENVIE UM ALERTA PARA ADMIN
        }

        if ($id == 4) {
            $plan->desconto = 10;
            $plan->horas = 16;
            $plan->turno = 0;

            $plan->stts = "pagamento";
            $plan->inicio = date('d/m/Y');
            $plan->dias = 30;
            $plan->codigo = $ger_code;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO
            Mail::to($planeta_mail)->send(new EmailPaymentAppPlan($planeta_id));

            // ENVIE UM ALERTA PARA ADMIN
        }

        if ($id == 3) {
            $plan->desconto = 20;
            $plan->horas = 16;
            $plan->turno = 0;

            $plan->stts = "pagamento";
            $plan->inicio = date('d/m/Y');
            $plan->dias = 30;
            $plan->codigo = $ger_code;
            $plan->save();

            // ENVIAR EMAIL COM PAGAMENTO
            Mail::to($planeta_mail)->send(new EmailPaymentAppPlan($planeta_id));

            // ENVIE UM ALERTA PARA ADMIN
        }

        // LOG DE REGISTRO FINANCEIRO
        $log = new LogFinanceiro;
        $log->codigo = $ger_code;
        $log->tipo = "plano";
        $log->data = date('d/m/Y');
        $log->valor = $valor_plan;
        $log->vantagem = 0;
        $log->stts = "pagamento";
        $log->save();

        // PÁGINA DE PAGAMENTO
        return view('payment_app', ['status_user' => $planeta_id]);
    }

    // AUTORIZAR PLANO
    public function autoriza_plano($id)
    {
        $planeta = Clube::where('id', $id)->first();
        $usuario = Usuario::where('id', $planeta->id_user)->first();

        $usuario_id = $usuario->$id;

        $plan = Clube::findOrFail($id);

        $plan->update([
            'stts' => "autorizado",
        ]);

        $code_consult = DB::select("SELECT * FROM clubes WHERE id = $id");
        $codigo_clubs = $code_consult[0]->codigo;

        $ver_code = DB::select("SELECT * FROM log_financeiros WHERE codigo = $codigo_clubs");
        $contagem = count($ver_code);

        if($contagem > 0){

            $id_log = $ver_code[0]->id;
            $log = LogFinanceiro::findOrFail($id_log);

            $log->update([
                'stts' => "pago",
            ]);
        }

        // ENVIAR EMAIL DE CONFIRMAÇÃO
        Mail::to($usuario->email)->send(new EmailAutorizadPlan($id));

        return redirect()->route('clube_negocio');
    }

    // SUSPENDE PLANO
    public function suspender_plano($id)
    {
        $plan = Clube::findOrFail($id);

        $plan->update([
            'stts' => "suspenso",
        ]);

        return redirect()->route('clube_negocio');
    }

    // LIBERAR PLANO
    public function liberar_plano($id)
    {
        $plan = Clube::findOrFail($id);

        $plan->update([
            'stts' => "autorizado",
        ]);

        return redirect()->route('clube_negocio');
    }



    // EXIBIR INFORMAÇÕES DE PAGAMENTOS
    public function pag_pay()
    {
        return view('payment');
    }
}

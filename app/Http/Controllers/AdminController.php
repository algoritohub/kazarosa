<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LogRequest;
use App\Models\Admin;
use App\Models\Clube;
use App\Models\Usuario;
use App\Models\Plano;
use App\Models\EntradaSaida;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ecibir painel geral
    public function geral()
    {
        if(session()->has('admin')){
            return view('dashboard.geral');
        }
        else{
            return redirect()->route('dashboard');
        }
    }

    // retonar erros para login / exibi login
    public function login_xp()
    {
        // verificar se já existe uma sessão
        if(session()->has('admin')){
            return redirect()->route('geral');
        }

        // enviar para formulário erros de acesso
        $erro = session('erro');
        $data = [];

        if(!empty($erro)){
            $data = [
                'erro' => $erro
            ];
        }

        return view('dashboard.login', $data);
    }

    // logar
    public function log(LogRequest $request)
    {
        // verificar se já existe uma sessão
        if(session()->has('admin')){
            return redirect()->route('geral');
        }

        // retorna todos os erros vindos de request
        $request->validated();

        // verificação de usuário
        $email = trim($request->input('email'));
        $senha = trim($request->input('senha'));

        $admin = Admin::where('email', $email)->first();

        // verificar e-mail
        if(!$admin)
        {
            session()->flash('erro', 'O usuário não existe!');
            return redirect()->route('dashboard');
        }

        // verificar senha
        if(!Hash::check($senha, $admin->senha))
        {
            session()->flash('erro', 'A senha está incorreta!');
            return redirect()->route('dashboard');
        }

        $admins = Admin::findOrFail($admin->id);

        $admins->update([
            'log' => $request->log,
        ]);

        // criar a sessão
        session()->put('admin', $admin);
        return redirect()->route('geral');
    }

    // logout dashboard
    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('dashboard');
    }

    // criar novos usuários admin
    public function master()
    {
        $admin = new Admin;
        $admin->nome  = 'Kênia Raissa';
        $admin->email = 'admin@kazarosa.com';
        $admin->senha = Hash::make('adminkenia22');
        $admin->acesso = 'administrativo';
        $admin->log = '00/00/0000';
        $admin->save();

        echo 'Usuário admin adicionado!';
    }

    // planos
    public function add_plano()
    {
        $admin = new Plano;
        $admin->plano          = 1;
        $admin->nome           = 'Executive Plan';
        $admin->valor          = '637';
        $admin->horas          = '16';
        $admin->salas_free     = '9,';
        $admin->horas_min      = 4;
        $admin->desconto       = '20';
        $admin->salas_desconto = 'all';
        $admin->save();

        echo 'Plano '.$admin->nome.' adicionado com sucesso!';
    }

    // criar novos usuários atendentes
    public function atendente()
    {
        $admin = new Admin;
        $admin->nome  = 'Helena';
        $admin->email = 'helena@kasarosa.com';
        $admin->senha = Hash::make('helena776483');
        $admin->acesso = 'atendimento';
        $admin->log = '00/00/0000';
        $admin->save();

        // kallyne953144
        // helena776483

        echo 'Usuário admin adicionado!';
    }

    // LogCheck
    public function log_check()
    {

        // CHECKAGEM DO DIA
        $mail_admin = session('admin')['email'];
        $admin = Admin::where('email', $mail_admin)->first();

        // CHECKAGEM DE PLANOS EXPIRADOS
        $club = Clube::all();

        foreach($club as $plan){

            $check = Admin::where('id', $plan->id)->first();
            $data_renova = $check->renova;

            if ($admin->log == $data_renova) {

                $plan = Clube::findOrFail($check->id);
                $plan->update([
                    'stts' => "suspenso",
                ]);
            }

            return redirect()->route('geral');
        }
    }

    // PAINEL FINANCEIRO
    public function pg_financeiro()
    {
        if(session()->has('admin')){
            return view('dashboard.financeiro');
        }
        else{
            return redirect()->route('dashboard');
        }
    }

    // PAINEL DE ENTRADA E SAÍDA
    public function entradaSaida()
    {
        if(session()->has('admin')){
            return view('dashboard.entrada_saida');
        }
        else{
            return redirect()->route('dashboard');
        }
    }

    // ADD ENTRADA
    public function addNewEntrada(Request $request)
    {
        $entrada = new EntradaSaida;

        $registro = date('d/m/Y');

        // SOMAR VALOR PELA QUANTIDADE
        $total = $request->quantidade * $request->valor;

        $entrada->nome        = $request->nome;
        $entrada->valor       = $request->valor;
        $entrada->valor_venda = $request->valor_venda;
        $entrada->quantidade  = $request->quantidade;
        $entrada->tipo        = $request->tipo;
        $entrada->registro    = $registro;
        $entrada->stts        = "entrada";
        $entrada->total       = $total;

        $entrada->save();

        return redirect()->route('entrada_saida');
    }

    // ADD ENTRADA
    public function addSaida(Request $request)
    {
        $saida = new EntradaSaida;

        $registro = date('d/m/Y');

        // ADICIONAR CAMPOS HIDDEM VALOR
        $entrada           = $request->nome;
        $busca_entrada     = DB::select("SELECT * FROM entrada_saidas WHERE id = '$entrada'");
        $total_saida       = $request->quantidade * $busca_entrada[0]->valor_venda;

        $saida->nome       = $busca_entrada[0]->nome;
        $saida->quantidade = $request->quantidade;
        $saida->valor      = $total_saida;
        $saida->tipo       = $request->tipo;
        $saida->registro   = $registro;
        $saida->stts       = "saida";
        $saida->total      = $total_saida;

        $saida->save();

        if ($busca_entrada[0]->quantidade > 0) {

            $entrada = EntradaSaida::findOrFail($entrada);
            $entrada->update([
                'quantidade' => $busca_entrada[0]->quantidade - $request->quantidade,
            ]);
        }

        return redirect()->route('entrada_saida');
    }

    // EXIBIR MODAL EDIT ENTRADA E SAÍDE
    public function editEntradaSaida($id)
    {
        return view('dashboard.entrada_saida', ['item' => $id]);
    }

    // EDITAR ITEM ENTRADAE SAÍDA
    public function editarEntradaSaida(Request $request, $id)
    {
        $edit = EntradaSaida::findOrFail($id);

        $edit->update([
            'valor'       => $request->valor,
            'valor_venda' => $request->valor_venda,
            'quantidade'  => $request->quantidade,
            'tipo'        => $request->tipo,
        ]);

        return redirect()->route('entrada_saida');
    }

    // DELETE ITEM ENTRADA E SAIDA
    public function deleteEntradaSaida($id)
    {
        $delete = EntradaSaida::findOrFail($id)->delete();
        return redirect()->route('entrada_saida');

    }

    public function excluir_user($id){

        $usuario = Usuario::findOrFail($id);

        // DELETAR AGENDAMENTOS
        DB::delete("DELETE FROM agendamentos WHERE user = '$id'");

        // DELETAR PLANO
        DB::delete("DELETE FROM clubes WHERE id_user = '$id'");

        // DELETAR NETWORK
        DB::delete("DELETE FROM networks WHERE usuario = '$id'");

        // DELETAR CURTIDAS
        DB::delete("DELETE FROM curtirs WHERE usuario = '$id'");

        // DELETAR SEGUIR
        DB::delete("DELETE FROM conexao_seguirs WHERE usuario = '$id'");

        $usuario->delete();

        return redirect()->route('geral');
    }
}

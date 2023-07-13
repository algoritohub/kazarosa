<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Principal;
use App\Models\Sala;
use App\Models\Evento;
use App\Models\Newslatter;
use App\Models\Network;
use App\Models\Clube;
use App\Models\ContatoCliente;
use App\Models\Usuario;
use App\Models\Comentario;
use App\Models\Curtir;

class PrincipalController extends Controller
{
    public function principal()
    {
        $salas = Sala::all();
        $eventos = Evento::all();

        return view('principal', ['salas' => $salas, 'eventos' => $eventos]);
    }

    // EXIBIR TODOS OS FAVORITOS
    public function favoritos()
    {
        return view('favoritos');
    }

    // SAVANDO FAVORITOS EM SESSÃO
    public function favoritar_espaco($id)
    {
        // definir função de salvar
    }

    // INCLUIR E-MAIL NO NEWSLATTER
    public function newslatter(Request $request)
    {
        $news = new Newslatter;
        $news->email = $request->email;
        $news->save();

        return redirect()->route('home');
    }

    // PÁGINA DE NEWSLETTER
    public function pg_newsletter()
    {
        $newsl = ContatoCliente::all();

        return view('dashboard.newslatter', ['newsletter' => $newsl]);
    }

    // PÁGINA DE PLANO
    public function meu_plano()
    {
        if(session()->has('usuario')){
            return view('meu_plano');
        }
        else{
            return redirect()->route('login');
        }
    }

    public function liberar_rede($id)
    {
        $block = Clube::findOrFail($id);

        $block->update([
            'turno' => 1,
        ]);

        return redirect()->route('meu_plano');
    }

    public function homeApp()
    {
        $ano_atual = date('Y');

        return view('newapp.home', compact('ano_atual'));
    }

    public function loginApp()
    {
        $ano_atual = date('Y');

        return view('newapp.login', compact('ano_atual'));
    }

    public function cadastroApp()
    {
        $ano_atual = date('Y');

        return view('newapp.cadastro', compact('ano_atual'));
    }

    public function registroApp(Request $request)
    {
        $request->merge([ 'ano_atual' => date('Y') ]);

        return $this->principalApp($request);
    }

    public function principalApp()
    {
        $salas = Sala::where('stts', 'ativo')->orderBy('id', 'ASC')->limit(4)->get();
        $user  = session('usuario');

        return view('newapp.principal', compact('user', 'salas'));
    }

    public function CoworkingDetalheApp($id)
    {
        $user  = session('usuario');
        $sala  = Sala::findOrFail($id);
        $valor = number_format($sala->turno,2,",",".");

        return view('newapp.detalhe_salas', compact('user', 'sala', 'valor'));
    }

    public function feedApp()
    {
        $feed     = Network::orderBy('id', 'DESC')->get();
        $usuarias = Usuario::orderBy('id', 'DESC')->limit(10)->get();
        $user     = session('usuario');

        return view('newapp.feed', compact('feed', 'usuarias', 'user'));
    }

    public function perfilApp()
    {
        $user = session('usuario');
        return view('newapp.perfil', compact('user'));
    }

    public function agendamentoApp()
    {
        return view('newapp.agendamentos');
    }

    public function reservaApp()
    {
        return view('newapp.reserva');
    }

    public function reservaDetalheApp()
    {
        $detalhe = "confirmado";
        return view('newapp.reserva_detalhe', compact('detalhe'));
    }

    public function reservaStatusApp()
    {
        $status = "yellow";
        return view('newapp.reserva_detalhe', compact('status'));
    }

    public function meuPlanoApp()
    {
        return view('newapp.plano');
    }

    public function pagPostagemApp($id)
    {
        $postagem = Network::find($id);
        $user     = session('usuario');

        $comentar = Comentario::where('postagem', $id)->orderBy('id', 'DESC')->get();
        $numb_cmt = count($comentar);

        $curtidas = Curtir::where('post', $id)->where('usuario', $user->id)->get();
        $numb_crt = count($curtidas);

        return view('newapp.postagem_detalhe', compact('postagem', 'user', 'comentar', 'numb_crt', 'numb_cmt'));
    }

    public function mensagensApp()
    {
        return view('newapp.caixa_mensagens');
    }

    public function mensagensDetalheApp()
    {
        return view('newapp.mensagem');
    }
}

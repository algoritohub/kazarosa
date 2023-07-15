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
use App\Models\Agendamento;
use App\Models\Plano;
use App\Models\ConexaoSeguir;

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

    public function PlanoDetalheApp($id)
    {
        $user  = session('usuario');
        $plano = Plano::where('plano', $id)->first();
        $valor = number_format($plano->valor,2,",",".");

        $salas_free = explode( ',', $plano->salas_free);
        $salas_desc = explode( ',', $plano->salas_desconto);

        return view('newapp.detalhe_planos', compact('plano', 'valor', 'salas_free', 'salas_desc', 'user'));
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
        $user  = session('usuario');
        $salas = Sala::where('stts', 'ativo')->orderBy('id', 'ASC')->limit(4)->get();
        $plano = Clube::where('id_user', $user->id)->first();

        return view('newapp.principal', compact('user', 'salas', 'plano'));
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

    public function perfilApp($id)
    {
        $user   = session('usuario');
        $perfil = Usuario::where('nickname', $id)->first();
        $seguir = ConexaoSeguir::where('usuario', $perfil->id)->where('seguidor', $user->id)->first();

        $posts         = Network::where('usuario', $perfil->id)->get();
        $numb_post     = count($posts);

        $seguidores    = ConexaoSeguir::where('usuario', $perfil->id)->get();
        $numb_seguidor = count($seguidores);

        $seguindo      = ConexaoSeguir::where('seguidor', $perfil->id)->get();
        $numb_seguindo = count($seguindo);

        return view('newapp.perfil', compact('user', 'perfil', 'posts', 'seguir', 'numb_seguidor', 'numb_seguindo', 'numb_post'));
    }

    public function agendamentoApp()
    {
        $user   = session('usuario');
        $agenda = Agendamento::where('user', $user->id)->orderBy('dia', 'ASC')->get();

        return view('newapp.agendamentos', compact('user', 'agenda'));
    }

    public function reservaApp($id)
    {
        $user    = session('usuario');
        $reserva = Sala::findOrFail($id);

        return view('newapp.reserva', compact('reserva', 'user'));
    }

    public function reservaDetalheApp()
    {
        $user    = session('usuario');
        $detalhe = "confirmado";

        return view('newapp.reserva_detalhe', compact('detalhe', 'user'));
    }

    public function reservaStatusApp($id, $status)
    {
        $agenda = Agendamento::findOrFail($id);
        $user   = session('usuario');

        return view('newapp.reserva_detalhe', compact('status', 'agenda', 'status', 'user'));
    }

    public function meuPlanoApp()
    {
        $user  = session('usuario');
        $plano = Clube::where('id_user', $user->id)->first();

        if($plano){

            $clube = Plano::where('plano', $plano->plano)->first();
            $valor = number_format($clube->valor,2,",",".");

            $salas_desc    = explode( ',', $clube->salas_desconto);
            $porcent_dias  = 100 * 30 / $plano->dias;
            $porcent_horas = 100 * $clube->horas / $plano->horas;

            return view('newapp.plano', compact('user', 'plano', 'clube', 'valor', 'porcent_dias', 'porcent_horas', 'salas_desc'));
        }

        else{
            return view('newapp.plano', compact('user', 'plano'));
        }
    }

    public function PlanoConfirmaApp($id)
    {
        $user  = session('usuario');
        $plano = Plano::where('plano', $id)->first();
        $valor = number_format($plano->valor,2,",",".");

        return view('newapp.confirma_plano', compact('user', 'plano', 'valor'));
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
        $user = session('usuario');

        return view('newapp.caixa_mensagens', compact('user'));
    }

    public function mensagensDetalheApp()
    {
        $user = session('usuario');

        return view('newapp.mensagem', compact('user'));
    }

    public function AppConfigura()
    {
        $user = session('usuario');

        return view('newapp.configuracao', compact('user'));
    }

    public function TodosEspacos()
    {
        $user  = session('usuario');
        $salas = Sala::where('stts', 'ativo')->orderBy('id', 'ASC')->get();

        return view('newapp.todas_salas', compact('user', 'salas'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LogRequest;
use App\Models\Usuario;
use App\Models\Carteira;
use App\Models\Carrinho;
use App\Models\Agendamento;
USE App\Models\Avalia;
use App\Models\ConexaoSeguir;
use App\Models\Network;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailRecupera;
use App\Models\ContatoCliente;
use App\Http\Requests\CadastroContatoLading;

class UsuarioController extends Controller
{
    // LADING PAGE
    public function HomeLanding()
    {
        // enviar para formulário erros de acesso
        $erro = session('erro');
        $data = [];

        if(!empty($erro)){
            $data = [
                'erro' => $erro
            ];
        }

        return view('landing', $data);
    }

    // EXIBIR PÁGINA DE LOGIN
    public function login()
    {
        // verificar se já existe uma sessão
        if(session()->has('usuario')){
            return redirect()->route('principal');
        }

        // enviar para formulário erros de acesso
        $erro = session('erro');
        $data = [];

        if(!empty($erro)){
            $data = [
                'erro' => $erro
            ];
        }

        return view('login', $data);
    }

    // LOGAR
    public function log(LogRequest $request)
    {
        // verificar se já existe uma sessão
        if(session()->has('usuario')){
            return redirect()->route('principal');
        }

        // validações
        $request->validated();

        // verificação de usuário
        $email = trim($request->input('email'));
        $senha = trim($request->input('senha'));

        $usuario = Usuario::where('email', $email)->first();

        // verificar e-mail
        if(!$usuario)
        {
            session()->flash('erro', 'O usuário não existe!');
            return redirect()->route('login');
        }

        // verificar senha
        if(!Hash::check($senha, $usuario->senha))
        {
            session()->flash('erro', 'A senha está incorreta!');
            return redirect()->route('login');
        }

        // criar a sessão
        session()->put('usuario', $usuario);
        return redirect()->route('principal');
    }

    // EXIBIR PÁGINA DE REGISTRO
    public function cadastro()
    {
        return view('cadastro');
    }

    // REGISTRAR NOVO USUÁRIO
    public function register(Request $request)
    {
        // VERIFICAÇÃO DE E-MAIL
        $verifica_mail = DB::select("SELECT * FROM usuarios WHERE email = '$request->email'");
        $bloqueador = count($verifica_mail);

        if ($bloqueador > 0) {
            return view('login', ['stts' => 'O e-mail já foi cadastrado!', 'mail' => $request->email]);
        }
        else{

            $usuario = new Usuario;
            $usuario->nome   = $request->nome;
            $usuario->email  = trim($request->email);
            $usuario->cidade = ""; // definir padrão null
            $usuario->estado = ""; // definir padrão null
            $usuario->bio    = "";
            $usuario->imagem = "usuario.png";

            $nome_user = $request->nome;

            // SEPARAR OS DOIS PRIMEIROS NOMES
            $separador_nome = explode(" ", $nome_user);
            $primeiro_nome  = $separador_nome[0];
            $segundo_nome   = $separador_nome[1];

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
            $usuario->telefone = $request->telefone;

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

            // VERIFICAR SE É PARCEIRO
            if(isset($request->nascimento) AND !empty($request->nascimento)){

                $usuario->tipo = $request->tipo;
            }

            $usuario->save();

            return view('login', ['stts' => 'Cadastro realizado com sucesso!', 'mail' => $request->email]);
        }
    }

    public function registro_registro()
    {
        return view('cadastro_parceira');
    }

    // ADICIONAR INFORMAÇÕES DO PERFIL
    public function informacao(Request $request, $id)
    {
        $informacoes = Usuario::findOrFail($id);

        // status de verificação
        $informacoes->update([
            'atuacao' => $request->atuacao,
            'bio' => $request->bio,
            'link' => $request->link,
            'telefone' => $request->telefone,
        ]);

        return redirect()->route('perfil');
    }

    public function bio(Request $request, $id)
    {
        $bio = Usuario::findOrFail($id);

        $bio->update([
            'bio' => $request->bio,
        ]);

        return view('feed');
    }

    // EDITAR PERFIL
    public function editar(Request $request, $id)
    {
        $bio = Usuario::findOrFail($id);

        $bio->update([
            'nome' => $request->nome,
            'nickname' => $request->nickname,
        ]);

        return redirect()->route('perfil');
    }

    public function alt_email(Request $request, $id)
    {
        $usuario = Usuario::where('id', $id)->first();
        $uss_session = session('usuario')['id'];

        $email = Usuario::findOrFail($id);

        // verificar senha
        if(Hash::check($request->novasenha, $usuario->senha))
        {
            $email->update([
                'email' => $request->email,
            ]);
        }

        session()->forget('usuario');
        return redirect()->route('login');
    }

    public function alt_senha(Request $request, $id)
    {
        $usuario = Usuario::where('id', $id)->first();
        $uss_session = session('usuario')['id'];

        $new_senha = Usuario::findOrFail($id);

        // verificar senha
        if(Hash::check($request->senha, $usuario->senha))
        {
            if ($request->novasenha == $request->confsenha) {

                $senha = Hash::make($request->novasenha);

                $new_senha->update([
                    'senha' => $senha,
                ]);
            }
        }

        session()->forget('usuario');
        return redirect()->route('login');
    }

    public function excluir()
    {
        session()->forget('usuario');
        return view('login');
    }

    public function recuperar()
    {
        return view('recupera');
    }

    public function verificar_rec(Request $request)
    {
        $email_ver = $request->email_rec;
        $verificar = DB::select("SELECT * FROM usuarios WHERE email = '$email_ver'");
        $ver_count = count($verificar);

        if($ver_count > 0){
            // GERAR UM NOVO CÓDIGO
            $codigo_ver = random_int(100000, 999999);

            // ID DO USUÁRIO
            $id_user = $verificar[0]->id;

            // ADICIONAR CÓDIGO AO STTS
            $alt_stts = Usuario::findOrFail($id_user);

            $alt_stts->update([
                'stts' => $codigo_ver,
            ]);

            Mail::to($email_ver)->send(new EmailRecupera($codigo_ver));

            return view('recupera', ['stts' => 'verificado', 'email_ver' => $email_ver, 'id_user' => $id_user]);
        }
        else{
            // RETORNAR
            return view('recupera');
        }
    }

    public function recuperar_senha(Request $request)
    {
        $id = $request->id_user;
        $alt_senha = Usuario::findOrFail($id);

        $codig_ver = $request->codigo;
        $email_ver = $request->email;
        $senha_ver = trim($request->senha);
        $senha_cnf = trim($request->confsenha);

        $verificar_code = DB::select("SELECT * FROM usuarios WHERE stts = '$codig_ver'");
        $count_verifica = count($verificar_code);

        if ($count_verifica > 0) {

            if ($senha_ver == $senha_cnf) {

                $senha = Hash::make($senha_ver);

                $alt_senha->update([
                    'senha' => $senha,
                    'stts' => "verificado",
                ]);

                return redirect()->route('login');
            }

            else{
                return view('recupera', ['stts' => 'verificado', 'email_ver' => $email_ver]);
            }
        }

        else{
            return view('recupera', ['stts' => 'verificado', 'email_ver' => $email_ver]);
        }
    }

    // ADICIONAR TELEFONE
    public function cadastrar_telefone(Request $request)
    {
        $uss_session = session('usuario')['id'];
        $alt_usuario = Usuario::findOrFail($uss_session);

        $alt_usuario->update([
            'telefone' => $request->telefone
        ]);

        return redirect()->route('principal');
    }

    public function ContatoCliente(CadastroContatoLading $request)
    {
        $contato = new ContatoCliente;

        $registro = date('d/m/Y');
        $nome     = $request->nome;
        $email    = $request->email;
        $telefone = $request->telefone;

        $contato->nome     = $nome;
        $contato->email    = $email;
        $contato->telefone = $telefone;
        $contato->registro = $registro;
        $contato->stts     = "novo";

        $contato->tipo     = 4;
        $contato->estado   = 1; // 1- recebido ou incluido, 2 - enviado ou respondido, 3 - retorno ou venda, 4 - não retornado


        if (!empty($nome) AND !empty($email) AND !empty($telefone)) {

            $contato->save();
            return redirect()->route('home');
        }

        return redirect()->route('home');
    }

    public function AdmContatoCliente(Request $request)
    {
        $contato = new ContatoCliente;

        $registro = date('d/m/Y');
        $nome     = $request->nome;
        $email    = $request->email;
        $telefone = $request->telefone;
        $tipo     = $request->tipo;
        $sala     = $request->sala;

        $contato->nome     = $nome;
        $contato->email    = $email;
        $contato->telefone = $telefone;
        $contato->registro = $registro;
        $contato->stts     = "novo";

        $contato->tipo     = $tipo;
        $contato->estado   = 1; // 1- recebido ou incluido, 2 - enviado ou respondido, 3 - retorno ou venda, 4 - não retornado
        $contato->sala     = $sala;


        if (!empty($nome) AND !empty($email) AND !empty($telefone)) {

            $contato->save();
            return redirect()->route('pg_newsletter');
        }

        return redirect()->route('pg_newsletter');
    }

    // MARCAR CONTATO
    public function ContatoMarcado($id)
    {
        $stts_contato = ContatoCliente::findOrFail($id);


        if($stts_contato->estado == 1){

            $stts_contato->update([
                'estado' => 2,
            ]);
        }

        elseif($stts_contato->estado == 2){

            $stts_contato->update([
                'estado' => 3,
            ]);
        }

        elseif($stts_contato->estado == 3){

            $stts_contato->update([
                'estado' => 4,
            ]);
        }

        return redirect()->route('pg_newsletter');
    }

    // REMOVER CONTATO
    public function RemoverContato($id)
    {

        ContatoCliente::findOrFail($id)->delete();
        return redirect()->route('pg_newsletter');
    }

    // LOGOUT
    public function logout()
    {
        session()->forget('usuario');
        return redirect()->route('login');
    }
}

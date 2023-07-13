<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Network;
use App\Models\ConexaoSeguir;
use App\Models\Usuario;
use App\Models\Clube;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PerfilController extends Controller
{
    // página de perfil
    public function perfil()
    {
        if(session()->has('usuario')){

            // VERIFICAÇÃO DE BLOQUEIO
            $id_user = session('usuario')['id'];

            // VERIFICAÇÃO DE PARCEIRA
            $tipov = DB::select("SELECT * FROM usuarios WHERE id = '$id_user' AND tipo = 3");

            if(!$tipov){

                $blocv = DB::select("SELECT * FROM clubes WHERE id_user = '$id_user'");
                $contv = count($blocv);

                if ($contv > 0) {

                    // VERIFICAR BLOQUEIO DE REDE
                    $blocnet = DB::select("SELECT * FROM clubes WHERE id_user = '$id_user' AND turno = 1");
                    $contnet = count($blocnet);

                    if ($contnet > 0) {

                        return view('perfil');
                    }
                    else{
                        return view('perfil', ['block_plan' => '3439887']);
                    }
                }
                else {
                    return view('perfil', ['block' => '3439887']);
                }
            }
            else{
                return view('perfil');
            }
        }
        else{
            return redirect()->route('login');
        }
    }

    // ver postagem
    public function post($id)
    {
        return view('perfil', ['ver' => $id]);
    }

    // ver postagem externa
    public function post_profile($id, $post)
    {
        return view('profile', ['nickname' => $id, 'post' => $post]);
    }

    // profile externo
    public function profile($id)
    {
        @$sessao = session('usuario')['nickname'];

        if ($sessao != $id) {
            return view('profile', ['nickname' => $id]);
        }

        else{
            return view('perfil');
        }
    }

    // seguir usuario
    public function seguir($id)
    {
        // RESGATAR INFORMAÇÕES DE QUEM VOU SEGUIR
        $usuario = Usuario::findOrFail($id);

        $info_usuario = DB::select("SELECT * FROM usuarios WHERE id = '$id'");
        $nickname = $info_usuario[0]->nickname;

        // RESGATAR DO USUARIO
        $seguidor = session('usuario')['id'];

        // VERIFICAÇÃO FORÇADA PARA NÃO SEGUIR ELE MESMO
        if ($usuario->id != $seguidor) {

            $seguir = new ConexaoSeguir;
            $seguir->seguidor = $seguidor;
            $seguir->usuario = $usuario->id;
            $seguir->stts = "ativo";

            $seguir->save();
        }

        // return Redirect::to('http://localhost:8000/'.$nickname);
        return Redirect::to('https://kazarosa.com/'.$nickname);
    }

    // deixar de seguir
    public function deixarDeSeguir($id)
    {
        $info_conects = DB::select("SELECT * FROM conexao_seguirs WHERE id = '$id'");
        $user_conects = $info_conects[0]->usuario;

        $info_usuario = DB::select("SELECT * FROM usuarios WHERE id = '$user_conects'");
        $nickname = $info_usuario[0]->nickname;

        ConexaoSeguir::findOrFail($id)->delete();

        // return Redirect::to('http://localhost:8000/'.$nickname);
        return Redirect::to('https://kazarosa.com/'.$nickname);
    }
}

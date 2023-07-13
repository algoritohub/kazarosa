<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Network;
use App\Models\Curtir;
use App\Models\Clube;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class NetworkController extends Controller
{
    // página de feed

    public function redes()
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

                        return view('feed');
                    }
                    else{
                        return view('block_plan', ['block_plan' => '3439887']);
                    }
                }
                else {
                    return view('feed', ['block' => '3439887']);
                }
            }
            else{
                return view('feed');
            }
        }
    }

    // página de feed
    public function rede()
    {
        return view('usuario_feed');
    }

    // CURTIDAS
    public function curtidas($id)
    {
        $user = session('usuario')['id'];

        // defina uma função para limitar curtidas por postagem

        $curtir = new Curtir;
        $curtir->post = $id;
        $curtir->usuario = $user;

        $postagem = Network::findOrFail($id);
        $curtidas = Network::where('id', $id)->first();

        $ver_curt = DB::select("SELECT * FROM curtirs WHERE usuario = '$user' AND post = '$id'");

        if (!$ver_curt) {

            // CRIAR REGISTRO DE CURTIDA
            $curtir->save();

            // INCREMENTAR CURTIDA
            $postagem->update([
                'curtidas' => $curtidas->curtidas + 1,
            ]);
        }

        return Redirect::to('https://kazarosa.com/feed/#post_'.$id);
        // return Redirect::to('http://localhost:8000/feed/#post_'.$id);

    }

    // exibir página de postagem
    public function exibir()
    {
        if(session()->has('usuario')){

            return view('publicar');
        }
        else{
            return redirect()->route('login');
        }
    }

    public function post($id)
    {
        $post = Network::where('id', $id)->first();

        return view('post', ['post' => $post]);
    }

    // DELETAR POSTAGEM
    public function deletar_post($id)
    {
        Network::findOrFail($id)->delete();

        return redirect()->route('perfil');
    }

    public function test()
    {
        return view('base_test');
    }
}

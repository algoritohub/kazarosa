<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;

class SalaController extends Controller
{
    // exibir página de salas
    public function salas()
    {
        if(session()->has('admin')){
 
            return view('dashboard.salas');
        }
        else{
            return redirect()->route('login_adm');
        }
    }

    // exibir lembrete
    public function show($id) 
    {
        $sala = Sala::where('id', $id)->first();
        
        if($sala){
            return view('agenda_det', ['sala' => $sala]);
        }

        else{
            return redirect()->route('agenda');
        }
    }

    // cria um novo espaço
    public function create(Request $request)
    {
        $sala = new Sala;
        $sala->nome = $request->nome;
        $sala->descricao = $request->descricao;
        $sala->minimo = $request->minimo;
        $sala->img1 = "nulla";
        $sala->img2 = "nulla";
        $sala->img3 = "nulla";
        $sala->img4 = "nulla";
        $sala->img5 = "nulla";
        $sala->stts = "imagem";

        if ($request->minimo == 2) {
            $sala->valor = "0.00";
            $sala->dual = $request->valor;
        }

        elseif ($request->minimo == 3) {
            $sala->valor = "0.00";
            $sala->dual = "0.00";
        }

        else{
            $sala->valor = $request->valor;
            $sala->dual = "0.00";
        }

        $sala->turno = $request->turno;
        $sala->diaria = $request->diaria;

        $sala->save();

        return redirect()->route('salas');
    }

    // atualizar sala
    public function atualizar(Request $request, $id)
    {
        $espaco = Sala::findOrFail($id);

        $espaco->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'minimo' => $request->minimo,
            // 'valor' => $request->valor,
            // 'dual' => $request->dual,
            'turno' => $request->turno,
            'diaria' => $request->diaria,
        ]);

        if ($request->minimo == 2) {
            $espaco->update([
                'valor' => "0.00",
                'dual' => $request->valor,
            ]);
        }
        elseif($request->minimo == 3){
            $espaco->update([
                'valor' => "0.00",
                'dual' => "0.00",
            ]);
        }
        else{
            $espaco->update([
                'valor' => $request->valor,
                'dual' => "0.00",
            ]);
        }

        return redirect()->route('salas');
    }

    // detalhe de sala
    public function detalhe($id)
    {
        $sala = Sala::where('id', $id)->first();

        return view('dashboard.detalhe_sala', ['sala' => $sala]);
    }

    // deletar sala
    public function delete($id)
    {
        Sala::findOrFail($id)->delete();

        return redirect()->route('salas');
    }
}

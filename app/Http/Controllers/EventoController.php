<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Variant;

class EventoController extends Controller
{
    // exibir página de eventos
    public function eventos()
    {
        if(session()->has('admin')){
            
            $eventos = Evento::all();
 
            return view('dashboard.eventos', ['eventos' => $eventos]);
        }
        else{
            return redirect()->route('login_adm');
        }
    }

    // criar um novo evento
    public function create(Request $request) 
    {
        $event = new Evento;

        $event->titulo = $request->titulo;
        $event->descricao = $request->descricao;
        $event->datas = $request->data;
        $event->hora = $request->hora;
        $event->quantidade = $request->quantidade;
        $event->entrada = $request->entrada;
        $event->valor = $request->valor;
        
        // UPLOAD DE IMAGEM

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {

            $requestImage = $request->imagem;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/eventos'), $imageName);
            $event->imagem = $imageName;
        }

        $event->status = "ativo";
        $event->link = $request->link;

        $event->save();

        return redirect()->route('eventos');
    }

    // criar variação de evento
    public function variacao(Request $request)
    {
        $variante = new Variant;

        $variante->evento = $request->evento;
        $variante->data = $request->data;
        $variante->hora = $request->hora;
        $variante->turno = $request->turno;
        $variante->entrada = $request->entrada;
        $variante->quantidade = $request->quantidade;
        $variante->link = $request->link;
        $variante->valor = $request->valor;
        $variante->status = 1;

        $variante->save();

        return redirect()->route('eventos');
    }

    // deletar variante
    public function delete_var($id)
    {
        Variant::findOrFail($id)->delete();

        return redirect()->route('eventos');
    }

    // atualizar evento
    public function atualizar(Request $request, $id)
    {
        $event = Evento::findOrFail($id);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {

            $requestImage = $request->imagem;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/eventos'), $imageName);
            $event->imagem = $imageName;
            
            $event->update([
                'imagem' => $event->imagem,
            ]);
        }

        $event->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'datas' => $request->data,
            'hora' => $request->hora,
            'quantidade' => $request->quantidade,
            'entrada' => $request->entrada,
            'valor' => $request->valor,
            'link' => $request->link,
        ]);

        return redirect()->route('eventos');
    }

    // detalhe de eventos
    public function show($id)
    {
        $eventos = Evento::where('id', $id)->first();

        if($eventos){
            return view('dashboard.detalhe_evento', ['eventos' => $eventos]);
        }

        else{
            return redirect()->route('eventos');
        }
    }

    // deletar evento
    public function delete($id)
    {
        Evento::findOrFail($id)->delete();

        return redirect()->route('eventos');
    }
}

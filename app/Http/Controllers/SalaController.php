<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Empresa;
use Illuminate\Http\Request;

class SalaController extends Controller
{

    public function listar(Request $request)
    {
        $query = Sala::with('empresa');

        if ($request->filled('busca')) {
            $termo = $request->busca;

            $query->where(function ($q) use ($termo) {
                $q->where('nome', 'like', '%' . $termo . '%')
                  ->orWhere('localizacao', 'like', '%' . $termo . '%');
            });
        }

        $salas = $query->orderBy('nome')->get();

        return view('salas.listar', compact('salas'));
    }

    public function create()
    {
        $empresas = Empresa::orderBy('nome')->get();

        return view('salas.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome'        => 'required|max:100',
            'capacidade'  => 'required|integer|min:1',
            'localizacao' => 'nullable|max:100',
            'empresa_id'  => 'required|exists:empresas,id',
        ], [
            'empresa_id.required' => 'Selecione a empresa responsavel pela sala.',
            'empresa_id.exists'   => 'Empresa selecionada invalida.',
        ]);

        Sala::create($dados);

        return redirect('/salas/listar')
            ->with('success', 'Sala cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $sala = Sala::findOrFail($id);
        $empresas = Empresa::orderBy('nome')->get();

        return view('salas.edit', compact('sala', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $sala = Sala::findOrFail($id);

        $dados = $request->validate([
            'nome'        => 'required|max:100',
            'capacidade'  => 'required|integer|min:1',
            'localizacao' => 'nullable|max:100',
            'empresa_id'  => 'required|exists:empresas,id',
        ], [
            'empresa_id.required' => 'Selecione a empresa responsavel pela sala.',
            'empresa_id.exists'   => 'Empresa selecionada invalida.',
        ]);

        $sala->update($dados);

        return redirect('/salas/listar')
            ->with('success', 'Sala atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $sala = Sala::findOrFail($id);

        if ($sala->agendamentos()->count() > 0) {
            return redirect('/salas/listar')
                ->with('erro', 'Nao e possivel excluir: a sala possui agendamentos.');
        }

        $sala->delete();

        return redirect('/salas/listar')
            ->with('success', 'Sala excluida com sucesso!');
    }
}

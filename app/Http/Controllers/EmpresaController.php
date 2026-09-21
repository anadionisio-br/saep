<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{

    public function listar(Request $request)
    {
        $query = Empresa::query();

        if ($request->filled('busca')) {
            $termo = $request->busca;

            $query->where(function ($q) use ($termo) {
                $q->where('nome', 'like', '%' . $termo . '%')
                  ->orWhere('responsavel', 'like', '%' . $termo . '%')
                  ->orWhere('email', 'like', '%' . $termo . '%');
            });
        }

        $empresas = $query->orderBy('nome')->get();

        return view('empresas.listar', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome'        => 'required|max:100',
            'cnpj'        => 'required|max:20',
            'responsavel' => 'nullable|max:100',
            'telefone'    => 'nullable|max:20',
            'email'       => 'nullable|email|max:100',
        ]);

        Empresa::create($dados);

        return redirect('/empresas/listar')
            ->with('success', 'Empresa cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id);

        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);

        $dados = $request->validate([
            'nome'        => 'required|max:100',
            'cnpj'        => 'required|max:20',
            'responsavel' => 'nullable|max:100',
            'telefone'    => 'nullable|max:20',
            'email'       => 'nullable|email|max:100',
        ]);

        $empresa->update($dados);

        return redirect('/empresas/listar')
            ->with('success', 'Empresa atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);

        if ($empresa->salas()->count() > 0) {
            return redirect('/empresas/listar')
                ->with('erro', 'Nao e possivel excluir: a empresa possui salas cadastradas.');
        }

        $empresa->delete();

        return redirect('/empresas/listar')
            ->with('success', 'Empresa excluida com sucesso!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Sala;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{

    public function listar(Request $request)
    {
        $agendamentos = Agendamento::with('sala.empresa')
            ->orderBy('data', 'asc')
            ->orderBy('hora_inicio', 'asc')
            ->get();

        return view('agendamento.listar', compact('agendamentos'));
    }

    public function create()
    {
        $salas = Sala::with('empresa')->orderBy('nome')->get();

        return view('agendamento.create', compact('salas'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'data'        => 'required|date',
            'hora_inicio' => 'required',
            'hora_fim'    => 'required|after:hora_inicio',
            'responsavel' => 'nullable|max:100',
            'descricao'   => 'nullable|max:255',
            'sala_id'     => 'required|exists:salas,id',
        ], [
            'hora_fim.after'   => 'A hora final deve ser maior que a hora inicial.',
            'sala_id.required' => 'Selecione a sala a ser agendada.',
        ]);

        if ($this->existeConflito($dados)) {
            return back()
                ->withInput()
                ->with('erro', 'Conflito de horario: a sala ja esta reservada nesse periodo.');
        }

        Agendamento::create($dados);

        return redirect('/agendamentos/listar')
            ->with('success', 'Agendamento cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $salas = Sala::with('empresa')->orderBy('nome')->get();

        return view('agendamento.edit', compact('agendamento', 'salas'));
    }

    public function update(Request $request, $id)
    {
        $agendamento = Agendamento::findOrFail($id);

        $dados = $request->validate([
            'data'        => 'required|date',
            'hora_inicio' => 'required',
            'hora_fim'    => 'required|after:hora_inicio',
            'responsavel' => 'nullable|max:100',
            'descricao'   => 'nullable|max:255',
            'sala_id'     => 'required|exists:salas,id',
        ], [
            'hora_fim.after'   => 'A hora final deve ser maior que a hora inicial.',
            'sala_id.required' => 'Selecione a sala a ser agendada.',
        ]);

        if ($this->existeConflito($dados, $agendamento->id)) {
            return back()
                ->withInput()
                ->with('erro', 'Conflito de horario: a sala ja esta reservada nesse periodo.');
        }

        $agendamento->update($dados);

        return redirect('/agendamentos/listar')
            ->with('success', 'Agendamento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Agendamento::destroy($id);

        return redirect('/agendamentos/listar')
            ->with('success', 'Agendamento excluido com sucesso!');
    }

    private function existeConflito(array $dados, $ignorarId = null)
    {
        $query = Agendamento::where('sala_id', $dados['sala_id'])
            ->where('data', $dados['data'])
            ->where('hora_inicio', '<', $dados['hora_fim'])
            ->where('hora_fim', '>', $dados['hora_inicio']);

        if ($ignorarId) {
            $query->where('id', '!=', $ignorarId);
        }

        return $query->exists();
    }
}

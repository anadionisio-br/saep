<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function login()
    {
        return view('login');
    }


    public function autenticar(Request $request)
    {
        
        $dados = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|min:4',
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email'    => 'Informe um e-mail valido.',
            'senha.required' => 'Informe a senha.',
            'senha.min'      => 'A senha deve ter pelo menos 4 caracteres.',
        ]);

        
        $usuario = User::where('email', $dados['email'])
            ->whereRaw('senha = SHA2(?, 256)', [$dados['senha']])
            ->first();

       
        if (!$usuario) {
            return back()
                ->withInput($request->only('email'))
                ->with('erro', 'E-mail ou senha invalidos.');
        }

        $request->session()->regenerate();

        $request->session()->put('usuario_id', $usuario->id);
        $request->session()->put('usuario_nome', $usuario->nome);
        $request->session()->put('usuario_email', $usuario->email);
        $request->session()->put('ultimo_acesso', time());

        return redirect('/principal');
    }


    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/login')->with('erro', 'Voce saiu do sistema.');
    }
}

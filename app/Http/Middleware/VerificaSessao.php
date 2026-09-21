<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Protege as rotas internas do sistema.
 *
 * Bloqueia o acesso de quem nao esta autenticado e tambem de quem
 * ficou inativo por mais tempo que o limite configurado
 * (SESSION_LIFETIME no arquivo .env - padrao: 30 minutos).
 */
class VerificaSessao
{
    public function handle(Request $request, Closure $next)
    {
        // Nao ha usuario na sessao -> nunca logou ou a sessao expirou
        if (!$request->session()->has('usuario_id')) {
            return redirect('/login')
                ->with('erro', 'Sua sessao expirou. Faca login novamente.');
        }

        // Controle adicional de expiracao por inatividade
        $limiteMinutos = (int) config('session.lifetime');
        $ultimoAcesso  = $request->session()->get('ultimo_acesso');

        if ($ultimoAcesso && (time() - $ultimoAcesso) > ($limiteMinutos * 60)) {
            $request->session()->flush();

            return redirect('/login')
                ->with('erro', 'Sua sessao expirou por inatividade. Faca login novamente.');
        }

        // Renova o marcador de atividade a cada requisicao valida
        $request->session()->put('ultimo_acesso', time());

        return $next($request);
    }
}

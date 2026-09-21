<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_tela_de_login_e_exibida(): void
    {
        $this->get('/login')->assertStatus(200);
    }

    public function test_acesso_sem_sessao_redireciona_para_login(): void
    {
        $this->get('/principal')->assertRedirect('/login');
    }
}

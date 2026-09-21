<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Carga inicial equivalente ao arquivo saep_db.sql.
 * Execute com: php artisan db:seed
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement("INSERT INTO usuarios (nome, email, senha, created_at, updated_at) VALUES
            ('Administrador',   'admin@saep.com',    SHA2('123456', 256), NOW(), NOW()),
            ('Carlos Oliveira', 'carlos@saep.com',   SHA2('123456', 256), NOW(), NOW()),
            ('Mariana Santos',  'mariana@saep.com',  SHA2('123456', 256), NOW(), NOW())");

        DB::statement("INSERT INTO empresas (nome, cnpj, responsavel, telefone, email, created_at, updated_at) VALUES
            ('Alfa Tecnologia LTDA',  '12345678000190', 'Joao da Silva',  '(16) 99999-1111', 'contato@alfatec.com.br', NOW(), NOW()),
            ('Beta Consultoria ME',   '98765432000155', 'Maria Oliveira', '(16) 98888-2222', 'contato@betacon.com.br', NOW(), NOW()),
            ('Gama Treinamentos S/A', '11222333000181', 'Carlos Santos',  '(16) 97777-3333', 'contato@gamatrein.com.br', NOW(), NOW())");

        DB::statement("INSERT INTO salas (nome, capacidade, localizacao, empresa_id, created_at, updated_at) VALUES
            ('Sala Executiva A',    10, 'Bloco A - 1o andar', 1, NOW(), NOW()),
            ('Auditorio Central',   60, 'Bloco B - Terreo',   2, NOW(), NOW()),
            ('Sala de Treinamento', 25, 'Bloco B - 1o andar', 3, NOW(), NOW())");

        DB::statement("INSERT INTO agendamentos (data, hora_inicio, hora_fim, responsavel, descricao, sala_id, created_at, updated_at) VALUES
            ('2026-10-05', '08:00:00', '10:00:00', 'Joao da Silva',  'Reuniao de alinhamento', 1, NOW(), NOW()),
            ('2026-10-06', '09:00:00', '12:00:00', 'Maria Oliveira', 'Apresentacao anual',     2, NOW(), NOW()),
            ('2026-10-07', '13:00:00', '17:00:00', 'Carlos Santos',  'Treinamento tecnico',    3, NOW(), NOW())");
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Estrutura do banco saep_db (equivalente ao arquivo saep_db.sql).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('email', 100)->unique();
            $table->string('senha', 255);       // hash SHA-256 (dado sensivel)
            $table->timestamps();
        });

        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('cnpj', 255);        // criptografado (dado sensivel)
            $table->string('responsavel', 100)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('salas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->integer('capacidade');
            $table->string('localizacao', 100)->nullable();
            $table->unsignedInteger('empresa_id');
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas');
        });

        Schema::create('agendamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->string('responsavel', 100)->nullable();
            $table->string('descricao', 255)->nullable();
            $table->unsignedInteger('sala_id');
            $table->timestamps();

            $table->foreign('sala_id')->references('id')->on('salas');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
        Schema::dropIfExists('salas');
        Schema::dropIfExists('empresas');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('sessions');
    }
};

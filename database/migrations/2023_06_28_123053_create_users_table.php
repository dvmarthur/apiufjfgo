<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('curso');
            $table->string('matricula')->nullable(); // Adiciona campo 'matricula' que pode ser nulo
            $table->string('cnh')->nullable(); // Adiciona campo 'numero_carteira_motorista' que pode ser nulo
            $table->string('password');
            $table->bigInteger('phone')->unique();
            $table->string('photo');
            $table->unsignedBigInteger('user_type_id'); // Chave estrangeira
            $table->timestamps();
            // Relacionamento com a tabela 'user_types'
            $table->foreign('user_type_id')->references('id')->on('user_types');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

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
            $table->string('matricula')->unique();
            $table->string('cnh')->nullable(); // Adiciona campo 'cnh' que pode ser nulo
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('photo')->nullable();
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

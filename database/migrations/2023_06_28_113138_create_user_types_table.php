<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            // Adicione aqui outros campos relacionados aos tipos de usuários
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->dateTime('datetime');
            $table->integer('passengers')->default(0);
            $table->integer('vagas')->default(0);
            $table->string('from_adress');
            $table->string('to_adress');
            $table->unsignedBigInteger('driver_user_id');
            $table->foreign('driver_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};

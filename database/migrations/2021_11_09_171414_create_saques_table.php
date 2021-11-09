<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saques', function (Blueprint $table) {
            $table->id();
            $table->foreignID('conta_id')->constrained();
            $table->double('valor_saque', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saques');


        Schema::table('saques', function (Blueprint $table) {
            $table->foreignId('conta_id')
            ->constrained()
            ->onDelete('cascade');
        });

    }
}

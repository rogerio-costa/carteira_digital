<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignID('account_id')->constrained();
            $table->foreignID('transaction_type_id')->constrained();
            $table->text('note')->nullable();
            $table->double('value', 10, 2);
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
        Schema::dropIfExists('transactions');

        Schema::table('transactions', function (Blueprint $table) {

            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->foreignId('transaction_type_id')->constrained()->onDelete('cascade');

        });

    }
}

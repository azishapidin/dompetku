<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->date('date')->nullable();
            $table->string('description');
            $table->string('type');
            $table->decimal('amount', 13);
            $table->decimal('balance', 13);
            $table->timestamps();

            // Foreign
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserInformationsOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->string('bio')->after('remember_token')->nullable();
            $table->string('default_currency')->after('bio')->nullable();
            $table->string('show_stats_on_dashboard')->after('default_currency')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('bio');
            $table->dropColumn('default_currency');
            $table->dropColumn('show_stats_on_dashboard');
        });
    }
}

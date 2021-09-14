<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('applications', function (Blueprint $table) {
            $table->string('mobile', 13);
            $table->foreignId('bank_id');
            $table->float('interest_rate', 8, 2);
            $table->float('amount', 11, 2);
            $table->integer('years');
            $table->enum('status',['pending','submitted','processed']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['mobile', 'bank_id', 'interest_rate', 'amount', 'years', 'status']);
        });
    }
}

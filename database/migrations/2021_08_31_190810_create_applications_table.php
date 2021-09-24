<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->date('dob');
            $table->enum('gender',['male','female']);
            $table->enum('employment',['salaried','business']);
            $table->float('income', 8, 2);
            $table->float('existing_emi', 8, 2);
            $table->integer('property_price');
            $table->integer('required_amount');
            $table->boolean('first_home');
            $table->string('mobile', 13);
            $table->foreignId('bank_id');
            $table->float('interest_rate', 8, 2);
            $table->float('amount', 11, 2);
            $table->integer('years');
            $table->enum('status',['pending','submitted','processed']);
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
        Schema::dropIfExists('applications');
    }
}

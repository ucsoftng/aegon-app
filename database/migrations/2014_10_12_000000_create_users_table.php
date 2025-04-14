<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('credit');
            $table->string('debit');
            $table->string('acct_no');
            $table->string('otp');
            $table->dateTime('date');
            $table->string('block');
            $table->dateTime('time');
            $table->string('id_no');
            $table->string('phone');
            $table->string('image');
            $table->longText('address');
            $table->string('dob');
            $table->string('status');
            $table->string('account_type');
            $table->string('sex');
            $table->string('city');
            $table->string('zip');
            $table->string('state');
            $table->string('country');
            $table->string('valid_id');
            $table->string('preferred_currency');
            $table->string('security_question');
            $table->string('answer');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function(){
            DB::table('users')->insert([
                'name'      => 'Superadmin SUSHIB3SD',
                'email'     => "sushib3sd@gmail.com",
                'password'  => bcrypt("Password#2023"),
                'role'      => "Admin"
            ]);
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
    }
}

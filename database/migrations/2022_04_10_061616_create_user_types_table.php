<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->primary('id');
            $table->string('name', 15)->unique();
        });

        DB::table('user_types')->insert([
            'name' => 'Admin',
            'id' => 1
        ]);
        DB::table('user_types')->insert([
            'name' => 'School Admin',
            'id' => 2
        ]);
        DB::table('user_types')->insert([
            'name' => 'Teacher',
            'id' => 3
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_type');
            $table->foreign('user_type')->references('id')->on('user_types');
        });

        DB::table('users')->insert([
            'name' => "Admin",
            'username' => "admin",
            'password' => Hash::make('password'),
            'user_type' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_type']);
            $table->dropColumn('user_type');
        });
        Schema::dropIfExists('user_types');
    }
};

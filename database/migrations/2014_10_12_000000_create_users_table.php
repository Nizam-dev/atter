<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto')->nullable()->default("profil.png");
            $table->string('bg')->nullable()->default("cover.png");
            $table->string('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('website')->nullable();
            $table->enum('role', ['admin', 'user']);
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'admin@atter.com',
            'password' => bcrypt('admin123'),
            'role'=>'admin'
        ]);
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

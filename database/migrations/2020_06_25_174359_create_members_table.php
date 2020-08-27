<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('username', 100);
            $table->string('email', 200);
            $table->string('password', 200);
            $table->string('phone', 100);
            $table->string('qid');
            $table->text('profile_pic');
            $table->enum('notification', ['on', 'off']);
            $table->enum('status', ['Enable', 'Disable'])->default('Enable');
            // $table->timestamps();
            // $table->nullableTimestamps();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}

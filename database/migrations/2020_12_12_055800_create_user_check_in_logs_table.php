<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCheckInLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_check_in_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('year')->comment('年');
            $table->unsignedInteger('month')->comment('月');
            $table->unsignedInteger('day')->comment('天');
            $table->unsignedInteger('user_id')->index()->comment('用户id');
            $table->json('rest')->nullable()->comment('非核心字段冗余');
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
        Schema::dropIfExists('user_check_in_logs');
    }
}

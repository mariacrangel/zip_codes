<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->integer('key')->unsigned();
            $table->string('name', 200);
            $table->integer('zip_code')->unsigned();
            $table->integer('type')->unsigned();
            $table->enum('zone', ['Rural', 'Urbano']);
            $table->integer('city')->unsigned()->nullable();
            $table->integer('entity')->unsigned()->nullable();
            $table->integer('municipality')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->foreign('municipality')->references('key')->on('municipalities')->onDelete('cascade');
            $table->foreign('entity')->references('key')->on('entities')->onDelete('cascade');
            $table->foreign('type')->references('key')->on('settlement_types')->onDelete('cascade');
            $table->primary(['key','municipality','entity']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlements');
    }
}

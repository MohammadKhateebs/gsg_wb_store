<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('categories', function (Blueprint $table) {

            //id BIGINT UNSIGEND AUTO_INCREMENT PRIMARY
            //All of it do seem $table->id();
            // $table->bigInteger('id')->unsigned()
            //     ->autoIncrement()->primary();
            // $table->unsignedBigInteger('id')->autoIncrement();
            // $table->bigIncrements('id');
            $table->id();

            // $table->unsignedBigInteger('parent_id')->nullable();
            // $table->foreign('parent_id')
            //     ->references('id')
            //     ->on('categories')
            //     ->onDelete('set null')
            //     ->onUpdate('set null');
            $table->foreignId('parent_id')
            ->nullable()
            ->constrained('categories','id')
            ->nullOnDelete()
            ->nullOnUpdate();
            //to use varchar we use string method
            //varchar(255)
            // $table->string('name',255);
            $table->string('name'); //use default value 255
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            //created_at , updated_at TimeStamp
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
        Schema::dropIfExists('categories');
    }
};

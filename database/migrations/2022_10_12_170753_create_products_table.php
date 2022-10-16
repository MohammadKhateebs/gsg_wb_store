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
    //double 10.654646546545646
    //float 20.32656656
    //decimal select how the lentgh of the number
    //double use in map location because the Precision is more than float
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')
                ->constrained('categories', 'id'); //restract on delete
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedFloat('price');
            $table->unsignedFloat('compare_price')->nullable(); //the sales at the product
            $table->unsignedFloat('cost')->nullable(); //to calculate profits

            $table->unsignedSmallInteger('quantity')->default(0);
            $table->string('sku')->unique()->nullable(); //sku :stoke keeping unite
            $table->string('barcode')->nullable();
            //status : active:1 , draft(مسوده):2 , archived(history):3
            //  $table->unsignedSmallInteger('status');
            //enum : that allow to select whate the value you went just
            $table->enum('status', ['active', 'draft', 'archived'])->default('active');
            $table->enum('availability', ['in-stoke', 'out-of-stoke', 'back-order'])
                ->default('in-stoke');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
};

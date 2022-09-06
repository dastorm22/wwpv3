<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oferts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('upc')->unsigned();
            $table->string('name')->nullable();
            $table->string('description')->default(1)->index()->comment('If false, this source will not be processed')->nullable();
            $table->string('brand')->nullable()->comment('Brand of the product');
            $table->string('category')->nullable()->comment('Category or type of the product');
            $table->integer('stock')->unsigned()->nullable()->comment('Current amount in stock');
            $table->decimal('price', 6, 2)->nullable();
            $table->string('sku')->nullable()->comment('Internal product id of a company');
            $table->boolean('is_enabled')->default(1)->index()->comment('If false, this source will not be processed');
            $table->string('vendor')->nullable();
            $table->string('offer')->nullable();
            $table->string('file')->nullable(); 
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
        Schema::dropIfExists('oferts');
    }
}

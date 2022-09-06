<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('import_batch_id')->unsigned()->comment('Import batch for this product');

            $table->bigInteger('upc')->unsigned();
            $table->string('name')->nullable()->comment('Name or description of the product');
            $table->string('brand')->nullable()->comment('Brand of the product');
            $table->string('category')->nullable()->comment('Category or type of the product');
            $table->integer('stock')->unsigned()->nullable()->comment('Current amount in stock');
            $table->decimal('price', 6, 2)->nullable();
            $table->string('sku')->nullable()->comment('Internal product id of a company');

            $table->timestamps();

            $table->foreign('import_batch_id')->references('id')->on('import_batches')->onDelete('cascade');
            $table->foreign('upc')->references('upc')->on('upcs');
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
}

<?php

use App\Source;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('type');
            $table->text('url')->nullable();
            $table->string('filename')->nullable();
            $table->boolean('is_main')->nullable()->index()->comment('True for the main source all others are compared against');
            $table->boolean('is_enabled')->nullable()->index()->comment('If false, this source will not be processed');
            $table->tinyInteger('skip_rows')->default(1)->comment('Number of rows to be skipped');

            $table->tinyInteger('column_upc')->nullable();
            $table->tinyInteger('column_name')->nullable();
            $table->tinyInteger('column_brand')->nullable();
            $table->tinyInteger('column_category')->nullable();
            $table->tinyInteger('column_stock')->nullable();
            $table->tinyInteger('column_price')->nullable();
            $table->tinyInteger('column_sku')->nullable();

            $table->timestamps();
        });

        Source::create([
            'name' => 'WWP',
            'type' => Source::TYPE_LOCAL,
            'filename' => 'pricelist_all.xlsx',
            'is_main' => true,
            'is_enabled' => true,
            'skip_rows' => 5,

            'column_upc' => 2,
            'column_name' => 1,
            'column_brand' => 8,
            'column_category' => 7,
            'column_stock' => 4,
            'column_price' => 3,
            'column_sku' => 0,
        ]);

        Source::create([
            'name' => 'Source 2',
            'type' => Source::TYPE_LOCAL,
            'filename' => 'pricelist_2.xlsx',
            'is_enabled' => true,
            'skip_rows' => 5,

            'column_upc' => 2,
            'column_name' => 1,
            'column_brand' => 8,
            'column_category' => 7,
            'column_stock' => 4,
            'column_price' => 3,
            'column_sku' => 0,
        ]);

        Source::create([
            'name' => 'Source 3',
            'type' => Source::TYPE_LOCAL,
            'filename' => 'pricelist_all.xlsx',
            'is_enabled' => true,
            'skip_rows' => 5,

            'column_upc' => 2,
            'column_name' => 1,
            'column_brand' => 8,
            'column_category' => 7,
            'column_stock' => 4,
            'column_price' => 3,
            'column_sku' => 0,
        ]);

        Source::create([
            'name' => 'Source 4',
            'type' => Source::TYPE_LOCAL,
            'filename' => 'pricelist_all.xlsx',
            'is_enabled' => true,
            'skip_rows' => 5,

            'column_upc' => 2,
            'column_name' => 1,
            'column_brand' => 8,
            'column_category' => 7,
            'column_stock' => 4,
            'column_price' => 3,
            'column_sku' => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sources');
    }
}

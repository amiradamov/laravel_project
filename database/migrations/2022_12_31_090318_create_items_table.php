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
        // Schema::dropIfExists('items');
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->float('item_price', 8, 2);
            $table->foreignId('category_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->text('item_description');
            $table->binary('item_image')->nullable();
            $table->json('item_ingredients')->nullable();
            $table->boolean('item_status')->default(1);
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
        Schema::dropIfExists('items');
    }
};

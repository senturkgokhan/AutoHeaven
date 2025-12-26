<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text("title");
            $table->text('description');
            $table->unsignedBigInteger('model_id');
            $table->date('year');
            $table->tinyInteger('color');
            $table->unsignedInteger('km');
            $table->tinyInteger('guarantee');
            $table->tinyInteger('gear_type')->comment('1-Manuel 2-Automatic 3-Semiautomatic');
            $table->tinyInteger('fuel_type')->comment('1-Gasoline 2-Diesel 3-LPG 4-Electric');
            $table->unsignedBigInteger('damage_id');
            $table->unsignedInteger('price');
            $table->string("media")->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
            ->on('users')
            ->references('id')
            ->onDelete('cascade');

            $table->foreign('model_id')
            ->on('car_models')
                ->references('id')
                ->onDelete('cascade');

            $table->foreign('damage_id')
            ->on('car_damages')
                ->references('id')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

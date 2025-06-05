<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->string('lifespan')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('coat')->nullable();
            $table->string('color')->nullable();
            $table->text('temperament')->nullable();
            $table->string('energy_level')->nullable();
            $table->string('grooming')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
   public function down()
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn([
                'lifespan',
                'weight',
                'height',
                'coat',
                'color',
                'temperament',
                'energy_level',
                'grooming'
            ]);
        });
    }

};

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
        Schema::table('pets', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable()->after('name');
            $table->string('gender')->nullable()->after('price');
            $table->text('other_details')->nullable()->after('gender');
        });
    }

    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn(['price', 'gender', 'other_details']);
        });
    }
};

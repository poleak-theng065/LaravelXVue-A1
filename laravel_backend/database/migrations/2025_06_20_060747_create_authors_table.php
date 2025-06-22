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
     Schema::create('authors', function (Blueprint $table) {
        $table->id(); // auto_increment primary key
        $table->string('name', 100);
        $table->string('DOB', 250);
        $table->integer('NumberOfWrittenBook'); // just an integer, no auto_increment
        $table->string('nationality', 150);
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};

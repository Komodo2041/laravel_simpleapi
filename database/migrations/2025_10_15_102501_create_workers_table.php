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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->integer("company_id");
            $table->string("name", 30);
            $table->string("surname", 30);
            $table->string("email", 30);
            $table->string("phone", 20)->nullable(true);            
            $table->timestamps();

            $table->foreign("company_id")->references('id')->on('company')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};

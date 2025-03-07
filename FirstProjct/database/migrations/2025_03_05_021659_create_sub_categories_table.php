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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignID('category_id')->constrained()->onDelete('cascade'); // when you do constrained then if the category id gets deleted then all the sub-category under that category will get deleted too . onDelete('cascade') means that the sub-category is connected with the category as child and parent . 
            $table->string('subcategory_name');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};

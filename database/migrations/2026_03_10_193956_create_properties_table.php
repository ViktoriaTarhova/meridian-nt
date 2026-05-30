<?php
// database/migrations/2024_01_01_000002_create_properties_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->decimal('price', 12, 2);
            $table->float('area');
            $table->integer('rooms')->nullable(); // <-- ИЗМЕНИТЬ: добавить ->nullable()
            $table->integer('floor')->nullable();
            $table->string('building_type')->nullable();
            $table->float('land_area')->nullable();
            $table->string('type')->default('apartment');
            $table->json('images')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};

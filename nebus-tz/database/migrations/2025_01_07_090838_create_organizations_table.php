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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название организации
            $table->text('phone_numbers')->nullable(); // Массив телефонов (тип text[])
            $table->unsignedBigInteger('building_id'); // Внешний ключ на здание
            $table->timestamps();

            // Внешний ключ на таблицу buildings
            $table->foreign('building_id')
                ->references('id')
                ->on('buildings')
                ->onDelete('cascade');
        });

        // Таблица связей между организациями и деятельностями
        Schema::create('activity_organization', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('activity_id');
            $table->timestamps();

            // Внешний ключ на organization
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');

            // Внешний ключ на activity
            $table->foreign('activity_id')
                ->references('id')
                ->on('activities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('activity_organization');
    }
};

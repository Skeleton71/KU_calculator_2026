<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bmi_records', function (Blueprint $table) {
            $table->id();
            $table->float('weight');
            $table->float('height');
            $table->float('bmi');
            $table->string('category');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bmi_records');
    }
};
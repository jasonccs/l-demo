<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


return new class extends Migration
{
    public function up()
    {
        Schema::create('error_logs', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->unique();
            $table->string('error_type');
            $table->text('error_message');
            $table->text('error_trace')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_logs');
    }
};

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
        Schema::create('team_powers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->integer('fan_support')->default(0);
            $table->integer('team_spirit')->default(0);
            $table->integer('attack')->default(50);
            $table->integer('defense')->default(50);

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_powers');
    }
};

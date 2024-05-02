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
        Schema::create('reservation', function (Blueprint $table) {
            $table->increments('res_id');
            $table->unsignedInteger('res_uti_id');
            $table->unsignedInteger('res_sal_id');
            $table->timestamp('res_heure_debut')->useCurrent();
            $table->timestamp('res_heure_fin')->useCurrent()->onUpdate('CURRENT_TIMESTAMP');
            $table->foreign('res_uti_id')->references('uti_id')->on('utilisateur');
            $table->foreign('res_sal_id')->references('sal_id')->on('salle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};

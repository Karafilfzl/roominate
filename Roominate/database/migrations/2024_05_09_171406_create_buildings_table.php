<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_buildings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('address', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buildings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crews', function (Blueprint $table) {
            $table->id();
            $table->string('crewid', 100);
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('middlename', 100);
            $table->string('email', 100);
            $table->string('address', 100);
            $table->string('education', 100);
            $table->string('contactnumber', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crews');
    }
};

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
        $this->down();
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('documentid', 100);
            $table->string('code', 100);
            $table->string('crewid', 100);
            $table->string('name', 100);
            $table->string('documentnumber', 100);
            $table->date('dateissued')->nullable();
            $table->date('dateexpiry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};

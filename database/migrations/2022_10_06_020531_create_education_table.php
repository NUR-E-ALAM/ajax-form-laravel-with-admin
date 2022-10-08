<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'exam_name','university','boards','results'
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->string('exam_name')->nullable();
            $table->string('university')->nullable();
            $table->string('boards')->nullable();
            $table->string('results')->nullable();
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
        Schema::dropIfExists('education');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'name','email','phone','division','district','upazila','address','language','images','cv','training'
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('division');
            $table->integer('district');
            $table->integer('upazila');
            $table->text('address');
            $table->string('language')->nullable();
            $table->string('images')->nullable();
            $table->string('cv')->nullable();
            $table->string('training')->nullable();
            $table->string('training_name')->nullable();
            $table->string('training_details')->nullable();
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
        Schema::dropIfExists('applications');
    }
}

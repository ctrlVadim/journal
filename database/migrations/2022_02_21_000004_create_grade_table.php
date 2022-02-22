<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('student')->onDelete('CASCADE');
            $table->foreignId('subject_id')->nullable()->constrained('subject')->onDelete('CASCADE');
            $table->date('date')->nullable();
            $table->enum('grade', [1, 2, 3, 4, 5])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade');
    }
}

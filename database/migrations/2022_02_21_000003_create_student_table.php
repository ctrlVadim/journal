<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('surname', 50)->nullable();
            $table->string('patronymic', 50)->nullable();
            $table->enum('gender', ['М', 'Ж'])->nullable();
            $table->timestamp('birth')->nullable();
            $table->enum('parents', ['Нет', 'Отец', 'Мать', 'Отец и мать'])->nullable();
            $table->string('address')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('passport_data')->nullable();
            $table->integer('report_card')->nullable();
            $table->timestamp('date_of_admission')->nullable();
            $table->string('group', 10)->nullable();
            $table->tinyInteger('course')->nullable();
            $table->foreignId('speciality_id')->nullable()->constrained('speciality')->onDelete('CASCADE');
            $table->boolean('form_of_study')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}

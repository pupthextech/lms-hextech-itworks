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
        Schema::create('book_issues', function (Blueprint $table) {
            $table->id();
            $table->string('book_isbn');
            $table->string('student_number');
            $table->dateTime('date_issued')->useCurrent();
            $table->dateTime('expected_return_date');
            $table->dateTime('return_date')->nullable();
            $table->string('book_issue_status')->default('To Return');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_issues');
    }
};

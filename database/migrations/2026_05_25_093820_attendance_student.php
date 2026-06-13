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
            Schema::create('attendances', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('class_id')
                ->constrained('classes')
                ->onDelete('cascade');

            $table->date('date');

            $table->string('subject');

            // Attendance for each day
            $table->enum('monday', ['present', 'absent', 'late'])->nullable();

            $table->enum('tuesday', ['present', 'absent', 'late'])->nullable();

            $table->enum('wednesday', ['present', 'absent', 'late'])->nullable();

            $table->enum('thursday', ['present', 'absent', 'late'])->nullable();

            $table->enum('friday', ['present', 'absent', 'late'])->nullable();

            $table->enum('saturday', ['present', 'absent', 'late'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

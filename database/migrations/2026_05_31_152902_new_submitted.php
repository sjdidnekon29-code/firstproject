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
          Schema::create('assignment_submitted', function (Blueprint $table) {
            $table->id();

            $table->integer('assignment_id');
            
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->text('answer')->nullable();
            $table->string('file')->nullable();

            $table->integer('marks')->nullable();
            $table->text('feedback')->nullable();

            $table->enum('status', [
                'submitted',
                'reviewed',
                'late'
            ])->default('submitted');

            $table->timestamp('submitted_at')->nullable();

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

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
        Schema::create('employer_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')
                ->constrained('employer_details')
                ->onDelete('cascade');

            $table->string('branch_name');

            $table->string('branch_email')->nullable();

            $table->string('branch_mobile')->nullable();

            $table->string('branch_manager')->nullable();

            $table->text('branch_address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_branches');
    }
};

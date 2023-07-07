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
        Schema::create('procurement_data', function (Blueprint $table) {
            $table->id();
            $table->string('firm_name');
            $table->string('certificate_number');
            $table->string('agpo_cert_no');
            $table->unsignedBigInteger('category_id');
            $table->json('directors'); // Storing as JSON to allow multiple values
            $table->string('postal_address');
            $table->string('email');
            $table->string('mobile_number');
            $table->decimal('amount', 10, 2); // Consider an appropriate size for your use case
            $table->unsignedBigInteger('spend_category_id');
            $table->string('procurement_number');
            $table->string('procurement_method');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('spend_category_id')->references('id')->on('spend_categories');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurement_data');
    }
};

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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('phone');
            $table->string('email');
            $table->string('whatsapp_number');
            $table->string('telegram_number');
            $table->string('fb_page');
            $table->string('fb_link');
            $table->string('twitter_link');
            $table->string('linkdin_link');
            $table->string('whatapps_link');
            $table->text('address');
            $table->text('details');
            $table->text('vision');
            $table->string('logo')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

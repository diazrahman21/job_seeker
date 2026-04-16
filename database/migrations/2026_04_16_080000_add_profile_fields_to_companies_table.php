<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('industry')->nullable()->after('location');
            $table->enum('company_size', ['1-50', '51-200', '201-500', '501-1000', '1000+'])->nullable()->after('industry');
            $table->integer('founded_year')->nullable()->after('company_size');
            $table->string('phone')->nullable()->after('founded_year');
            $table->string('social_media')->nullable()->comment('JSON format: {"linkedin": "...", "twitter": "...", "instagram": "..."}')->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['industry', 'company_size', 'founded_year', 'phone', 'social_media']);
        });
    }
};

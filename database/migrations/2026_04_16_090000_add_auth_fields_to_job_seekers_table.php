<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_seekers', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('user_id');
            $table->string('provider_id')->nullable()->after('provider');
            $table->string('avatar')->nullable()->after('provider_id');
            $table->boolean('is_verified')->default(false)->after('avatar');
            $table->string('otp_code')->nullable()->after('is_verified');
            $table->timestamp('otp_expired_at')->nullable()->after('otp_code');

            $table->index(['provider', 'provider_id']);
            $table->index('is_verified');
        });
    }

    public function down(): void
    {
        Schema::table('job_seekers', function (Blueprint $table) {
            $table->dropIndex(['provider', 'provider_id']);
            $table->dropIndex(['is_verified']);
            $table->dropColumn([
                'provider',
                'provider_id',
                'avatar',
                'is_verified',
                'otp_code',
                'otp_expired_at',
            ]);
        });
    }
};

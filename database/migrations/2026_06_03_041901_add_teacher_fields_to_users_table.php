<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->unique()->after('email');
            $table->string('google_id')->nullable()->unique()->after('phone');
            $table->foreignId('district_id')->nullable()->constrained()->nullOnDelete()->after('google_id');
            $table->string('upazila')->nullable()->after('district_id');
            $table->string('school_name')->nullable()->after('upazila');
            $table->string('designation')->nullable()->after('school_name');
            $table->string('avatar')->nullable()->after('designation');
            $table->boolean('is_admin')->default(false)->after('avatar');
            $table->boolean('is_active')->default(true)->after('is_admin');
            $table->string('otp_code', 6)->nullable()->after('is_active');
            $table->timestamp('otp_expires_at')->nullable()->after('otp_code');
            $table->string('mobile_verified_at')->nullable()->after('otp_expires_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'google_id', 'district_id', 'upazila', 'school_name',
                'designation', 'avatar', 'is_admin', 'is_active',
                'otp_code', 'otp_expires_at', 'mobile_verified_at',
            ]);
        });
    }
};

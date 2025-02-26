<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('swarm_uid')->after('id');
            $table->string('username')->after('name');
            $table->string('currency_code')->after('password');
            $table->string('country_code')->after('currency_code');
            $table->string('phone_number')->after('country_code');
            $table->string('btag')->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'currency_code', 'country_code', 'phone_number', 'btag']);
        });
    }
};

<?php
// database/migrations/2024_04_20_xxxxxx_add_social_fields_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telegram')->nullable()->after('phone');
            $table->string('whatsapp')->nullable()->after('telegram');
            $table->string('vk')->nullable()->after('whatsapp');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['telegram', 'whatsapp', 'vk']);
        });
    }
};

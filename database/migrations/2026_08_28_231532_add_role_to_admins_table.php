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
       // Mengecek apakah tabel admins SUDAH punya kolom 'role'
       if (!Schema::hasColumn('admins', 'role')) {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('role')->default('super_admin')->after('email'); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('admins', 'role')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};

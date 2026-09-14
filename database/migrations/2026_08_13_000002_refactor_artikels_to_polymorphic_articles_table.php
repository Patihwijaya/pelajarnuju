<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->renameColumn('judul', 'title');
            $table->renameColumn('isi', 'content');

            $table->unsignedBigInteger('authorable_id')->nullable()->after('id');
            $table->string('authorable_type')->nullable()->after('authorable_id');

            $table->unsignedBigInteger('verifier_id')->nullable()->after('status');
            $table->string('verifier_type')->nullable()->after('verifier_id');

            $table->index(['authorable_type', 'authorable_id']);
        });

        DB::table('artikels')
            ->whereNotNull('admin_id')
            ->update([
                'authorable_type' => Admin::class,
                'authorable_id' => DB::raw('admin_id'),
            ]);

        DB::table('artikels')
            ->whereNotNull('user_id')
            ->update([
                'authorable_type' => User::class,
                'authorable_id' => DB::raw('user_id'),
            ]);

        DB::statement("ALTER TABLE artikels MODIFY status ENUM('pending','approved','rejected','published') NOT NULL DEFAULT 'pending'");

        DB::table('artikels')->where('status', 'approved')->update(['status' => 'published']);
        DB::table('artikels')->where('status', 'rejected')->update(['status' => 'pending']);

        DB::table('artikels')
            ->where('status', 'pending')
            ->where('authorable_type', Admin::class)
            ->update(['status' => 'published']);

        Schema::table('artikels', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn(['admin_id', 'user_id']);
        });

        DB::statement("ALTER TABLE artikels MODIFY status ENUM('pending','published') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE artikels MODIFY status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending'");

        Schema::table('artikels', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->nullable()->after('id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        DB::table('artikels')
            ->where('authorable_type', Admin::class)
            ->whereNotNull('authorable_id')
            ->update(['admin_id' => DB::raw('authorable_id')]);

        DB::table('artikels')
            ->where('authorable_type', User::class)
            ->whereNotNull('authorable_id')
            ->update(['user_id' => DB::raw('authorable_id')]);

        DB::table('artikels')->where('status', 'published')->update(['status' => 'approved']);

        Schema::table('artikels', function (Blueprint $table) {
            $table->dropIndex(['authorable_type', 'authorable_id']);
            $table->dropColumn(['authorable_type', 'authorable_id', 'verifier_type', 'verifier_id']);
            $table->renameColumn('title', 'judul');
            $table->renameColumn('content', 'isi');
        });
    }
};

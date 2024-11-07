<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteDateInBlogersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blogers', function (Blueprint $table) {
			DB::statement("ALTER TABLE blogers DROP COLUMN created_at");
			DB::statement("ALTER TABLE blogers DROP COLUMN updated_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogers', function (Blueprint $table) {
            //
        });
    }
};

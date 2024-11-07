<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersDateTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscribers_date', function (Blueprint $table) {
			$table->id();

			$table->bigInteger('bloger_id')->index()->unsigned();
			$table->foreign('bloger_id')
		          ->references('id')->on('blogers')
	              ->onDelete('cascade');
			
			$table->date('date');
			$table->bigInteger('subscribers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers_date');
    }
};

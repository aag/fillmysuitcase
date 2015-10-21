<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterItemsTablePackedDefaultFalse extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('items', function($table)
        {
            $table->dropColumn('packed');
        });

        Schema::table('items', function($table)
        {
            $table->boolean('packed')->default(false);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('items', function($table)
        {
            $table->dropColumn('packed');
        });

        Schema::table('items', function($table)
        {
            $table->boolean('packed')->nullable();
        });
	}

}

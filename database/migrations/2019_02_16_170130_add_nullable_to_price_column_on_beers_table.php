<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToPriceColumnOnBeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beers', function($table) {
            $table->string('price')->nullable()->change();    // String because of things like sm...$6.75 lg...$10.00
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beers', function($table) {
            $table->string('price')->change();
        });
    }
}

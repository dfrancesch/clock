<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTimesLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('times', function (Blueprint $table) {
            $table->decimal('latitude',12,8)->nullable()->after('original_picture');
            $table->decimal('longitude',12,8)->nullable()->after('latitude');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('times', function (Blueprint $table) {
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });

    }
}

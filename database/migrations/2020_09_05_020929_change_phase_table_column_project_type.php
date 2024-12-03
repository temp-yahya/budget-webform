<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePhaseTableColumnProjectType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phase', function (Blueprint $table) {
             $table->unsignedInteger('project_type')->length(7)->nullable(true)->default(null)->charset(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phase', function (Blueprint $table) {
             $table->string('project_type',100)->default(NULL)->change();
        });
    }
}

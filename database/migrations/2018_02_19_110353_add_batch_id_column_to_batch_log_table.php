<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBatchIdColumnToBatchLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('batch_log', function (Blueprint $table) {
           $table->integer('batch_id')->after('batch_status_id');      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('batch_log', function (Blueprint $table) {
           $table->dropColumn('batch_id'); 
          });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyNameColumnToCompareDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('compare_data', function (Blueprint $table) {
           $table->string('company_name')->after('last_name');      
           $table->string('email1')->after('title');      
           $table->string('email2')->after('email1');      
           $table->string('email3')->after('email2');      
           $table->string('phone_number1')->after('email3');      
           $table->string('phone_number2')->after('phone_number1');      
           $table->string('phone_number3')->after('phone_number2');     
           $table->string('address3')->after('address2');      
           $table->string('city')->after('address3');      
           $table->string('state')->after('city');      
           $table->string('zip')->after('state');      
           $table->string('country')->after('zip');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('compare_data', function (Blueprint $table) {
           $table->dropColumn('company_name'); 
           $table->dropColumn('email1'); 
           $table->dropColumn('email2'); 
           $table->dropColumn('email3'); 
           $table->dropColumn('phone_number1'); 
           $table->dropColumn('phone_number2'); 
           $table->dropColumn('phone_number3'); 
           $table->dropColumn('address3'); 
           $table->dropColumn('city'); 
           $table->dropColumn('state'); 
           $table->dropColumn('country'); 
          });
    }
}

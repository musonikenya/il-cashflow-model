<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashflows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('loanId')->nullable();
            $table->string('officeId')->nullable();
            $table->string('clientId')->nullable();
            $table->string('resourceId')->nullable();
            $table->string('realFilePath')->nullable();
            $table->string('savedFilePath')->nullable();
            $table->string('path')->nullable();
            $table->string('processed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashflows');
    }
}

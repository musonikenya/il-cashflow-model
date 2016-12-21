<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashflowEditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashflow_edits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cashflowId')->index();
            $table->string('loanId')->nullable();
            $table->integer('officeId')->nullable();
            $table->integer('office_Id')->unsigned()->index();
            $table->integer('clientId')->nullable();
            $table->integer('resourceId')->nullable();
            $table->string('realFilePath')->nullable();
            $table->string('savedFilePath')->nullable();
            $table->string('path')->nullable();
            $table->string('processed');
            $table->timestamps();
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashflow_edits');
    }
}

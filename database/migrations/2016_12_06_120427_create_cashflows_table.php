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
            $table->string('loanId')->unique()->index();
            $table->integer('timesEdited')->nullable();
            $table->integer('officeId')->unsigned()->index();
            $table->integer('office_Id')->unsigned()->index();
            $table->integer('clientId')->unsigned()->index();
            $table->integer('resourceId')->nullable();
            $table->string('realFilePath')->nullable();
            $table->string('savedFilePath')->nullable();
            $table->string('path')->nullable();
            $table->boolean('processed')->default(false)->index();
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
        Schema::dropIfExists('cashflows');
    }
}

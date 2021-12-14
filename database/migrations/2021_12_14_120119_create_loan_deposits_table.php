<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_deposits', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('loan_accounts_id');
            $table->double('deposit_amount', 15, 4)->default(0);
            $table->double('late_fee', 15, 4)->default(0);
            $table->date('schedule_date');
            $table->date('deposit_date');
            $table->text('remarks')->nullable();
            $table->tinyInteger('active_fg')->default(1);

            $table->foreign('loan_accounts_id')->references('id')->on('loan_accounts');
            $table->unsignedBigInteger('created_by')->default(1);
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->default(1);
            $table->foreign('updated_by')->references('id')->on('users');

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
        Schema::dropIfExists('loan_deposits');
    }
}

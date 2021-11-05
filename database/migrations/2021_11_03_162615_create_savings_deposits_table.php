<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('savings_accounts_id');
            $table->double('deposit_amount', 15, 4)->default(0);
            $table->double('late_fee', 15, 4)->default(0);
            $table->date('schedule_date');
            $table->date('deposit_date');
            $table->text('remarks')->nullable();
            $table->tinyInteger('active_fg')->default(1);

            $table->foreign('savings_accounts_id')->references('id')->on('savings_accounts');
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
        Schema::dropIfExists('savings_deposits');
    }
}

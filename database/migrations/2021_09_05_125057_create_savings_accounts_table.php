<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_no',50);
            $table->double('first_deposit_amount', 15, 4)->default(0);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('savings_scheme_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('remarks')->nullable();

            $table->tinyInteger('active_fg')->default(1);
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('savings_scheme_id')->references('id')->on('savings_schemes');
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
        Schema::dropIfExists('savings_accounts');
    }
}

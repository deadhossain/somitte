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
            $table->double('first_deposit_ammount', 15, 4)->default(1);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('svaings_scheme_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('remarks')->nullable();

            $table->decimal('amount', 12, 4)->default(1);
            $table->decimal('late_fee', 12, 4)->default(1);
            $table->decimal('profit', 7, 4)->default(1);

            $table->tinyInteger('active_fg')->default(1);
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('svaings_scheme_id')->references('id')->on('svaings_schemes');
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

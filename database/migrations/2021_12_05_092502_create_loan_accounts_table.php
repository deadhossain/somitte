<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_no',50)->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('nominee_id');
            $table->unsignedBigInteger('loan_scheme_id');
            $table->double('loan_amount', 15, 4)->default(1);
            $table->decimal('late_fee', 12, 4)->default(1);
            $table->decimal('rate', 7, 4)->default(1);
            $table->smallInteger('total_installment_no')->default(1);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('account_status')->default(1)->comment('1 for running, 2 for complete');
            $table->tinyInteger('active_fg')->default(1);
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('nominee_id')->references('id')->on('customers');
            $table->foreign('loan_scheme_id')->references('id')->on('loan_schemes');
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
        Schema::dropIfExists('loan_accounts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanSchemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_schemes', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->decimal('min_amount', 12, 4)->default(1);
            $table->decimal('max_amount', 12, 4)->default(1);
            $table->decimal('late_fee', 12, 4)->default(1);
            $table->decimal('rate', 7, 4)->default(1);
            $table->smallInteger('max_installment')->default(1);
            $table->text('remarks')->nullable();

            $table->tinyInteger('active_fg')->default(1);
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
        Schema::dropIfExists('loan_schemes');
    }
}

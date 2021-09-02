<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsSchemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_schemes', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->decimal('amount', 12, 4)->default(1);
            $table->decimal('late_fee', 12, 4)->default(1);
            $table->decimal('profit', 7, 4)->default(1);
            $table->date('start_date');
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('savings_schemes');
    }
}

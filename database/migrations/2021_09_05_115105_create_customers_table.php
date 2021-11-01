<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('customer_id',100)->unique();
            $table->string('nid_no',20);
            $table->unsignedBigInteger('gender_id');
            $table->string('phone',20)->nullable();
            $table->string('image',100)->nullable();
            $table->string('nid_attachment',100)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('address',100)->nullable();
            $table->text('remarks')->nullable();


            $table->tinyInteger('active_fg')->default(1);
            $table->foreign('gender_id')->references('id')->on('lookup_details');
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
        Schema::dropIfExists('customers');
    }
}

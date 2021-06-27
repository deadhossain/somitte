<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookup_details', function (Blueprint $table) {
            $table->id();
            $table->string('udid',50)->nullable();
            $table->string('name',100);
            $table->text('remarks')->nullable();
            $table->tinyInteger('active_fg')->default(1);
            $table->string('value',50)->nullable();

            $table->foreignId('lookup_id')->references('id')->on('lookups');
            $table->foreignId('created_by')->default(1);
            $table->foreignId('updated_by')->default(1);
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
        Schema::dropIfExists('lookup_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToSavingsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('savings_accounts', function (Blueprint $table) {
            if (!Schema::hasColumn('savings_accounts', 'deposit_amount')) $table->double('deposit_amount', 15, 4)->default(1);
            if (!Schema::hasColumn('savings_accounts', 'late_fee')) $table->decimal('late_fee', 12, 4)->default(1);
            if (!Schema::hasColumn('savings_accounts', 'profit')) $table->decimal('profit', 7, 4)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('savings_accounts', function (Blueprint $table) {
            //
        });
    }
}

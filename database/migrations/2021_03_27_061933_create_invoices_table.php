<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->char('invoice');
            $table->char('code', 6);
            $table->integer('total');
            $table->enum('jenis', ['Income','Expense'])->default('Income');
            $table->enum('payment_method', ['Tunai','Transfer Bank','Kredit/Debit','Dana','OVO','GoPay','Hutang'])->nullable();
            $table->enum('status', ['Lunas','Belum Bayar']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}

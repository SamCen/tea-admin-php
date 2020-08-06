<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->comment('产品科目id');
            $table->string('action')->comment('行为：input 入库，output 出库。');
            $table->unsignedInteger('num')->comment('数量');
            $table->date('operation_date')->comment('操作日期,年月日');
            $table->unsignedBigInteger('op_user_id')->comment('操作用户id');
            $table->softDeletes();
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
        Schema::dropIfExists('operation_records');
    }
}

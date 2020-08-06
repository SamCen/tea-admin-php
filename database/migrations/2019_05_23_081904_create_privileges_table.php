<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('parent_code')->nullable();
            $table->string('name')->comment('权限名称');
            $table->unsignedInteger('menu_id')->nullable()->comment('路由名称');
            $table->string('type')->comment('权限菜单类型 menus:菜单 button:按钮');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privileges');
    }
}

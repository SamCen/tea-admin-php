<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = \Illuminate\Support\Facades\DB::table('admins');
        $data = [
            [
                'id'=>1,
                'name'=>'超级管理员',
                'account'=>'tianxiang',
                'password'=>bcrypt('123123'),
                'last_login_ip'=>ip2long('127.0.0.1'),
                'status'=>1,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ],
        ];
        $table->truncate();
        $table->insert($data);
    }
}

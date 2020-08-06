<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = \Illuminate\Support\Facades\DB::table('users');
        $data = [
            [
                'id'=>1,
                'username'=>'appuser',
                'password'=>bcrypt('123456'),
                'last_login_ip'=>ip2long('127.0.0.1'),
                'role'=>\App\Models\User::ROLE_OPERATION,
                'phone'=>'15902082831',
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ],
        ];
        $table->truncate();
        $table->insert($data);
    }
}

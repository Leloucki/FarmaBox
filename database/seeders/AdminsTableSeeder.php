<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            [
            'nome'=>'Super Admin', 
            'cargo' => 'Admin',
            'celular' => '',
            'email' => 'lf3lxl@gmail.com',
            'password' => '$2a$12$kO68.IE8eLS9/PGbpQBSBeAuYi8rrYSwNiQEJiTRkXJbVfWOBNgNG',
            'image' => '',
            'vendor_id' => 0,
            'status' => 0,
            ]
        ];
        Admin::insert($adminRecords);
    }
}

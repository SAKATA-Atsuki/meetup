<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'login_id' => 'rm0183rs',
            'name' => '坂田淳樹',
            'password' => Hash::make('Zny0e0Pt')
        ]);
    }
}

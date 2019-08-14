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
        DB::table('users')->insert([
            [
                'name'=> 'Jonathan',
                'email' => 'ahproh661@gmail.com',
                'password' => bcrypt('nhezithan017'),
                'end_user' => 'admin'
            ]
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('roles')->insert([
            'name' => "Admin",
            'role_id' => 1
        ]);
        DB::table('roles')->insert([
            'name' => 'Staff',
            'role_id' => 2
        ]);
        DB::table('roles')->insert([
            'name' => "User",
            'role_id' => 3
        ]);

    }
}

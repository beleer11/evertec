<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (User::create([
            'name' => "Admin",
            'email' => "admin@evertec.com",
            'phone' => "+5713795628",
            'password' => bcrypt('password'),
        ]))->assignRole("SuperAdministrator");
        (User::create([
            'name' => "Admin Ordenes",
            'email' => "admin_ordenes@evertec.com",
            'phone' => "+5713795628",
            'password' => bcrypt('password'),
        ]))->assignRole("Ordenes");
        User::create([
            'name' => "Brahiam Musse",
            'email' => "mussebrahiam11@gmail.com",
            'phone' => "+573222755825",
            'password' => bcrypt('123456'),
        ]);
    }
}

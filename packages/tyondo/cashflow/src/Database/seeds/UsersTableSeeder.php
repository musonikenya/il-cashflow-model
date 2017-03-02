<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => 'Raphael Ndwiga',
          'is_active' => 1,
          'activated' => 1,
          'office_id' => 1,
          'role_id' => 1,
          'email' => 'raphndwi@gmail.com',
          'password' => bcrypt('secret'),
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
    }
}

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
          'email' => 'raphndwi@gmail.com',
          'password' => bcrypt('secret'),
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
    }
}

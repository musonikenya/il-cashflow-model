<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('offices')->insert([
          'name' => 'Head Office',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Zimmerman',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Gikomba',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Thika',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Naivasha',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Kitengela',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Kisii',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Donholm',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Kariobangi',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Kawangware',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Kiambu',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Machakos',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Muranga',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Nakuru',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Narok',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Rongai',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Pilot Branch',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Matuu',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Molo',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'Eldoret',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      DB::table('offices')->insert([
          'name' => 'HQ-Branch',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

    }
}

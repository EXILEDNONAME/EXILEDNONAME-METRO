<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder {

  public function run(): void {

    $user = [
      [
        'name'              => 'Administrator',
        'email'             => 'administrator@exilednoname.com',
        'phone'             => '08112448111',
        'username'          => 'administrator',
        'password'          => bcrypt('1234'),
        'created_at'        => Carbon::now(),
        'email_verified_at' => Carbon::now(),
      ],
      [
        'name'              => 'Admin',
        'email'             => 'admin@exilednoname.com',
        'phone'             => '08112448112',
        'username'          => 'admin',
        'password'          => bcrypt('1234'),
        'created_at'        => Carbon::now(),
        'email_verified_at' => Carbon::now(),
      ],
      [
        'name'              => 'User',
        'email'             => 'user@exilednoname.com',
        'phone'             => '08112448113',
        'username'          => 'user',
        'password'          => bcrypt('1234'),
        'created_at'        => Carbon::now(),
        'email_verified_at' => Carbon::now(),
      ],
    ];
    User::insert($user);

    $model_has_roles = [
      [
        'role_id'        => '1',
        'model_type'     => 'App\Models\User',
        'model_id'       => '1',
      ],
      [
        'role_id'        => '2',
        'model_type'     => 'App\Models\User',
        'model_id'       => '2',
      ],
    ];
    \DB::table('model_has_roles')->insert($model_has_roles);

  }
}

<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    public function run()
    {
      $initUser = User::create([
        'email' => 'alumno_prueba@inacap.cl',
        'password' => bcrypt('123456'),
        'run' => '11111111-1',
        'nombre' => 'Alumno',
        'apellido' => 'Prueba',
        'rol' => 2
      ]);
      $initUser = User::create([
        'email' => 'docente_prueba@inacap.cl',
        'password' => bcrypt('123456'),
        'run' => '222222222-2',
        'nombre' => 'Docente',
        'apellido' => 'Prueba',
        'rol' => 1
      ]);
      $initUser = User::create([
        'email' => 'admin@inacap.cl',
        'password' => bcrypt('123456'),
        'run' => '33333333-3',
        'nombre' => 'Admin',
        'apellido' => 'Admin',
        'rol' => 1
      ]);
    }
}

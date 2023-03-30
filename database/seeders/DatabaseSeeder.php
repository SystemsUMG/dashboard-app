<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user_types = [
            'Administrador',
            'Estudiante',
            'Profesor',
        ];
        foreach ($user_types as $type) {
            UserType::create([
                'description' => $type,
                'active' => 1,
            ]);
        }

        User::create([
            'name' => 'Fredy Alexander',
            'last_name' => 'Xalín Aguín',
            'email' => 'alexanderxalinfredy@gmail.com',
            'password' => Hash::make('password'),
            'user_type_id' => 1,
            'active' => 1,
        ]);
    }
}

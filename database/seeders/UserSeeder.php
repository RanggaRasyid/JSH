<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Socialite\Facades\Socialite;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::firstOrNew(
        [
            'email' => 'superadmin@demo.test',
        ],
            [
            'name' => 'Super Admin Role',
            'google_id' => 1,
            'google_token' => 1,
            'google_refresh_token' => 1,
            'password' => bcrypt('12345678'),
        ]);

        if (!$superadmin->exists) {
            $superadmin->save();
            $superadmin->assignRole('superadmin');
        }
    }
}

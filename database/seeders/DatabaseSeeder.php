<?php

namespace Database\Seeders;

use App\Models\SupportedTicket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        SupportedTicket::factory(5)->create();

        User::create([
            'name'     => 'Livewire',
            'email'    => 'livewire@laravel.com',
            'password' => 'password',
        ]);
    }
}

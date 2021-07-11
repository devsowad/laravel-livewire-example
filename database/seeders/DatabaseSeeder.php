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
        User::create([
            'name'     => 'Livewire',
            'email'    => 'livewire@laravel.com',
            'password' => 'password',
        ]);

        SupportedTicket::create([
            'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing.',
        ]);
        SupportedTicket::create([
            'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        ]);
        SupportedTicket::create([
            'question' => 'Lorem ipsum dolor sit amet consectetur.',
        ]);
    }
}

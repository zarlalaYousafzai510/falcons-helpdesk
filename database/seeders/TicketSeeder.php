<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tickets')->insert([
            [
                'subject' => 'Cannot reset password',
                'description' => 'The password reset link has expired.',
                'status' => 'open',
            ],
            [
                'subject' => 'Invoice question',
                'description' => 'Please clarify the latest invoice charge.',
                'status' => 'open',
            ],
            [
                'subject' => 'App crashes on login',
                'description' => 'The app closes after I submit my login details.',
                'status' => 'in_progress',
            ],
            [
                'subject' => 'Update contact email',
                'description' => 'Please change the email address on my account.',
                'status' => 'resolved',
            ],
            [
                'subject' => 'Feature request',
                'description' => 'Please add dark mode to the dashboard.',
                'status' => 'open',
            ],
        ]);
    }
}
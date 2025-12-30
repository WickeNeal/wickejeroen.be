<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter the admin name', 'Admin');
        $email = $this->ask('Enter the admin email address');

        if (\App\Models\User::where('email', $email)->exists()) {
            $this->error('User with this email already exists.');
            return;
        }

        $password = $this->secret('Enter the password');
        $confirm = $this->secret('Confirm the password');

        if ($password !== $confirm) {
            $this->error('Passwords do not match.');
            return;
        }

        \App\Models\User::create([
            'name' => $name,
            'email' => $email,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
        ]);

        $this->info("User {$email} created successfully!");
    }
}

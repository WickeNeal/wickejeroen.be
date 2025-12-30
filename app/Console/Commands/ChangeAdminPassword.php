<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ChangeAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the password for an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask('Enter the admin email address', 'admin@wickejeroen.be');

        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return;
        }

        $password = $this->secret('Enter the new password');
        $confirm = $this->secret('Confirm the new password');

        if ($password !== $confirm) {
            $this->error('Passwords do not match.');
            return;
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($password);
        $user->save();

        $this->info("Password updated successfully for user: {$email}");
    }
}

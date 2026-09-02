<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'app:create-admin-user {--email=} {--password=} {--name=}';
    protected $description = 'Create an admin user with email and password';

    public function handle()
    {
        $email = $this->option('email') ?? $this->ask('Admin email');
        $password = $this->option('password') ?? $this->secret('Admin password');
        $name = $this->option('name') ?? $this->ask('Admin name');

        if (User::where('email', $email)->exists()) {
            $this->error("User with email {$email} already exists.");
            return 1;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'phone' => '00000000000',
            'password' => Hash::make($password),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        $this->info("Admin user {$email} created successfully.");
        return 0;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeFilamentUserCommand extends Command
{
    protected $signature = 'make:filament-user
                            {--name= : The name of the user}
                            {--email= : A valid and unique email address}
                            {--password= : The password for the user (min. 8 characters)}';

    protected $description = 'Create a new Filament user';

    public function handle(): int
    {
        $name = $this->option('name') ?: $this->ask('Name');
        $email = $this->option('email') ?: $this->ask('Email address');
        $password = $this->option('password') ?: $this->secret('Password');

        // Ask which type of user to create
        $userType = $this->choice(
            'What type of user do you want to create?',
            ['Admin (for /admin panel)', 'User (for /app panel)'],
            0
        );

        if ($userType === 'Admin (for /admin panel)') {
            // Create Admin user
            $admin = Admin::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'active' => true,
            ]);

            $this->info('Success! Admin user created.');
            $this->info($admin->email . ' can now log in at /admin with the provided password.');
            
            return self::SUCCESS;
        }

        // Create regular User
        $isSuperAdmin = $this->confirm('Create as superadmin? (No organisation required)', false);

        $userData = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'administrator' => true,
        ];

        if (!$isSuperAdmin) {
            // Get the first organisation or prompt to create one
            $organisation = \App\Models\Organisation::first();
            
            if (!$organisation) {
                $this->error('No organisation found. Please create an organisation first or create a superadmin user.');
                return self::FAILURE;
            }

            $userData['organisation_id'] = $organisation->id;
        }

        $user = User::create($userData);

        $this->info('Success! User created.');
        $this->info($user->email . ' can now log in at /app with the provided password.');
        
        if ($isSuperAdmin) {
            $this->info('User created as superadmin (no organisation).');
        } else {
            $this->info('User has been assigned to organisation: ' . $organisation->name);
        }

        return self::SUCCESS;
    }
}

<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = new User;

        $user->name  = $this->ask('Enter full name:');
        $user->email = $this->ask('Enter user email:');

        while (! $user->password) {
            $password = $this->ask('Enter a password');

            if ($this->confirm('Set password as: "' . $password . '"?')) {
                $user->password = Hash::make($password);
            }
        }

        if ($this->confirm('Is this user an admin? (can edit menu items only)')) {
            $user->is_admin = true;
        }

        if ($this->confirm('Is this user a superuser?')) {
            $user->is_super_user = true;
        }

        $user->save();
        $this->info('User created!');
        exit;
    }
}

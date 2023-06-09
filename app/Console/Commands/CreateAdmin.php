<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function checkPass()
    {
        $password = $this->secret('Enter password ');
        $confirmPassword = $this->secret('Confirm password ');
        if ($password != $confirmPassword) {
            $this->line('Your Password Not Match');
            $this->line('=======================');
            $this->checkPass();
        } else {
            return $password;
        }
    }

    public function checkUser()
    {
        $user = $this->ask('Enter Username (Minimum 6 Character)');
        if (strlen($user) < 6) {
            $this->line('Minimum Character is 6');
            $this->line('======================');
            $this->checkUser();
        }
        $getUser = User::where('username', $user)->get();
        if (count($getUser) > 0) {
            $this->line('Username already exists');
            $this->line('=======================');
            $this->checkUser();
        } else {
            return $user;
        }
    }

    public function handle()
    {
        $fullname = $this->ask('Enter name ');
        $username = $this->checkUser();
        $email = $this->ask('Enter email ');
        $password = $this->checkPass();
        if ($this->confirm('Are You Sure Make This User ?'."\n".'Name : '.$fullname."\n".'Username :'.$username."\n".'Email : '.$email."\n".'Password : As you set')) {
            User::create([
                'name' => $fullname,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($password),
                'status' => true,
                'permission_id' => 1,
            ]);
            $this->info('Your Account Has Been Created.');
        }
    }
}

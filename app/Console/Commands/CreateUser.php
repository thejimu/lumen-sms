<?php
namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\User;

class CreateUser extends Command {

    protected $signature = "api:generate-user {user}";

    protected $description = "Generates an API user and returns an API key";

    public function handle() {
        $salt = env('DB_DATABASE');
        $password = uniqid();
        $token = md5($this->argument('user').$salt.uniqid().$salt.date("dmY"));
        try {
            User::create(
                [
                    'email' => $this->argument('user'),
                    'password' => Hash::make($password),
                    'token' => $token
                ]
            );
        } catch (\Exception $e){
            var_dump($e->getMessage());
            die;
        }

        echo "Keep your password and token in a safe place \n";
        echo "Password: ".$password." \n";
        echo "API Token: ".$token." \n";


    }

}

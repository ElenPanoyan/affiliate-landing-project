<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    /**
     * Create a new user in db
     */
    public function create(array $data): User
    {
        return User::create([
            'username' => $data['username'],
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'country_code' => $data['country_code'],
            'currency_code' => $data['currency_code'],
            'btag' => $data['btag'],
            'swarm_uid' => $data['swarm_uid'],
        ]);
    }
}

<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    public function view(User $user, Client $client)
    {
        return $client->user_id === $user->id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Client $client)
    {
        return $client->user_id === $user->id;
    }

    public function delete(User $user, Client $client)
    {
        return $client->user_id === $user->id;
    }
}


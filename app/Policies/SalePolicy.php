<?php

namespace App\Policies;

use App\Models\Sale;
use App\Models\User;

class SalePolicy
{
    public function view(User $user, Sale $sale)
    {
        return $sale->user_id === $user->id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Sale $sale)
    {
        return $sale->user_id === $user->id;
    }

    public function delete(User $user, Sale $sale)
    {
        return $sale->user_id === $user->id;
    }

    public function markAsPaid(User $user, Sale $sale)
    {
        return $sale->user_id === $user->id;
    }
}


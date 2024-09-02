<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\User;

class AccountPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Account $account): bool
    {
        return $user->id === $account->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
//    public function delete(User $user, Account $account): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can permanently delete the model.
     */
//    public function forceDelete(User $user, Account $account): bool
//    {
//        //
//    }
}

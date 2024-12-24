<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function canSeeAllEditActions(User $user, User $model)
    {
        return $user->id === $model->id;
    }

    public function edit(User $user, User $model)
    {
        return $this->canSeeAllEditActions($user, $model) || $user->hasPermissionTo('edit users');
    }
}

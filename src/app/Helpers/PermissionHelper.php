<?php

namespace App\Helpers;

class PermissionHelper{

  public static function hasPermission($permission)
{
    return auth()->user()->role->permissions->contains('name', $permission);
}

// app/helpers.php

public static function userHasPermission($slug)
{
    $user = auth()->user();
    if (!$user) return false;

    return $user->role->permissions->contains('name', $slug);
}

}

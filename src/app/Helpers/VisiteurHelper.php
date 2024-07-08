<?php

namespace App\Helpers;

use App\Models\Badge;
use App\Models\BadgeType;
use App\Models\Visiteur;

class VisiteurHelper
{
    public static function getInviterBadges()
    {
        $inviter = BadgeType::where('name', 'Inviter')->first();
        return Badge::where('type_id', $inviter->id)->where('taken', 0)->get();
    }

    public static function setBadgeTaken($badgeId, $taken)
    {
        Badge::where('id', $badgeId)->update(['taken' => $taken]);
    }

    public static function findVisiteur($id)
    {
        return Visiteur::where('id', $id)->first();
    }
}

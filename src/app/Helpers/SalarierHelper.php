<?php

namespace App\Helpers;

class SalarierHelper
{
    public static function formatCin($cin)
    {
        // Example logic for formatting CIN
        return strtoupper($cin);
    }

    public static function formatSituationFamiliale($situation){
      switch($situation){
        case "1":
          return "Célibataire";
        case "4":
          return "Veufe/Veuve";
        case "3":
          return "Divorcé";
        case "2":
          return "Marié";
      }
    }


}

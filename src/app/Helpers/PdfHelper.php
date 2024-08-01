<?php

namespace App\Helpers;

class PdfHelper{


  public static function appreciation($note){
    switch($note){
      case 1:
        echo "<td class='g8' style='background-color:#FF0000;'>
        <span class='appreciation' >A améliorer</span>
        </td>";
        break;
      case 2:
        echo "<td class='g8' style='background-color:#ED7D31;'>
        <span class='appreciation' >Insuffisant</span>";
        break;
      case 3:
        echo "<td class='g8' style='background-color:#FFC000;'>
        <span class='appreciation' >Moyen</span>";
        break;
      case 4:
        echo "<td class='g8' style='background-color:#A9D08E;'>
        <span class='appreciation' >Bon</span>";
        break;
      case 5:
        echo "<td class='g8' style='background-color:#70AD47;'>
        <span class='appreciation' >Excellent</span>
        </td>";
        break;
      default:
        break;

    }
  }


  public static function appreciationBadge($note){
    switch($note){
      case 1:
        echo "<td class='g8' style='background-color:#FF0000;'>
        <span class='appreciation' >A améliorer</span>
        </td>";
        break;
      case 2:
        echo "<td class='g8' style='background-color:#ED7D31;'>
        <span class='appreciation' >Insuffisant</span>";
        break;
      case 3:
        echo "<td class='g8' style='background-color:#FFC000;'>
        <span class='appreciation' >Moyen</span>";
        break;
      case 4:
        echo "<td class='g8' style='background-color:#A9D08E;'>
        <span class='appreciation' >Bon</span>";
        break;
      case 5:
        echo "<td class='g8' style='background-color:#70AD47;'>
        <span class='appreciation' >Excellent</span>
        </td>";
        break;
      default:
        break;

    }
  }

}

<?php

namespace App\Helpers;

use App\Models\ContactUrgence;
use PDO;

class SalarierHelper
{
    public static function toMaj($string)
    {
        return strtoupper($string);
    }

    public static function firstMaj($string){
      return ucfirst(strtolower($string));
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

    public static function gender($sexe){
      if($sexe == 1){
        return 'Homme';
      }
      return 'Femme';
    }

    public static function seniority($dateDebut){
      $currentDate = \Carbon\Carbon::now();
                    $startDate = \Carbon\Carbon::parse($dateDebut);
                    $seniority = $currentDate->diff($startDate);

                    $seniorityString = '';

                    if ($seniority->y > 0) {
                        $seniorityString .= $seniority->y . ' Ans ';
                    }
                    if ($seniority->m > 0) {
                        $seniorityString .= $seniority->m . ' Mois ';
                    }
                    if ($seniority->d > 0) {
                        $seniorityString .= $seniority->d . ' Jours';
                    }

                    echo trim($seniorityString);
    }



    private static function updateOrDeleteContactUrgence($existingContacts,$contactsData){

      foreach ($existingContacts as $index => $contact) {
        if (isset($contactsData['nom_contact'][$index])) {
            $contact->update([
                'nom_contact' => $contactsData['nom_contact'][$index],
                'phone_contact' => $contactsData['phone_contact'][$index],
                'lien_familiale' => $contactsData['lien_familiale'][$index],
            ]);
        } else {
            $contact->delete();
        }
    }

    }

    private static function addContactUrgence($existingContacts,$contactsData,$id){
      for ($i = count($existingContacts); $i < count($contactsData['nom_contact']); $i++) {
        if (! empty($contactsData['nom_contact'][$i])) {
            ContactUrgence::create([
                'salarier_id' => $id,
                'nom_contact' => $contactsData['nom_contact'][$i],
                'phone_contact' => $contactsData['phone_contact'][$i],
                'lien_familiale' => $contactsData['lien_familiale'][$i],
            ]);
        }
    }
    }
    public static function updateContactUrgence($existingContacts,$contactsData,$id){
      SalarierHelper::updateOrDeleteContactUrgence($existingContacts, $contactsData);
      SalarierHelper::addContactUrgence($existingContacts, $contactsData, $id);
    }


}

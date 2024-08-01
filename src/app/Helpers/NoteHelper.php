<?php

namespace App\Helpers;

use Barryvdh\DomPDF\Facade\Pdf;

class NoteHelper{
  public static function calculateCategoryAverages($groupedSubCategories, $groupedNotes)
    {
        return $groupedSubCategories->map(function ($subCategories, $noteCategoryId) use ($groupedNotes) {
            $totalMarks = 0;
            $count = 0;
            foreach ($subCategories as $subCategory) {
                $notes = $groupedNotes->get($subCategory->id);
                if ($notes) {
                    foreach ($notes as $note) {
                        $totalMarks += $note->note;
                        $count++;
                    }
                }
            }
            $average = $count > 0 ? $totalMarks / $count : 0;
            return number_format($average, 2);
        });
    }

    public static function generatePdf($notes, $remarques, $salarie, $manager, $groupedSubCategories, $groupedNotes, $categoryAverages)
    {
        $directory = storage_path('app/public/pdfs');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = $salarie->nom . '-' . $salarie->prenom . '-' . $remarques->annee . '.pdf';
        $filePath = $directory . '/' . $fileName;
        $pdf = Pdf::loadView('content.ficheEvaluationPdf', compact('notes', 'remarques', 'salarie', 'manager', 'groupedSubCategories', 'groupedNotes', 'categoryAverages'));
        $pdf->save($filePath);

        return [
            'pdf_url' => route('download.pdf', ['filename' => $fileName]),
            'redirect_url' => url('/notes'),
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssignmentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $experts = User::where('role', 'expert')
            ->with(['universities.formEntry']) // Загрузим formEntry вместе с вузами
            ->get();

        $data = [];

        foreach ($experts as $expert) {
            if ($expert->universities->count() > 0) {
                foreach ($expert->universities as $university) {
                    $score = $university->formEntry && $university->formEntry->score !== null
                        ? $university->formEntry->score
                        : '';

                    $data[] = [
                        'Expert ID' => $expert->id,
                        'Expert Name' => $expert->name,
                        'Expert Email' => $expert->email,
                        'University ID' => $university->id,
                        'University Name' => $university->name,
                        'University Email' => $university->email,
                        'Score' => $score,
                    ];
                }
            } else {
                $data[] = [
                    'Expert ID' => $expert->id,
                    'Expert Name' => $expert->name,
                    'Expert Email' => $expert->email,
                    'University ID' => '',
                    'University Name' => 'Нет закрепленных вузов',
                    'University Email' => '',
                    'Score' => '',
                ];
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'ID эксперта',
            'Имя эксперта',
            'Email эксперта',
            'ID вуза',
            'Название вуза',
            'Email вуза',
            'Баллы',
        ];
    }
}

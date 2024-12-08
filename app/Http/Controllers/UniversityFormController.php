<?php

namespace App\Http\Controllers;

use App\Models\FormEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversityFormController extends Controller
{
    public function showForm()
    {
        $formEntry = Auth::user()->formEntry;

        return view('university.form', compact('formEntry'));
    }

    public function submitForm(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Валидация входных данных
        $validatedData = $request->validate([
            // ЧАСТЬ 1
            'program_theology' => 'required|in:ДА,НЕТ',
            'file_program_theology' => 'nullable|file|mimes:pdf,doc,docx',

            'state_accreditation' => 'required|in:ДА,НЕТ',
            'file_state_accreditation' => 'nullable|file|mimes:pdf,doc,docx',

            'compliance_percentage' => 'required|numeric|min:0|max:100',
            'file_compliance_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'test_results' => 'required|numeric|min:0|max:100',
            'file_test_results' => 'nullable|file|mimes:pdf,doc,docx',

            'employment_rate' => 'required|numeric|min:0|max:100',
            'file_employment_rate' => 'nullable|file|mimes:pdf,doc,docx',

            'full_time_students' => 'required|integer|min:0',
            'file_full_time_students' => 'nullable|file|mimes:pdf,doc,docx',

            'npr_coverage' => 'required|numeric|min:0|max:100',
            'file_npr_coverage' => 'nullable|file|mimes:pdf,doc,docx',

            'degree_holders_percentage' => 'required|numeric|min:0|max:100',
            'file_degree_holders_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'grant_funding' => 'required|numeric|min:0',
            'file_grant_funding' => 'nullable|file|mimes:pdf,doc,docx',

            'vak_publications_per_npr' => 'required|numeric|min:0',
            'file_vak_publications_per_npr' => 'nullable|file|mimes:pdf,doc,docx',

            'monographs_per_npr' => 'required|numeric|min:0',
            'file_monographs_per_npr' => 'nullable|file|mimes:pdf,doc,docx',

            'h_index_per_npr' => 'required|numeric|min:0',
            'file_h_index_per_npr' => 'nullable|file|mimes:pdf,doc,docx',

            'olympiad_winners' => 'required|integer|min:0',
            'file_olympiad_winners' => 'nullable|file|mimes:pdf,doc,docx',

            'patriotic_events' => 'required|integer|min:0',
            'file_patriotic_events' => 'nullable|file|mimes:pdf,doc,docx',

            'website_compliance' => 'required|numeric|min:0|max:100',
            'file_website_compliance' => 'nullable|file|mimes:pdf,doc,docx',

            'media_activity' => 'required|integer|min:0',
            'file_media_activity' => 'nullable|file|mimes:pdf,doc,docx',

            'indigenous_students_percentage' => 'required|numeric|min:0|max:100',
            'file_indigenous_students_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            // ЧАСТЬ 2
            'national_events_per_npr' => 'required|numeric|min:0',
            'file_national_events_per_npr' => 'nullable|file|mimes:pdf,doc,docx',

            'internal_quality_system' => 'required|in:Имеется,Отсутствует',
            'file_internal_quality_system' => 'nullable|file|mimes:pdf,doc,docx',

            'professional_competitions' => 'required|integer|min:0',
            'file_professional_competitions' => 'nullable|file|mimes:pdf,doc,docx',

            'npr_award_winners' => 'required|integer|min:0',
            'file_npr_award_winners' => 'nullable|file|mimes:pdf,doc,docx',

            'graduates_percentage' => 'required|numeric|min:0|max:100',
            'file_graduates_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'postgraduate_percentage' => 'required|numeric|min:0|max:100',
            'file_postgraduate_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'ebs_usage_percentage' => 'required|numeric|min:0|max:100',
            'file_ebs_usage_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'programs_availability' => 'required|numeric|min:0|max:100',
            'file_programs_availability' => 'nullable|file|mimes:pdf,doc,docx',

            'eios_usage_percentage' => 'required|numeric|min:0|max:100',
            'file_eios_usage_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'international_agreements' => 'required|in:ДА,НЕТ',
            'file_international_agreements' => 'nullable|file|mimes:pdf,doc,docx',

            'medrese_graduates_percentage' => 'required|numeric|min:0|max:100',
            'file_medrese_graduates_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'non_scientific_publications' => 'required|in:ДА,НЕТ',
            'file_non_scientific_publications' => 'nullable|file|mimes:pdf,doc,docx',

            'students_under_25_percentage' => 'required|numeric|min:0|max:100',
            'file_students_under_25_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'students_from_muslim_orgs_percentage' => 'required|numeric|min:0|max:100',
            'file_students_from_muslim_orgs_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'muslim_orgs_involved' => 'required|integer|min:0',
            'file_muslim_orgs_involved' => 'nullable|file|mimes:pdf,doc,docx',

            'graduates_employed_in_muslim_orgs_percentage' => 'required|numeric|min:0|max:100',
            'file_graduates_employed_in_muslim_orgs_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'joint_events_with_muslim_orgs' => 'required|integer|min:0',
            'file_joint_events_with_muslim_orgs' => 'nullable|file|mimes:pdf,doc,docx',

            'founders_funding_share' => 'required|numeric|min:0|max:100',
            'file_founders_funding_share' => 'nullable|file|mimes:pdf,doc,docx',

            'donations_share' => 'required|numeric|min:0|max:100',
            'file_donations_share' => 'nullable|file|mimes:pdf,doc,docx',

            'paid_education_share' => 'required|numeric|min:0|max:100',
            'file_paid_education_share' => 'nullable|file|mimes:pdf,doc,docx',

            'scientific_events_held' => 'required|integer|min:0',
            'file_scientific_events_held' => 'nullable|file|mimes:pdf,doc,docx',

            'students_in_science_percentage' => 'required|numeric|min:0|max:100',
            'file_students_in_science_percentage' => 'nullable|file|mimes:pdf,doc,docx',

            'has_educational_plan' => 'required|in:ДА,НЕТ',
            'file_has_educational_plan' => 'nullable|file|mimes:pdf,doc,docx',

            'lectures_by_foreign_scholars' => 'required|integer|min:0',
            'file_lectures_by_foreign_scholars' => 'nullable|file|mimes:pdf,doc,docx',

            'international_memberships' => 'required|integer|min:0',
            'file_international_memberships' => 'nullable|file|mimes:pdf,doc,docx',

            'prepared_audiovisual_content' => 'required|in:ДА,НЕТ',
            'file_prepared_audiovisual_content' => 'nullable|file|mimes:pdf,doc,docx',

            'academic_exchanges_teachers' => 'required|integer|min:0',
            'file_academic_exchanges_teachers' => 'nullable|file|mimes:pdf,doc,docx',

            'teachers_advanced_training_percentage' => 'required|numeric|min:0|max:100',
            'file_teachers_advanced_training_percentage' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $fileFields = [
            'file_program_theology',
            'file_state_accreditation',
            'file_compliance_percentage',
            'file_test_results',
            'file_employment_rate',
            'file_full_time_students',
            'file_npr_coverage',
            'file_degree_holders_percentage',
            'file_grant_funding',
            'file_vak_publications_per_npr',
            'file_monographs_per_npr',
            'file_h_index_per_npr',
            'file_olympiad_winners',
            'file_patriotic_events',
            'file_website_compliance',
            'file_media_activity',
            'file_indigenous_students_percentage',
            'file_national_events_per_npr',
            'file_internal_quality_system',
            'file_professional_competitions',
            'file_npr_award_winners',
            'file_graduates_percentage',
            'file_postgraduate_percentage',
            'file_ebs_usage_percentage',
            'file_programs_availability',
            'file_eios_usage_percentage',
            'file_international_agreements',
            'file_medrese_graduates_percentage',
            'file_non_scientific_publications',
            'file_students_under_25_percentage',
            'file_students_from_muslim_orgs_percentage',
            'file_muslim_orgs_involved',
            'file_graduates_employed_in_muslim_orgs_percentage',
            'file_joint_events_with_muslim_orgs',
            'file_founders_funding_share',
            'file_donations_share',
            'file_paid_education_share',
            'file_scientific_events_held',
            'file_students_in_science_percentage',
            'file_has_educational_plan',
            'file_lectures_by_foreign_scholars',
            'file_international_memberships',
            'file_prepared_audiovisual_content',
            'file_academic_exchanges_teachers',
            'file_teachers_advanced_training_percentage',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $filePath = $request->file($fileField)->store('uploads', 'public');
                $validatedData[$fileField] = $filePath;
            } elseif (isset($formEntry->data[$fileField])) {
                $validatedData[$fileField] = $formEntry->data[$fileField];
            }
        }

        // Расчет балла на основе введенных данных
        $score = $this->calculateScore($validatedData);

        // Сохранение данных в базе
        $formEntry = FormEntry::updateOrCreate(
            ['university_id' => Auth::id()],
            [
                'data' => $validatedData,
                'score' => $score,
            ]
        );

        return redirect()->route('university.form')->with('success', 'Форма успешно отправлена.');
    }


    public function calculateScore($data)
    {
        $totalScore = 0;

        // Хелпер для преобразования 'ДА'/'НЕТ'/'Имеется' в 1/0
        $yesNoToInt = function ($val) {
            return ($val === 'ДА' || $val === 'Имеется') ? 1 : 0;
        };

        // Показатель №1
        $L1 = $yesNoToInt($data['program_theology']);
        $K1 = (intval($data['full_time_students']) > 0) ? 1 : 0;
        $P1 = 3 * $L1 * $K1;
        $totalScore += $P1;

        // Показатель №2
        $A1 = $yesNoToInt($data['state_accreditation']);
        $P2 = 10 * $A1;
        $totalScore += $P2;

        // Показатель №3
        $S3 = floatval($data['compliance_percentage']);
        if ($S3 < 60) {
            $P3 = 0;
        } elseif ($S3 >= 60 && $S3 < 90) {
            $P3 = 0.2 * $S3 - 12;
        } else {
            $P3 = 5;
        }
        $totalScore += $P3;

        // Показатель №4
        // Используем employment_rate (>=80% => K4=1) и test_results как S4
        $participation = floatval($data['employment_rate']);
        $S4 = floatval($data['test_results']);
        $K4 = ($participation >= 80) ? 1 : 0;
        if ($S4 < 50) {
            $P4 = 0;
        } elseif ($S4 >= 50 && $S4 < 75) {
            $P4 = 0.32 * $K4 * $S4 - 16;
        } else {
            $P4 = $K4 * 8;
        }
        $totalScore += $P4;

        // Показатель №5
        // У нас есть employment_rate как доля трудоустроенных (0..100%)
        // Но в верстке по п.5 ЧАСТИ 1 — это "Доля трудоустроенных...". Отлично.
        $S5 = floatval($data['employment_rate']);
        // Логика из предыдущей адаптации:
        if ($S5 < 40) {
            $P5 = 0;
        } elseif ($S5 >= 40 && $S5 < 200) {
            $P5 = 0.1875 * $S5 - 7.5;
        } else {
            $P5 = 8;
        }
        $totalScore += $P5;

        // Показатель №6
        // Используем indigenous_students_percentage (0..100)
        $S6 = floatval($data['indigenous_students_percentage']);
        if ($S6 < 60) {
            $P6 = 0;
        } elseif ($S6 >= 60 && $S6 < 90) {
            $P6 = (1 / 6) * $S6 - 10;
        } else {
            $P6 = 5;
        }
        $totalScore += $P6;

        // Показатель №7
        // Используем npr_coverage (0..100) как показатель обеспеченности ООП НПР.
        $S7 = floatval($data['npr_coverage']);
        if ($S7 < 40) {
            $P7 = 0;
        } elseif ($S7 >= 40 && $S7 < 70) {
            $P7 = (1 / 3) * $S7 - (40 / 3);
        } else {
            $P7 = 10;
        }
        $totalScore += $P7;

        // Показатель №8
        // degree_holders_percentage (0..100)
        $S8 = floatval($data['degree_holders_percentage']);
        if ($S8 < 20) {
            $P8 = 0;
        } elseif ($S8 >= 20 && $S8 < 60) {
            $P8 = 0.25 * $S8 - 5;
        } else {
            $P8 = 10;
        }
        $totalScore += $P8;

        // Показатель №9
        // grant_funding
        $S9 = floatval($data['grant_funding']);
        if ($S9 == 0) {
            $P9 = 0;
        } elseif ($S9 > 0 && $S9 < 5000000) {
            $P9 = 0.000002 * $S9;
        } else {
            $P9 = 10;
        }
        $totalScore += $P9;

        // Показатель №10
        // vak_publications_per_npr - уже нормированное значение
        $S10 = floatval($data['vak_publications_per_npr']);
        if ($S10 < 0.3) {
            $P10 = 0;
        } elseif ($S10 >= 0.3 && $S10 < 1) {
            $P10 = (1 / 7) * $S10 - (30 / 7);
        } else {
            $P10 = 10;
        }
        $totalScore += $P10;

        // Показатель №11
        // monographs_per_npr
        $S11 = floatval($data['monographs_per_npr']);
        if ($S11 < 0.01) {
            $P11 = 0;
        } elseif ($S11 >= 0.01 && $S11 < 0.5) {
            $P11 = (600.0 / 49.0) * $S11 - (6.0 / 49.0);
        } else {
            $P11 = 6;
        }
        $totalScore += $P11;

        // Показатель №12
        // h_index_per_npr
        $S12 = floatval($data['h_index_per_npr']);
        if ($S12 < 0.6) {
            $P12 = 0;
        } elseif ($S12 >= 0.6 && $S12 < 2) {
            $P12 = (25.0 / 7.0) * $S12 - (15.0 / 7.0);
        } else {
            $P12 = 5;
        }
        $totalScore += $P12;

        // Показатель №13
        // olympiad_winners (int)
        $S13 = intval($data['olympiad_winners']);
        if ($S13 == 0) {
            $P13 = 0;
        } elseif ($S13 > 0 && $S13 < 3) {
            $P13 = (8.0 / 3.0) * $S13;
        } else {
            $P13 = 8;
        }
        $totalScore += $P13;

        // Показатель №14
        // patriotic_events (int)
        $S14 = intval($data['patriotic_events']);
        if ($S14 < 1) {
            $P14 = 0;
        } elseif ($S14 >= 1 && $S14 < 8) {
            $P14 = (10.0 / 7.0) * $S14 - (10.0 / 7.0);
        } else {
            $P14 = 10;
        }
        $totalScore += $P14;

        // Показатель №15
        // website_compliance (0..100)
        $S15 = floatval($data['website_compliance']);
        if ($S15 < 50) {
            $P15 = 0;
        } elseif ($S15 >= 50 && $S15 < 100) {
            $P15 = 0.16 * $S15 - 8;
        } else {
            $P15 = 8;
        }
        $totalScore += $P15;

        // Показатель №16
        // media_activity (int)
        $S16 = intval($data['media_activity']);
        if ($S16 < 1) {
            $P16 = 0;
        } elseif ($S16 >= 1 && $S16 < 500) {
            $P16 = (5.0 / 499.0) * $S16 - (5.0 / 499.0);
        } else {
            $P16 = 5;
        }
        $totalScore += $P16;

        // Показатель №17
        // indigenous_students_percentage (0..100)
        $S17 = floatval($data['indigenous_students_percentage']);
        if ($S17 < 60) {
            $P17 = 0;
        } elseif ($S17 >= 60 && $S17 < 90) {
            $P17 = (1 / 6) * $S17 - 10;
        } else {
            $P17 = 5;
        }
        $totalScore += $P17;


        // ЧАСТЬ 2 Показатели

        // П1 (Часть 2) national_events_per_npr (0..)
        $S_part2_1 = floatval($data['national_events_per_npr']);
        // Допустим, просто баллы по аналогии:
        $P18 = ($S_part2_1 > 0) ? 1 : 0;
        $totalScore += $P18;

        // П2 (Часть 2) internal_quality_system (Имеется/Отсутствует)
        $Q2 = $yesNoToInt($data['internal_quality_system']);
        $P19 = $Q2 * 1;
        $totalScore += $P19;

        // И так далее для всех остальных показателей Часть 2.
        // Поскольку у вас много полей и вы не указали точную формулу для каждой из них,
        // вы можете просто присвоить им по 1 баллу, если значение >0 или 'ДА', и 0 иначе.
        // Или использовать ту логику, которую вы ранее упоминали (например, если поле > какого-то значения, дать балл).

        // Ниже просто пример, присвоим по 1 баллу если значение >0 или 'ДА':
        $P20 = (intval($data['professional_competitions']) > 0) ? 1 : 0;
        $totalScore += $P20;

        $P21 = (intval($data['npr_award_winners']) > 0) ? 1 : 0;
        $totalScore += $P21;

        $P22 = (floatval($data['graduates_percentage']) >= 0) ? 1 : 0;
        $totalScore += $P22;

        $P23 = (floatval($data['postgraduate_percentage']) >= 0) ? 1 : 0;
        $totalScore += $P23;

        $P24 = (floatval($data['ebs_usage_percentage']) >= 0) ? 1 : 0;
        $totalScore += $P24;

        $P25 = (floatval($data['programs_availability']) >= 0) ? 1 : 0;
        $totalScore += $P25;

        $P26 = (floatval($data['eios_usage_percentage']) >= 0) ? 1 : 0;
        $totalScore += $P26;

        $P27 = $yesNoToInt($data['international_agreements']);
        $totalScore += $P27;

        $P28 = (floatval($data['medrese_graduates_percentage']) >= 0) ? 1 : 0;
        $totalScore += $P28;

        $P29 = $yesNoToInt($data['non_scientific_publications']);
        $totalScore += $P29;

        $P30 = (floatval($data['students_under_25_percentage']) >= 0) ? 1 : 0;
        $totalScore += $P30;

        $P31 = (floatval($data['students_from_muslim_orgs_percentage']) >= 0) ? 1 : 0;
        $totalScore += $P31;

        $P32 = (intval($data['muslim_orgs_involved']) >= 0) ? 1 : 0;
        $totalScore += $P32;

        $P33 = (floatval($data['graduates_employed_in_muslim_orgs_percentage']) >= 0) ? 1 : 0;
        $totalScore += $P33;

        $P34 = (intval($data['joint_events_with_muslim_orgs']) >= 0) ? 1 : 0;
        $totalScore += $P34;

        $P35 = (floatval($data['founders_funding_share']) >= 0) ? 1 : 0;
        $totalScore += $P35;

        $P36 = (floatval($data['donations_share']) >= 0) ? 1 : 0;
        $totalScore += $P36;

        $P37 = (floatval($data['paid_education_share']) >= 0) ? 1 : 0;
        $totalScore += $P37;

        $P38 = (intval($data['scientific_events_held']) >= 0) ? 1 : 0;
        $totalScore += $P38;

        $P39 = (floatval($data['students_in_science_percentage']) >= 0) ? 1 : 0;
        $totalScore += $P39;

        $P40 = $yesNoToInt($data['has_educational_plan']);
        $totalScore += $P40;

        $P41 = (intval($data['lectures_by_foreign_scholars']) >= 0) ? 1 : 0;
        $totalScore += $P41;

        $P42 = (intval($data['international_memberships']) >= 0) ? 1 : 0;
        $totalScore += $P42;

        $P43 = $yesNoToInt($data['prepared_audiovisual_content']);
        $totalScore += $P43;

        $P44 = (intval($data['academic_exchanges_teachers']) >= 0) ? 1 : 0;
        $totalScore += $P44;

        $P45 = (floatval($data['teachers_advanced_training_percentage']) >= 0) ? 1 : 0;
        $totalScore += $P45;

        return $totalScore;
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\FormEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversityFormController extends Controller
{
    public function index()
    {
        return view('university.dashboard');
    }

    public function showForm()
    {
        $formEntry = Auth::user()->formEntry;

        if ($formEntry && $formEntry->is_submitted) {
            return redirect()->route('university.dashboard')->with(
                'error',
                'Форма уже отправлена и не может быть изменена.'
            );
        }

        return view('university.form', compact('formEntry'));
    }

    public function submitForm(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Перечисляем все поля файлов:
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

        // Формируем правила валидации, все file_ поля теперь массивы
        // Вместо одиночных правил делаем array + *.file
        $validationRules = [
            'program_theology' => 'required|in:ДА,НЕТ',
            'state_accreditation' => 'required|in:ДА,НЕТ',
            'compliance_percentage' => 'required|numeric|min:0|max:100',
            'test_results' => 'required|numeric|min:0|max:100',
            'employment_rate' => 'required|numeric|min:0|max:100',
            'full_time_students' => 'required|integer|min:0',
            'npr_coverage' => 'required|numeric|min:0|max:100',
            'degree_holders_percentage' => 'required|numeric|min:0|max:100',
            'grant_funding' => 'required|numeric|min:0',
            'vak_publications_per_npr' => 'required|numeric|min:0',
            'monographs_per_npr' => 'required|numeric|min:0',
            'h_index_per_npr' => 'required|numeric|min:0',
            'olympiad_winners' => 'required|integer|min:0',
            'patriotic_events' => 'required|integer|min:0',
            'website_compliance' => 'required|numeric|min:0|max:100',
            'media_activity' => 'required|integer|min:0',
            'indigenous_students_percentage' => 'required|numeric|min:0|max:100',

            'national_events_per_npr' => 'required|numeric|min:0',
            'internal_quality_system' => 'required|in:Имеется,Отсутствует',
            'professional_competitions' => 'required|integer|min:0',
            'npr_award_winners' => 'required|integer|min:0',
            'graduates_percentage' => 'required|numeric|min:0|max:100',
            'postgraduate_percentage' => 'required|numeric|min:0|max:100',
            'ebs_usage_percentage' => 'required|numeric|min:0|max:100',
            'programs_availability' => 'required|numeric|min:0|max:100',
            'eios_usage_percentage' => 'required|numeric|min:0|max:100',
            'international_agreements' => 'required|in:ДА,НЕТ',
            'medrese_graduates_percentage' => 'required|numeric|min:0|max:100',
            'non_scientific_publications' => 'required|in:ДА,НЕТ',
            'students_under_25_percentage' => 'required|numeric|min:0|max:100',
            'students_from_muslim_orgs_percentage' => 'required|numeric|min:0|max:100',
            'muslim_orgs_involved' => 'required|integer|min:0',
            'graduates_employed_in_muslim_orgs_percentage' => 'required|numeric|min:0|max:100',
            'joint_events_with_muslim_orgs' => 'required|integer|min:0',
            'founders_funding_share' => 'required|numeric|min:0|max:100',
            'donations_share' => 'required|numeric|min:0|max:100',
            'paid_education_share' => 'required|numeric|min:0|max:100',
            'scientific_events_held' => 'required|integer|min:0',
            'students_in_science_percentage' => 'required|numeric|min:0|max:100',
            'has_educational_plan' => 'required|in:ДА,НЕТ',
            'lectures_by_foreign_scholars' => 'required|integer|min:0',
            'international_memberships' => 'required|integer|min:0',
            'prepared_audiovisual_content' => 'required|in:ДА,НЕТ',
            'academic_exchanges_teachers' => 'required|integer|min:0',
            'teachers_advanced_training_percentage' => 'required|numeric|min:0|max:100',
        ];

        // Для каждого file_ поля добавляем правила array и file.*
        foreach ($fileFields as $fileField) {
            $validationRules[$fileField] = 'nullable|array';
            $validationRules[$fileField . '.*'] = 'file|mimes:pdf,doc,docx';
        }

        $validatedData = $request->validate($validationRules);

        $formEntry = Auth::user()->formEntry;
        $data = $validatedData;

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                // Получаем массив загруженных файлов
                $uploadedFiles = $request->file($fileField);

                // Может быть ситуация, что поле одно, но с multiple его станет массивом
                // Если как-то получится что только один файл, нужно привести к массиву
                if (!is_array($uploadedFiles)) {
                    $uploadedFiles = [$uploadedFiles];
                }

                $paths = [];
                foreach ($uploadedFiles as $file) {
                    // Сохраняем каждый файл
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');
                    $paths[] = $path;
                }

                // Теперь $validatedData[$fileField] будет содержать массив путей
                $validatedData[$fileField] = $paths;
            } elseif (isset($formEntry->data[$fileField])) {
                // Если файлы не загружены в этот раз, оставляем старые пути
                $validatedData[$fileField] = $formEntry->data[$fileField];
            } else {
                // Если никаких данных не было и нет, можем установить пустой массив
                $validatedData[$fileField] = [];
            }
        }

        // Подсчет баллов
        $score = $this->calculateScore($validatedData);

        // Сохранение
        // Убедитесь, что в модели FormEntry у вас есть cast: protected $casts = ['data' => 'array'];
        $formEntry = FormEntry::updateOrCreate(
            ['university_id' => Auth::id()],
            [
                'data' => $validatedData,
                'score' => $score,
            ]
        );

        return redirect()->route('university.form')->with('success', 'Форма успешно отправлена.');
    }

    public function savePartial(Request $request)
    {
        $formEntry = Auth::user()->formEntry;

        $data = $formEntry->data ?? []; // Получаем текущие данные из формы
        $data = array_merge($data, $request->only(array_keys($request->all()))); // Обновляем данные

        $formEntry = FormEntry::updateOrCreate(
            ['university_id' => Auth::id()],
            ['data' => $data]
        );

        return response()->json(['success' => true, 'message' => 'Данные успешно сохранены.']);
    }


    public function calculateScore($data)
    {
        $totalScore = 0;

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

        $S8 = floatval($data['degree_holders_percentage']); // Уже рассчитанный процент
        if ($S8 < 10) {
            $P8 = 0;
        } elseif ($S8 >= 10 && $S8 < 25) {
            $P8 = 0.4 * $S8 - 2;
        } else {
            $P8 = 6;
        }
        $totalScore += $P8;


        $S9 = floatval($data['grant_funding']); // Уже рассчитанный процент
        if ($S9 < 50) {
            $P9 = 0;
        } elseif ($S9 >= 50 && $S9 < 80) {
            $P9 = (1 / 3) * $S9 - (50 / 3);
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

        $S11 = floatval($data['monographs_per_npr']); // Уже рассчитанный процент
        if ($S11 < 20) {
            $P11 = 0;
        } elseif ($S11 >= 20 && $S11 < 60) {
            $P11 = 0.25 * $S11 - 5;
        } else {
            $P11 = 10;
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

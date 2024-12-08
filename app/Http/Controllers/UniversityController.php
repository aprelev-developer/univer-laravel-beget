<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        return view('university.dashboard');
    }

    public function form()
    {
        $form = auth()->user()->form;

        return view('university.form', compact('form'));
    }

    public function storeForm(Request $request)
    {
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
            'international_memberships',
            'file_prepared_audiovisual_content',
            'file_academic_exchanges_teachers',
            'file_lectures_by_foreign_scholars',
            'file_teachers_advanced_training_percentage',
        ];

        // Валидация данных
        $rules = [
            // Добавьте правила валидации для всех полей
            'data.program_theology' => 'required|string',
            'data.state_accreditation' => 'required|string',
            'data.compliance_percentage' => 'required|integer|min:0|max:100',
            'data.test_results' => 'required|integer|min:0|max:100',
            'data.employment_rate' => 'required|integer|min:0|max:100',
            'data.full_time_students' => 'required|integer|min:0',
            'data.npr_coverage' => 'required|integer|min:0|max:100',
            'data.degree_holders_percentage' => 'required|integer|min:0|max:100',
            'data.grant_funding' => 'required|integer|min:0',
            'data.vak_publications_per_npr' => 'required|numeric|min:0',
            'data.monographs_per_npr' => 'required|numeric|min:0',
            'data.h_index_per_npr' => 'required|numeric|min:0',
            'data.olympiad_winners' => 'required|integer|min:0',
            'data.patriotic_events' => 'required|integer|min:0',
            'data.website_compliance' => 'required|integer|min:0|max:100',
            'data.media_activity' => 'required|integer|min:0',
            'data.international_agreements' => 'required|string',
            'data.medrese_graduates_percentage' => 'required|integer|min:0|max:100',
            'data.non_scientific_publications' => 'required|string',
            'data.students_under_25_percentage' => 'required|integer|min:0|max:100',
            'data.students_from_muslim_orgs_percentage' => 'required|integer|min:0|max:100',
            'data.muslim_orgs_involved' => 'required|integer|min:0',
            'data.graduates_employed_in_muslim_orgs_percentage' => 'required|integer|min:0|max:100',
            'data.joint_events_with_muslim_orgs' => 'required|integer|min:0',
            'data.founders_funding_share' => 'required|integer|min:0|max:100',
            'data.donations_share' => 'required|integer|min:0|max:100',
            'data.paid_education_share' => 'required|integer|min:0|max:100',
            'data.scientific_events_held' => 'required|integer|min:0',
            'data.students_in_science_percentage' => 'required|integer|min:0|max:100',
            'data.has_educational_plan' => 'required|string',
            'data.lectures_by_foreign_scholars' => 'required|integer|min:0',
            'data.teachers_advanced_training_percentage' => 'required|integer|min:0|max:100',
        ];

        // Добавьте правила валидации для файлов
        foreach ($fileFields as $fileField) {
            $rules["data.$fileField"] = 'nullable|file|mimes:jpg,png,pdf,docx|max:2048';
        }

        $validatedData = $request->validate($rules);

        $data = $validatedData['data'];

        // Обработка загрузки файлов
        foreach ($fileFields as $fileField) {
            if ($request->hasFile("data.$fileField")) {
                $file = $request->file("data.$fileField");
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public');
                $data[$fileField] = $path;
            }
        }

        // Сохранение данных в базе
        Form::updateOrCreate(
            ['university_id' => auth()->id()],
            ['data' => $data]
        );

        return redirect()->route('university.dashboard')->with('success', 'Форма сохранена.');
    }
}

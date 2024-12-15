<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpertController extends Controller
{
    public function index()
    {
        // Получаем эксперта
        $expert = Auth::user();
        // Получаем университеты, закреплённые за экспертом
        $universities = $expert->universities()->with('formEntry')->get();

        // На странице покажем таблицу: Университет | Баллы | Действия (Просмотреть/Редактировать)
        return view('expert.index', compact('universities'));
    }

    public function review(User $university)
    {
        if (!auth()->user()->universities->contains($university)) {
            abort(403, 'Доступ запрещен');
        }

        $form = $university->form;

        if (!$form) {
            return redirect()->back()->with('error', 'Форма еще не заполнена.');
        }

        return view('expert.review', compact('university', 'form'));
    }

    public function viewUniversities()
    {
        $universities = auth()->user()->universities;
        return view('expert.universities', compact('universities'));
    }

    public function viewForm($id)
    {
        $university = User::findOrFail($id);

        // Проверка, что эксперт закреплен за этим вузом
        if (!auth()->user()->universities->contains($university)) {
            abort(403, 'Доступ запрещен');
        }

        $formEntry = $university->formEntry;

        return view('expert.viewForm', compact('university', 'formEntry'));
    }

 public function editForm($universityId)
{
    // Проверка, что эксперт прикреплен к этому универу
    $expert = Auth::user();

    // Указываем таблицу явно, чтобы избежать ошибки
    $university = $expert->universities()
        ->where('expert_university.university_id', $universityId)
        ->firstOrFail();

    $formEntry = $university->formEntry;

    // Проверяем, можно ли редактировать
    if (!$formEntry || $formEntry->is_editable == false) {
        return redirect()->route('expert.index')->with('error', 'Редактирование запрещено или форма не найдена.');
    }

    // Отображаем форму с данными $formEntry->data
    return view('expert.edit_form', compact('university', 'formEntry'));
}


    public function updateForm(Request $request, $universityId)
{
    $expert = Auth::user();
    $university = $expert->universities()->where('university_id', $universityId)->firstOrFail();
    $formEntry = $university->formEntry;

    if (!$formEntry || !$formEntry->is_editable) {
        return redirect()->route('expert.index')->with('error', 'Невозможно редактировать.');
    }

    // Правила валидации для файлов меняются на массивы
    $validatedData = $request->validate([
        // ЧАСТЬ 1
        'program_theology' => 'required|in:ДА,НЕТ',
        'file_program_theology' => 'nullable|array',
        'file_program_theology.*' => 'file|mimes:pdf,doc,docx',

        'state_accreditation' => 'required|in:ДА,НЕТ',
        'file_state_accreditation' => 'nullable|array',
        'file_state_accreditation.*' => 'file|mimes:pdf,doc,docx',

        'compliance_percentage' => 'required|numeric|min:0|max:100',
        'file_compliance_percentage' => 'nullable|array',
        'file_compliance_percentage.*' => 'file|mimes:pdf,doc,docx',

        'test_results' => 'required|numeric|min:0|max:100',
        'file_test_results' => 'nullable|array',
        'file_test_results.*' => 'file|mimes:pdf,doc,docx',

        'employment_rate' => 'required|numeric|min:0|max:100',
        'file_employment_rate' => 'nullable|array',
        'file_employment_rate.*' => 'file|mimes:pdf,doc,docx',

        'full_time_students' => 'required|integer|min:0',
        'file_full_time_students' => 'nullable|array',
        'file_full_time_students.*' => 'file|mimes:pdf,doc,docx',

        'npr_coverage' => 'required|numeric|min:0|max:100',
        'file_npr_coverage' => 'nullable|array',
        'file_npr_coverage.*' => 'file|mimes:pdf,doc,docx',

        'degree_holders_percentage' => 'required|numeric|min:0|max:100',
        'file_degree_holders_percentage' => 'nullable|array',
        'file_degree_holders_percentage.*' => 'file|mimes:pdf,doc,docx',

        'grant_funding' => 'required|numeric|min:0',
        'file_grant_funding' => 'nullable|array',
        'file_grant_funding.*' => 'file|mimes:pdf,doc,docx',

        'vak_publications_per_npr' => 'required|numeric|min:0',
        'file_vak_publications_per_npr' => 'nullable|array',
        'file_vak_publications_per_npr.*' => 'file|mimes:pdf,doc,docx',

        'monographs_per_npr' => 'required|numeric|min:0',
        'file_monographs_per_npr' => 'nullable|array',
        'file_monographs_per_npr.*' => 'file|mimes:pdf,doc,docx',

        'h_index_per_npr' => 'required|numeric|min:0',
        'file_h_index_per_npr' => 'nullable|array',
        'file_h_index_per_npr.*' => 'file|mimes:pdf,doc,docx',

        'olympiad_winners' => 'required|integer|min:0',
        'file_olympiad_winners' => 'nullable|array',
        'file_olympiad_winners.*' => 'file|mimes:pdf,doc,docx',

        'patriotic_events' => 'required|integer|min:0',
        'file_patriotic_events' => 'nullable|array',
        'file_patriotic_events.*' => 'file|mimes:pdf,doc,docx',

        'website_compliance' => 'required|numeric|min:0|max:100',
        'file_website_compliance' => 'nullable|array',
        'file_website_compliance.*' => 'file|mimes:pdf,doc,docx',

        'media_activity' => 'required|integer|min:0',
        'file_media_activity' => 'nullable|array',
        'file_media_activity.*' => 'file|mimes:pdf,doc,docx',

        'indigenous_students_percentage' => 'required|numeric|min:0|max:100',
        'file_indigenous_students_percentage' => 'nullable|array',
        'file_indigenous_students_percentage.*' => 'file|mimes:pdf,doc,docx',

        // ЧАСТЬ 2
        'national_events_per_npr' => 'required|numeric|min:0',
        'file_national_events_per_npr' => 'nullable|array',
        'file_national_events_per_npr.*' => 'file|mimes:pdf,doc,docx',

        'internal_quality_system' => 'required|in:Имеется,Отсутствует',
        'file_internal_quality_system' => 'nullable|array',
        'file_internal_quality_system.*' => 'file|mimes:pdf,doc,docx',

        'professional_competitions' => 'required|integer|min:0',
        'file_professional_competitions' => 'nullable|array',
        'file_professional_competitions.*' => 'file|mimes:pdf,doc,docx',

        'npr_award_winners' => 'required|integer|min:0',
        'file_npr_award_winners' => 'nullable|array',
        'file_npr_award_winners.*' => 'file|mimes:pdf,doc,docx',

        'graduates_percentage' => 'required|numeric|min:0|max:100',
        'file_graduates_percentage' => 'nullable|array',
        'file_graduates_percentage.*' => 'file|mimes:pdf,doc,docx',

        'postgraduate_percentage' => 'required|numeric|min:0|max:100',
        'file_postgraduate_percentage' => 'nullable|array',
        'file_postgraduate_percentage.*' => 'file|mimes:pdf,doc,docx',

        'ebs_usage_percentage' => 'required|numeric|min:0|max:100',
        'file_ebs_usage_percentage' => 'nullable|array',
        'file_ebs_usage_percentage.*' => 'file|mimes:pdf,doc,docx',

        'programs_availability' => 'required|numeric|min:0|max:100',
        'file_programs_availability' => 'nullable|array',
        'file_programs_availability.*' => 'file|mimes:pdf,doc,docx',

        'eios_usage_percentage' => 'required|numeric|min:0|max:100',
        'file_eios_usage_percentage' => 'nullable|array',
        'file_eios_usage_percentage.*' => 'file|mimes:pdf,doc,docx',

        'international_agreements' => 'required|in:ДА,НЕТ',
        'file_international_agreements' => 'nullable|array',
        'file_international_agreements.*' => 'file|mimes:pdf,doc,docx',

        'medrese_graduates_percentage' => 'required|numeric|min:0|max:100',
        'file_medrese_graduates_percentage' => 'nullable|array',
        'file_medrese_graduates_percentage.*' => 'file|mimes:pdf,doc,docx',

        'non_scientific_publications' => 'required|in:ДА,НЕТ',
        'file_non_scientific_publications' => 'nullable|array',
        'file_non_scientific_publications.*' => 'file|mimes:pdf,doc,docx',

        'students_under_25_percentage' => 'required|numeric|min:0|max:100',
        'file_students_under_25_percentage' => 'nullable|array',
        'file_students_under_25_percentage.*' => 'file|mimes:pdf,doc,docx',

        'students_from_muslim_orgs_percentage' => 'required|numeric|min:0|max:100',
        'file_students_from_muslim_orgs_percentage' => 'nullable|array',
        'file_students_from_muslim_orgs_percentage.*' => 'file|mimes:pdf,doc,docx',

        'muslim_orgs_involved' => 'required|integer|min:0',
        'file_muslim_orgs_involved' => 'nullable|array',
        'file_muslim_orgs_involved.*' => 'file|mimes:pdf,doc,docx',

        'graduates_employed_in_muslim_orgs_percentage' => 'required|numeric|min:0|max:100',
        'file_graduates_employed_in_muslim_orgs_percentage' => 'nullable|array',
        'file_graduates_employed_in_muslim_orgs_percentage.*' => 'file|mimes:pdf,doc,docx',

        'joint_events_with_muslim_orgs' => 'required|integer|min:0',
        'file_joint_events_with_muslim_orgs' => 'nullable|array',
        'file_joint_events_with_muslim_orgs.*' => 'file|mimes:pdf,doc,docx',

        'founders_funding_share' => 'required|numeric|min:0|max:100',
        'file_founders_funding_share' => 'nullable|array',
        'file_founders_funding_share.*' => 'file|mimes:pdf,doc,docx',

        'donations_share' => 'required|numeric|min:0|max:100',
        'file_donations_share' => 'nullable|array',
        'file_donations_share.*' => 'file|mimes:pdf,doc,docx',

        'paid_education_share' => 'required|numeric|min:0|max:100',
        'file_paid_education_share' => 'nullable|array',
        'file_paid_education_share.*' => 'file|mimes:pdf,doc,docx',

        'scientific_events_held' => 'required|integer|min:0',
        'file_scientific_events_held' => 'nullable|array',
        'file_scientific_events_held.*' => 'file|mimes:pdf,doc,docx',

        'students_in_science_percentage' => 'required|numeric|min:0|max:100',
        'file_students_in_science_percentage' => 'nullable|array',
        'file_students_in_science_percentage.*' => 'file|mimes:pdf,doc,docx',

        'has_educational_plan' => 'required|in:ДА,НЕТ',
        'file_has_educational_plan' => 'nullable|array',
        'file_has_educational_plan.*' => 'file|mimes:pdf,doc,docx',

        'lectures_by_foreign_scholars' => 'required|integer|min:0',
        'file_lectures_by_foreign_scholars' => 'nullable|array',
        'file_lectures_by_foreign_scholars.*' => 'file|mimes:pdf,doc,docx',

        'international_memberships' => 'required|integer|min:0',
        'file_international_memberships' => 'nullable|array',
        'file_international_memberships.*' => 'file|mimes:pdf,doc,docx',

        'prepared_audiovisual_content' => 'required|in:ДА,НЕТ',
        'file_prepared_audiovisual_content' => 'nullable|array',
        'file_prepared_audiovisual_content.*' => 'file|mimes:pdf,doc,docx',

        'academic_exchanges_teachers' => 'required|integer|min:0',
        'file_academic_exchanges_teachers' => 'nullable|array',
        'file_academic_exchanges_teachers.*' => 'file|mimes:pdf,doc,docx',

        'teachers_advanced_training_percentage' => 'required|numeric|min:0|max:100',
        'file_teachers_advanced_training_percentage' => 'nullable|array',
        'file_teachers_advanced_training_percentage.*' => 'file|mimes:pdf,doc,docx',
    ]);

    // Список всех полей с файлами
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

    // Обработка файлов: добавляем новые к уже существующим
    foreach ($fileFields as $fileField) {
        $existingFiles = $formEntry->data[$fileField] ?? [];
        if ($request->hasFile($fileField)) {
            foreach($request->file($fileField) as $file) {
                $filePath = $file->store('uploads', 'public');
                $existingFiles[] = $filePath;
            }
        }
        $validatedData[$fileField] = $existingFiles;
    }

    // Пересчитываем баллы
    $score = (new UniversityFormController())->calculateScore($validatedData);

    // Сохранение
    $formEntry->update([
        'data' => $validatedData,
        'score' => $score,
        'is_editable' => false,
    ]);

    return redirect()->route('expert.dashboard')->with('success', 'Форма успешно обновлена и редактирование закрыто.');
}

}

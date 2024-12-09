@extends('layouts.app')
<style>
    /* Общие стили */
body {
    background: #f5fff5; /* Светло-зеленый пастельный оттенок для фона */
    font-family: "Segoe UI", sans-serif;
    color: #333;
}

h1, h3, label {
    font-family: "Segoe UI", sans-serif;
    font-weight: 600;
    color: #2b572c; /* Темно-зеленый оттенок для заголовков и текста */
}

h1 {
    font-size: 28px;
    text-align: center;
    margin-bottom: 20px;
}

h3 {
    font-size: 22px;
    margin-top: 40px;
    margin-bottom: 20px;
    border-bottom: 2px solid #2b572c;
    padding-bottom: 5px;
}

/* Контейнер формы */
.container {
    max-width: 1200px;
    margin: 30px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

/* Формы и поля ввода */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-control {
    border-radius: 4px;
    border: 1px solid #a6d1a6;
    box-shadow: none;
    transition: border-color 0.2s ease;
}

.form-control:focus {
    border-color: #2b572c;
    box-shadow: 0 0 0 1px #2b572c33;
}

input[type="file"] {
    padding: 5px 0;
}

/* Кнопки */
.btn-success {
    background: #3d8b3d;
    border: none;
    border-radius: 4px;
    font-weight: 500;
    padding: 10px 20px;
    transition: background 0.3s ease;
}

.btn-success:hover {
    background: #2b572c;
}

/* Оповещения */
.alert {
    border-radius: 4px;
    margin-top: 20px;
    border: 1px solid transparent;
}

.alert-success {
    background: #e4f7e4;
    border-color: #3d8b3d;
    color: #2b572c;
}

.alert-danger {
    background: #fdeaea;
    border-color: #e56b6b;
    color: #a33c3c;
}

.alert ul {
    margin: 0;
    padding-left: 20px;
}

/* Список уже загруженных файлов */
.uploaded-files-list {
    list-style: disc;
    padding-left: 20px;
    margin-top: 10px;
    margin-bottom: 20px;
    color: #2b572c;
}

.uploaded-files-list li {
    margin-bottom: 5px;
}

.uploaded-files-list a {
    color: #3d8b3d;
    text-decoration: none;
}

.uploaded-files-list a:hover {
    text-decoration: underline;
}

/* Дополнительный акцент */
label[for^="file_"] {
    font-weight: 500;
    display: block;
    margin-bottom: 5px;
    color: #2b572c;
}

.btn-success.mt-4 {
    margin-top: 30px !important;
}

</style>
@section('content')
<div class="container">
    <h1>Редактирование формы для: {{ $university->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Ошибки валидации:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('expert.update_form', $university->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- ЧАСТЬ 1 -->
        <h3>ЧАСТЬ 1</h3>

        <!-- 1. program_theology -->
        <div class="form-group">
            <label>1. Наличие реализуемой образовательной программы «Теология»</label>
            <select name="program_theology" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('program_theology', $formEntry->data['program_theology'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('program_theology', $formEntry->data['program_theology'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_program_theology'] ?? [], 'name' => 'file_program_theology'])

        <!-- 2. state_accreditation -->
        <div class="form-group">
            <label>2. Наличие государственной аккредитации</label>
            <select name="state_accreditation" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('state_accreditation', $formEntry->data['state_accreditation'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('state_accreditation', $formEntry->data['state_accreditation'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_state_accreditation'] ?? [], 'name' => 'file_state_accreditation'])

        <!-- 3. compliance_percentage -->
        <div class="form-group">
            <label>3. Соблюдение при реализации программ (%)</label>
            <input type="number" name="compliance_percentage" class="form-control" min="0" max="100" value="{{ old('compliance_percentage', $formEntry->data['compliance_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_compliance_percentage'] ?? [], 'name' => 'file_compliance_percentage'])

        <!-- 4. test_results -->
        <div class="form-group">
            <label>4. Результаты тестирования (%)</label>
            <input type="number" name="test_results" class="form-control" min="0" max="100" value="{{ old('test_results', $formEntry->data['test_results'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_test_results'] ?? [], 'name' => 'file_test_results'])

        <!-- 5. employment_rate -->
        <div class="form-group">
            <label>5. Доля трудоустроенных по специальности выпускников за последние 3 года (%)</label>
            <input type="number" name="employment_rate" class="form-control" min="0" max="100" value="{{ old('employment_rate', $formEntry->data['employment_rate'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_employment_rate'] ?? [], 'name' => 'file_employment_rate'])

        <!-- 6. full_time_students -->
        <div class="form-group">
            <label>6. Количество студентов очной формы обучения</label>
            <input type="number" name="full_time_students" class="form-control" min="0" value="{{ old('full_time_students', $formEntry->data['full_time_students'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_full_time_students'] ?? [], 'name' => 'file_full_time_students'])

        <!-- 7. npr_coverage -->
        <div class="form-group">
            <label>7. Степень обеспеченности реализации ООП НПР (%)</label>
            <input type="number" name="npr_coverage" class="form-control" min="0" max="100" value="{{ old('npr_coverage', $formEntry->data['npr_coverage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_npr_coverage'] ?? [], 'name' => 'file_npr_coverage'])

        <!-- 8. degree_holders_percentage -->
        <div class="form-group">
            <label>8. Доля НПР с ученой степенью (%)</label>
            <input type="number" name="degree_holders_percentage" class="form-control" min="0" max="100" value="{{ old('degree_holders_percentage', $formEntry->data['degree_holders_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_degree_holders_percentage'] ?? [], 'name' => 'file_degree_holders_percentage'])

        <!-- 9. founders_funding_share -->
        <div class="form-group">
            <label>9. Доля финансовых средств учредителей (%)</label>
            <input type="number" name="founders_funding_share" class="form-control" min="0" max="100" value="{{ old('founders_funding_share', $formEntry->data['founders_funding_share'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_founders_funding_share'] ?? [], 'name' => 'file_founders_funding_share'])

        <!-- 10. grant_funding -->
        <div class="form-group">
            <label>10. Объем грантового финансирования (руб.)</label>
            <input type="number" name="grant_funding" class="form-control" min="0" value="{{ old('grant_funding', $formEntry->data['grant_funding'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_grant_funding'] ?? [], 'name' => 'file_grant_funding'])

        <!-- 11. vak_publications_per_npr -->
        <div class="form-group">
            <label>11. Количество публикаций в журналах ВАК (на 1 НПР)</label>
            <input type="number" name="vak_publications_per_npr" class="form-control" min="0" step="0.01" value="{{ old('vak_publications_per_npr', $formEntry->data['vak_publications_per_npr'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_vak_publications_per_npr'] ?? [], 'name' => 'file_vak_publications_per_npr'])

        <!-- 12. monographs_per_npr -->
        <div class="form-group">
            <label>12. Кол-во монографий на одного НПР</label>
            <input type="number" name="monographs_per_npr" class="form-control" min="0" step="0.01" value="{{ old('monographs_per_npr', $formEntry->data['monographs_per_npr'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_monographs_per_npr'] ?? [], 'name' => 'file_monographs_per_npr'])

        <!-- 13. h_index_per_npr -->
        <div class="form-group">
            <label>13. Средний индекс Хирша (на 1 НПР)</label>
            <input type="number" name="h_index_per_npr" class="form-control" min="0" step="0.01" value="{{ old('h_index_per_npr', $formEntry->data['h_index_per_npr'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_h_index_per_npr'] ?? [], 'name' => 'file_h_index_per_npr'])

        <!-- 14. olympiad_winners -->
        <div class="form-group">
            <label>14. Кол-во победителей олимпиад (человек)</label>
            <input type="number" name="olympiad_winners" class="form-control" min="0" value="{{ old('olympiad_winners', $formEntry->data['olympiad_winners'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_olympiad_winners'] ?? [], 'name' => 'file_olympiad_winners'])

        <!-- 15. patriotic_events -->
        <div class="form-group">
            <label>15. Мероприятия гражданско-патриотической направленности (кол-во)</label>
            <input type="number" name="patriotic_events" class="form-control" min="0" value="{{ old('patriotic_events', $formEntry->data['patriotic_events'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_patriotic_events'] ?? [], 'name' => 'file_patriotic_events'])

        <!-- 16. website_compliance -->
        <div class="form-group">
            <label>16. Соответствие сайта требованиям (%)</label>
            <input type="number" name="website_compliance" class="form-control" min="0" max="100" value="{{ old('website_compliance', $formEntry->data['website_compliance'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_website_compliance'] ?? [], 'name' => 'file_website_compliance'])

        <!-- 17. media_activity -->
        <div class="form-group">
            <label>17. Медийная активность (публикаций в год)</label>
            <input type="number" name="media_activity" class="form-control" min="0" value="{{ old('media_activity', $formEntry->data['media_activity'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_media_activity'] ?? [], 'name' => 'file_media_activity'])

        <!-- 18. indigenous_students_percentage -->
        <div class="form-group">
            <label>18. Кол-во студентов из коренных народов РФ (%)</label>
            <input type="number" name="indigenous_students_percentage" class="form-control" min="0" max="100" value="{{ old('indigenous_students_percentage', $formEntry->data['indigenous_students_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_indigenous_students_percentage'] ?? [], 'name' => 'file_indigenous_students_percentage'])


        <!-- ЧАСТЬ 2 -->
        <h3>ЧАСТЬ 2</h3>

        <!-- 1. national_events_per_npr -->
        <div class="form-group">
            <label>1 (Ч2). Участие во всероссийских мероприятиях (на 1 НПР)</label>
            <input type="number" name="national_events_per_npr" class="form-control" min="0" step="0.01" value="{{ old('national_events_per_npr', $formEntry->data['national_events_per_npr'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_national_events_per_npr'] ?? [], 'name' => 'file_national_events_per_npr'])

        <!-- 2. internal_quality_system -->
        <div class="form-group">
            <label>2 (Ч2). Наличие внутренней системы качества</label>
            <select name="internal_quality_system" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="Имеется" {{ (old('internal_quality_system', $formEntry->data['internal_quality_system'] ?? '') == 'Имеется') ? 'selected' : '' }}>Имеется</option>
                <option value="Отсутствует" {{ (old('internal_quality_system', $formEntry->data['internal_quality_system'] ?? '') == 'Отсутствует') ? 'selected' : '' }}>Отсутствует</option>
            </select>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_internal_quality_system'] ?? [], 'name' => 'file_internal_quality_system'])

        <!-- 3. professional_competitions -->
        <div class="form-group">
            <label>3 (Ч2). Кол-во конкурсов проф. направленности</label>
            <input type="number" name="professional_competitions" class="form-control" min="0" value="{{ old('professional_competitions', $formEntry->data['professional_competitions'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_professional_competitions'] ?? [], 'name' => 'file_professional_competitions'])

        <!-- 4. npr_award_winners -->
        <div class="form-group">
            <label>4 (Ч2). Победители и призеры региональных/всероссийских конкурсов НПР</label>
            <input type="number" name="npr_award_winners" class="form-control" min="0" value="{{ old('npr_award_winners', $formEntry->data['npr_award_winners'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_npr_award_winners'] ?? [], 'name' => 'file_npr_award_winners'])

        <!-- 5. graduates_percentage -->
        <div class="form-group">
            <label>5 (Ч2). Процент выпускников к общему числу поступивших (%)</label>
            <input type="number" name="graduates_percentage" class="form-control" min="0" max="100" value="{{ old('graduates_percentage', $formEntry->data['graduates_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_graduates_percentage'] ?? [], 'name' => 'file_graduates_percentage'])

        <!-- 6. postgraduate_percentage -->
        <div class="form-group">
            <label>6 (Ч2). Процент выпускников бакалавриата, продолжающих обучение (%)</label>
            <input type="number" name="postgraduate_percentage" class="form-control" min="0" max="100" value="{{ old('postgraduate_percentage', $formEntry->data['postgraduate_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_postgraduate_percentage'] ?? [], 'name' => 'file_postgraduate_percentage'])

        <!-- 7. ebs_usage_percentage -->
        <div class="form-group">
            <label>7 (Ч2). Процент использования ЭБС (%)</label>
            <input type="number" name="ebs_usage_percentage" class="form-control" min="0" max="100" value="{{ old('ebs_usage_percentage', $formEntry->data['ebs_usage_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_ebs_usage_percentage'] ?? [], 'name' => 'file_ebs_usage_percentage'])

        <!-- 8. programs_availability -->
        <div class="form-group">
            <label>8 (Ч2). Доступность разработанных программ (%)</label>
            <input type="number" name="programs_availability" class="form-control" min="0" max="100" value="{{ old('programs_availability', $formEntry->data['programs_availability'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_programs_availability'] ?? [], 'name' => 'file_programs_availability'])

        <!-- 9. eios_usage_percentage -->
        <div class="form-group">
            <label>9 (Ч2). Процент использования ЭИОС (%)</label>
            <input type="number" name="eios_usage_percentage" class="form-control" min="0" max="100" value="{{ old('eios_usage_percentage', $formEntry->data['eios_usage_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_eios_usage_percentage'] ?? [], 'name' => 'file_eios_usage_percentage'])

        <!-- 10. international_agreements -->
        <div class="form-group">
            <label>10 (Ч2). Международные соглашения</label>
            <select name="international_agreements" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('international_agreements', $formEntry->data['international_agreements'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('international_agreements', $formEntry->data['international_agreements'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_international_agreements'] ?? [], 'name' => 'file_international_agreements'])

        <!-- 11. medrese_graduates_percentage -->
        <div class="form-group">
            <label>11 (Ч2). Процент выпускников медресе (%)</label>
            <input type="number" name="medrese_graduates_percentage" class="form-control" min="0" max="100" value="{{ old('medrese_graduates_percentage', $formEntry->data['medrese_graduates_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_medrese_graduates_percentage'] ?? [], 'name' => 'file_medrese_graduates_percentage'])

        <!-- 12. non_scientific_publications -->
        <div class="form-group">
            <label>12 (Ч2). Издание не связанных с наукой материалов</label>
            <select name="non_scientific_publications" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('non_scientific_publications', $formEntry->data['non_scientific_publications'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('non_scientific_publications', $formEntry->data['non_scientific_publications'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_non_scientific_publications'] ?? [], 'name' => 'file_non_scientific_publications'])

        <!-- 13. students_under_25_percentage -->
        <div class="form-group">
            <label>13 (Ч2). Процент студентов до 25 лет (%)</label>
            <input type="number" name="students_under_25_percentage" class="form-control" min="0" max="100" value="{{ old('students_under_25_percentage', $formEntry->data['students_under_25_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_students_under_25_percentage'] ?? [], 'name' => 'file_students_under_25_percentage'])

        <!-- 14. students_from_muslim_orgs_percentage -->
        <div class="form-group">
            <label>14 (Ч2). Процент студентов от мусульманских орг. (%)</label>
            <input type="number" name="students_from_muslim_orgs_percentage" class="form-control" min="0" max="100" value="{{ old('students_from_muslim_orgs_percentage', $formEntry->data['students_from_muslim_orgs_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_students_from_muslim_orgs_percentage'] ?? [], 'name' => 'file_students_from_muslim_orgs_percentage'])

        <!-- 15. muslim_orgs_involved -->
        <div class="form-group">
            <label>15 (Ч2). Количество мусульманских религ. орг. вовлеченных</label>
            <input type="number" name="muslim_orgs_involved" class="form-control" min="0" value="{{ old('muslim_orgs_involved', $formEntry->data['muslim_orgs_involved'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_muslim_orgs_involved'] ?? [], 'name' => 'file_muslim_orgs_involved'])

        <!-- 16. graduates_employed_in_muslim_orgs_percentage -->
        <div class="form-group">
            <label>16 (Ч2). Процент выпускников, трудоустроенных в мусульм. орг. (%)</label>
            <input type="number" name="graduates_employed_in_muslim_orgs_percentage" class="form-control" min="0" max="100" value="{{ old('graduates_employed_in_muslim_orgs_percentage', $formEntry->data['graduates_employed_in_muslim_orgs_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_graduates_employed_in_muslim_orgs_percentage'] ?? [], 'name' => 'file_graduates_employed_in_muslim_orgs_percentage'])

        <!-- 17. joint_events_with_muslim_orgs -->
        <div class="form-group">
            <label>17 (Ч2). Кол-во совместных мероприятий с мусульм. орг.</label>
            <input type="number" name="joint_events_with_muslim_orgs" class="form-control" min="0" value="{{ old('joint_events_with_muslim_orgs', $formEntry->data['joint_events_with_muslim_orgs'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_joint_events_with_muslim_orgs'] ?? [], 'name' => 'file_joint_events_with_muslim_orgs'])

        <!-- 18. founders_funding_share -->
        <div class="form-group">
            <label>18 (Ч2). Доля средств учредителей (%)</label>
            <input type="number" name="founders_funding_share" class="form-control" min="0" max="100" value="{{ old('founders_funding_share', $formEntry->data['founders_funding_share'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_founders_funding_share'] ?? [], 'name' => 'file_founders_funding_share'])

        <!-- 19. donations_share -->
        <div class="form-group">
            <label>19 (Ч2). Объем привлеченных пожертвований (%)</label>
            <input type="number" name="donations_share" class="form-control" min="0" max="100" value="{{ old('donations_share', $formEntry->data['donations_share'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_donations_share'] ?? [], 'name' => 'file_donations_share'])

        <!-- 20. paid_education_share -->
        <div class="form-group">
            <label>20 (Ч2). Доля платного образования (%)</label>
            <input type="number" name="paid_education_share" class="form-control" min="0" max="100" value="{{ old('paid_education_share', $formEntry->data['paid_education_share'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_paid_education_share'] ?? [], 'name' => 'file_paid_education_share'])

        <!-- 21. scientific_events_held -->
        <div class="form-group">
            <label>21 (Ч2). Кол-во научных/научно-метод. мероприятий</label>
            <input type="number" name="scientific_events_held" class="form-control" min="0" value="{{ old('scientific_events_held', $formEntry->data['scientific_events_held'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_scientific_events_held'] ?? [], 'name' => 'file_scientific_events_held'])

        <!-- 22. students_in_science_percentage -->
        <div class="form-group">
            <label>22 (Ч2). Процент студентов, участвующих в науке (%)</label>
            <input type="number" name="students_in_science_percentage" class="form-control" min="0" max="100" value="{{ old('students_in_science_percentage', $formEntry->data['students_in_science_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_students_in_science_percentage'] ?? [], 'name' => 'file_students_in_science_percentage'])

        <!-- 23. has_educational_plan -->
        <div class="form-group">
            <label>23 (Ч2). Наличие утвержденного плана воспитательной работы</label>
            <select name="has_educational_plan" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('has_educational_plan', $formEntry->data['has_educational_plan'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('has_educational_plan', $formEntry->data['has_educational_plan'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_has_educational_plan'] ?? [], 'name' => 'file_has_educational_plan'])

        <!-- 24. lectures_by_foreign_scholars -->
        <div class="form-group">
            <label>24 (Ч2). Количество лекций зарубежных ученых</label>
            <input type="number" name="lectures_by_foreign_scholars" class="form-control" min="0" value="{{ old('lectures_by_foreign_scholars', $formEntry->data['lectures_by_foreign_scholars'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_lectures_by_foreign_scholars'] ?? [], 'name' => 'file_lectures_by_foreign_scholars'])

        <!-- 25. international_memberships -->
        <div class="form-group">
            <label>25 (Ч2). Кол-во международных членств</label>
            <input type="number" name="international_memberships" class="form-control" min="0" value="{{ old('international_memberships', $formEntry->data['international_memberships'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_international_memberships'] ?? [], 'name' => 'file_international_memberships'])

        <!-- 26. prepared_audiovisual_content -->
        <div class="form-group">
            <label>26 (Ч2). Подготовка аудиовизуального контента</label>
            <select name="prepared_audiovisual_content" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('prepared_audiovisual_content', $formEntry->data['prepared_audiovisual_content'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('prepared_audiovisual_content', $formEntry->data['prepared_audiovisual_content'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_prepared_audiovisual_content'] ?? [], 'name' => 'file_prepared_audiovisual_content'])

        <!-- 27. academic_exchanges_teachers -->
        <div class="form-group">
            <label>27 (Ч2). Кол-во академических обменов НПР</label>
            <input type="number" name="academic_exchanges_teachers" class="form-control" min="0" value="{{ old('academic_exchanges_teachers', $formEntry->data['academic_exchanges_teachers'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_academic_exchanges_teachers'] ?? [], 'name' => 'file_academic_exchanges_teachers'])

        <!-- 28. teachers_advanced_training_percentage -->
        <div class="form-group">
            <label>28 (Ч2). Процент преподавателей с повыш. квалификацией (%)</label>
            <input type="number" name="teachers_advanced_training_percentage" class="form-control" min="0" max="100" value="{{ old('teachers_advanced_training_percentage', $formEntry->data['teachers_advanced_training_percentage'] ?? '') }}" required>
        </div>
        @include('expert.partials.files', ['data' => $formEntry->data['file_teachers_advanced_training_percentage'] ?? [], 'name' => 'file_teachers_advanced_training_percentage'])

        <button type="submit" class="btn btn-success mt-4">Сохранить изменения</button>
    </form>
</div>
@endsection

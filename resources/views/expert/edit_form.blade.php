@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактирование формы для: {{ $university->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
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

        <!-- Пункт 1: Наличие реализуемой образовательной программы «Теология» -->
        <div class="form-group">
            <label>1. Наличие реализуемой образовательной программы «Теология»</label>
            <select name="program_theology" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('program_theology', $formEntry->data['program_theology'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('program_theology', $formEntry->data['program_theology'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @if(isset($formEntry->data['file_program_theology']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_program_theology']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 1 (при необходимости)</label>
            <input type="file" name="file_program_theology" class="form-control-file">
        </div>

        <!-- Пункт 2: Наличие государственной аккредитации -->
        <div class="form-group">
            <label>2. Наличие государственной аккредитации</label>
            <select name="state_accreditation" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('state_accreditation', $formEntry->data['state_accreditation'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('state_accreditation', $formEntry->data['state_accreditation'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @if(isset($formEntry->data['file_state_accreditation']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_state_accreditation']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 2 (при необходимости)</label>
            <input type="file" name="file_state_accreditation" class="form-control-file">
        </div>

        <!-- Пункт 3: Процент соответствия программ стандартам -->
        <div class="form-group">
            <label>3. Процент соответствия программ стандартам (%)</label>
            <input type="number" name="compliance_percentage" class="form-control" min="0" max="100" value="{{ old('compliance_percentage', $formEntry->data['compliance_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_compliance_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_compliance_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 3 (при необходимости)</label>
            <input type="file" name="file_compliance_percentage" class="form-control-file">
        </div>

        <!-- Пункт 4: Результаты тестирования -->
        <div class="form-group">
            <label>4. Результаты тестирования (%)</label>
            <input type="number" name="test_results" class="form-control" min="0" max="100" value="{{ old('test_results', $formEntry->data['test_results'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_test_results']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_test_results']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 4 (при необходимости)</label>
            <input type="file" name="file_test_results" class="form-control-file">
        </div>

        <!-- Пункт 5: Процент занятости выпускников -->
        <div class="form-group">
            <label>5. Процент занятости выпускников (%)</label>
            <input type="number" name="employment_rate" class="form-control" min="0" max="100" value="{{ old('employment_rate', $formEntry->data['employment_rate'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_employment_rate']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_employment_rate']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 5 (при необходимости)</label>
            <input type="file" name="file_employment_rate" class="form-control-file">
        </div>

        <!-- Пункт 6: Количество студентов на дневной форме обучения -->
        <div class="form-group">
            <label>6. Количество студентов на дневной форме обучения</label>
            <input type="number" name="full_time_students" class="form-control" min="0" value="{{ old('full_time_students', $formEntry->data['full_time_students'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_full_time_students']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_full_time_students']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 6 (при необходимости)</label>
            <input type="file" name="file_full_time_students" class="form-control-file">
        </div>

        <!-- Пункт 7: Процент охвата NPR -->
        <div class="form-group">
            <label>7. Процент охвата NPR (%)</label>
            <input type="number" name="npr_coverage" class="form-control" min="0" max="100" value="{{ old('npr_coverage', $formEntry->data['npr_coverage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_npr_coverage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_npr_coverage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 7 (при необходимости)</label>
            <input type="file" name="file_npr_coverage" class="form-control-file">
        </div>

        <!-- Пункт 8: Процент обладателей ученых степеней -->
        <div class="form-group">
            <label>8. Процент обладателей ученых степеней (%)</label>
            <input type="number" name="degree_holders_percentage" class="form-control" min="0" max="100" value="{{ old('degree_holders_percentage', $formEntry->data['degree_holders_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_degree_holders_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_degree_holders_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 8 (при необходимости)</label>
            <input type="file" name="file_degree_holders_percentage" class="form-control-file">
        </div>

        <!-- Пункт 9: Доля финансирования от учредителей -->
        <div class="form-group">
            <label>9. Доля финансирования от учредителей (%)</label>
            <input type="number" name="founders_funding_share" class="form-control" min="0" max="100" value="{{ old('founders_funding_share', $formEntry->data['founders_funding_share'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_founders_funding_share']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_founders_funding_share']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 9 (при необходимости)</label>
            <input type="file" name="file_founders_funding_share" class="form-control-file">
        </div>

        <!-- Пункт 10: Доля грантового финансирования -->
        <div class="form-group">
            <label>10. Доля грантового финансирования (%)</label>
            <input type="number" name="grant_funding" class="form-control" min="0" value="{{ old('grant_funding', $formEntry->data['grant_funding'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_grant_funding']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_grant_funding']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 10 (при необходимости)</label>
            <input type="file" name="file_grant_funding" class="form-control-file">
        </div>

        <!-- Продолжайте добавлять остальные пункты ЧАСТИ 1 аналогично -->

        <!-- ЧАСТЬ 2 -->
        <h3>ЧАСТЬ 2</h3>

        <!-- Пункт 1: Наличие внутренней системы качества -->
        <div class="form-group">
            <label>1. Наличие внутренней системы качества</label>
            <select name="internal_quality_system" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="Имеется" {{ (old('internal_quality_system', $formEntry->data['internal_quality_system'] ?? '') == 'Имеется') ? 'selected' : '' }}>Имеется</option>
                <option value="Отсутствует" {{ (old('internal_quality_system', $formEntry->data['internal_quality_system'] ?? '') == 'Отсутствует') ? 'selected' : '' }}>Отсутствует</option>
            </select>
        </div>
        @if(isset($formEntry->data['file_internal_quality_system']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_internal_quality_system']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 1 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_internal_quality_system" class="form-control-file">
        </div>

        <!-- Пункт 2: Профессиональные соревнования -->
        <div class="form-group">
            <label>2. Профессиональные соревнования</label>
            <input type="number" name="professional_competitions" class="form-control" min="0" value="{{ old('professional_competitions', $formEntry->data['professional_competitions'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_professional_competitions']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_professional_competitions']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 2 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_professional_competitions" class="form-control-file">
        </div>

        <!-- Пункт 3: Награды NPR -->
        <div class="form-group">
            <label>3. Награды NPR</label>
            <input type="number" name="npr_award_winners" class="form-control" min="0" value="{{ old('npr_award_winners', $formEntry->data['npr_award_winners'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_npr_award_winners']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_npr_award_winners']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 3 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_npr_award_winners" class="form-control-file">
        </div>

        <!-- Пункт 4: Процент выпускников -->
        <div class="form-group">
            <label>4. Процент выпускников (%)</label>
            <input type="number" name="graduates_percentage" class="form-control" min="0" max="100" value="{{ old('graduates_percentage', $formEntry->data['graduates_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_graduates_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_graduates_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 4 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_graduates_percentage" class="form-control-file">
        </div>

        <!-- Пункт 5: Процент аспирантов -->
        <div class="form-group">
            <label>5. Процент аспирантов (%)</label>
            <input type="number" name="postgraduate_percentage" class="form-control" min="0" max="100" value="{{ old('postgraduate_percentage', $formEntry->data['postgraduate_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_postgraduate_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_postgraduate_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 5 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_postgraduate_percentage" class="form-control-file">
        </div>

        <!-- Пункт 6: Процент использования EBS -->
        <div class="form-group">
            <label>6. Процент использования EBS (%)</label>
            <input type="number" name="ebs_usage_percentage" class="form-control" min="0" max="100" value="{{ old('ebs_usage_percentage', $formEntry->data['ebs_usage_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_ebs_usage_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_ebs_usage_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 6 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_ebs_usage_percentage" class="form-control-file">
        </div>

        <!-- Пункт 7: Доступность программ (%) -->
        <div class="form-group">
            <label>7. Доступность программ (%)</label>
            <input type="number" name="programs_availability" class="form-control" min="0" max="100" value="{{ old('programs_availability', $formEntry->data['programs_availability'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_programs_availability']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_programs_availability']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 7 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_programs_availability" class="form-control-file">
        </div>

        <!-- Пункт 8: Процент использования EIOS -->
        <div class="form-group">
            <label>8. Процент использования EIOS (%)</label>
            <input type="number" name="eios_usage_percentage" class="form-control" min="0" max="100" value="{{ old('eios_usage_percentage', $formEntry->data['eios_usage_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_eios_usage_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_eios_usage_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 8 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_eios_usage_percentage" class="form-control-file">
        </div>

        <!-- Пункт 9: Международные соглашения -->
        <div class="form-group">
            <label>9. Международные соглашения</label>
            <select name="international_agreements" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('international_agreements', $formEntry->data['international_agreements'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('international_agreements', $formEntry->data['international_agreements'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @if(isset($formEntry->data['file_international_agreements']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_international_agreements']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 9 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_international_agreements" class="form-control-file">
        </div>

        <!-- Пункт 10: Процент выпускников медресе -->
        <div class="form-group">
            <label>10. Процент выпускников медресе (%)</label>
            <input type="number" name="medrese_graduates_percentage" class="form-control" min="0" max="100" value="{{ old('medrese_graduates_percentage', $formEntry->data['medrese_graduates_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_medrese_graduates_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_medrese_graduates_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 10 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_medrese_graduates_percentage" class="form-control-file">
        </div>

        <!-- Пункт 11: Наличие научных публикаций -->
        <div class="form-group">
            <label>11. Наличие научных публикаций</label>
            <select name="non_scientific_publications" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('non_scientific_publications', $formEntry->data['non_scientific_publications'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('non_scientific_publications', $formEntry->data['non_scientific_publications'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @if(isset($formEntry->data['file_non_scientific_publications']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_non_scientific_publications']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 11 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_non_scientific_publications" class="form-control-file">
        </div>

        <!-- Пункт 12: Процент студентов до 25 лет -->
        <div class="form-group">
            <label>12. Процент студентов до 25 лет (%)</label>
            <input type="number" name="students_under_25_percentage" class="form-control" min="0" max="100" value="{{ old('students_under_25_percentage', $formEntry->data['students_under_25_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_students_under_25_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_students_under_25_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 12 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_students_under_25_percentage" class="form-control-file">
        </div>

        <!-- Пункт 13: Процент студентов из мусульманских организаций -->
        <div class="form-group">
            <label>13. Процент студентов из мусульманских организаций (%)</label>
            <input type="number" name="students_from_muslim_orgs_percentage" class="form-control" min="0" max="100" value="{{ old('students_from_muslim_orgs_percentage', $formEntry->data['students_from_muslim_orgs_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_students_from_muslim_orgs_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_students_from_muslim_orgs_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 13 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_students_from_muslim_orgs_percentage" class="form-control-file">
        </div>

        <!-- Пункт 14: Количество вовлеченных мусульманских организаций -->
        <div class="form-group">
            <label>14. Количество вовлеченных мусульманских организаций</label>
            <input type="number" name="muslim_orgs_involved" class="form-control" min="0" value="{{ old('muslim_orgs_involved', $formEntry->data['muslim_orgs_involved'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_muslim_orgs_involved']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_muslim_orgs_involved']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 14 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_muslim_orgs_involved" class="form-control-file">
        </div>

        <!-- Пункт 15: Процент выпускников, трудоустроенных в мусульманских организациях -->
        <div class="form-group">
            <label>15. Процент выпускников, трудоустроенных в мусульманских организациях (%)</label>
            <input type="number" name="graduates_employed_in_muslim_orgs_percentage" class="form-control" min="0" max="100" value="{{ old('graduates_employed_in_muslim_orgs_percentage', $formEntry->data['graduates_employed_in_muslim_orgs_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_graduates_employed_in_muslim_orgs_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_graduates_employed_in_muslim_orgs_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 15 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_graduates_employed_in_muslim_orgs_percentage" class="form-control-file">
        </div>

        <!-- Пункт 16: Количество совместных мероприятий с мусульманскими организациями -->
        <div class="form-group">
            <label>16. Количество совместных мероприятий с мусульманскими организациями</label>
            <input type="number" name="joint_events_with_muslim_orgs" class="form-control" min="0" value="{{ old('joint_events_with_muslim_orgs', $formEntry->data['joint_events_with_muslim_orgs'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_joint_events_with_muslim_orgs']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_joint_events_with_muslim_orgs']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 16 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_joint_events_with_muslim_orgs" class="form-control-file">
        </div>

        <!-- Пункт 17: Доля грантового финансирования -->
        <div class="form-group">
            <label>17. Доля грантового финансирования (%)</label>
            <input type="number" name="donations_share" class="form-control" min="0" max="100" value="{{ old('donations_share', $formEntry->data['donations_share'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_donations_share']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_donations_share']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 17 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_donations_share" class="form-control-file">
        </div>

        <!-- Пункт 18: Доля платного образования -->
        <div class="form-group">
            <label>18. Доля платного образования (%)</label>
            <input type="number" name="paid_education_share" class="form-control" min="0" max="100" value="{{ old('paid_education_share', $formEntry->data['paid_education_share'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_paid_education_share']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_paid_education_share']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 18 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_paid_education_share" class="form-control-file">
        </div>

        <!-- Пункт 19: Количество проведенных научных мероприятий -->
        <div class="form-group">
            <label>19. Количество проведенных научных мероприятий</label>
            <input type="number" name="scientific_events_held" class="form-control" min="0" value="{{ old('scientific_events_held', $formEntry->data['scientific_events_held'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_scientific_events_held']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_scientific_events_held']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 19 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_scientific_events_held" class="form-control-file">
        </div>

        <!-- Пункт 20: Процент студентов в науке -->
        <div class="form-group">
            <label>20. Процент студентов в науке (%)</label>
            <input type="number" name="students_in_science_percentage" class="form-control" min="0" max="100" value="{{ old('students_in_science_percentage', $formEntry->data['students_in_science_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_students_in_science_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_students_in_science_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 20 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_students_in_science_percentage" class="form-control-file">
        </div>

        <!-- Пункт 21: Наличие образовательного плана -->
        <div class="form-group">
            <label>21. Наличие образовательного плана</label>
            <select name="has_educational_plan" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('has_educational_plan', $formEntry->data['has_educational_plan'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('has_educational_plan', $formEntry->data['has_educational_plan'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @if(isset($formEntry->data['file_has_educational_plan']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_has_educational_plan']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 21 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_has_educational_plan" class="form-control-file">
        </div>

        <!-- Пункт 22: Количество лекций иностранных ученых -->
        <div class="form-group">
            <label>22. Количество лекций иностранных ученых</label>
            <input type="number" name="lectures_by_foreign_scholars" class="form-control" min="0" value="{{ old('lectures_by_foreign_scholars', $formEntry->data['lectures_by_foreign_scholars'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_lectures_by_foreign_scholars']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_lectures_by_foreign_scholars']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 22 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_lectures_by_foreign_scholars" class="form-control-file">
        </div>

        <!-- Пункт 23: Количество международных членств -->
        <div class="form-group">
            <label>23. Количество международных членств</label>
            <input type="number" name="international_memberships" class="form-control" min="0" value="{{ old('international_memberships', $formEntry->data['international_memberships'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_international_memberships']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_international_memberships']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 23 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_international_memberships" class="form-control-file">
        </div>

        <!-- Пункт 24: Подготовка аудиовизуального контента -->
        <div class="form-group">
            <label>24. Подготовка аудиовизуального контента</label>
            <select name="prepared_audiovisual_content" class="form-control" required>
                <option value="">-- Выберите --</option>
                <option value="ДА" {{ (old('prepared_audiovisual_content', $formEntry->data['prepared_audiovisual_content'] ?? '') == 'ДА') ? 'selected' : '' }}>ДА</option>
                <option value="НЕТ" {{ (old('prepared_audiovisual_content', $formEntry->data['prepared_audiovisual_content'] ?? '') == 'НЕТ') ? 'selected' : '' }}>НЕТ</option>
            </select>
        </div>
        @if(isset($formEntry->data['file_prepared_audiovisual_content']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_prepared_audiovisual_content']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 24 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_prepared_audiovisual_content" class="form-control-file">
        </div>

        <!-- Пункт 25: Количество академических обменов для преподавателей -->
        <div class="form-group">
            <label>25. Количество академических обменов для преподавателей</label>
            <input type="number" name="academic_exchanges_teachers" class="form-control" min="0" value="{{ old('academic_exchanges_teachers', $formEntry->data['academic_exchanges_teachers'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_academic_exchanges_teachers']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_academic_exchanges_teachers']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 25 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_academic_exchanges_teachers" class="form-control-file">
        </div>

        <!-- Пункт 26: Процент преподавателей с повышенной квалификацией -->
        <div class="form-group">
            <label>26. Процент преподавателей с повышенной квалификацией (%)</label>
            <input type="number" name="teachers_advanced_training_percentage" class="form-control" min="0" max="100" value="{{ old('teachers_advanced_training_percentage', $formEntry->data['teachers_advanced_training_percentage'] ?? '') }}" required>
        </div>
        @if(isset($formEntry->data['file_teachers_advanced_training_percentage']))
            <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_teachers_advanced_training_percentage']) }}" target="_blank">Скачать</a></p>
        @endif
        <div class="form-group">
            <label>Загрузить файл для пункта 26 ЧАСТИ 2 (при необходимости)</label>
            <input type="file" name="file_teachers_advanced_training_percentage" class="form-control-file">
        </div>

        <!-- Кнопка отправки формы -->
        <button type="submit" class="btn btn-success mt-4">Сохранить изменения</button>
    </form>
</div>
@endsection

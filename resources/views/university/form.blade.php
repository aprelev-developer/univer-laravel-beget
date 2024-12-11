@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Заполнение формы оценки</h1>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('university.submitForm') }}" enctype="multipart/form-data" id="form">
        @csrf

        <!-- Прогресс-бар -->
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 0%;" id="progressBar"></div>
        </div>

        @php
        $totalSteps = 45; // Общее количество пунктов
        $currentStep = 1;
        @endphp

        <h2>ЧАСТЬ 1: ОСНОВНЫЕ ПОКАЗАТЕЛИ</h2>

        <!-- Пункт 1 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>1. Наличие реализуемой образовательной программы «Теология»</label>
                <select name="program_theology" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old('program_theology', $formEntry->data['program_theology'] ?? '') == 'ДА' ? 'selected' : '' }}>ДА</option>
                    <option value="НЕТ" {{ old('program_theology', $formEntry->data['program_theology'] ?? '') == 'НЕТ' ? 'selected' : '' }}>НЕТ</option>
                </select>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 1</label>
                <input type="file" name="file_program_theology[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_program_theology']) && is_array($formEntry->data['file_program_theology']))
                    <ul>
                        @foreach($formEntry->data['file_program_theology'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 2 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>2. Наличие государственной аккредитации по «Теологии»</label>
                <select name="state_accreditation" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old('state_accreditation', $formEntry->data['state_accreditation'] ?? '') == 'ДА' ? 'selected' : '' }}>ДА</option>
                    <option value="НЕТ" {{ old('state_accreditation', $formEntry->data['state_accreditation'] ?? '') == 'НЕТ' ? 'selected' : '' }}>НЕТ</option>
                </select>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 2</label>
                <input type="file" name="file_state_accreditation[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_state_accreditation']) && is_array($formEntry->data['file_state_accreditation']))

                    <ul>
                        @foreach($formEntry->data['file_state_accreditation'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 3 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>3. Соблюдение при реализации программ подготовки служителей  и религиозного персонала, утвержденных Советом по исламскому образованию единых стандартов религиозного образования (%)</label>
                <input type="number" name="compliance_percentage" class="form-control" min="0" max="100" value="{{ old('compliance_percentage', $formEntry->data['compliance_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 3</label>
                <input type="file" name="file_compliance_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_compliance_percentage']) && is_array($formEntry->data['file_compliance_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_compliance_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 4 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>4. Результаты тестирования остаточных знаний обучающихся (%)</label>
                <input type="number" name="test_results" class="form-control" min="0" max="100" value="{{ old('test_results', $formEntry->data['test_results'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 4</label>
                <input type="file" name="file_test_results[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_test_results']) && is_array($formEntry->data['file_test_results']))

                    <ul>
                        @foreach($formEntry->data['file_test_results'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 5 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>5. Количество студентов очной формы обучения (кол-во)</label>
                <input type="number" name="employment_rate" class="form-control" min="0" max="100" value="{{ old('employment_rate', $formEntry->data['employment_rate'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 5</label>
                <input type="file" name="file_employment_rate[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_employment_rate']) && is_array($formEntry->data['file_employment_rate']))

                    <ul>
                        @foreach($formEntry->data['file_employment_rate'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 6 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>6. Количество студентов очной формы обучения из числа лиц, имеющих гражданство Российской Федерации по рождению(%)</label>
                <input type="number" name="full_time_students" class="form-control" min="0" value="{{ old('full_time_students', $formEntry->data['full_time_students'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 6</label>
                <input type="file" name="file_full_time_students[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_full_time_students']) && is_array($formEntry->data['file_full_time_students']))

                    <ul>
                        @foreach($formEntry->data['file_full_time_students'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 7 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>7. Доля трудоустроенных по специальности выпускников за последние 3 года (%)</label>
                <input type="number" name="npr_coverage" class="form-control" min="0" max="100" value="{{ old('npr_coverage', $formEntry->data['npr_coverage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 7</label>
                <input type="file" name="file_npr_coverage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_npr_coverage']) && is_array($formEntry->data['file_npr_coverage']))

                    <ul>
                        @foreach($formEntry->data['file_npr_coverage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 8 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>8. Процент студентов очной формы обучения МОО, обучающихся по направлениям от мусульманских религиозных организаций: (%)</label>
                <input type="number" name="degree_holders_percentage" class="form-control" min="0" max="100" value="{{ old('degree_holders_percentage', $formEntry->data['degree_holders_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 8</label>
                <input type="file" name="file_degree_holders_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_degree_holders_percentage']) && is_array($formEntry->data['file_degree_holders_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_degree_holders_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 9 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>9. Процент выпускников МОО, обучившихся по направлениям от мусульманских религиозных организаций, и принятых на работу в данные религиозные организации (за последние 3 года): (%)</label>
                <input type="number" name="grant_funding" class="form-control" min="0" value="{{ old('grant_funding', $formEntry->data['grant_funding'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 9</label>
                <input type="file" name="file_grant_funding[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_grant_funding']) && is_array($formEntry->data['file_grant_funding']))

                    <ul>
                        @foreach($formEntry->data['file_grant_funding'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 10 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>10. Степень обеспеченности реализации основных образовательных программ научно-педагогическими работниками в соответствии с профилем преподаваемой дисциплины (средний показатель по всем ООП)(%)</label>
                <input type="number" name="vak_publications_per_npr" class="form-control" min="0" step="0.01" value="{{ old('vak_publications_per_npr', $formEntry->data['vak_publications_per_npr'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 10</label>
                <input type="file" name="file_vak_publications_per_npr[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_vak_publications_per_npr']) && is_array($formEntry->data['file_vak_publications_per_npr']))

                    <ul>
                        @foreach($formEntry->data['file_vak_publications_per_npr'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 11 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>11. Доля научно-педагогических работников МОО (в приведенных к целочисленным значениям ставок), имеющих ученую степень и (или) ученое звание, включая богословские степени и звания) (%)</label>
                <input type="number" name="monographs_per_npr" class="form-control" min="0" step="0.01" value="{{ old('monographs_per_npr', $formEntry->data['monographs_per_npr'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 11</label>
                <input type="file" name="file_monographs_per_npr[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_monographs_per_npr']) && is_array($formEntry->data['file_monographs_per_npr']))

                    <ul>
                        @foreach($formEntry->data['file_monographs_per_npr'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 12 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>12. Объем привлеченного государственного грантового финансирования на научные и образовательные проекты (от общего объема финансирования )(руб)</label>
                <input type="number" name="h_index_per_npr" class="form-control" min="0" step="0.01" value="{{ old('h_index_per_npr', $formEntry->data['h_index_per_npr'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 12</label>
                <input type="file" name="file_h_index_per_npr[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_h_index_per_npr']) && is_array($formEntry->data['file_h_index_per_npr']))

                    <ul>
                        @foreach($formEntry->data['file_h_index_per_npr'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 13 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>13. Количество публикаций в научных журналах рецензируемых ВАК (в расчете на 1 единицу штатного состава НПР)</label>
                <input type="number" name="olympiad_winners" class="form-control" min="0" value="{{ old('olympiad_winners', $formEntry->data['olympiad_winners'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 13</label>
                <input type="file" name="file_olympiad_winners[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_olympiad_winners']) && is_array($formEntry->data['file_olympiad_winners']))

                    <ul>
                        @foreach($formEntry->data['file_olympiad_winners'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 14 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>14. Количество опубликованных монографий на одного штатного научно-педагогического работника МОО в течение календарного года </label>
                <input type="number" name="patriotic_events" class="form-control" min="0" value="{{ old('patriotic_events', $formEntry->data['patriotic_events'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 14</label>
                <input type="file" name="file_patriotic_events[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_patriotic_events']) && is_array($formEntry->data['file_patriotic_events']))

                    <ul>
                        @foreach($formEntry->data['file_patriotic_events'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 15 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>15. Средний показатель индекса научного цитирования Хирша публикаций научно-педагогических работников МОО (В расчете на 1 единицу НПР)</label>
                <input type="number" name="website_compliance" class="form-control" min="0" max="100" value="{{ old('website_compliance', $formEntry->data['website_compliance'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 15</label>
                <input type="file" name="file_website_compliance[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_website_compliance']) && is_array($formEntry->data['file_website_compliance']))

                    <ul>
                        @foreach($formEntry->data['file_website_compliance'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 16 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>16. Наличие в течение календарного года среди студентов МОО победителей и призеров всероссийских и международных олимпиад и конкурсов (кол-во)</label>
                <input type="number" name="media_activity" class="form-control" min="0" value="{{ old('media_activity', $formEntry->data['media_activity'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 16</label>
                <input type="file" name="file_media_activity[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_media_activity']) && is_array($formEntry->data['file_media_activity']))

                    <ul>
                        @foreach($formEntry->data['file_media_activity'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 17 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>17. Участие вуза в мероприятиях гражданско-патриотической направленности </label>
                <input type="number" name="indigenous_students_percentage" class="form-control" min="0" max="100" value="{{ old('indigenous_students_percentage', $formEntry->data['indigenous_students_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для пункта 17</label>
                <input type="file" name="file_indigenous_students_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_indigenous_students_percentage']) && is_array($formEntry->data['file_indigenous_students_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_indigenous_students_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <h2>ЧАСТЬ 2: ДОПОЛНИТЕЛЬНЫЕ КРИТЕРИИ</h2>

        <!-- Пункт 1 (Часть 2) national_events_per_npr -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>1 (Часть 2). Участие во всерос. мероприятиях (на 1 НПР)</label>
                <input type="number" name="national_events_per_npr" class="form-control" min="0" step="0.01" value="{{ old('national_events_per_npr', $formEntry->data['national_events_per_npr'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_national_events_per_npr[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_national_events_per_npr']) && is_array($formEntry->data['file_national_events_per_npr']))

                    <ul>
                        @foreach($formEntry->data['file_national_events_per_npr'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 1 (Часть 2) internal_quality_system -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>1 (Часть 2). Система оценки НПР</label>
                <select name="internal_quality_system" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="Имеется" {{ old('internal_quality_system', $formEntry->data['internal_quality_system'] ?? '') == 'Имеется' ? 'selected' : '' }}>Имеется</option>
                    <option value="Отсутствует" {{ old('internal_quality_system', $formEntry->data['internal_quality_system'] ?? '') == 'Отсутствует' ? 'selected' : '' }}>Отсутствует</option>
                </select>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_internal_quality_system[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_internal_quality_system']) && is_array($formEntry->data['file_internal_quality_system']))

                    <ul>
                        @foreach($formEntry->data['file_internal_quality_system'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 2 (Часть 2) professional_competitions -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>2 (Часть 2). Конкурсы проф. направленности (кол-во)</label>
                <input type="number" name="professional_competitions" class="form-control" min="0" value="{{ old('professional_competitions', $formEntry->data['professional_competitions'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_professional_competitions[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_professional_competitions']) && is_array($formEntry->data['file_professional_competitions']))

                    <ul>
                        @foreach($formEntry->data['file_professional_competitions'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 3 (Часть 2) npr_award_winners -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>3 (Часть 2). Победители/призёры конкурсов для НПР</label>
                <input type="number" name="npr_award_winners" class="form-control" min="0" value="{{ old('npr_award_winners', $formEntry->data['npr_award_winners'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_npr_award_winners[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_npr_award_winners']) && is_array($formEntry->data['file_npr_award_winners']))

                    <ul>
                        @foreach($formEntry->data['file_npr_award_winners'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 4 (Часть 2) graduates_percentage -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>4 (Часть 2). Процент выпускников к числу поступивших (%)</label>
                <input type="number" name="graduates_percentage" class="form-control" min="0" max="100" value="{{ old('graduates_percentage', $formEntry->data['graduates_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_graduates_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_graduates_percentage']) && is_array($formEntry->data['file_graduates_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_graduates_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 5 (Часть 2) postgraduate_percentage -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>5 (Часть 2). Процент выпускников бакалавриата в магистратуру/асп. (%)</label>
                <input type="number" name="postgraduate_percentage" class="form-control" min="0" max="100" value="{{ old('postgraduate_percentage', $formEntry->data['postgraduate_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_postgraduate_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_postgraduate_percentage']) && is_array($formEntry->data['file_postgraduate_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_postgraduate_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 6 (Часть 2) ebs_usage_percentage -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>6 (Часть 2). Процент использования ЭБС (%)</label>
                <input type="number" name="ebs_usage_percentage" class="form-control" min="0" max="100" value="{{ old('ebs_usage_percentage', $formEntry->data['ebs_usage_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_ebs_usage_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_ebs_usage_percentage']) && is_array($formEntry->data['file_ebs_usage_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_ebs_usage_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 7 (Часть 2) programs_availability -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>7 (Часть 2). Доступность разработанных программ (%)</label>
                <input type="number" name="programs_availability" class="form-control" min="0" max="100" value="{{ old('programs_availability', $formEntry->data['programs_availability'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_programs_availability[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_programs_availability']) && is_array($formEntry->data['file_programs_availability']))

                    <ul>
                        @foreach($formEntry->data['file_programs_availability'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 8 (Часть 2) eios_usage_percentage -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>8 (Часть 2). Использование ЭИОС (%)</label>
                <input type="number" name="eios_usage_percentage" class="form-control" min="0" max="100" value="{{ old('eios_usage_percentage', $formEntry->data['eios_usage_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_eios_usage_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_eios_usage_percentage']) && is_array($formEntry->data['file_eios_usage_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_eios_usage_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 9 (Часть 2) international_agreements -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>9 (Часть 2). Наличие международных соглашений</label>
                <select name="international_agreements" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old('international_agreements', $formEntry->data['international_agreements'] ?? '') == 'ДА' ? 'selected' : '' }}>ДА</option>
                    <option value="НЕТ" {{ old('international_agreements', $formEntry->data['international_agreements'] ?? '') == 'НЕТ' ? 'selected' : '' }}>НЕТ</option>
                </select>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_international_agreements[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_international_agreements']) && is_array($formEntry->data['file_international_agreements']))

                    <ul>
                        @foreach($formEntry->data['file_international_agreements'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 10 (Часть 2) medrese_graduates_percentage -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>10 (Часть 2). Процент выпускников медресе (%)</label>
                <input type="number" name="medrese_graduates_percentage" class="form-control" min="0" max="100" value="{{ old('medrese_graduates_percentage', $formEntry->data['medrese_graduates_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_medrese_graduates_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_medrese_graduates_percentage']) && is_array($formEntry->data['file_medrese_graduates_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_medrese_graduates_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 11 (Часть 2) non_scientific_publications -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>11 (Часть 2). Издание не научных бюллетеней</label>
                <select name="non_scientific_publications" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old('non_scientific_publications', $formEntry->data['non_scientific_publications'] ?? '') == 'ДА' ? 'selected' : '' }}>ДА</option>
                    <option value="НЕТ" {{ old('non_scientific_publications', $formEntry->data['non_scientific_publications'] ?? '') == 'НЕТ' ? 'selected' : '' }}>НЕТ</option>
                </select>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_non_scientific_publications[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_non_scientific_publications']) && is_array($formEntry->data['file_non_scientific_publications']))

                    <ul>
                        @foreach($formEntry->data['file_non_scientific_publications'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 12 (Часть 2) students_under_25_percentage -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>12 (Часть 2). Процент студентов до 25 лет (%)</label>
                <input type="number" name="students_under_25_percentage" class="form-control" min="0" max="100" value="{{ old('students_under_25_percentage', $formEntry->data['students_under_25_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_students_under_25_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_students_under_25_percentage']) && is_array($formEntry->data['file_students_under_25_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_students_under_25_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 13 (Часть 2) students_from_muslim_orgs_percentage -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>13 (Часть 2). % студентов, обучающихся по направлению мусульманских орг. (%)</label>
                <input type="number" name="students_from_muslim_orgs_percentage" class="form-control" min="0" max="100" value="{{ old('students_from_muslim_orgs_percentage', $formEntry->data['students_from_muslim_orgs_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_students_from_muslim_orgs_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_students_from_muslim_orgs_percentage']) && is_array($formEntry->data['file_students_from_muslim_orgs_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_students_from_muslim_orgs_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 14 (Часть 2) muslim_orgs_involved -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>14 (Часть 2). Кол-во мусульманских религ. орг. для практики</label>
                <input type="number" name="muslim_orgs_involved" class="form-control" min="0" value="{{ old('muslim_orgs_involved', $formEntry->data['muslim_orgs_involved'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_muslim_orgs_involved[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_muslim_orgs_involved']) && is_array($formEntry->data['file_muslim_orgs_involved']))

                    <ul>
                        @foreach($formEntry->data['file_muslim_orgs_involved'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 15 (Часть 2) graduates_employed_in_muslim_orgs_percentage -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>15 (Часть 2). % выпускников, принятых в мусульм. орг. (%)</label>
                <input type="number" name="graduates_employed_in_muslim_orgs_percentage" class="form-control" min="0" max="100" value="{{ old('graduates_employed_in_muslim_orgs_percentage', $formEntry->data['graduates_employed_in_muslim_orgs_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_graduates_employed_in_muslim_orgs_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_graduates_employed_in_muslim_orgs_percentage']) && is_array($formEntry->data['file_graduates_employed_in_muslim_orgs_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_graduates_employed_in_muslim_orgs_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 16 (Часть 2) joint_events_with_muslim_orgs -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>16 (Часть 2). Мероприятий с мусульм. орг. (год)</label>
                <input type="number" name="joint_events_with_muslim_orgs" class="form-control" min="0" value="{{ old('joint_events_with_muslim_orgs', $formEntry->data['joint_events_with_muslim_orgs'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_joint_events_with_muslim_orgs[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_joint_events_with_muslim_orgs']) && is_array($formEntry->data['file_joint_events_with_muslim_orgs']))

                    <ul>
                        @foreach($formEntry->data['file_joint_events_with_muslim_orgs'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 17 (Часть 2) founders_funding_share -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>17 (Часть 2). Доля средств учредителей (%)</label>
                <input type="number" name="founders_funding_share" class="form-control" min="0" max="100" value="{{ old('founders_funding_share', $formEntry->data['founders_funding_share'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_founders_funding_share[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_founders_funding_share']) && is_array($formEntry->data['file_founders_funding_share']))

                    <ul>
                        @foreach($formEntry->data['file_founders_funding_share'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 18 (Часть 2) donations_share -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>18 (Часть 2). Объем пожертвований (%)</label>
                <input type="number" name="donations_share" class="form-control" min="0" max="100" value="{{ old('donations_share', $formEntry->data['donations_share'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_donations_share[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_donations_share']) && is_array($formEntry->data['file_donations_share']))

                    <ul>
                        @foreach($formEntry->data['file_donations_share'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 19 (Часть 2) paid_education_share -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>19 (Часть 2). Доля платных услуг (%)</label>
                <input type="number" name="paid_education_share" class="form-control" min="0" max="100" value="{{ old('paid_education_share', $formEntry->data['paid_education_share'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_paid_education_share[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_paid_education_share']) && is_array($formEntry->data['file_paid_education_share']))

                    <ul>
                        @foreach($formEntry->data['file_paid_education_share'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 20 (Часть 2) scientific_events_held -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>20 (Часть 2). Научных/науч.-метод. мероприятий (год)</label>
                <input type="number" name="scientific_events_held" class="form-control" min="0" value="{{ old('scientific_events_held', $formEntry->data['scientific_events_held'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_scientific_events_held[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_scientific_events_held']) && is_array($formEntry->data['file_scientific_events_held']))

                    <ul>
                        @foreach($formEntry->data['file_scientific_events_held'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 21 (Часть 2) students_in_science_percentage -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>21 (Часть 2). % студентов в научной деятельности (%)</label>
                <input type="number" name="students_in_science_percentage" class="form-control" min="0" max="100" value="{{ old('students_in_science_percentage', $formEntry->data['students_in_science_percentage'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_students_in_science_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_students_in_science_percentage']) && is_array($formEntry->data['file_students_in_science_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_students_in_science_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 22 (Часть 2) has_educational_plan -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>22 (Часть 2). Наличие утвержденного плана воспитательной работы</label>
                <select name="has_educational_plan" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old('has_educational_plan', $formEntry->data['has_educational_plan'] ?? '') == 'ДА' ? 'selected' : '' }}>ДА</option>
                    <option value="НЕТ" {{ old('has_educational_plan', $formEntry->data['has_educational_plan'] ?? '') == 'НЕТ' ? 'selected' : '' }}>НЕТ</option>
                </select>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_has_educational_plan[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_has_educational_plan']) && is_array($formEntry->data['file_has_educational_plan']))

                    <ul>
                        @foreach($formEntry->data['file_has_educational_plan'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 23 (Часть 2) lectures_by_foreign_scholars -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>23 (Часть 2). Лекции зарубежных учёных (кол-во)</label>
                <input type="number" name="lectures_by_foreign_scholars" class="form-control" min="0" value="{{ old('lectures_by_foreign_scholars', $formEntry->data['lectures_by_foreign_scholars'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_lectures_by_foreign_scholars[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_lectures_by_foreign_scholars']) && is_array($formEntry->data['file_lectures_by_foreign_scholars']))

                    <ul>
                        @foreach($formEntry->data['file_lectures_by_foreign_scholars'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 24 (Часть 2) international_memberships -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>24 (Часть 2). Членство в междунар. орг. (кол-во)</label>
                <input type="number" name="international_memberships" class="form-control" min="0" value="{{ old('international_memberships', $formEntry->data['international_memberships'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_international_memberships[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_international_memberships']) && is_array($formEntry->data['file_international_memberships']))

                    <ul>
                        @foreach($formEntry->data['file_international_memberships'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 25 (Часть 2) prepared_audiovisual_content -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>25 (Часть 2). Подготовка аудиовиз. контента</label>
                <select name="prepared_audiovisual_content" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old('prepared_audiovisual_content', $formEntry->data['prepared_audiovisual_content'] ?? '') == 'ДА' ? 'selected' : '' }}>ДА</option>
                    <option value="НЕТ" {{ old('prepared_audiovisual_content', $formEntry->data['prepared_audiovisual_content'] ?? '') == 'НЕТ' ? 'selected' : '' }}>НЕТ</option>
                </select>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_prepared_audiovisual_content[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_prepared_audiovisual_content']) && is_array($formEntry->data['file_prepared_audiovisual_content']))

                    <ul>
                        @foreach($formEntry->data['file_prepared_audiovisual_content'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 26 (Часть 2) academic_exchanges_teachers -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>26 (Часть 2). Академические обмены преподавателей (человек)</label>
                <input type="number" name="academic_exchanges_teachers" class="form-control" min="0" value="{{ old('academic_exchanges_teachers', $formEntry->data['academic_exchanges_teachers'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_academic_exchanges_teachers[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_academic_exchanges_teachers']) && is_array($formEntry->data['file_academic_exchanges_teachers']))

                    <ul>
                        @foreach($formEntry->data['file_academic_exchanges_teachers'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @php $currentStep++; @endphp

        <!-- Пункт 27 (Часть 2) teachers_advanced_training_percentage -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>27 (Часть 2). % преподавателей, прошедших КПК (%)</label>
                <input type="number" name="teachers_advanced_training_percentage" class="form-control" min="0" max="100" value="{{ old('teachers_advanced_training_percentage', $formEntry->data['teachers_advanced_training_percentage'] ?? '') }}" >
            </div>
            <div class="form-group">
                <label>Загрузить файлы для данного пункта</label>
                <input type="file" name="file_teachers_advanced_training_percentage[]" class="form-control-file" multiple>
                @if(isset($formEntry->data['file_teachers_advanced_training_percentage']) && is_array($formEntry->data['file_teachers_advanced_training_percentage']))

                    <ul>
                        @foreach($formEntry->data['file_teachers_advanced_training_percentage'] as $file)
                           @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <!-- Кнопки навигации -->
        <div class="form-navigation">
            <button type="button" class="previous btn btn-secondary">Назад</button>
            <button type="button" class="next btn btn-primary">Далее</button>
            <button type="submit" class="btn btn-success">Отправить</button>
        </div>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form');
        const steps = Array.from(form.querySelectorAll('.form-step'));
        const nextBtn = form.querySelector('.next');
        const prevBtn = form.querySelector('.previous');
        const submitBtn = form.querySelector('button[type="submit"]');
        const progressBar = document.getElementById('progressBar');
        let currentStep = 0;

        updateFormSteps();

        nextBtn.addEventListener('click', () => {
            // if (validateFormStep(steps[currentStep])) {
                currentStep++;
                updateFormSteps();
            // }
        });

        prevBtn.addEventListener('click', () => {
            currentStep--;
            updateFormSteps();
        });

        function updateFormSteps() {
            steps.forEach((step, index) => {
                step.classList.toggle('active', index === currentStep);
            });

            prevBtn.style.display = currentStep > 0 ? 'inline-block' : 'none';
            nextBtn.style.display = currentStep < steps.length - 1 ? 'inline-block' : 'none';
            submitBtn.style.display = currentStep === steps.length - 1 ? 'inline-block' : 'none';

            const progress = (currentStep + 1) / steps.length * 100;
            progressBar.style.width = progress + '%';
            progressBar.innerText = `Шаг ${currentStep + 1} из ${steps.length}`;
        }

        // function validateFormStep(step) {
        //     const inputs = Array.from(step.querySelectorAll('input[required], select[required], textarea[required]'));
        //     for (let input of inputs) {
        //         if (!input.checkValidity()) {
        //             input.reportValidity();
        //             return false;
        //         }
        //     }
        //     return true;
        // }
    });

     document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form');
        const url = '{{ route("university.form.save_partial") }}'; // Укажите маршрут для сохранения

        form.addEventListener('input', function (event) {
            const formData = new FormData(form);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.message); // Можно добавить всплывающее уведомление
                }
            })
            .catch(error => {
                console.error('Ошибка сохранения данных:', error);
            });
        });
    });
</script>

<style>
    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
    }
</style>

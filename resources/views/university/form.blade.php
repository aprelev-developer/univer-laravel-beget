@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Заполнение формы оценки</h1>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('university.submitForm') }}" enctype="multipart/form-data" id="multiStepForm">
        @csrf

        <!-- Прогресс-бар -->
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 0%;" id="progressBar"></div>
        </div>

        <!-- Шаги формы -->
        @php
        $totalSteps = 45; // Общее количество пунктов
        $currentStep = 1;
        @endphp

        <!-- Создаем массив для хранения названий полей файлов -->
        @php
        $fileFields = [];
        @endphp

        <!-- ЧАСТЬ 1: ОСНОВНЫЕ ПОКАЗАТЕЛИ -->
        <h2>ЧАСТЬ 1: ОСНОВНЫЕ ПОКАЗАТЕЛИ</h2>

        <!-- Пункт 1 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>1. Наличие реализуемой образовательной программы «Теология»</label>
                <select name="program_theology" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old(
                    'program_theology', $formEntry->data['program_theology'] ?? '') == 'ДА' ? 'selected' : ''
                    }}>ДА</option>
                    <option value="НЕТ" {{ old(
                    'program_theology', $formEntry->data['program_theology'] ?? '') == 'НЕТ' ? 'selected' : ''
                    }}>НЕТ</option>
                </select>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 1 (при необходимости)</label>
                <input type="file" name="file_program_theology" class="form-control-file">
                @if(isset($formEntry->data['file_program_theology']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_program_theology']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_program_theology'; @endphp

        <!-- Пункт 2 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>2. Наличие государственной аккредитации по направлению подготовки «Теология»</label>
                <select name="state_accreditation" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old(
                    'state_accreditation', $formEntry->data['state_accreditation'] ?? '') == 'ДА' ? 'selected' : ''
                    }}>ДА</option>
                    <option value="НЕТ" {{ old(
                    'state_accreditation', $formEntry->data['state_accreditation'] ?? '') == 'НЕТ' ? 'selected' : ''
                    }}>НЕТ</option>
                </select>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 2 (при необходимости)</label>
                <input type="file" name="file_state_accreditation" class="form-control-file">
                @if(isset($formEntry->data['file_state_accreditation']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_state_accreditation']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_state_accreditation'; @endphp

        <!-- Пункт 3 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>3. Соблюдение при реализации программ подготовки служителей и религиозного персонала (%)</label>
                <input type="number" name="compliance_percentage" class="form-control" min="0" max="100"
                       value="{{ old('compliance_percentage', $formEntry->data['compliance_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 3 (при необходимости)</label>
                <input type="file" name="file_compliance_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_compliance_percentage']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_compliance_percentage']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_compliance_percentage'; @endphp

        <!-- Пункт 4 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>4. Результаты тестирования остаточных знаний обучающихся (%)</label>
                <input type="number" name="test_results" class="form-control" min="0" max="100"
                       value="{{ old('test_results', $formEntry->data['test_results'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 4 (при необходимости)</label>
                <input type="file" name="file_test_results" class="form-control-file">
                @if(isset($formEntry->data['file_test_results']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_test_results']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_test_results'; @endphp

        <!-- Пункт 5 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>5. Доля трудоустроенных по специальности выпускников за последние 3 года (%)</label>
                <input type="number" name="employment_rate" class="form-control" min="0" max="100"
                       value="{{ old('employment_rate', $formEntry->data['employment_rate'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 5 (при необходимости)</label>
                <input type="file" name="file_employment_rate" class="form-control-file">
                @if(isset($formEntry->data['file_employment_rate']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_employment_rate']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_employment_rate'; @endphp

        <!-- Пункт 6 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>6. Количество студентов очной формы обучения</label>
                <input type="number" name="full_time_students" class="form-control" min="0"
                       value="{{ old('full_time_students', $formEntry->data['full_time_students'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 6 (при необходимости)</label>
                <input type="file" name="file_full_time_students" class="form-control-file">
                @if(isset($formEntry->data['file_full_time_students']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_full_time_students']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_full_time_students'; @endphp

        <!-- Пункт 7 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>7. Степень обеспеченности реализации основных образовательных программ НПР (%)</label>
                <input type="number" name="npr_coverage" class="form-control" min="0" max="100"
                       value="{{ old('npr_coverage', $formEntry->data['npr_coverage'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 7 (при необходимости)</label>
                <input type="file" name="file_npr_coverage" class="form-control-file">
                @if(isset($formEntry->data['file_npr_coverage']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_npr_coverage']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_npr_coverage'; @endphp

        <!-- Пункт 8 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>8. Доля НПР, имеющих ученую степень и/или звание (%)</label>
                <input type="number" name="degree_holders_percentage" class="form-control" min="0" max="100"
                       value="{{ old('degree_holders_percentage', $formEntry->data['degree_holders_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 8 (при необходимости)</label>
                <input type="file" name="file_degree_holders_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_degree_holders_percentage']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_degree_holders_percentage']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_degree_holders_percentage'; @endphp

        <!-- Пункт 9 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>9. Объем привлеченного государственного грантового финансирования (в рублях)</label>
                <input type="number" name="grant_funding" class="form-control" min="0"
                       value="{{ old('grant_funding', $formEntry->data['grant_funding'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 9 (при необходимости)</label>
                <input type="file" name="file_grant_funding" class="form-control-file">
                @if(isset($formEntry->data['file_grant_funding']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_grant_funding']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_grant_funding'; @endphp

        <!-- Пункт 10 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>10. Количество публикаций в научных журналах рецензируемых ВАК (на 1 НПР)</label>
                <input type="number" name="vak_publications_per_npr" class="form-control" min="0" step="0.01"
                       value="{{ old('vak_publications_per_npr', $formEntry->data['vak_publications_per_npr'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 10 (при необходимости)</label>
                <input type="file" name="file_vak_publications_per_npr" class="form-control-file">
                @if(isset($formEntry->data['file_vak_publications_per_npr']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_vak_publications_per_npr']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_vak_publications_per_npr'; @endphp

        <!-- Пункт 11 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>11. Количество опубликованных монографий на одного штатного научно-педагогического работника МОО
                    в течение календарного года</label>
                <input type="number" name="monographs_per_npr" class="form-control" min="0" step="0.01"
                       value="{{ old('monographs_per_npr', $formEntry->data['monographs_per_npr'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 11 (при необходимости)</label>
                <input type="file" name="file_monographs_per_npr" class="form-control-file">
                @if(isset($formEntry->data['file_monographs_per_npr']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_monographs_per_npr']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_monographs_per_npr'; @endphp

        <!-- Пункт 12 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>12. Средний показатель индекса научного цитирования Хирша публикаций НПР (в расчете на 1
                    НПР)</label>
                <input type="number" name="h_index_per_npr" class="form-control" min="0" step="0.01"
                       value="{{ old('h_index_per_npr', $formEntry->data['h_index_per_npr'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 12 (при необходимости)</label>
                <input type="file" name="file_h_index_per_npr" class="form-control-file">
                @if(isset($formEntry->data['file_h_index_per_npr']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_h_index_per_npr']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_h_index_per_npr'; @endphp
        <!-- Пункт 13 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>13. Наличие в течение календарного года среди студентов МОО победителей и призеров всероссийских
                    и международных олимпиад и конкурсов (количество человек)</label>
                <input type="number" name="olympiad_winners" class="form-control" min="0"
                       value="{{ old('olympiad_winners', $formEntry->data['olympiad_winners'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 13 (при необходимости)</label>
                <input type="file" name="file_olympiad_winners" class="form-control-file">
                @if(isset($formEntry->data['file_olympiad_winners']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_olympiad_winners']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_olympiad_winners'; @endphp
        <!-- Пункт 14 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>14. Участие вуза в мероприятиях гражданско-патриотической направленности (количество
                    мероприятий)</label>
                <input type="number" name="patriotic_events" class="form-control" min="0"
                       value="{{ old('patriotic_events', $formEntry->data['patriotic_events'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 14 (при необходимости)</label>
                <input type="file" name="file_patriotic_events" class="form-control-file">
                @if(isset($formEntry->data['file_patriotic_events']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_patriotic_events']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_patriotic_events'; @endphp
        <!-- Пункт 15 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>15. Соответствие структуры официального сайта МОО требованиям законодательства РФ в сфере
                    образования (%)</label>
                <input type="number" name="website_compliance" class="form-control" min="0" max="100"
                       value="{{ old('website_compliance', $formEntry->data['website_compliance'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 15 (при необходимости)</label>
                <input type="file" name="file_website_compliance" class="form-control-file">
                @if(isset($formEntry->data['file_website_compliance']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_website_compliance']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_website_compliance'; @endphp
        <!-- Пункт 16 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>16. Медийная активность официальных аккаунтов организации (количество публикаций в год)</label>
                <input type="number" name="media_activity" class="form-control" min="0"
                       value="{{ old('media_activity', $formEntry->data['media_activity'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 16 (при необходимости)</label>
                <input type="file" name="file_media_activity" class="form-control-file">
                @if(isset($formEntry->data['file_media_activity']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_media_activity']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_media_activity'; @endphp
        <!-- Пункт 17 -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>17. Количество студентов очной формы обучения из числа коренных народов России (%)</label>
                <input type="number" name="indigenous_students_percentage" class="form-control" min="0" max="100"
                       value="{{ old('indigenous_students_percentage', $formEntry->data['indigenous_students_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 17 (при необходимости)</label>
                <input type="file" name="file_indigenous_students_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_indigenous_students_percentage']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_indigenous_students_percentage']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_indigenous_students_percentage'; @endphp


        <!-- Продолжайте добавлять остальные пункты ЧАСТИ 1 аналогичным образом -->

        <!-- ЧАСТЬ 2: ДОПОЛНИТЕЛЬНЫЕ КРИТЕРИИ -->
        <h2>ЧАСТЬ 2: ДОПОЛНИТЕЛЬНЫЕ КРИТЕРИИ</h2>

        <!-- Пункт 1 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>1. Участие во всероссийских мероприятиях (на 1 НПР)</label>
                <input type="number" name="national_events_per_npr" class="form-control" min="0" step="0.01"
                       value="{{ old('national_events_per_npr', $formEntry->data['national_events_per_npr'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 1 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_national_events_per_npr" class="form-control-file">
                @if(isset($formEntry->data['file_national_events_per_npr']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_national_events_per_npr']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_national_events_per_npr'; @endphp
        <!-- Пункт 1 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>1. Наличие внутренней системы оценки качества и эффективности деятельности научно-педагогических
                    работников</label>
                <select name="internal_quality_system" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="Имеется" {{ old(
                    'internal_quality_system', $formEntry->data['internal_quality_system'] ?? '') == 'Имеется' ?
                    'selected' : '' }}>Имеется</option>
                    <option value="Отсутствует" {{ old(
                    'internal_quality_system', $formEntry->data['internal_quality_system'] ?? '') == 'Отсутствует' ?
                    'selected' : '' }}>Отсутствует</option>
                </select>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 1 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_internal_quality_system" class="form-control-file">
                @if(isset($formEntry->data['file_internal_quality_system']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_internal_quality_system']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_internal_quality_system'; @endphp
        <!-- Пункт 2 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>2. Количество конкурсов профессиональной направленности, проводимых МОО в течение календарного
                    года</label>
                <input type="number" name="professional_competitions" class="form-control" min="0"
                       value="{{ old('professional_competitions', $formEntry->data['professional_competitions'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 2 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_professional_competitions" class="form-control-file">
                @if(isset($formEntry->data['file_professional_competitions']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_professional_competitions']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_professional_competitions'; @endphp
        <!-- Пункт 3 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>3. Количество победителей и призеров региональных и всероссийских конкурсов для НПР в течение
                    календарного года</label>
                <input type="number" name="npr_award_winners" class="form-control" min="0"
                       value="{{ old('npr_award_winners', $formEntry->data['npr_award_winners'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 3 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_npr_award_winners" class="form-control-file">
                @if(isset($formEntry->data['file_npr_award_winners']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_npr_award_winners']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_npr_award_winners'; @endphp
        <!-- Пункт 4 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>4. Процент выпускников вуза к общему числу поступивших (%)</label>
                <input type="number" name="graduates_percentage" class="form-control" min="0" max="100"
                       value="{{ old('graduates_percentage', $formEntry->data['graduates_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 4 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_graduates_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_graduates_percentage']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_graduates_percentage']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_graduates_percentage'; @endphp
        <!-- Пункт 5 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>5. Процент выпускников бакалавриата, продолжающих обучение в магистратуре и аспирантуре
                    (%)</label>
                <input type="number" name="postgraduate_percentage" class="form-control" min="0" max="100"
                       value="{{ old('postgraduate_percentage', $formEntry->data['postgraduate_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 5 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_postgraduate_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_postgraduate_percentage']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_postgraduate_percentage']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_postgraduate_percentage'; @endphp
        <!-- Пункт 6 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>6. Процент студентов и преподавателей, использующих электронную библиотечную систему (ЭБС)
                    (%)</label>
                <input type="number" name="ebs_usage_percentage" class="form-control" min="0" max="100"
                       value="{{ old('ebs_usage_percentage', $formEntry->data['ebs_usage_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 6 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_ebs_usage_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_ebs_usage_percentage']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_ebs_usage_percentage']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_ebs_usage_percentage'; @endphp
        <!-- Пункт 7 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>7. Уровень доступности разработанных программ для студентов и преподавателей (%)</label>
                <input type="number" name="programs_availability" class="form-control" min="0" max="100"
                       value="{{ old('programs_availability', $formEntry->data['programs_availability'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 7 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_programs_availability" class="form-control-file">
                @if(isset($formEntry->data['file_programs_availability']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_programs_availability']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_programs_availability'; @endphp
        <!-- Пункт 8 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>8. Процент студентов и преподавателей, использующих электронно-информационную образовательную
                    среду (%)</label>
                <input type="number" name="eios_usage_percentage" class="form-control" min="0" max="100"
                       value="{{ old('eios_usage_percentage', $formEntry->data['eios_usage_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 8 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_eios_usage_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_eios_usage_percentage']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_eios_usage_percentage']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_eios_usage_percentage'; @endphp
        <!-- Пункт 9 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>9. Наличие международных соглашений о сотрудничестве с зарубежными вузами и организациями</label>
                <select name="international_agreements" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old(
                    'international_agreements', $formEntry->data['international_agreements'] ?? '') == 'ДА' ? 'selected'
                    : '' }}>ДА</option>
                    <option value="НЕТ" {{ old(
                    'international_agreements', $formEntry->data['international_agreements'] ?? '') == 'НЕТ' ?
                    'selected' : '' }}>НЕТ</option>
                </select>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 9 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_international_agreements" class="form-control-file">
                @if(isset($formEntry->data['file_international_agreements']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_international_agreements']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_international_agreements'; @endphp
        <!-- Пункт 10 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>10. Процент выпускников медресе из общего количества студентов очной формы обучения (%)</label>
                <input type="number" name="medrese_graduates_percentage" class="form-control" min="0" max="100"
                       value="{{ old('medrese_graduates_percentage', $formEntry->data['medrese_graduates_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 10 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_medrese_graduates_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_medrese_graduates_percentage']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_medrese_graduates_percentage']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_medrese_graduates_percentage'; @endphp
        <!-- Пункт 11 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>11. Издание газеты, журнала, информационного бюллетеня, не связанного с научной деятельностью
                    организации (в электронном и/или ином виде)</label>
                <select name="non_scientific_publications" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old(
                    'non_scientific_publications', $formEntry->data['non_scientific_publications'] ?? '') == 'ДА' ?
                    'selected' : '' }}>ДА</option>
                    <option value="НЕТ" {{ old(
                    'non_scientific_publications', $formEntry->data['non_scientific_publications'] ?? '') == 'НЕТ' ?
                    'selected' : '' }}>НЕТ</option>
                </select>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 11 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_non_scientific_publications" class="form-control-file">
                @if(isset($formEntry->data['file_non_scientific_publications']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_non_scientific_publications']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_non_scientific_publications'; @endphp
        <!-- Пункт 12 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>12. Процент студентов МОО очной формы обучения в возрасте до 25 лет (%)</label>
                <input type="number" name="students_under_25_percentage" class="form-control" min="0" max="100"
                       value="{{ old('students_under_25_percentage', $formEntry->data['students_under_25_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 12 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_students_under_25_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_students_under_25_percentage']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_students_under_25_percentage']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_students_under_25_percentage'; @endphp
        <!-- Пункт 13 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>13. Процент студентов очной формы обучения МОО, обучающихся по направлениям от мусульманских
                    религиозных организаций (%)</label>
                <input type="number" name="students_from_muslim_orgs_percentage" class="form-control" min="0" max="100"
                       value="{{ old('students_from_muslim_orgs_percentage', $formEntry->data['students_from_muslim_orgs_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 13 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_students_from_muslim_orgs_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_students_from_muslim_orgs_percentage']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_students_from_muslim_orgs_percentage']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_students_from_muslim_orgs_percentage'; @endphp
        <!-- Пункт 14 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>14. Количество мусульманских религиозных организаций, задействованных в практической подготовке
                    обучающихся (на основе договоров о практике или распорядительных документов учредителей МОО)</label>
                <input type="number" name="muslim_orgs_involved" class="form-control" min="0"
                       value="{{ old('muslim_orgs_involved', $formEntry->data['muslim_orgs_involved'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 14 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_muslim_orgs_involved" class="form-control-file">
                @if(isset($formEntry->data['file_muslim_orgs_involved']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_muslim_orgs_involved']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_muslim_orgs_involved'; @endphp
        <!-- Пункт 15 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>15. Процент выпускников МОО, обучившихся по направлениям от мусульманских религиозных
                    организаций, и принятых на работу в данные религиозные организации (за последние 3 года) (%)</label>
                <input type="number" name="graduates_employed_in_muslim_orgs_percentage" class="form-control" min="0"
                       max="100"
                       value="{{ old('graduates_employed_in_muslim_orgs_percentage', $formEntry->data['graduates_employed_in_muslim_orgs_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 15 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_graduates_employed_in_muslim_orgs_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_graduates_employed_in_muslim_orgs_percentage']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_graduates_employed_in_muslim_orgs_percentage']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_graduates_employed_in_muslim_orgs_percentage'; @endphp
        <!-- Пункт 16 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>16. Количество научно-образовательных, социально-значимых, культовых мероприятий, проводимых
                    совместно с мусульманскими религиозными организациями в течение календарного года</label>
                <input type="number" name="joint_events_with_muslim_orgs" class="form-control" min="0"
                       value="{{ old('joint_events_with_muslim_orgs', $formEntry->data['joint_events_with_muslim_orgs'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 16 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_joint_events_with_muslim_orgs" class="form-control-file">
                @if(isset($formEntry->data['file_joint_events_with_muslim_orgs']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_joint_events_with_muslim_orgs']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_joint_events_with_muslim_orgs'; @endphp
        <!-- Пункт 17 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>17. Доля финансовых средств учредителей (от общего объема финансирования) (%)</label>
                <input type="number" name="founders_funding_share" class="form-control" min="0" max="100"
                       value="{{ old('founders_funding_share', $formEntry->data['founders_funding_share'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 17 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_founders_funding_share" class="form-control-file">
                @if(isset($formEntry->data['file_founders_funding_share']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_founders_funding_share']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_founders_funding_share'; @endphp
        <!-- Пункт 18 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>18. Объем привлеченных пожертвований (от общего объема финансирования) (%)</label>
                <input type="number" name="donations_share" class="form-control" min="0" max="100"
                       value="{{ old('donations_share', $formEntry->data['donations_share'] ?? '') }}" required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 18 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_donations_share" class="form-control-file">
                @if(isset($formEntry->data['file_donations_share']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_donations_share']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_donations_share'; @endphp
        <!-- Пункт 19 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>19. Доля средств, полученных от оказания платных образовательных услуг (от общего объема
                    финансирования) (%)</label>
                <input type="number" name="paid_education_share" class="form-control" min="0" max="100"
                       value="{{ old('paid_education_share', $formEntry->data['paid_education_share'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 19 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_paid_education_share" class="form-control-file">
                @if(isset($formEntry->data['file_paid_education_share']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_paid_education_share']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_paid_education_share'; @endphp
        <!-- Пункт 20 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>20. Проведение МОО в течение календарного года научных и научно-методических мероприятий
                    (количество)</label>
                <input type="number" name="scientific_events_held" class="form-control" min="0"
                       value="{{ old('scientific_events_held', $formEntry->data['scientific_events_held'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 20 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_scientific_events_held" class="form-control-file">
                @if(isset($formEntry->data['file_scientific_events_held']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_scientific_events_held']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_scientific_events_held'; @endphp
        <!-- Пункт 21 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>21. Процент обучающихся МОО, участвующих в научной деятельности в течение календарного года
                    (%)</label>
                <input type="number" name="students_in_science_percentage" class="form-control" min="0" max="100"
                       value="{{ old('students_in_science_percentage', $formEntry->data['students_in_science_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 21 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_students_in_science_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_students_in_science_percentage']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_students_in_science_percentage']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_students_in_science_percentage'; @endphp
        <!-- Пункт 22 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>22. Наличие утвержденного плана воспитательной работы МОО</label>
                <select name="has_educational_plan" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old(
                    'has_educational_plan', $formEntry->data['has_educational_plan'] ?? '') == 'ДА' ? 'selected' : ''
                    }}>ДА</option>
                    <option value="НЕТ" {{ old(
                    'has_educational_plan', $formEntry->data['has_educational_plan'] ?? '') == 'НЕТ' ? 'selected' : ''
                    }}>НЕТ</option>
                </select>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 22 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_has_educational_plan" class="form-control-file">
                @if(isset($formEntry->data['file_has_educational_plan']))
                <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_has_educational_plan']) }}"
                                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_has_educational_plan'; @endphp
        <!-- Пункт 23 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>23. Организация чтения лекций ведущими зарубежными учеными (количество лекций)</label>
                <input type="number" name="lectures_by_foreign_scholars" class="form-control" min="0"
                       value="{{ old('lectures_by_foreign_scholars', $formEntry->data['lectures_by_foreign_scholars'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 23 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_lectures_by_foreign_scholars" class="form-control-file">
                @if(isset($formEntry->data['file_lectures_by_foreign_scholars']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_lectures_by_foreign_scholars']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_lectures_by_foreign_scholars'; @endphp
        <!-- Пункт 24 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>24. Членство организации в международных научных и/или образовательных организациях (количество
                    организаций)</label>
                <input type="number" name="international_memberships" class="form-control" min="0"
                       value="{{ old('international_memberships', $formEntry->data['international_memberships'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 24 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_international_memberships" class="form-control-file">
                @if(isset($formEntry->data['file_international_memberships']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_international_memberships']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_international_memberships'; @endphp
        <!-- Пункт 25 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>25. Подготовка аудиовизуального учебного контента в целях распространения в СМИ и соцсетях по
                    профильному направлению образовательной организации</label>
                <select name="prepared_audiovisual_content" class="form-control" required>
                    <option value="">-- Выберите --</option>
                    <option value="ДА" {{ old(
                    'prepared_audiovisual_content', $formEntry->data['prepared_audiovisual_content'] ?? '') == 'ДА' ?
                    'selected' : '' }}>ДА</option>
                    <option value="НЕТ" {{ old(
                    'prepared_audiovisual_content', $formEntry->data['prepared_audiovisual_content'] ?? '') == 'НЕТ' ?
                    'selected' : '' }}>НЕТ</option>
                </select>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 25 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_prepared_audiovisual_content" class="form-control-file">
                @if(isset($formEntry->data['file_prepared_audiovisual_content']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_prepared_audiovisual_content']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_prepared_audiovisual_content'; @endphp
        <!-- Пункт 26 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>26. Академические обмены преподавателями для повышения профессионального уровня, стажировки НПР в
                    течение календарного года (количество человек)</label>
                <input type="number" name="academic_exchanges_teachers" class="form-control" min="0"
                       value="{{ old('academic_exchanges_teachers', $formEntry->data['academic_exchanges_teachers'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 26 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_academic_exchanges_teachers" class="form-control-file">
                @if(isset($formEntry->data['file_academic_exchanges_teachers']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_academic_exchanges_teachers']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        @php $currentStep++; $fileFields[] = 'file_academic_exchanges_teachers'; @endphp
        <!-- Пункт 27 (Часть 2) -->
        <div class="form-step">
            <h3>Пункт {{ $currentStep }} из {{ $totalSteps }}</h3>
            <div class="form-group">
                <label>27. Количество преподавателей МОО, прошедших курсы повышения квалификации по профилю
                    преподаваемой дисциплины за последние 3 года (%)</label>
                <input type="number" name="teachers_advanced_training_percentage" class="form-control" min="0" max="100"
                       value="{{ old('teachers_advanced_training_percentage', $formEntry->data['teachers_advanced_training_percentage'] ?? '') }}"
                       required>
            </div>
            <!-- Поле для загрузки файла -->
            <div class="form-group">
                <label>Загрузить файл для пункта 27 (Часть 2) (при необходимости)</label>
                <input type="file" name="file_teachers_advanced_training_percentage" class="form-control-file">
                @if(isset($formEntry->data['file_teachers_advanced_training_percentage']))
                <p>Загруженный файл: <a
                        href="{{ asset('storage/' . $formEntry->data['file_teachers_advanced_training_percentage']) }}"
                        target="_blank">Скачать</a></p>
                @endif
            </div>
        </div>
        <!-- Не увеличиваем $currentStep, так как это последний пункт -->
        @php $fileFields[] = 'file_teachers_advanced_training_percentage'; @endphp


        <!-- Продолжайте добавлять остальные пункты ЧАСТИ 2 аналогичным образом -->

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
        const form = document.getElementById('multiStepForm');
        const steps = Array.from(form.querySelectorAll('.form-step'));
        const nextBtn = form.querySelector('.next');
        const prevBtn = form.querySelector('.previous');
        const submitBtn = form.querySelector('button[type="submit"]');
        const progressBar = document.getElementById('progressBar');
        let currentStep = 0;

        // Инициализация
        updateFormSteps();

        nextBtn.addEventListener('click', () => {
            if (validateFormStep(steps[currentStep])) {
                currentStep++;
                updateFormSteps();
            }
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

            // Обновление прогресс-бара
            const progress = (currentStep + 1) / steps.length * 100;
            progressBar.style.width = progress + '%';
            progressBar.innerText = `Шаг ${currentStep + 1} из ${steps.length}`;
        }

        function validateFormStep(step) {
            const inputs = Array.from(step.querySelectorAll('input[required], select[required], textarea[required]'));
            for (let input of inputs) {
                if (!input.checkValidity()) {
                    input.reportValidity();
                    return false;
                }
            }
            return true;
        }
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


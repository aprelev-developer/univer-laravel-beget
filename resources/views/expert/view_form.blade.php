@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Просмотр формы для: {{ $university->name }}</h1>

    <!-- Вывод данных формы -->
    <div class="mb-3">
        <strong>1. Наличие реализуемой образовательной программы «Теология»:</strong> {{ $formEntry->data['program_theology'] }}
    </div>
    @if(isset($formEntry->data['file_program_theology']))
        <p>Загруженный файл: <a href="{{ asset('storage/' . $formEntry->data['file_program_theology']) }}" target="_blank">Скачать</a></p>
    @endif

    <!-- Повторите аналогично для всех остальных полей -->

    <div class="mb-3">
        <strong>Баллы:</strong> {{ $formEntry->score }}
    </div>
</div>
@endsection

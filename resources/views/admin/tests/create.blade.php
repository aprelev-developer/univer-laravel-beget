@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #f0fff0; /* очень светлый зелёный фон */
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        font-family: 'Arial', sans-serif;
    }

    h1 {
        text-align: center;
        color: #2e7d32; /* темно-зелёный */
        margin-bottom: 30px;
        font-size: 2rem;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 500;
        display: block;
        margin-bottom: 5px;
        color: #2e7d32; /* темно-зелёный */
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #a6d1a6;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #2e7d32;
        outline: none;
        box-shadow: 0 0 3px #2e7d3233;
    }

    .text-danger {
        color: #c62828; /* красный цвет для ошибок */
        font-size: 0.9rem;
    }

    .btn-success {
        display: inline-block;
        padding: 10px 20px;
        background-color: #66bb6a;
        color: #ffffff;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-success:hover {
        background-color: #388e3c;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Кнопка возврата */
    .back-btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #8bc34a;
        color: #ffffff;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .back-btn:hover {
        background-color: #7cb342;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .mt-3 {
        margin-top: 20px;
    }

    @media (max-width: 600px) {
        .container {
            margin: 20px;
            padding: 20px;
        }

        h1 {
            font-size: 1.5rem;
        }

        .btn-success, .back-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container">
    <a href="{{ route('admin.dashboard') }}" class="back-btn">Вернуться в админ-панель</a>
    <h1>Создать Новый Тест</h1>
    <form action="{{ route('admin.tests.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Название Теста</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Описание Теста</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="university_id">Университет</label>
            <select name="university_id" id="university_id" class="form-control" required>
                <option value="">Выберите университет</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}" {{ old('university_id') == $university->id ? 'selected' : '' }}>
                        {{ $university->name }}
                    </option>
                @endforeach
            </select>
            @error('university_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="group_id">Группа</label>
            <select name="group_id" id="group_id" class="form-control" required>
                <option value="">Выберите группу</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
            @error('group_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn-success mt-3">Создать Тест</button>
    </form>
</div>
@endsection

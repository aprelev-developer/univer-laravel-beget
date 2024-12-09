@extends('layouts.app')

@section('content')
<style>
    /* Общие стили для контейнера */
    .container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 30px;
        background-color: #f0fff0; /* Очень светло-зелёный фон */
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        font-family: 'Arial', sans-serif;
    }

    /* Заголовок страницы */
    h1 {
        text-align: center;
        color: #2e7d32; /* Тёмно-зелёный */
        margin-bottom: 30px;
        font-size: 2.5rem;
    }

    /* Кнопка "Экспортировать в Excel" */
    .export-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #66bb6a; /* Светло-зелёный */
        color: #ffffff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .export-btn:hover {
        background-color: #388e3c; /* Средне-зелёный при наведении */
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Стилизация таблицы */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    thead {
        background-color: #66bb6a; /* Светло-зелёный */
        color: #ffffff;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    tbody tr:hover {
        background-color: #e8f5e9; /* Очень светло-зелёный при наведении */
    }

    /* Стилизация ошибок */
    .error-messages {
        background-color: #ffcdd2; /* Светло-красный фон для ошибок */
        border-left: 4px solid #f44336; /* Красная линия слева */
        padding: 10px 15px;
        margin-bottom: 20px;
        border-radius: 4px;
        color: #c62828; /* Красный текст */
    }

    /* Кнопка "Вернуться в админ-панель" */
    .back-btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #66bb6a; /* Зеленоватый цвет */
        color: #ffffff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        font-weight: bold;
    }

    .back-btn:hover {
        background-color: #7cb342;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Адаптивность для мобильных устройств */
    @media (max-width: 600px) {
        .container {
            padding: 20px;
            margin: 20px;
        }

        .export-btn {
            width: 100%;
            text-align: center;
        }

        th, td {
            padding: 10px;
        }

        .back-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container">
    <h1>Список экспертов</h1>

    @if (session('error'))
    <div class="error-messages">
        {{ session('error') }}
    </div>
    @endif
    <a href="{{ route('admin.dashboard') }}" class="back-btn">Вернуться в админ-панель</a><br>
    <a href="{{ route('admin.exportExperts') }}" class="export-btn">
        <i class="fas fa-file-excel"></i> Экспортировать в Excel
    </a>

    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <!-- Добавьте другие необходимые поля -->
        </tr>
        </thead>
        <tbody>
        @foreach ($experts as $expert)
        <tr>
            <td>{{ $expert->id }}</td>
            <td>{{ $expert->name }}</td>
            <td>{{ $expert->email }}</td>
            <!-- Добавьте другие необходимые поля -->
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

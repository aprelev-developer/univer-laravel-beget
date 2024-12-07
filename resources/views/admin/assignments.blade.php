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

    /* Подзаголовки экспертов */
    h3 {
        color: #388e3c; /* Средне-зелёный */
        margin-top: 40px;
        margin-bottom: 15px;
        font-size: 1.5rem;
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

    /* Стилизация списков вузов */
    ul {
        list-style-type: disc;
        padding-left: 20px;
        margin-bottom: 20px;
    }

    li {
        padding: 8px 0;
        color: #2e7d32; /* Тёмно-зелёный */
        font-size: 1.1rem;
    }

    /* Стилизация сообщений об ошибках */
    .error-messages {
        background-color: #ffcdd2; /* Светло-красный фон для ошибок */
        border-left: 4px solid #f44336; /* Красная линия слева */
        padding: 10px 15px;
        margin-bottom: 20px;
        border-radius: 4px;
        color: #c62828; /* Красный текст */
    }

    /* Стилизация таблицы (если решите использовать таблицу для отображения данных) */
    /*
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
    */

    /* Иконки Font Awesome */
    .export-btn i {
        margin-right: 8px;
    }

    /* Медиа-запросы для адаптивности */
    @media (max-width: 600px) {
        .container {
            padding: 20px;
            margin: 20px;
        }

        .export-btn {
            width: 100%;
            text-align: center;
        }

        h3 {
            font-size: 1.3rem;
        }

        li {
            font-size: 1rem;
        }
    }
</style>

<div class="container">
    <h1>Закрепления экспертов за вузами</h1>

    @if (session('error'))
        <div class="error-messages">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('admin.exportAssignments') }}" class="export-btn">
        <i class="fas fa-file-excel"></i> Экспортировать в Excel
    </a>

    @foreach ($experts as $expert)
        <h3>Эксперт: {{ $expert->name }} ({{ $expert->email }})</h3>
        @if ($expert->universities->count() > 0)
            <ul>
                @foreach ($expert->universities as $university)
                    <li>{{ $university->name }} ({{ $university->email }})</li>
                @endforeach
            </ul>
        @else
            <p>Нет закрепленных вузов.</p>
        @endif
    @endforeach
</div>
@endsection

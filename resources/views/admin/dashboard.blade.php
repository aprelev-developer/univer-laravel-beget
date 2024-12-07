@extends('layouts.app')

@section('content')
<style>
    /* Общие стили для контейнера */
    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background-color: #f0f9f0; /* Светло-зелёный фон */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: 'Arial', sans-serif;
    }

    /* Заголовки */
    h1 {
        text-align: center;
        color: #2e7d32; /* Тёмно-зелёный */
        margin-bottom: 40px;
        font-size: 2.5rem;
    }

    h3 {
        color: #388e3c; /* Средне-зелёный */
        margin-top: 40px;
        margin-bottom: 20px;
        font-size: 1.75rem;
    }

    /* Ссылки как кнопки */
    a.button-link {
        display: inline-block;
        margin: 10px 0;
        padding: 12px 25px;
        background-color: #66bb6a; /* Светло-зелёный */
        color: #ffffff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        font-size: 1rem;
        font-weight: bold;
    }

    a.button-link:hover {
        background-color: #388e3c; /* Средне-зелёный при наведении */
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }

    /* Разделение ссылок */
    .button-group a {
        display: block;
    }

    /* Медиа-запросы для адаптивности */
    @media (max-width: 600px) {
        .container {
            padding: 20px;
            margin: 20px;
        }

        a.button-link {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container">
    <h1>Администраторский кабинет</h1>

    <div class="button-group">
        <a href="{{ route('admin.createUser') }}" class="button-link">
            Создать пользователя
        </a>
        <a href="{{ route('admin.assignExpert') }}" class="button-link">
            Закрепить эксперта за вузом
        </a>
    </div>

    <h3>Отчеты:</h3>
    <div class="button-group">
        <a href="{{ route('admin.experts') }}" class="button-link">
            Список экспертов
        </a>
        <a href="{{ route('admin.universities') }}" class="button-link">
            Список вузов
        </a>
        <a href="{{ route('admin.assignments') }}" class="button-link">
            Закрепления экспертов за вузами
        </a>
    </div>
</div>
@endsection

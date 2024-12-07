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
        margin-bottom: 30px;
        font-size: 2.5rem;
    }

    /* Стили для сообщений об ошибках */
    .error-messages {
        background-color: #ffcdd2; /* Светло-красный фон для ошибок */
        border-left: 4px solid #f44336; /* Красная линия слева */
        padding: 10px 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .error-messages ul {
        list-style-type: none;
        padding-left: 0;
        margin: 0;
        color: #c62828; /* Красный текст */
    }

    .error-messages li {
        margin-bottom: 5px;
    }

    /* Стили для формы */
    form {
        display: flex;
        flex-direction: column;
    }

    form div {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    form label {
        margin-bottom: 5px;
        color: #2e7d32; /* Тёмно-зелёный */
        font-weight: bold;
    }

    form select {
        padding: 10px;
        border: 1px solid #c8e6c9; /* Светло-зелёная рамка */
        border-radius: 4px;
        font-size: 1rem;
    }

    form select:focus {
        outline: none;
        border-color: #66bb6a; /* Светло-зелёный при фокусе */
        box-shadow: 0 0 5px rgba(102, 187, 106, 0.5);
    }

    /* Стили для кнопок */
    .btn {
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        font-weight: bold;
        width: fit-content;
    }

    .btn-primary {
        background-color: #66bb6a; /* Светло-зелёный */
        color: #ffffff;
    }

    .btn-primary:hover {
        background-color: #388e3c; /* Средне-зелёный при наведении */
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: #81c784; /* Ещё один оттенок зелёного */
        color: #ffffff;
        margin-top: 10px;
    }

    .btn-secondary:hover {
        background-color: #388e3c; /* Средне-зелёный при наведении */
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: #e57373; /* Красновато-зелёный для удаления */
        color: #ffffff;
    }

    .btn-danger:hover {
        background-color: #c62828; /* Темно-красный при наведении */
        transform: translateY(-2px);
    }

    /* Медиа-запросы для адаптивности */
    @media (max-width: 600px) {
        .container {
            padding: 20px;
            margin: 20px;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container">
    <h1>Закрепление эксперта за вузом</h1>

    @if (session('error'))
        <div class="error-messages">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.storeAssignment') }}">
        @csrf
        <div>
            <label for="expert_id">Эксперт:</label>
            <select name="expert_id" id="expert_id" required>
                <option value="" disabled selected>Выберите эксперта</option>
                @foreach ($experts as $expert)
                    <option value="{{ $expert->id }}">{{ $expert->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="university_id">Вуз:</label>
            <select name="university_id" id="university_id" required>
                <option value="" disabled selected>Выберите вуз</option>
                @foreach ($universities as $university)
                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Закрепить</button>
    </form>
</div>
@endsection

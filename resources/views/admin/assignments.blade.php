@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 30px;
        background-color: #f0fff0;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        font-family: 'Arial', sans-serif;
    }

    h1 {
        text-align: center;
        color: #2e7d32;
        margin-bottom: 30px;
        font-size: 2.5rem;
    }

    h3 {
        color: #388e3c;
        margin-top: 40px;
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    .export-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #66bb6a;
        color: #ffffff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .export-btn:hover {
        background-color: #388e3c;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .error-messages {
        background-color: #ffcdd2;
        border-left: 4px solid #f44336;
        padding: 10px 15px;
        margin-bottom: 20px;
        border-radius: 4px;
        color: #c62828;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    thead {
        background-color: #66bb6a;
        color: #ffffff;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
        font-size: 1rem;
        color: #2e7d32;
    }

    tbody tr:hover {
        background-color: #e8f5e9;
    }

    .export-btn i {
        margin-right: 8px;
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

        th, td {
            font-size: 0.9rem;
        }

        .back-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container">
    <!-- Кнопка возвращения на админ-панель -->
    <a href="{{ route('admin.dashboard') }}" class="back-btn">Вернуться в админ-панель</a>

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
            <table>
                <thead>
                    <tr>
                        <th>Название вуза</th>
                        <th>Email вуза</th>
                        <th>Баллы</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expert->universities as $university)
                        <tr>
                            <td>{{ $university->name }}</td>
                            <td>{{ $university->email }}</td>
                            <td>
                                @if($university->formEntry && $university->formEntry->score !== null)
                                    {{ $university->formEntry->score }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Нет закрепленных вузов.</p>
        @endif
    @endforeach
</div>
@endsection

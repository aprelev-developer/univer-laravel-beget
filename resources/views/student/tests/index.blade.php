@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Доступные Тесты</h1>

    @if($tests->isEmpty())
        <p>Нет доступных тестов.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Название Теста</th>
                    <th>Описание</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tests as $test)
                    @php
                        $isCompleted = $test->results()->where('user_id', auth()->user()->id)->exists();
                    @endphp
                    <tr class="{{ $isCompleted ? 'table-success' : '' }}">
                        <td>{{ $test->title }}</td>
                        <td>{{ $test->description }}</td>
                        <td>
                            @if($isCompleted)
                                <span class="badge bg-success">Пройден</span>
                            @else
                                <span class="badge bg-primary">Не пройден</span>
                            @endif
                        </td>
                        <td>
                            @if(!$isCompleted)
                                <a href="{{ route('student.tests.show', $test->id) }}" class="btn btn-success">Сдать Тест</a>
                            @else
                                <button class="btn btn-secondary" disabled>Тест пройден</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

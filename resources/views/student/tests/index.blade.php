<!-- resources/views/student/tests/index.blade.php -->

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
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tests as $test)
                    <tr>
                        <td>{{ $test->title }}</td>
                        <td>{{ $test->description }}</td>
                        <td>
                            <a href="{{ route('student.tests.show', $test->id) }}" class="btn btn-primary">Просмотреть</a>
                            <form action="{{ route('student.tests.submit', $test->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success">Сдать Тест</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

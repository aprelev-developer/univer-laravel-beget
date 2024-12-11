@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Результаты Тестов</h1>
    @if($results->isEmpty())
        <p>Нет результатов для отображения.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Студент</th>
                    <th>Тест</th>
                    <th>Правильных Ответов</th>
                    <th>Всего Вопросов</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result->student->surname }} {{ $result->student->name }}</td>
                        <td>{{ $result->test->title }}</td>
                        <td>{{ $result->correct_answers }}</td>
                        <td>{{ $result->total_questions }}</td>
                        <td>{{ $result->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.results.show', $result->id) }}" class="btn btn-sm btn-info">Просмотреть</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $results->links() }}
    @endif
</div>
@endsection

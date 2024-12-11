@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Результаты Теста: {{ $result->test->title }}</h1>
    <p><strong>Студент:</strong> {{ $result->student->name }} ({{ $result->student->email }})</p>
    <p><strong>Группа:</strong> {{ $result->student->group->name }}</p>
    <p><strong>Университет:</strong> {{ $result->student->university->name }}</p>
    <p><strong>Дата Прохождения:</strong> {{ $result->created_at->format('d.m.Y H:i') }}</p>
    <p><strong>Результат:</strong> {{ $result->correct_answers }} из {{ $result->total_questions }}</p>

    <h3 class="mt-4">Детали Ответов</h3>
    @foreach($result->student->answers as $answer)
        <div class="card mb-3">
            <div class="card-header">
                Вопрос: {{ $answer->option->question->content }}
            </div>
            <div class="card-body">
                <p><strong>Ваш Ответ:</strong> {{ $answer->option->option_text }}</p>
                @if($answer->option->is_correct)
                    <p><span class="badge badge-success">Правильный Ответ</span></p>
                @else
                    <p><span class="badge badge-danger">Неправильный Ответ</span></p>
                    <p><strong>Правильный Ответ:</strong>
                        @foreach($answer->option->question->options->where('is_correct', true) as $correctOption)
                            {{ $correctOption->option_text }}@if(!$loop->last), @endif
                        @endforeach
                    </p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection

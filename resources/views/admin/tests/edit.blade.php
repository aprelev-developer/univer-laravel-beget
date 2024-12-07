@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Редактировать Тест: {{ $test->title }}</h1>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <h3>Добавить Вопрос</h3>
    <form action="{{ route('admin.tests.questions.store', $test->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">Текст Вопроса</label>
            <textarea name="content" id="content" class="form-control" required>{{ old('content') }}</textarea>
            @error('content')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-2">Добавить Вопрос</button>
    </form>

    <!-- Список вопросов и их вариантов -->
    <h3 class="mt-5">Список Вопросов</h3>
    @if($test->questions->isEmpty())
    <p>Нет вопросов в этом тесте.</p>
    @else
    @foreach($test->questions as $question)
    <div class="card mb-3">
        <div class="card-header">
            Вопрос {{ $loop->iteration }}: {{ $question->content }}
          <a href="{{ route('admin.tests.questions.edit', [$test->id, $question->id]) }}" class="btn btn-sm btn-warning float-right">Редактировать</a>

        </div>
        <div class="card-body">
            <ul>
                @foreach($question->options as $option)
                <li>
                    {{ $option->option_text }}
                    @if($option->is_correct)
                    <span class="badge badge-success">Правильный</span>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection

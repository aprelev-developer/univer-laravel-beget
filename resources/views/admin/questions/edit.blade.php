@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Редактировать Вопрос: {{ $question->content }}</h1>

    <!-- Форма для обновления вопроса -->
    <form action="{{ route('admin.tests.questions.update', [$test->id, $question->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="content">Текст Вопроса</label>
            <textarea name="content" id="content" class="form-control" required>{{ old('content', $question->content) }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success mt-2">Обновить Вопрос</button>
    </form>

    <!-- Форма для добавления варианта ответа -->
    <h3 class="mt-5">Добавить Вариант Ответа</h3>
    <form action="{{ route('admin.tests.questions.options.store', [$test->id, $question->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="option_text">Текст Варианта</label>
            <input type="text" name="option_text" id="option_text" class="form-control" required value="{{ old('option_text') }}">
        </div>
       <div class="form-group form-check">
    <input type="hidden" name="is_correct" value="0"> <!-- Добавлено скрытое поле -->
    <input type="checkbox" name="is_correct" id="is_correct" class="form-check-input" value="1" {{ old('is_correct') ? 'checked' : '' }}>
    <label class="form-check-label" for="is_correct">Правильный Ответ</label>
    @error('is_correct')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

        <button type="submit" class="btn btn-primary">Добавить Вариант</button>
    </form>

    <!-- Список вариантов ответов -->
    <h3 class="mt-5">Список Вариантов Ответов</h3>
    @if($question->options->isEmpty())
        <p>Нет вариантов ответов для этого вопроса.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Текст Варианта</th>
                    <th>Правильный</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($question->options as $option)
                    <tr>
                        <td>{{ $option->option_text }}</td>
                        <td>{{ $option->is_correct ? 'Да' : 'Нет' }}</td>
                        <td>
                            <a href="{{ route('admin.tests.questions.options.edit', [$test->id, $question->id, $option->id]) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <form action="{{ route('admin.tests.questions.options.destroy', [$test->id, $question->id, $option->id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

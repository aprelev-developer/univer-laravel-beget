@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Редактировать Вариант Ответа</h1>
    <form action="{{ route('admin.tests.questions.options.update', [$question->test_id, $question->id, $option->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="option_text">Текст Варианта</label>
            <input type="text" name="option_text" id="option_text" class="form-control" required value="{{ old('option_text', $option->option_text) }}">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="is_correct" id="is_correct" class="form-check-input" {{ old('is_correct', $option->is_correct) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_correct">Правильный Ответ</label>
        </div>
        <button type="submit" class="btn btn-success mt-2">Обновить Вариант</button>
    </form>
</div>
@endsection

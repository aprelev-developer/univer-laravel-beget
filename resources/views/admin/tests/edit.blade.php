@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать Тест: {{ $test->title }}</h1>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.tests.update', $test->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Кнопка Импорта Вопросов -->
        <a href="{{ route('admin.tests.import', $test->id) }}" class="btn btn-success mb-3">Импортировать Вопросы</a>

        <!-- Поля для редактирования теста -->
        <div class="form-group">
            <label for="title">Название Теста</label>
            <input type="text" name="title" id="title" class="form-control" required
                   value="{{ old('title', $test->title) }}">
            @error('title')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Описание Теста</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $test->description) }}</textarea>
            @error('description')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="university_id">Университет</label>
            <select name="university_id" id="university_id" class="form-control" required>
                <option value="">Выберите университет</option>
                @foreach($universities as $university)
                <option value="{{ $university->id }}" {{ (old(
                'university_id', $test->university_id) == $university->id) ? 'selected' : '' }}>
                {{ $university->name }}
                </option>
                @endforeach
            </select>
            @error('university_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="group_id">Группа</label>
            <select name="group_id" id="group_id" class="form-control" required>
                <option value="">Выберите группу</option>
                @foreach($groups as $group)
                <option value="{{ $group->id }}" {{ (old(
                'group_id', $test->group_id) == $group->id) ? 'selected' : '' }}>
                {{ $group->name }}
                </option>
                @endforeach
            </select>
            @error('group_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mt-3">Обновить Тест</button>
    </form>

    <!-- Существующий код для добавления и отображения вопросов -->
    <h3 class="mt-5">Добавить Вопрос</h3>
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
            <a href="{{ route('admin.tests.questions.edit', [$test->id, $question->id]) }}"
               class="btn btn-sm btn-warning float-right ml-2">Редактировать</a>
            <!-- Кнопка удаления вопроса -->
            <form action="{{ route('admin.tests.questions.destroy', [$test->id, $question->id]) }}" method="POST"
                  class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger float-right"
                        onclick="return confirm('Вы уверены, что хотите удалить этот вопрос?')">Удалить
                </button>
            </form>
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

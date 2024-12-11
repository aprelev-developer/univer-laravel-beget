@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $test->title }}</h1>
    <p>{{ $test->description }}</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('student.tests.submit', $test->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <h3>Информация о Студенте</h3>
            <div class="form-group">
                <label for="surname">Фамилия</label>
                <input type="text" name="surname" id="surname" class="form-control" required value="{{ old('surname') }}">
                @error('surname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="group_number">Номер Группы</label>
                <input type="text" name="group_number" id="group_number" class="form-control" required value="{{ old('group_number') }}">
                @error('group_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="university">ВУЗ</label>
                <input type="text" name="university" id="university" class="form-control" required value="{{ old('university') }}">
                @error('university')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <hr>

        <div class="mb-4">
            <h3>Тест</h3>
            @foreach($test->questions as $question)
                <div class="card mb-3">
                    <div class="card-header">
                        Вопрос {{ $loop->iteration }}: {{ $question->content }}
                    </div>
                    <div class="card-body">
                        @foreach($question->options as $option)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="answers[{{ $question->id }}]" id="option{{ $option->id }}" value="{{ $option->id }}">
                                <label class="form-check-label" for="option{{ $option->id }}">
                                    {{ $option->option_text }}
                                </label>
                            </div>
                        @endforeach

                        @error('answers.' . $question->id)
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Отправить Тест</button>
    </form>
</div>
@endsection

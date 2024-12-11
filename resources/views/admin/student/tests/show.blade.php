@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $test->title }}</h1>
    <p>{{ $test->description }}</p>

    <form action="{{ route('student.tests.submit', $test->id) }}" method="POST">
        @csrf
        @foreach($test->questions as $question)
            <div class="card mb-3">
                <div class="card-header">
                    Вопрос {{ $loop->iteration }}: {{ $question->content }}
                </div>
                <div class="card-body">
                    @foreach($question->options as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="option{{ $option->id }}" value="{{ $option->id }}" required>
                            <label class="form-check-label" for="option{{ $option->id }}">
                                {{ $option->option_text }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-success">Сдать Тест</button>
    </form>
</div>
@endsection

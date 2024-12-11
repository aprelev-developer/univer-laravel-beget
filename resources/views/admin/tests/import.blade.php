@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Импорт Вопросов для Теста: {{ $test->title }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tests.import.submit', $test->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="questions_file">Загрузить JSON файл с вопросами</label>
            <input type="file" name="questions_file" id="questions_file" class="form-control" accept=".json" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Импортировать Вопросы</button>
    </form>
</div>
@endsection

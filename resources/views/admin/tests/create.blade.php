@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Создать Новый Тест</h1>
    <form action="{{ route('admin.tests.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Название Теста</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Описание Теста</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success mt-3">Создать Тест</button>
    </form>
</div>
@endsection

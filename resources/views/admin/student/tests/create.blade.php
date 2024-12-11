@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary mb-3">Вернуться к списку студентов</a>
    <h1>Создать Студента</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">ФИО Студента</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Электронная Почта (Логин)</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="university_id">Университет</label>
            <select name="university_id" id="university_id" class="form-control" required>
                <option value="">Выберите университет</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}" {{ old('university_id') == $university->id ? 'selected' : '' }}>
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
                    <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
            @error('group_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Создать Студента</button>
    </form>
</div>
@endsection

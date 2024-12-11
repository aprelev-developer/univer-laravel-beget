@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список Тестов</h1>
    <a href="{{ route('admin.tests.create') }}" class="btn btn-primary mb-3">Создать Новый Тест</a>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($tests->isEmpty())
    <p>Нет доступных тестов.</p>
    @else
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Вуз</th>
            <th>Группа</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tests as $test)
        <tr>
            <td>{{ $test->title }}</td>
            <td>{{ $test->description }}</td>
            <td>{{ $test->university->name }}</td>
            <td>{{ $test->group->name }}</td>
            <td>
                <a href="{{ route('admin.tests.edit', $test->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                <form action="{{ route('admin.tests.destroy', $test->id) }}" method="POST"
                      style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">
                        Удалить
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection

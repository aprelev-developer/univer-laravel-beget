@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список Студентов</h1>
    <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">Создать Студента</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($students->isEmpty())
        <p>Нет студентов для отображения.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Email (Логин)</th>
                    <th>Университет</th>
                    <th>Группа</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->university->name }}</td>
                        <td>{{ $student->group->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $students->links() }}
    @endif
</div>
@endsection

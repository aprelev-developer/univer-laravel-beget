@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список вузов</h1>
    <a href="{{ route('admin.exportUniversities') }}" class="btn btn-success">Экспортировать в Excel</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Email</th>
                <!-- Добавьте другие необходимые поля -->
            </tr>
        </thead>
        <tbody>
            @foreach ($universities as $university)
                <tr>
                    <td>{{ $university->id }}</td>
                    <td>{{ $university->name }}</td>
                    <td>{{ $university->email }}</td>
                    <!-- Добавьте другие необходимые поля -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

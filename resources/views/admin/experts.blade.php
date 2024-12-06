@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список экспертов</h1>
    <a href="{{ route('admin.exportExperts') }}" class="btn btn-success">Экспортировать в Excel</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <!-- Добавьте другие необходимые поля -->
            </tr>
        </thead>
        <tbody>
            @foreach ($experts as $expert)
                <tr>
                    <td>{{ $expert->id }}</td>
                    <td>{{ $expert->name }}</td>
                    <td>{{ $expert->email }}</td>
                    <!-- Добавьте другие необходимые поля -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

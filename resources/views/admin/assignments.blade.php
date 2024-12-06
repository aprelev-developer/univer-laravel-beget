@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Закрепления экспертов за вузами</h1>
    <a href="{{ route('admin.exportAssignments') }}" class="btn btn-success">Экспортировать в Excel</a>
    @foreach ($experts as $expert)
        <h3>Эксперт: {{ $expert->name }} ({{ $expert->email }})</h3>
        @if ($expert->universities->count() > 0)
            <ul>
                @foreach ($expert->universities as $university)
                    <li>{{ $university->name }} ({{ $university->email }})</li>
                @endforeach
            </ul>
        @else
            <p>Нет закрепленных вузов.</p>
        @endif
    @endforeach
</div>
@endsection

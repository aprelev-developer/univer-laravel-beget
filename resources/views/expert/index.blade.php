@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Прикрепленные университеты</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Университет</th>
                <th>Баллы</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($universities as $university)
                <tr>
                    <td>{{ $university->name }}</td>
                    <td>{{ $university->formEntry->score ?? 'Не заполнено' }}</td>
                    <td>
                        @if($university->formEntry && $university->formEntry->is_editable)
                            <a href="{{ route('expert.edit_form', $university->id) }}" class="btn btn-primary btn-sm">Редактировать</a>
                        @else
                            <a href="{{ route('expert.view_form', $university->id) }}" class="btn btn-secondary btn-sm">Просмотреть</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

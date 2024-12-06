@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Кабинет эксперта</h1>
    <h3>Закрепленные вузы:</h3>
    @foreach ($universities as $university)
        <p>
            {{ $university->name }} -
            <a href="{{ route('expert.review', $university->id) }}">Проверить форму</a>
        </p>
    @endforeach
</div>
@endsection

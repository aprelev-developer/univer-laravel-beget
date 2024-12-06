@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Кабинет вуза</h1>
    <a href="{{ route('university.form') }}">Заполнить форму</a>
</div>
@endsection

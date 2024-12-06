@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Проверка формы вуза: {{ $university->name }}</h1>
    <p>{{ $form->data }}</p>
    <!-- Здесь можно добавить функционал проверки -->
</div>
@endsection

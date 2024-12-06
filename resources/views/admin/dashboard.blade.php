@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Администраторский кабинет</h1>
    <a href="{{ route('admin.createUser') }}">Создать пользователя</a><br>
    <a href="{{ route('admin.assignExpert') }}">Закрепить эксперта за вузом</a><br><br>
    <h3>Отчеты:</h3>
    <a href="{{ route('admin.experts') }}">Список экспертов</a><br>
    <a href="{{ route('admin.universities') }}">Список вузов</a><br>
    <a href="{{ route('admin.assignments') }}">Закрепления экспертов за вузами</a>
</div>
@endsection

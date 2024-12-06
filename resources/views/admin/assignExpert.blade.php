@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Закрепление эксперта за вузом</h1>
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.storeAssignment') }}">
        @csrf
        <div>
            <label>Эксперт:</label>
            <select name="expert_id" required>
                @foreach ($experts as $expert)
                    <option value="{{ $expert->id }}">{{ $expert->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Вуз:</label>
            <select name="university_id" required>
                @foreach ($universities as $university)
                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Закрепить</button>
    </form>
</div>
@endsection

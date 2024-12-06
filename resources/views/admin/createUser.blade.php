@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создание пользователей</h1>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.storeMultipleUsers') }}">
        @csrf
        <div id="user-forms">
            <div class="user-form">
                <h4>Пользователь 1</h4>
                <div>
                    <label>Имя:</label>
                    <input type="text" name="users[0][name]" required>
                </div>
                <div>
                    <label>Email:</label>
                    <input type="email" name="users[0][email]" required>
                </div>
                <div>
                    <label>Пароль:</label>
                    <input type="password" name="users[0][password]" required>
                </div>
                <div>
                    <label>Подтвердите пароль:</label>
                    <input type="password" name="users[0][password_confirmation]" required>
                </div>
                <div>
                    <label>Роль:</label>
                    <select name="users[0][role]" required>
                        <option value="expert">Эксперт</option>
                        <option value="university">Вуз</option>
                    </select>
                </div>
                <button type="button" class="remove-user btn btn-danger">Удалить</button>
                <hr>
            </div>
        </div>
        <button type="button" id="add-user" class="btn btn-secondary">Добавить пользователя</button>
        <br><br>
        <button type="submit" class="btn btn-primary">Создать пользователей</button>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let userIndex = 1;

        document.getElementById('add-user').addEventListener('click', function () {
            const userForms = document.getElementById('user-forms');
            const newUserForm = document.querySelector('.user-form').cloneNode(true);

            newUserForm.querySelector('h4').textContent = 'Пользователь ' + (userIndex + 1);
            newUserForm.querySelectorAll('input, select').forEach(function (input) {
                const name = input.getAttribute('name');
                const newName = name.replace(/\d+/, userIndex);
                input.setAttribute('name', newName);
                input.value = '';
            });

            userForms.appendChild(newUserForm);
            userIndex++;
        });

        document.getElementById('user-forms').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-user')) {
                if (document.querySelectorAll('.user-form').length > 1) {
                    e.target.closest('.user-form').remove();
                    userIndex--;
                } else {
                    alert('Должен быть хотя бы один пользователь.');
                }
            }
        });
    });
</script>


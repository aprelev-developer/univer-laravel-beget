@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background-color: #f0f9f0;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: 'Arial', sans-serif;
    }

    h1 {
        text-align: center;
        color: #2e7d32;
        margin-bottom: 30px;
        font-size: 2.5rem;
    }

    h4 {
        color: #388e3c;
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    .error-messages {
        background-color: #ffcdd2;
        border-left: 4px solid #f44336;
        padding: 10px 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .error-messages ul {
        list-style-type: none;
        padding-left: 0;
        margin: 0;
        color: #c62828;
    }

    .error-messages li {
        margin-bottom: 5px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    .user-form {
        margin-bottom: 30px;
        padding: 20px;
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        position: relative;
    }

    .user-form h4 {
        margin-top: 0;
    }

    .user-form div {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .user-form label {
        margin-bottom: 5px;
        color: #2e7d32;
        font-weight: bold;
    }

    .user-form input,
    .user-form select {
        padding: 10px;
        border: 1px solid #c8e6c9;
        border-radius: 4px;
        font-size: 1rem;
    }

    .user-form input:focus,
    .user-form select:focus {
        outline: none;
        border-color: #66bb6a;
        box-shadow: 0 0 5px rgba(102, 187, 106, 0.5);
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #66bb6a;
        color: #ffffff;
        margin-top: 20px;
    }

    .btn-primary:hover {
        background-color: #388e3c;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: #81c784;
        color: #ffffff;
        margin-top: 10px;
    }

    .btn-secondary:hover {
        background-color: #388e3c;
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: #e57373;
        color: #ffffff;
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .btn-danger:hover {
        background-color: #c62828;
        transform: translateY(-2px);
    }

    #add-user {
        align-self: flex-start;
    }

    /* Кнопка вернуться */
    .back-btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #8bc34a;
        color: #ffffff;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .back-btn:hover {
        background-color: #7cb342;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    @media (max-width: 600px) {
        .container {
            padding: 20px;
            margin: 20px;
        }

        .user-form {
            padding: 15px;
        }

        .btn {
            width: 100%;
            text-align: center;
        }

        .btn-danger {
            position: static;
            margin-top: 10px;
        }
    }
</style>

<div class="container">
    <!-- Кнопка вернуться в админ-панель -->
    <a href="{{ route('admin.dashboard') }}" class="back-btn">Вернуться в админ-панель</a>

    <h1>Создание пользователей</h1>

    @if ($errors->any())
        <div class="error-messages">
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
                    <label for="users[0][name]">Имя:</label>
                    <input type="text" name="users[0][name]" id="users[0][name]" required>
                </div>
                <div>
                    <label for="users[0][email]">Email:</label>
                    <input type="email" name="users[0][email]" id="users[0][email]" required>
                </div>
                <div>
                    <label for="users[0][password]">Пароль:</label>
                    <input type="password" name="users[0][password]" id="users[0][password]" required>
                </div>
                <div>
                    <label for="users[0][password_confirmation]">Подтвердите пароль:</label>
                    <input type="password" name="users[0][password_confirmation]" id="users[0][password_confirmation]" required>
                </div>
                <div>
                    <label for="users[0][role]">Роль:</label>
                    <select name="users[0][role]" id="users[0][role]" required>
                        <option value="expert">Эксперт</option>
                        <option value="university">Вуз</option>
                    </select>
                </div>
                <button type="button" class="remove-user btn btn-danger">Удалить</button>
            </div>
        </div>
        <button type="button" id="add-user" class="btn btn-secondary">Добавить пользователя</button>
        <button type="submit" class="btn btn-primary">Создать пользователей</button>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let userIndex = 1;

        document.getElementById('add-user').addEventListener('click', function () {
            const userForms = document.getElementById('user-forms');
            const template = document.querySelector('.user-form');
            const newUserForm = template.cloneNode(true);

            newUserForm.querySelector('h4').textContent = 'Пользователь ' + (userIndex + 1);

            newUserForm.querySelectorAll('input, select').forEach(function (input) {
                const name = input.getAttribute('name');
                const id = input.getAttribute('id');
                const newName = name.replace(/\d+/, userIndex);
                const newId = id.replace(/\d+/, userIndex);
                input.setAttribute('name', newName);
                input.setAttribute('id', newId);
                input.value = '';
            });

            userForms.appendChild(newUserForm);
            userIndex++;
        });

        document.getElementById('user-forms').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-user')) {
                const userForms = document.querySelectorAll('.user-form');
                if (userForms.length > 1) {
                    e.target.closest('.user-form').remove();
                    userIndex--;
                } else {
                    alert('Должен быть хотя бы один пользователь.');
                }
            }
        });
    });
</script>

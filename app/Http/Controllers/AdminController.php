<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\ExpertsExport;
use App\Exports\UniversitiesExport;
use App\Exports\AssignmentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function createUser()
    {
        return view('admin.createUser');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:expert,university',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Пользователь создан.');
    }

    public function assignExpert()
    {
        $experts = User::where('role', 'expert')->get();
        $universities = User::where('role', 'university')->get();

        return view('admin.assignExpert', compact('experts', 'universities'));
    }

    public function storeAssignment(Request $request)
    {
        $request->validate([
            'expert_id' => 'required|exists:users,id',
            'university_id' => 'required|exists:users,id',
        ]);

        $expert = User::find($request->expert_id);

        if ($expert->universities()->count() >= 3) {
            return redirect()->back()->with('error', 'Эксперт уже имеет 3 вуза.');
        }

        $expert->universities()->attach($request->university_id);

        return redirect()->route('admin.dashboard')->with('success', 'Вуз закреплен за экспертом.');
    }

    //методы для выгрузки отчетов
    public function experts()
    {
        $experts = User::where('role', 'expert')->get();
        return view('admin.experts', compact('experts'));
    }

    public function exportExperts()
    {
        return Excel::download(new ExpertsExport, 'experts.xlsx');
    }

    public function universities()
    {
        $universities = User::where('role', 'university')->get();
        return view('admin.universities', compact('universities'));
    }

    public function exportUniversities()
    {
        return Excel::download(new UniversitiesExport, 'universities.xlsx');
    }

    public function assignments()
    {
        $experts = User::where('role', 'expert')->with('universities')->get();
        return view('admin.assignments', compact('experts'));
    }

    public function exportAssignments()
    {
        return Excel::download(new AssignmentsExport, 'assignments.xlsx');
    }

    public function storeMultipleUsers(Request $request)
    {
        $users = $request->input('users');

        foreach ($users as $key => $userData) {
            $validator = Validator::make($userData, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|in:expert,university',
            ], [], [
                'name' => "Имя пользователя #" . ($key + 1),
                'email' => "Email пользователя #" . ($key + 1),
                'password' => "Пароль пользователя #" . ($key + 1),
                'role' => "Роль пользователя #" . ($key + 1),
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'role' => $userData['role'],
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Пользователи созданы.');
    }

     // Метод для отображения формы создания студента
    public function createStudent()
    {
        $universities = University::all();
        $groups = Group::all();
        return view('admin.students.create', compact('universities', 'groups'));
    }

    // Метод для сохранения студента
    public function storeStudent(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'university_id' => 'required|exists:universities,id',
            'group_id' => 'required|exists:groups,id',
            'name' => 'required|string|max:255',
        ]);

        // Генерация случайного пароля
        $password = Str::random(8);

        // Создание пользователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'university_id' => $request->university_id,
            'group_id' => $request->group_id,
            'password' => Hash::make($password),
        ]);

        // Назначение роли студент
        $user->assignRole('student');

        // Отправка логина и пароля на email студента
        // Здесь предполагается, что настройка почты уже выполнена
        // Добавь код для отправки email, если необходимо

        return redirect()->route('admin.students.index')
                         ->with('success', "Студент успешно создан. Логин: {$user->email}, Пароль: {$password}");
    }

    // Метод для отображения списка студентов
    public function indexStudents()
    {
        $students = User::role('student')->with('university', 'group')->paginate(20);
        return view('admin.students.index', compact('students'));
    }

}


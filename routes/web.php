<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\UniversityFormController;
use App\Http\Controllers\Admin\ResultController;

// Отключение регистрации
Illuminate\Support\Facades\Auth::routes(['register' => false]);

// Главная страница — перенаправление на форму входа
Route::get('/', function () {
    return view('auth.login');
});

// Маршруты для Администраторов
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Основные маршруты
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/create-user', [AdminController::class, 'createUser'])->name('createUser');
    Route::post('/store-user', [AdminController::class, 'storeUser'])->name('storeUser');
    Route::get('/assign-expert', [AdminController::class, 'assignExpert'])->name('assignExpert');
    Route::post('/store-assignment', [AdminController::class, 'storeAssignment'])->name('storeAssignment');
    Route::post('/store-multiple-users', [AdminController::class, 'storeMultipleUsers'])->name('storeMultipleUsers');

    // Маршруты для выгрузки отчетов
    Route::get('/experts', [AdminController::class, 'experts'])->name('experts');
    Route::get('/experts/export', [AdminController::class, 'exportExperts'])->name('exportExperts');
    Route::get('/universities', [AdminController::class, 'universities'])->name('universities');
    Route::get('/universities/export', [AdminController::class, 'exportUniversities'])->name('exportUniversities');
    Route::get('/assignments', [AdminController::class, 'assignments'])->name('assignments');
    Route::get('/assignments/export', [AdminController::class, 'exportAssignments'])->name('exportAssignments');

    // Ресурсные маршруты для тестов
    Route::resource('tests', \App\Http\Controllers\Admin\TestController::class);

    // Вложенные ресурсные маршруты для вопросов и вариантов ответов
    Route::prefix('tests/{test}')->name('tests.')->group(function () {
        Route::resource('questions', \App\Http\Controllers\Admin\QuestionController::class)->except(
            ['show', 'index', 'create']
        )->names([
            'store' => 'questions.store',
            'update' => 'questions.update',
            'edit' => 'questions.edit',
            'destroy' => 'questions.destroy',
        ]);

        Route::resource('questions.options', \App\Http\Controllers\Admin\OptionController::class)->except(
            ['show', 'index', 'create']
        )->names([
            'store' => 'questions.options.store',
            'update' => 'questions.options.update',
            'edit' => 'questions.options.edit',
            'destroy' => 'questions.options.destroy',
        ]);

        // Добавлен уникальный маршрут для сдачи теста
        Route::post('/submit', [\App\Http\Controllers\Admin\TestController::class, 'submit'])->name('submit');
        Route::get('results', [ResultController::class, 'index'])->name('results.index');
        Route::get('results/{result}', [ResultController::class, 'show'])->name('results.show');
    });

    // Маршруты для управления студентами
    Route::get('/students', [AdminController::class, 'indexStudents'])->name('students.index');
    Route::get('/students/create', [AdminController::class, 'createStudent'])->name('students.create');
    Route::post('/students', [AdminController::class, 'storeStudent'])->name('students.store');


    // Корректные маршруты импорта
   Route::get('tests/{test}/import', [\App\Http\Controllers\Admin\TestImportController::class, 'showImportForm'])->name('tests.import');
Route::post('tests/{test}/import', [\App\Http\Controllers\Admin\TestImportController::class, 'import'])->name('tests.import.submit');

});


// Маршруты для Экспертов
Route::middleware(['auth', 'role:expert'])->prefix('expert')->name('expert.')->group(function () {
    // Панель эксперта
    Route::get('/', [ExpertController::class, 'index'])->name('dashboard');

    // Просмотр и обзор
    Route::get('/review/{university}', [ExpertController::class, 'review'])->name('review');
    Route::get('/universities', [ExpertController::class, 'viewUniversities'])->name('viewUniversities');
    Route::get('/university/{id}', [ExpertController::class, 'viewForm'])->name('viewForm');

    // Редактирование формы университета
    Route::get('/university/{id}/edit', [ExpertController::class, 'editForm'])->name('edit_form');
    Route::put('/university/{id}', [ExpertController::class, 'updateForm'])->name('update_form');

    // Просмотр формы университета без редактирования
    Route::get('/university/{id}/view', [ExpertController::class, 'viewForm'])->name('view_form');
});

// Маршруты для Вузов
Route::middleware(['auth', 'role:university'])->group(function () {
    Route::get('/', [UniversityFormController::class, 'index'])->name('dashboard');
    Route::get('/university/form', [UniversityFormController::class, 'showForm'])->name('university.form');
    Route::post('/university/form', [UniversityFormController::class, 'submitForm'])->name('university.submitForm');
      Route::post('/university/form/save', [UniversityFormController::class, 'savePartial'])->name('university.form.save_partial');
});

// Маршруты для Студентов
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    // Отображение списка доступных тестов
    Route::get('/tests', [\App\Http\Controllers\Student\TestController::class, 'index'])->name('tests.index');

    // Отображение конкретного теста
    Route::get('/tests/{test}', [\App\Http\Controllers\Student\TestController::class, 'show'])->name('tests.show');

    // Сдача теста
    Route::post('/tests/{test}/submit', [\App\Http\Controllers\Student\TestController::class, 'submit'])->name(
        'tests.submit'
    );
});

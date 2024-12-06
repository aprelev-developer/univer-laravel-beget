<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UniversityFormController;

\Illuminate\Support\Facades\Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('auth.login');
});

// Администратор
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/create-user', [AdminController::class, 'createUser'])->name('admin.createUser');
    Route::post('/admin/store-user', [AdminController::class, 'storeUser'])->name('admin.storeUser');
    Route::get('/admin/assign-expert', [AdminController::class, 'assignExpert'])->name('admin.assignExpert');
    Route::post('/admin/store-assignment', [AdminController::class, 'storeAssignment'])->name('admin.storeAssignment');
    Route::post('/admin/store-multiple-users', [AdminController::class, 'storeMultipleUsers'])->name(
        'admin.storeMultipleUsers'
    );


    //маршруты для выгрузки отчетов
    Route::get('/admin/experts', [AdminController::class, 'experts'])->name('admin.experts');
    Route::get('/admin/experts/export', [AdminController::class, 'exportExperts'])->name('admin.exportExperts');

    Route::get('/admin/universities', [AdminController::class, 'universities'])->name('admin.universities');
    Route::get('/admin/universities/export', [AdminController::class, 'exportUniversities'])->name(
        'admin.exportUniversities'
    );

    Route::get('/admin/assignments', [AdminController::class, 'assignments'])->name('admin.assignments');
    Route::get('/admin/assignments/export', [AdminController::class, 'exportAssignments'])->name(
        'admin.exportAssignments'
    );
});

// Группа маршрутов для экспертов, защищенная аутентификацией и ролью "expert"
Route::middleware(['auth', 'role:expert'])->prefix('expert')->name('expert.')->group(function () {
    // 1. Отображение панели эксперта
    Route::get('/', [ExpertController::class, 'index'])->name('dashboard');

    // 2. Просмотр и обзор
    Route::get('/review/{university}', [ExpertController::class, 'review'])->name('review');
    Route::get('/universities', [ExpertController::class, 'viewUniversities'])->name('viewUniversities');
    Route::get('/university/{id}', [ExpertController::class, 'viewForm'])->name('viewForm');

    // 3. Редактирование формы университета
    Route::get('/university/{id}/edit', [ExpertController::class, 'editForm'])->name('edit_form');
    Route::put('/university/{id}', [ExpertController::class, 'updateForm'])->name('update_form');

    // 4. Просмотр формы университета без редактирования
    Route::get('/university/{id}/view', [ExpertController::class, 'viewForm'])->name('view_form');
});

// Вуз
Route::middleware(['auth', 'role:university'])->group(function () {
    Route::get('/university', [UniversityController::class, 'index'])->name('university.dashboard');
    Route::get('/university/form', [UniversityController::class, 'form'])->name('university.form');
    Route::post('/university/form', [UniversityController::class, 'storeForm'])->name('university.storeForm');
    Route::get('/university/form', [UniversityFormController::class, 'showForm'])->name('university.form');
    Route::post('/university/form', [UniversityFormController::class, 'submitForm'])->name('university.submitForm');
});

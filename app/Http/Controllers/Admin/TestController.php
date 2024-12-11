<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\University;
use App\Models\Group;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('admin.tests.index', compact('tests'));
    }

  public function create()
    {
        $universities = University::all();
        $groups = Group::all();
        return view('admin.tests.create', compact('universities', 'groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
             'university_id' => 'required|exists:universities,id',
            'group_id' => 'required|exists:groups,id',
        ]);

          Test::create([
            'title' => $request->title,
            'description' => $request->description,
            'university_id' => $request->university_id,
            'group_id' => $request->group_id,
        ]);

        return redirect()->route('admin.tests.index')->with('success', 'Тест успешно создан.');
    }

    /**
     * @TODO:Перенаправление после импорта, важно учитывать что нужно передавать id теста, чтобы он правильно перенаправил, формат ссылки: http://127.0.0.1:8000/admin/tests/6/edit
     */
    public function show(Test $test)
    {
        return view('admin.tests.edit', compact('test'));
    }

    public function edit(Test $test)
    {
        $universities = University::all();
        $groups = Group::all();
        $test->load('questions.options');
        return view('admin.tests.edit', compact('test', 'universities', 'groups'));
    }

    public function update(Request $request, Test $test)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'university_id' => 'required|exists:universities,id',
            'group_id' => 'required|exists:groups,id',
        ]);

        $test->update([
            'title' => $request->title,
            'description' => $request->description,
            'university_id' => $request->university_id,
            'group_id' => $request->group_id,
        ]);

        return redirect()->route('admin.tests.index')->with('success', 'Тест успешно обновлен.');
    }

    public function destroy(Test $test)
    {
        $test->delete();
        return redirect()->route('admin.tests.index')
            ->with('success', 'Тест успешно удален.');
    }
}

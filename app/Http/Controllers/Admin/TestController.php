<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
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
        return view('admin.tests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $test = Test::create($request->only(['title', 'description']));

        return redirect()->route('admin.tests.edit', $test->id)
                         ->with('success', 'Тест успешно создан. Теперь добавьте вопросы.');
    }

    public function show(Test $test)
    {
        return view('admin.tests.show', compact('test'));
    }

    public function edit(Test $test)
    {
        $test->load('questions.options');
        return view('admin.tests.edit', compact('test'));
    }

    public function update(Request $request, Test $test)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $test->update($request->only(['title', 'description']));

        return redirect()->route('admin.tests.edit', $test->id)
                         ->with('success', 'Тест успешно обновлен.');
    }

    public function destroy(Test $test)
    {
        $test->delete();
        return redirect()->route('admin.tests.index')
                         ->with('success', 'Тест успешно удален.');
    }
}

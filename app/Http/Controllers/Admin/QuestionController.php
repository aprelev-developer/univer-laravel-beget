<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Test $test, Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $test->questions()->create([
            'content' => $request->content,
            'order' => $test->questions()->count() + 1,
        ]);

        return redirect()->route('admin.tests.edit', $test->id)
                         ->with('success', 'Вопрос успешно добавлен.');
    }

    public function edit(Test $test, Question $question)
    {
        $question->load('options');
        return view('admin.questions.edit', compact('test', 'question'));
    }

    public function update(Test $test, Question $question, Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $question->update([
            'content' => $request->content,
        ]);

        return redirect()->route('admin.tests.edit', $test->id)
                         ->with('success', 'Вопрос успешно обновлен.');
    }

    public function destroy(Test $test, Question $question)
    {
        $question->delete();
        return redirect()->route('admin.tests.edit', $test->id)
                         ->with('success', 'Вопрос успешно удален.');
    }
}

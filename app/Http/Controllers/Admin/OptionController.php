<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    // Метод для создания варианта ответа
    public function store(Test $test, Question $question, Request $request)
    {
        $request->validate([
            'option_text' => 'required|string',
            'is_correct' => 'nullable|boolean',
        ]);

        $question->options()->create([
            'option_text' => $request->option_text,
            'is_correct' => $request->has('is_correct'),
        ]);

        return redirect()->route('admin.tests.questions.edit', [$test->id, $question->id])
                         ->with('success', 'Вариант ответа успешно добавлен.');
    }

    // Метод для редактирования варианта ответа
    public function edit(Test $test, Question $question, Option $option)
    {
        return view('admin.options.edit', compact('test', 'question', 'option'));
    }

    // Метод для обновления варианта ответа
    public function update(Test $test, Question $question, Option $option, Request $request)
    {
        $request->validate([
            'option_text' => 'required|string',
            'is_correct' => 'nullable|boolean',
        ]);

        $option->update([
            'option_text' => $request->option_text,
            'is_correct' => $request->has('is_correct'),
        ]);

        return redirect()->route('admin.tests.questions.edit', [$test->id, $question->id])
                         ->with('success', 'Вариант ответа успешно обновлен.');
    }

    // Метод для удаления варианта ответа
    public function destroy(Test $test, Question $question, Option $option)
    {
        $option->delete();

        return redirect()->route('admin.tests.questions.edit', [$test->id, $question->id])
                         ->with('success', 'Вариант ответа успешно удален.');
    }
}

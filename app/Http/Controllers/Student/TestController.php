<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Answer;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    // Отображение списка доступных тестов
    public function index()
    {
        $student = Auth::user();
        $tests = Test::where('university_id', $student->university_id)
            ->where('group_id', $student->group_id)
            ->get();

        return view('student.tests.index', compact('tests'));
    }

    // Отображение конкретного теста
    public function show(Test $test)
    {
        $student = Auth::user();

        // Проверка, что тест принадлежит университету и группе студента
        if ($test->university_id !== $student->university_id || $test->group_id !== $student->group_id) {
            abort(403, 'У вас нет доступа к этому тесту.');
        }

        $test->load('questions.options');
        return view('student.tests.show', compact('test'));
    }

    // Сдача теста
    public function submit(Request $request, Test $test)
    {
        $student = Auth::user();

        // Проверка доступа к тесту
        if ($test->university_id !== $student->university_id || $test->group_id !== $student->group_id) {
            abort(403, 'У вас нет доступа к этому тесту.');
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer|exists:options,id',
        ]);

        /**
         * @TODO Потом решить как проверить сдавал он тест или нет
         */
        // Проверка, что студент уже не сдавал этот тест
//        $existingResult = $student->results()->where('test_id', $test->id)->first();
//        if ($existingResult) {
//            return redirect()->route('student.tests.index')->with('error', 'Вы уже сдавали этот тест.');
//        }

        // Сохраняем ответы
        foreach ($request->answers as $question_id => $option_id) {
            Answer::create([
                'user_id' => $student->id,
                'question_id' => $question_id,
                'option_id' => $option_id,
            ]);
        }

        // Подсчитываем правильные ответы
        $correct_answers = 0;
        $total_questions = $test->questions->count();

        foreach ($test->questions as $question) {
            $selected_option_id = $request->answers[$question->id] ?? null;
            if ($selected_option_id) {
                $selected_option = $question->options->find($selected_option_id);
                if ($selected_option && $selected_option->is_correct) {
                    $correct_answers++;
                }
            }
        }

        // Сохраняем результат
        Result::create([
            'user_id' => $student->id,
            'test_id' => $test->id,
            'correct_answers' => $correct_answers,
            'total_questions' => $total_questions,
        ]);

        return redirect()->route('student.tests.index')->with(
            'success',
            "Тест успешно пройден. Ваш результат: {$correct_answers} из {$total_questions}"
        );
    }
}

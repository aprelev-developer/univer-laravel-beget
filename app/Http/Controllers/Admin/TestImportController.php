<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class TestImportController extends Controller
{
    /**
     * Отобразить форму для импорта вопросов.
     */
    public function showImportForm(Test $test)
    {
        return view('admin.tests.import', compact('test'));
    }

  /**
     * Обработать импорт вопросов из файла.
     */
    public function import(Request $request, Test $test)
    {
        // Валидация загружаемого файла
        $validator = Validator::make($request->all(), [
            'questions_file' => 'required|file|mimes:json',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Получение содержимого файла
            $file = $request->file('questions_file');
            $content = file_get_contents($file->getRealPath());

            // Декодирование JSON
            $questionsData = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Ошибка декодирования JSON: ' . json_last_error_msg());
            }

            // Проверка, что данные являются массивом
            if (!is_array($questionsData)) {
                throw new \Exception('Данные в файле должны быть массивом вопросов.');
            }

            // Итерация по вопросам и создание записей
            foreach ($questionsData as $index => $questionData) {
                // Валидация структуры каждого вопроса
                $questionValidator = Validator::make($questionData, [
                    'question' => 'required|string',
                    'type' => 'required|in:MULTIPLE_CHOICE,SINGLE_CHOICE',
                    'options' => 'required|array|min:2',
                    'options.*' => 'required|string',
                    'correctAnswer' => 'required|string',
                ]);

                if ($questionValidator->fails()) {
                    throw new \Exception("Некорректная структура вопроса на позиции {$index}.");
                }

                // Проверка, что correctAnswer существует в options
                if (!in_array($questionData['correctAnswer'], $questionData['options'])) {
                    throw new \Exception("Правильный ответ не найден среди вариантов ответа для вопроса на позиции {$index}.");
                }

                // Создание вопроса с маппингом 'question' из JSON в 'content' в базе данных
                $question = $test->questions()->create([
                    'content' => $questionData['question'], // Маппинг JSON 'question' в DB 'content'
                    'type' => $questionData['type'],
                    // 'question' => 'Дополнительные субпункты или детали, если необходимо' // Если используется
                ]);

                // Создание вариантов ответа
                foreach ($questionData['options'] as $optionText) {
                    $question->options()->create([
                        'option_text' => $optionText,
                        'is_correct' => $optionText === $questionData['correctAnswer'],
                    ]);
                }
            }

            return redirect()->route('admin.tests.show', $test->id)->with('success', 'Вопросы успешно импортированы.');
        } catch (\Exception $e) {
            Log::error('Ошибка импорта вопросов: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

}

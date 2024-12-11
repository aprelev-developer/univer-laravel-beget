<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::with('student', 'test')->latest()->paginate(20);
        return view('admin.results.index', compact('results'));
    }

    public function show(Result $result)
    {
        $result->load('student', 'test', 'student.answers.option.question');
        return view('admin.results.show', compact('result'));
    }
}

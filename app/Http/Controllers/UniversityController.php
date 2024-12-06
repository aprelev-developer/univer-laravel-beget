<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        return view('university.dashboard');
    }

    public function form()
    {
        $form = auth()->user()->form;

        return view('university.form', compact('form'));
    }

    public function storeForm(Request $request)
    {
        $request->validate([
            'data' => 'required',
        ]);

        Form::updateOrCreate(
            ['university_id' => auth()->id()],
            ['data' => $request->data]
        );

        return redirect()->route('university.dashboard')->with('success', 'Форма сохранена.');
    }
}

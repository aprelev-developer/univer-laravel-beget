<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpertsExport implements FromCollection
{
    public function collection()
    {
        return User::where('role', 'expert')->get(['id', 'name', 'email']);
    }
}

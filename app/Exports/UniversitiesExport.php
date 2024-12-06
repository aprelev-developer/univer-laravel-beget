<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UniversitiesExport implements FromCollection
{
    public function collection()
    {
        return User::where('role', 'university')->get(['id', 'name', 'email']);
    }
}


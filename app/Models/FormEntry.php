<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormEntry extends Model
{
    use HasFactory;

    protected $fillable = ['university_id', 'data', 'score'];

    protected $casts = [
        'data' => 'array', // Автоматическое преобразование JSON в массив
    ];


    public function university()
    {
        return $this->belongsTo(User::class, 'university_id');
    }
}

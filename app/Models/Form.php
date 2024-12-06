<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['university_id', 'data'];

    public function university()
    {
        return $this->belongsTo(User::class, 'university_id');
    }
}

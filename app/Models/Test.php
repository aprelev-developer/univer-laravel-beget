<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Result;


class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'university_id',
        'group_id',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['test_id', 'content', 'order'];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    // Автоматическое удаление связанных записей
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($question) {
            $question->options()->delete();
        });
    }
}

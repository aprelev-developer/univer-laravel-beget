<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    /**
     * Связь с экспертами (многие ко многим).
     */
    public function experts()
    {
        return $this->belongsToMany(User::class, 'expert_university', 'university_id', 'expert_id');
    }

    /**
     * Связь с формой.
     */
    public function formEntry()
    {
        return $this->hasOne(FormEntry::class);
    }
}

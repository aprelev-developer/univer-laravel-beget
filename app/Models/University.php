<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    // Другие свойства и методы

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

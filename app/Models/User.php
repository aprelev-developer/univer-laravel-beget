<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'university_id',
        'group_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function universities()
    {
        return $this->belongsToMany(User::class, 'expert_university', 'expert_id', 'university_id');
    }

    public function experts()
    {
        return $this->belongsToMany(User::class, 'expert_university', 'university_id', 'expert_id');
    }

    public function form()
    {
        return $this->hasOne(Form::class, 'university_id');
    }

    public function formEntry()
    {
        return $this->hasOne(FormEntry::class, 'university_id');
    }

      // Отношение к университету
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    // Отношение к группе
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function results()
    {
        return $this->hasMany(Result::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}

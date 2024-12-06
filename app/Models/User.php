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

}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'favorite',
        'country_id',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'role' => 'boolean'
        'favorite' => 'array'
    ];

    public function scopeIsOver($query, $age)
    {
        return $query->where('age', '>', $age);
    }
    // public function getRoleNameAttribute()
    // {
    //     return $this->role == 2 ? 'admin' : 'member';
    // }

    // public function setRoleAttribute($value)
    // {
    //      $this->attributes['role'] = $value == 'admin' ? 3 : 4;
    // }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}

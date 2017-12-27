<?php

namespace App;

use App\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    const VERIFIED_USER ='1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER ='false';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ="users";
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'verified',
        'verification_token',
        'admin'
    ];


    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtoupper($name);
    }

    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }
    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token'
    ];

    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }

    public function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationCode(){
        return str_random(40);
    }
}


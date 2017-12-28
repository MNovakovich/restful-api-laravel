<?php

namespace App;

use App\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//class for table deleted_at , ($table->softDeletes - in migration file);
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    
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
        'admin',
        'deleted_at'
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
        //return static::where('verified',User::VERIFIED_USER);
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


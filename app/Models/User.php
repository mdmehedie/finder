<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Datetime;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function isAdmin()
    {
        return $this->role == 'admin' ? 1 : 0;
    }
    public function isActive()
    {
        if($this->role == 'admin' || $this->role == 'superadmin'){
            return true;
        }

        $now = new DateTime('now', new DateTimezone('Asia/Dhaka'));
//        $today = date('d-m-y', strtotime($now));
//        dd(now(), $this->activationDate);
        if($this && $this->activationDate < now()){
            $this->isActive = 0;
            $this->save();
        }
        return $this->isActive == 1;
    }
}

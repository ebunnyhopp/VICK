<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
    ];
    
        public function getrole(){
        switch($this->role){
            case 1:
                return "<span class='badge bg-primary'>User</span>";
                break;
            case 3:
                return "<span class='badge bg-success'>Admin/Staff</span>";
                break;
            default:
                return 'error';
              
        }
    }
    
    public function getstatus(){
        return isset($this->email_verified_at) ?  "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-warning'>Inactive</span>";
    }
    
    public function r_details(){
        return $this->hasOne(UserDetail::class,'user_id');
    }
}

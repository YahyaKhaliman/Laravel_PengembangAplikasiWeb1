<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='user';
    protected $primaryKey='user_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'password',
        'hak_akses'
    ];
}

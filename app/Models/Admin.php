<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//extends from user
class Admin extends User
{
    use HasFactory;
    use HasApiTokens;//for api
    use Notifiable;//its important


}

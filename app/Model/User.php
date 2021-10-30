<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
      
    public $timestamps=false;
    use Notifiable,HasApiTokens;

    protected $rememberTokenName=false;
    protected $fillable = [
        'name', 'email', 'password',
    ];

    
   

      
}

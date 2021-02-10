<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primarykey = 'id';
    protected $fillable = ['name', 'email', 'create_at'];
}

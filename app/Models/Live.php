<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Live extends Model
{
    use SoftDeletes;
    protected $fillable = ['message', 'link', 'user_id', 'user_name', 'user_phone', 'user_email', 'user_address', 'user_passport_id'];
}

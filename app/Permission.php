<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
//    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'permission',
    ];
}

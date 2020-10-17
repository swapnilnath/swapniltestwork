<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
//    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id','post_id'
    ];
}

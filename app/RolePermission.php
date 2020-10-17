<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
//    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'role_id','permission_id'
    ];

    public function permission()
    {

        return $this->hasMany(Permission::class, 'id', 'permission_id');
    }
}

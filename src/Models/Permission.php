<?php

namespace Edwin\Edwinpermisos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function roles(){
        return $this->belongsToMany('Edwin\Edwinpermisos\Models\Role')->withTimestamps();
    }
}

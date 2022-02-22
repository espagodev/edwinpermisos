<?php

namespace Edwin\Edwinpermisos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'full-access',
    ];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function permissions(){
        return $this->belongsToMany('Edwin\Edwinpermisos\Models\Permission')->withTimestamps();
    }
}

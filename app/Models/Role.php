<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Permission;



class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug'
    ];


    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }


    public function givePermissionTo(Permission $permission) {
        return $this->permissions()->save($permission);
    }

}

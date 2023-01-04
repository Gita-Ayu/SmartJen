<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SchoolAdminModel extends Authenticatable
{
    use HasFactory;
    protected $table      = 'school_admin';
    protected $primaryKey = 'school_admin_id';
    protected $fillable   =
        [
            'school_admin_id',
            'school_name',
            'email','password'
        ];
}

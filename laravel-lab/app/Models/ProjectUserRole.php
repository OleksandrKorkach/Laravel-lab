<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUserRole extends Model
{
    use HasFactory;

    protected $table = 'project_user_roles';

    protected $fillable = [
        'name',
        'type',
    ];
}

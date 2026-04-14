<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blasting extends Model
{
    protected $fillable = [
        'name',
        'agent_id',
        'department_id',
        'broadcast_id',
        'phone',
        'language',
        'broadcast_time',
        'status_response',
        'template_name'
    ];
}

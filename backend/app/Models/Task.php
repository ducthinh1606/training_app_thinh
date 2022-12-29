<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'estimate',
        'task_status_id',
        'user_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}

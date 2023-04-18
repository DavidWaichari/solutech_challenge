<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'deleted_at'
    ];

    public function usertasks()
    {
        return $this->hasMany(UserTask::class, 'status_id');
    }
    
    public function tasks()
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}

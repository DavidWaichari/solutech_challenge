<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'status_id',
        'deleted_at'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}

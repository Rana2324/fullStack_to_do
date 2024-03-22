<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "is_active",
        "deadline",
        "todo_type_id",
        "user_id"
    ];

    public function todoType()
    {
        return $this->belongsTo(TodoType::class);
    }
}

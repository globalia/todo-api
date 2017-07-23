<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';

    protected $attributes = [
        'checked' => false,
    ];

    protected $fillable = [
        'name', 'description', 'tags', 'content', 'list_id',
    ];

    public function todoList() {
        return $this->belongsTo(TodoList::class, 'list_id');
    }
}

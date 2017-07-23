<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $table = 'todolists';

    protected $attributes = [
        'active' => true,
    ];

    protected $fillable = [
        'active', 'name', 'description', 'tags',
    ];

    public function items()
    {
        return $this->hasMany(Todo::class, 'list_id');
    }
}

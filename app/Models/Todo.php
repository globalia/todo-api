<?php

namespace App\Models;

use Globalia\LaravelScoutMysql\Models\Concerns\HasSearchIndex;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasSearchIndex;

    protected $table = 'todos';

    protected $attributes = [
        'checked' => false,
    ];

    protected $fillable = [
        'name', 'tags', 'content', 'list_id',
    ];

    protected $casts = [
        'checked' => 'boolean',
    ];

    protected $searchIndexSchema = [
        'name' => ['string', 'boostable' => true],
        'tags' => ['text', 'boostable' => true],
        'content' => 'text',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'list_id' => $this->getAttribute('list_id'),
            'checked' => $this->checked,
            'name' => $this->name,
            'tags' => $this->tags,
            'content' => $this->content,
        ];
    }

    public function todoList() {
        return $this->belongsTo(TodoList::class, 'list_id');
    }
}

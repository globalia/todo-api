<?php

namespace App\Models;

use Globalia\LaravelScoutMysql\Models\Concerns\HasSearchIndex;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasSearchIndex;

    protected $table = 'todolists';

    protected $attributes = [
        'active' => true,
    ];

    protected $fillable = [
        'active', 'name', 'description', 'tags',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $searchIndexSchema = [
        'name' => ['string', 'boostable' => true],
        'description' => ['text', 'boostable' => true],
        'tags' => ['text', 'boostable' => true],
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'active' => $this->active,
            'name' => $this->name,
            'description' => $this->description,
            'tags' => $this->tags,
        ];
    }

    public function items()
    {
        return $this->hasMany(Todo::class, 'list_id');
    }
}

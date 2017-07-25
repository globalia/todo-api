<?php

use App\Models\TodoList;
use Illuminate\Database\Seeder;

class TodoListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TodoList::disableSearchSyncing();

        TodoList::create([
            'id' => 1,
            'name' => 'Grocery list',
            'tags' => 'home,shopping',
        ]);

        TodoList::create([
            'id' => 2,
            'name' => 'Invitation for Ryan\'s Birthday',
            'description' => implode(' ', [
                'Send invitations for Ryan\'s birthday party,',
                'which will be held at the reception room of',
                'the Continental School.',
            ]),
            'tags' => 'event',
        ]);

        TodoList::create([
            'id' => 3,
            'name' => 'Back to school equipment',
            'tags' => 'kids,school,shopping',
        ]);
    }
}

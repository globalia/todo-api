<?php

use App\Models\Todo;
use App\Models\TodoList;
use Illuminate\Database\Seeder;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groceryList = TodoList::query()->find(1);

        Todo::create([
            'name' => 'Milk',
            'tags' => 'refrigerated,beverage',
            'list_id' => $groceryList->id,
        ]);

        Todo::create([
            'name' => 'Carrots',
            'tags' => 'Vegetable',
            'list_id' => $groceryList->id,
        ]);

        Todo::create([
            'name' => 'Apples',
            'tags' => 'fruit',
            'content' => 'Take Granny Smith and Cortland for make a pie.',
            'list_id' => $groceryList->id,
        ]);

        $invitationList = TodoList::query()->find(2);

        Todo::create([
            'name' => 'Richard Gere',
            'list_id' => $invitationList->id,
        ]);

        Todo::create([
            'name' => 'Lior Ashkenazi',
            'list_id' => $invitationList->id,
        ]);

        Todo::create([
            'name' => 'Michael Sheen',
            'list_id' => $invitationList->id,
        ]);

        Todo::create([
            'name' => 'Steve Buscemi',
            'list_id' => $invitationList->id,
        ]);

        Todo::create([
            'name' => 'Yehuda Almagor',
            'list_id' => $invitationList->id,
        ]);

        Todo::create([
            'name' => 'Neta Riskin',
            'list_id' => $invitationList->id,
        ]);
    }
}

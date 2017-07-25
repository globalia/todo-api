<?php

namespace App\Http\Controllers\Api;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoListController extends Controller
{
    const DEFAULT_LIMIT = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (null === $searchTerm = $request->query->get('s')) {
            $result = TodoList::query();
        } else {
            $result = TodoList::search($request->query->get('s'))
                ->where('boost(name)', 5)
                ->where('boost(tags)', 2);
        }

        if (null !== $active = $request->query->get('active')) {
            $result->where('active', $active);
        }

        if (! ($limit = $request->query->get('limit', self::DEFAULT_LIMIT))) {
            return $result->get();
        }

        return $result->paginate($limit)
            ->appends(array_merge($request->query->all(), ['limit' => $limit]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todoList = TodoList::create($request->request->all());

        return response($todoList, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $todoList)
    {
        return $todoList;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoList $todoList)
    {
        if ($request->getMethod() === 'PATCH') {
            $todoList->fill($request->request->all());
        } else {
            foreach (array_keys($todoList->getAttributes()) as $attribute) {
                $todoList->fill([$attribute => $request->request->get($attribute)]);
            }
        }

        $todoList->save();

        return $todoList;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoList $todoList)
    {
        $todoList->delete();

        return response(null, 204);
    }
}

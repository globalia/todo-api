<?php

namespace App\Http\Controllers\Api;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TodoList::query();

        if (null !== $limit = $request->query->get('limit')) {
            $query->limit($limit);

            if (null !== $offset = $request->query->get('offset')) {
                $query->offset($offset);
            }
        }

        return $query->get();
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

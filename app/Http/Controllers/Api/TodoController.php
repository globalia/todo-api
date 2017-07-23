<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Todo::query();

        if (null !== $checked = $request->query->get('checked')) {
            $query->where('checked', $checked);
        }

        if (null !== $listId = $request->query->get('list')) {
            $query->where('list_id', $listId);
        }

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
        $todo = Todo::create($request->request->all());

        return response($todo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return $todo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        if ($request->getMethod() === 'PATCH') {
            $todo->fill($request->request->all());
        } else {
            foreach (array_keys($todo->getAttributes()) as $attribute) {
                $todo->fill([$attribute => $request->request->get($attribute)]);
            }
        }

        $todo->save();

        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response(null, 204);
    }
}

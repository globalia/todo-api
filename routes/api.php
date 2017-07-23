<?php

Route::group(['middleware' => ['api']], function () {
    Route::resource('todolists', 'Api\TodoListController', [
        'parameters' => ['todolists' => 'todoList'],
        'except' => ['create', 'edit'],
    ]);

    Route::resource('todos', 'Api\TodoController', [
        'parameters' => ['todos' => 'todo'],
        'except' => ['create', 'edit'],
    ]);
});

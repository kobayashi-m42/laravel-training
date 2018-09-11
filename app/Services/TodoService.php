<?php
/**
 * TodoService
 */

namespace App\Services;

use App\Todo;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TodoService
 * @package App\Services
 */

class TodoService
{
    /**
     * 全てのTodoを取得する

     * @return Collection
     */
    public function fetchTodos(): Collection
    {
        return Todo::all();
    }

    /**
     * Todoを登録する
     *
     * @param array $params
     */
    public function saveTodo(array $params)
    {
        $todo = new Todo();
        $todo->title = $params['title'];
        $todo->state = $params['state'];
        $todo->save();
    }

    /**
     * Todoを取得する
     *
     * @param array $params
     * @return Todo
     */
    public function findTodo(array $params): Todo
    {
        return Todo::find($params['id']);
    }

    /**
     * Todoを更新する
     *
     * @param array $params
     */
    public function updateTodo(array $params)
    {
        $todo = Todo::find($params['id']);
        $todo->title = $params['title'];
        $todo->state = $params['state'];
        $todo->save();
    }

    /**
     * Todoを削除する
     * @param array $params
     */
    public function destroyTodo(array $params)
    {
        $todo = Todo::find($params['id']);
        $todo->delete();
    }
}

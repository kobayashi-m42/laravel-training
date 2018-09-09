<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Todo;

class TodosController extends Controller
{
    /**
     * Todoの一覧を取得する
     *
     * @return JsonResponse
     */
    function index(): JsonResponse
    {
        $todos = Todo::all();
        return response()->json([$todos]);
    }

    /**
     * Todoを登録する
     *
     * @param Request $request
     * @return JsonResponse
     */
    function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'state' => ['required', 'regex:/0|1/'],
        ]);

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->state = $request->state;
        $todo->save();
        return response()->json();
    }

    /**
     * Todoを取得する
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    function show(Request $request, string $id): JsonResponse
    {
        $todo = Todo::find($id);
        return response()->json($todo);
    }

    /**
     * Todoを更新する
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    function update(Request $request, string $id): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'state' => ['required', 'regex:/0|1/'],
        ]);

        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->state = $request->state;
        $todo->save();
        return response()->json();
    }

    /**
     * Todoを削除する
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    function destroy(Request $request, string $id): JsonResponse
    {
        $todo = ToDo::find($id);
        $todo->delete();
        return response()->json();
    }
}

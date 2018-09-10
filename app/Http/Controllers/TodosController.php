<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\TodoService;
use App\Http\Requests\TodoRequest;


class TodosController extends Controller
{

    /**
     * @var todoService
     */
    protected $todoService;

    /**
     * TodosController constructor.
     * @param TodoService $todoService
     */
    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * Todoの一覧を取得する
     *
     * @return JsonResponse
     */
    function index(): JsonResponse
    {
        $todos = $this->todoService->fetchTodos();
        return response()->json([$todos]);
    }

    /**
     * Todoを登録する
     *
     * @param TodoRequest $request
     * @return JsonResponse
     */
    function store(TodoRequest $request): JsonResponse
    {
        $params = [
            'title' => $request->title,
            'state' => $request->state
        ];
        $this->todoService->saveTodo($params);
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
        $params = ['id' => $id];
        $todo = $this->todoService->findTodo($params);
        return response()->json($todo);
    }

    /**
     * Todoを更新する
     *
     * @param TodoRequest $request
     * @param string $id
     * @return JsonResponse
     */
    function update(TodoRequest $request, string $id): JsonResponse
    {
        $params = [
            'id' => $id,
            'title' => $request->title,
            'state' => $request->state

        ];
        $this->todoService->updateTodo($params);
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
        $params = ['id' => $id];
        $this->todoService->destroyTodo($params);
        return response()->json();
    }
}

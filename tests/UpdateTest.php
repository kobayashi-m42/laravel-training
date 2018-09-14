<?php
/**
 * updateTest
 */

namespace Tests;

use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class updateTest
 * @package Tests
 */
class updateTest extends AbstractTestCase
{
    use RefreshDatabase;

    /**
     * 正常系のテスト
     * Todoの更新ができること
     */
    public function testSuccessUpdate()
    {
        $todo = factory(Todo::class)->create();

        $jsonResponse = $this->put(
            '/api/todos/' . $todo->id,
            [
                'title' => 'todo update',
                'state' => 1
            ]
        );
        $responseArray = json_decode($jsonResponse->content(), true);

        // 実際にJSONResponseに期待したデータが含まれているか確認する
        $this->assertSame([], $responseArray);
        $jsonResponse->assertStatus(200);

        // DBのテーブルに期待した形でデータが入っているか確認する
        $this->assertDatabaseHas('todos', [
            'id'    => 1,
            'title' => 'todo update',
            'state' => 1,
        ]);
    }
}

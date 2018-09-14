<?php
/**
 * DestroyTest
 */

namespace Tests;

use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class DestroyTest
 * @package Tests
 */
class DestroyTest extends AbstractTestCase
{
    use RefreshDatabase;

    /**
     * 正常系のテスト
     * Todoの削除ができること
     */
    public function testSuccessDestroy()
    {
        $todo = factory(Todo::class, 2)->create();

        $jsonResponse = $this->delete('/api/todos/1');
        $responseArray = json_decode($jsonResponse->content(), true);

        // 実際にJSONResponseに期待したデータが含まれているか確認する
        $this->assertSame([], $responseArray);
        $jsonResponse->assertStatus(200);

        // DBのテーブルに期待した形でデータが入っているか確認する
        $this->assertDatabaseMissing('todos', [
            'id'    => 1,
            'title' => 'todo',
            'state' => 0,
        ]);

        $this->assertDatabaseHas('todos', [
            'id'    => 2,
            'title' => 'todo',
            'state' => 0,
        ]);
    }
}

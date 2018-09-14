<?php
/**
 * StoreTest
 */

namespace Tests;

use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class StoreTest
 * @package Tests
 */
class StoreTest extends AbstractTestCase
{
    use RefreshDatabase;

    /**
     * 正常系のテスト
     * Todoの作成ができること
     */
    public function testSuccessStore()
    {
        $todo = factory(Todo::class)->create();

        $jsonResponse = $this->post(
            '/api/todos',
            [
                'title' => 'todo store',
                'state' => 1
            ]
        );
        $responseArray = json_decode($jsonResponse->content(), true);

        // 実際にJSONResponseに期待したデータが含まれているか確認する
        $this->assertSame([], $responseArray);
        $jsonResponse->assertStatus(200);

        // DBのテーブルに期待した形でデータが入っているか確認する
        $this->assertDatabaseHas('todos', [
            'id'    => 2,
            'title' => 'todo store',
            'state' => 1,
        ]);
    }
}

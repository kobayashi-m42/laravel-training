<?php
/**
 * IndexTest
 */

namespace Tests;

use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class IndexTest
 * @package Tests
 */
class IndexTest extends AbstractTestCase
{
    use RefreshDatabase;

    /**
     * 正常系のテスト
     * Todoが取得できること
     */
    public function testSuccessIndex()
    {
        $todo = factory(Todo::class, 2)->create();

        $jsonResponse = $this->get('/api/todos');

        $expectResponse['id'] = 1;
        $expectResponse['title'] = 'todo';
        $expectResponse['state'] = 0;

        $expectResponse = [[
            [
                'id'    => 1,
                'title' => 'todo',
                'state' => 0
            ],
            [
                'id'    => 2,
                'title' => 'todo',
                'state' => 0
            ]
        ]];

        $responseArray = json_decode($jsonResponse->content(), true);

        $nowDate = new \DateTime();

        $createdAt = new \DateTime($responseArray[0][0]['created_at']);
        $updatedAt = new \DateTime($responseArray[0][0]['updated_at']);
        $this->assertSame($nowDate->format('Y-m-d'), $createdAt->format('Y-m-d'));
        $this->assertSame($nowDate->format('Y-m-d'), $updatedAt->format('Y-m-d'));

        $createdAt = new \DateTime($responseArray[0][1]['created_at']);
        $updatedAt = new \DateTime($responseArray[0][1]['updated_at']);
        $this->assertSame($nowDate->format('Y-m-d'), $createdAt->format('Y-m-d'));
        $this->assertSame($nowDate->format('Y-m-d'), $updatedAt->format('Y-m-d'));

        // 以下については日付の一致のみ確認
        unset($responseArray[0][0]['created_at']);
        unset($responseArray[0][0]['updated_at']);
        unset($responseArray[0][1]['created_at']);
        unset($responseArray[0][1]['updated_at']);

        // 実際にJSONResponseに期待したデータが含まれているか確認する
        $this->assertSame($expectResponse, $responseArray);
        $jsonResponse->assertStatus(200);
    }
}

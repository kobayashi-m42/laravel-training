<?php
/**
 * ShowTest
 */

namespace Tests;

use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ShowTest
 * @package Tests
 */
class ShowTest extends AbstractTestCase
{
    use RefreshDatabase;

    /**
     * 正常系のテスト
     * Todoが取得できること
     */
    public function testSuccessShow()
    {
        $todo = factory(Todo::class)->create();

        $jsonResponse = $this->get('/api/todos/' . $todo->id);

        $responseArray = json_decode($jsonResponse->content(), true);

        $createdAt = new \DateTime($responseArray['created_at']);
        $updatedAt = new \DateTime($responseArray['updated_at']);
        $nowDate = new \DateTime();

        $this->assertSame($nowDate->format('Y-m-d'), $createdAt->format('Y-m-d'));
        $this->assertSame($nowDate->format('Y-m-d'), $updatedAt->format('Y-m-d'));

        // 以下については日付の一致のみ確認
        unset($responseArray['created_at']);
        unset($responseArray['updated_at']);

        // 実際にJSONResponseに期待したデータが含まれているか確認する
        $expectResponse['id'] = 1;
        $expectResponse['title'] = 'todo';
        $expectResponse['state'] = 0;

        $this->assertSame($expectResponse, $responseArray);
        $jsonResponse->assertStatus(200);
    }
}

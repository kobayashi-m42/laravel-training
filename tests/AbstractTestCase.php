<?php
/**
 * AbstractTestCase
 */

namespace Tests;

/**
 * Class AbstractTestCase
 * @package Tests\Unit
 */
abstract class AbstractTestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use CreatesApplication;

    public function tearDown()
    {
        \DB::table('todos')->truncate();

        $this->beforeApplicationDestroyed(function () {
            \DB::disconnect();
        });

        parent::tearDown();
    }
}

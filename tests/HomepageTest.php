<?php

class HomepageTest extends TestCase {

    /**
     * A basic functional test of the homepage.
     *
     * @return void
     */
    public function testHomepageGetResponse()
    {
        $response = $this->call('GET', '/');

        $this->assertTrue($response->isOk());
    }

}

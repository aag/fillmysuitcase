<?php

class HomepageTest extends TestCase {

    /**
     * A basic functional test of the homepage.
     *
     * @return void
     */
    public function testHomepageGetResponse()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

}

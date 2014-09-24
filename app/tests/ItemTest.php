<?php

class ItemTest extends TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->validAttribs = array(
            'name'   => 'Socks',
            'packed' => false,
        );
        $this->validItem = new Item($this->validAttribs);
    }

    public function tearDown()
    {
    }

	public function testValidItemCreation()
	{
		$this->assertEquals($this->validAttribs['name'], $this->validItem->name);
		$this->assertEquals($this->validAttribs['packed'], $this->validItem->packed);
	}

    public function testValidItemValidation()
    {
        $this->assertTrue($this->validItem->validate());
    }

    public function testEmptyNameIsInvalid()
    {
        $attrs = $this->validAttribs;
        unset($attrs['name']);

        $item = new Item($attrs);
        $this->assertFalse($item->validate());
    }

    public function testLongNameIsInvalid()
    {
        // First try with the maximum valid length
        $longName = '12345678901234567890123456789012345678901234567890' .
                    '12345678901234567890123456789012345678901234567890';

        $attrs = $this->validAttribs;
        $attrs['name'] = $longName;

        $item = new Item($attrs);
        $this->assertTrue($item->validate());

        // Then try with a name that it just too long
        $tooLongName = $longName . '!';
        $attrs['name'] = $tooLongName;

        $item = new Item($attrs);
        $this->assertFalse($item->validate());
    }

}

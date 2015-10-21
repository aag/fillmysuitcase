<?php

class ItemTest extends TestCase {

    public function testValidItemCreation()
    {
        $validAttribs = array(
            'name'   => 'Socks',
            'packed' => false,
        );
        $validItem = new Item($validAttribs);

        $this->assertEquals('Socks', $validItem->name);
    }

    public function testValidItemValidation()
    {
        $validAttribs = array(
            'name'   => 'Socks',
            'packed' => false,
        );
        $validItem = new Item($validAttribs);

        $this->assertTrue($validItem->validate());
    }

    public function testEmptyNameIsInvalid()
    {
        $item = new Item([
            'packed' => false
        ]);

        $this->assertFalse($item->validate());
    }

    public function testUnsetPackedIsDefaultFalse()
    {
        $item = new Item([
            'name' => 'Shoes'
        ]);

        $this->assertFalse($item->packed);
    }

    public function testLongNameIsValid()
    {
        // Try with the maximum valid length
        $longName = '12345678901234567890123456789012345678901234567890' .
                    '12345678901234567890123456789012345678901234567890';

        $item = new Item([
            'name' => $longName,
        ]);
        $this->assertTrue($item->validate());
    }

    public function testLongNameIsInvalid()
    {
        // Try with a name that it just too long
        $longName = '12345678901234567890123456789012345678901234567890' .
                    '12345678901234567890123456789012345678901234567890';

        $tooLongName = $longName . '!';
        $item = new Item([
            'name' => $tooLongName,
        ]);

        $this->assertFalse($item->validate());
    }

}

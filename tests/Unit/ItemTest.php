<?php

namespace Tests\Unit;

use App\Models\Item;

class ItemTest extends \Tests\TestCase {

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

        $this->assertTrue($validItem->isValid($validAttribs));
    }

    public function testEmptyNameIsInvalid()
    {
        $attribs = [
            'packed' => false
        ];
        $item = new Item($attribs);

        $this->assertFalse($item->isValid($attribs));
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

        $attribs = [
            'name' => $longName,
        ];
        $item = new Item($attribs);
        $this->assertTrue($item->isValid($attribs));
    }

    public function testLongNameIsInvalid()
    {
        // Try with a name that it just too long
        $longName = '12345678901234567890123456789012345678901234567890' .
                    '12345678901234567890123456789012345678901234567890';

        $tooLongName = $longName . '!';
        $attribs = [
            'name' => $tooLongName,
        ];
        $item = new Item($attribs);

        $this->assertFalse($item->isValid($attribs));
    }

}

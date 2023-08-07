<?php

use Bi\Address\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    /** @test */
    public function testContent()
    {
        $address = new Address([
            'door_number' => 33,
            'building_floor' => 4,
            'building_number' => 45,
            'street' => 3,
            'state' => 'Butel',
            'region' => 'Skopje',
            'county' => 'Butel',
            'city' => 'Skopje',
            'zip' => 1000,
            'country' => 'North Macedonia',
            'is_primary' => 1,
            'is_invoice' => 0,
            'is_shipping' => 0,
            'is_private' => 0,
        ]);

        return $address;
    }

}

<?php

use Bi\Address\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    /**
     * Test creating a valid address
     */
    public function testCreateValidAddress()
    {
        $address = new Address([
            'street' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip' => '12345',
            'country' => 'USA'
        ]);

        $this->assertInstanceOf(Address::class, $address);
    }

    /**
     * Test address validation with valid data
     */
    public function testValidAddressValidation()
    {
        $address = new Address([
            'street' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip' => '12345',
            'country' => 'USA'
        ]);

        $this->assertTrue($address->isValid());
    }

    /**
     * Test address validation with missing required fields
     */
    public function testInvalidAddressMissingFields()
    {
        $address = new Address([
            'street' => '123 Main St',
            // Missing city
            'state' => 'CA',
            'zip' => '12345',
            'country' => 'USA'
        ]);

        $this->assertFalse($address->isValid());
    }

    /**
     * Test getting address components
     */
    public function testGetAddressComponents()
    {
        $addressData = [
            'street' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip' => '12345',
            'country' => 'USA'
        ];

        $address = new Address($addressData);

        $this->assertEquals($addressData['street'], $address->getStreet());
        $this->assertEquals($addressData['city'], $address->getCity());
        $this->assertEquals($addressData['state'], $address->getState());
        $this->assertEquals($addressData['zip'], $address->getZip());
        $this->assertEquals($addressData['country'], $address->getCountry());
    }

    /**
     * Test address formatting
     */
    public function testAddressFormatting()
    {
        $address = new Address([
            'street' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip' => '12345',
            'country' => 'USA'
        ]);

        $expected = "123 Main St\nAnytown, CA 12345\nUSA";
        $this->assertEquals($expected, $address->format());
    }

    /**
     * Test address with optional fields
     */
    public function testAddressWithOptionalFields()
    {
        $address = new Address([
            'street' => '123 Main St',
            'street2' => 'Apt 4B',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip' => '12345',
            'country' => 'USA'
        ]);

        $this->assertEquals('Apt 4B', $address->getStreet2());
        $expected = "123 Main St\nApt 4B\nAnytown, CA 12345\nUSA";
        $this->assertEquals($expected, $address->format());
    }

    /**
     * Test creating an empty address
     */
    public function testEmptyAddress()
    {
        $address = new Address([]);

        $this->assertFalse($address->isValid());
        $this->assertEquals('', $address->getStreet());
        $this->assertEquals('', $address->getCity());
    }

    /**
     * Test address with international format
     */
    public function testInternationalAddress()
    {
        $address = new Address([
            'street' => '10 Downing Street',
            'city' => 'London',
            'zip' => 'SW1A 2AA',
            'country' => 'United Kingdom'
        ]);

        $this->assertTrue($address->isValid());
        $expected = "10 Downing Street\nLondon, SW1A 2AA\nUnited Kingdom";
        $this->assertEquals($expected, $address->format());
    }

    /**
     * Test updating address components
     */
    public function testUpdateAddressComponents()
    {
        $address = new Address([
            'street' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip' => '12345',
            'country' => 'USA'
        ]);

        $address->setStreet('456 Oak Ave');
        $address->setCity('Othertown');

        $this->assertEquals('456 Oak Ave', $address->getStreet());
        $this->assertEquals('Othertown', $address->getCity());
    }

    /**
     * Test address equality comparison
     */
    public function testAddressEquality()
    {
        $address1 = new Address([
            'street' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip' => '12345',
            'country' => 'USA'
        ]);

        $address2 = new Address([
            'street' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip' => '12345',
            'country' => 'USA'
        ]);

        $address3 = new Address([
            'street' => '456 Oak Ave',
            'city' => 'Othertown',
            'state' => 'NY',
            'zip' => '67890',
            'country' => 'USA'
        ]);

        $this->assertTrue($address1->equals($address2));
        $this->assertFalse($address1->equals($address3));
    }
}
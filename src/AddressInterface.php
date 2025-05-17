<?php

namespace Bi\Address;


interface AddressInterface
{
    public static function getPrimaryAddress(): Address;

    public static function isFilled(array $attributes);
}

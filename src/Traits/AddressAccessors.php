<?php

namespace Bi\Address\Traits;

use Bi\Address\Address;

/**
 * @param Address $primaryAddress
 */
trait AddressAccessors
{
    /**
     * @return mixed
     */
    public function getPrimaryAddressAttribute(): Address
    {
        if (!$this->addresses->count()) {
            return new Address();
        }

        if ($primary = $this->addresses->where('primary', true)->first()) {
            return $primary;
        }

        return $this->addresses->first();
    }
}

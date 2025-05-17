<?php

namespace Bi\Address\Traits;

use Bi\Address\Address;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property Collection $addresses
 *
 * @property Address $primaryAddress
 * @property Address $billingAddress
 * @property Address $shippingAddress
 */
trait AddressAccessors
{
    public function getPrimaryAddressAttribute(): Address
    {
        if (!$this->addresses->count()) {
            return new Address();
        }

        return $this->addresses->where('is_primary', true)->first() ?? $this->addresses->first();
    }

    public function getBillingAddressAttribute(): ?Address
    {
        if (!$this->addresses->count()) {
            return null;
        }

        return $this->addresses->where('is_invoice', true)->first();
    }

    public function getShippingAddressAttribute(): ?Address
    {
        if (!$this->addresses->count()) {
            return null;
        }

        return $this->addresses->where('is_shipping', true)->first();
    }
}

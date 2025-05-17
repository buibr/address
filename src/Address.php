<?php

namespace Bi\Address;

use Exception;
use Illuminate\Database\Eloquent\Model;
use League\ISO3166\ISO3166;

class Address extends Model implements AddressInterface
{
    /** @var array */
    protected $fillable = [
        'door_number',
        'street',
        'state',
        'province',
        'region',
        'county',
        'city',
        'zip',
        'country',
        'building_floor',
        'building_number',
        'is_primary',
        'is_invoice',
        'is_shipping',
        'is_private',
        'cord_lat',
        'cord_lng',
    ];

    public static function isFilled(array $attributes)
    {
        $fillable = (new Address())->getFillable();

        foreach ($fillable as $attr) {
            if (isset($attributes[$attr]) && !empty($attributes[$attr])) {
                return TRUE;
            }
        }

        return FALSE;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Address $address) {

            if (empty($address->country) && config('addresses.default_country')) {
                $address->country = config('addresses.default_country');
            }
        });
    }

    public function getNameAttribute(): string
    {
        return $this->resolveAddressString();
    }

    public function getCountryNameAttribute(): mixed
    {
        try {
            $country = (new ISO3166())->alpha3($this->country);
            return $country['name'] ?? $this->country;
        } catch (Exception $e) {
        }

        return $this->country;
    }

    private function resolveAddressString(): string
    {
        $keys = $this->getConfigKeys();
        $keys = collect($keys)
            ->filter(fn ($key) => $this->{$key} !== null)
            ->map(fn ($key) =>  $this->{$key})
            ->toArray();
    }

    private function getConfigKeys(): ?string
    {
        $attribute = config('addresses.name_format');

        preg_match_all('/\[(.*?)\]/', $attribute, $keys);

        return $keys[1] ?? null;
    }
}

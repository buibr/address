<?php

namespace Bi\Address;

use League\ISO3166\ISO3166;

class Address extends \Illuminate\Database\Eloquent\Model
{
    /** @var array */
    protected $fillable = [
        'door_number',
        'building_floor',
        'building_number',
        'street',
        'state',
        'province',
        'region',
        'county',
        'city',
        'zip',
        'country',
        'is_primary',
        'is_invoice',
        'is_shipping',
        'is_private',
        'lat',
        'lng',
    ];

    /**
     * @param $attributes
     *
     * @return bool
     */
    public static function isFilled($attributes)
    {
        $fillable = (new Address())->getFillable();

        foreach ($fillable as $attr) {
            if (isset($attributes[$attr]) && !empty($attributes[$attr])) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Address $address) {

            if ( empty($address->country) && config('addresses.default_country')) {
                $address->country = config('addresses.default_country');
            }

        });
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->resolveAddressString();
    }

    /**
     * @return mixed
     */
    public function getCountryNameAttribute()
    {
        try {
            $country = (new ISO3166())->alpha3($this->country);
            return $country['name'] ?? $this->country;
        } catch (\Exception $e) {
        }

        return $this->country;
    }

    /**
     *
     */
    private function resolveAddressString()
    {
        $keys = $this->getConfigKeys();


    }

    /**
     * @return mixed|null
     */
    private function getConfigKeys()
    {
        $attribute = config('addresses.name_format');

        preg_match_all('/\[(.*?)\]/', $attribute, $keys);

        return $keys[1] ?? null;
    }
}

<?php

namespace Bi\Address;

use Exception;
use Illuminate\Database\Eloquent\Model;
use League\ISO3166\ISO3166;

/**
 * @property int $id
 * @property string $door_number
 * @property string $street
 * @property string $state
 * @property string $province
 * @property string $region
 * @property string $county
 * @property string $city
 * @property string $zip
 * @property string $country
 * @property string $building_floor
 * @property string $building_number
 * @property bool $is_primary
 * @property bool $is_invoice
 * @property bool $is_shipping
 * @property bool $is_private
 * @property string $cord_lat
 * @property string $cord_lng
 *
 * @property string $name;
 * @property string $country_name;
 */
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

    protected $casts = [
        'is_primary' => 'boolean',
        'is_invoice' => 'boolean',
        'is_shipping' => 'boolean',
        'is_private' => 'boolean',
    ];

    public static function isFilled(array $attributes)
    {
        $fillable = (new Address())->getFillable();

        foreach ($fillable as $attr) {
            if (isset($attributes[$attr]) && !empty($attributes[$attr])) {
                return true;
            }
        }

        return false;
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
        $format = config('addresses.name_format');

        // Define the mapping of placeholders to actual values
        $replacements = ['[door_number]' => $this->door_number ?? '',
            '[street]' => $this->street ?? '',
            '[line1]' => $this->line1 ?? '',
            '[line2]' => $this->line2 ?? '',
            '[city]' => $this->city ?? '',
            '[state]' => $this->state ?? '',
            '[zip]' => $this->zip ?? '',
            '[country_name]' => $this->country_name ?? '',
            '[country_code]' => $this->country_code ?? '',
            '[lat]' => $this->cord_lat ?? '',
            '[lng]' => $this->cord_lng ?? '',
        ];

        // Replace all placeholders with their corresponding values
        $formattedAddress = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $format
        );

        // Clean up multiple spaces and commas with empty values
        $formattedAddress = preg_replace('/\s+/', ' ', $formattedAddress);
        $formattedAddress = preg_replace('/,\s*,/', ',', $formattedAddress);
        $formattedAddress = preg_replace('/\s+,/', ',', $formattedAddress);
        $formattedAddress = preg_replace('/,\s*$/', '', $formattedAddress);

        return trim($formattedAddress);
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
}

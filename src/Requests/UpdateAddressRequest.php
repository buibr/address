<?php

namespace Bi\Address\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'door_number' => ['nullable', 'numeric'],
            'building_floor' => ['nullable', 'numeric'],
            'building_number' => ['nullable', 'numeric'],
            'street' => ['nullable', 'string'],
            'state' => ['nullable', 'string'],
            'province' => ['nullable', 'string'],
            'region' => ['nullable', 'string',],
            'county' => ['nullable', 'string',],
            'city' => ['nullable', 'string',],
            'zip' => ['nullable', 'string',],
            'country' => ['nullable', 'string',],
            'is_primary' => ['nullable', 'boolean',],
            'is_invoice' => ['nullable', 'boolean',],
            'is_shipping' => ['nullable', 'boolean',],
            'is_private' => ['nullable', 'boolean',],
            'cord_lat' => ['nullable', 'numeric',],
            'cord_lng' => ['nullable', 'numeric',],
        ];
    }
}

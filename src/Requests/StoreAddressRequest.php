<?php

namespace Bi\Address\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'door_number' => 'required|numeric',
            'building_floor' => 'nullable|numeric',
            'building_number' => 'nullable|numeric',
            'street' => 'required|string',
            'state' => 'nullable|string',
            'province' => 'nullable|string',
            'region' => 'nullable|string',
            'county' => 'nullable|string',
            'city' => 'required|string',
            'zip' => 'nullable|string',
            'country' => 'nullable|string',
            'is_primary' => 'boolean',
            'is_invoice' => 'boolean',
            'is_shipping' => 'boolean',
            'is_private' => 'boolean',
            'cord_lat' => 'nullable|numeric',
            'cord_lng' => 'nullable|numeric',
        ];
    }
}

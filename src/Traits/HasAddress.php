<?php


namespace Bi\Address\Traits;


use Bi\Address\Address;
use Bi\Address\AddressInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @param Collection $addresses
 */
trait HasAddress
{
    use AddressAccessors;

    public static function bootHasAddress()
    {
        static::deleting(function (Model $model) {

            if (in_array(SoftDeletes::class, class_uses_recursive($model))) {
                if (!$model->forceDeleting) {
                    return;
                }
            }

            $model->addresses()->cursor()->each(function (Address $model) {
                $model->delete();
            });
        });
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(config('addresses.model'), 'model');
    }

    public function hasAddress(): bool
    {
        return $this->addresses->count() ? true : false;
    }

    public function addAddress(array $attributes): AddressInterface
    {
        $this->validateAddressAttributes($attributes);
        return $this->addresses()->create($attributes);
    }

    protected function validateAddressAttributes(array $attributes)
    {
        $required = $this->requiredAddressAttributes();
        $diff = array_diff($required, array_keys($attributes));

        if (!$diff) {
            return true;
        }

        return array_fill_keys($diff, 'This attribute is required');
    }

    protected function requiredAddressAttributes()
    {
        return config('addresses.required');
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    /**
     * @param $attributes
     *
     * @return mixed
     */
    public function updatePrimaryAddress($attributes)
    {
        return $this->primaryAddress->update($attributes);
    }

    /**
     * @return bool
     */
    public function clearAddress()
    {
        return $this->addresses->each(function (Address $model) {
            return $model->forceDelete();
        });
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function isAddressFilled($key)
    {
        return Address::isFilled(request()->input($key));
    }
}

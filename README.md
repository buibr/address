# buibr/address
Laravel package for managing addresses on model, morph class for a class, ex. User'

## Installation
You can install the package via composer:
```bash
composer require buibr/address
```

## Usage

### Solely for Laravel
```php
$address = new Buibr\Address\Address();
echo $address->id;
```

### Eloquent model relationship
```php
class User {
  use HasAddress;
}

$user = User::first($id);

$user->adresses; // Collection[Address]

$user->addresses() // HasMany
$user->hasAddress() // boolean
$user->addAddress([...]) // AddressInterface

$user->primaryAddress // Address.is_primary = tru or first address
$user->shippingAddress // Address or null
$user->billingAddress // Address or null
```

### Formating
```php
// full formated address from config/addresses.php ['name_format'] 
$user->primaryaddress->name
```




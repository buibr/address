# buibr/address
Laravel package for managing addresses on model, morph class for a class, ex. User'

### Usage
```php
class User {
  use HasAddress;
}

$user = User::first($id);

$user->adresses; // Collection[Address]
$user->addresses() // HasMany

$user->hasAddress() // boolean

$user->addAddress([...]) // AddressInterface

$user->getAddresses(); // Collection[Address]

$user->primaryAddress // Address or null

```

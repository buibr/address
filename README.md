# buibr/address
Laravel package for managing addresses on model, morph class for a class, ex. User'

### Usage
```php
class User {
  use HasAddress;
}

$user = User::first($id);

$user->address() // collection

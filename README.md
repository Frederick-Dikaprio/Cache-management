# Cache Management

This package lets you manage the cache with Laravel. You can choose to use Redis or the file system as your cache manager. On top of that, it contains an integrated CRUD system where the cache handles everything. All you have to do is pass the model, and you're done.

To do this, in your service class, which could be :

## Classe UserService

```php
class UserService extends BaseService
{
    // Vos méthodes ici
}
```php
for example: 
1) to add data to the database, you'll use
```php
     $result = $this->insert($modelData);
```php
2) for update it will be :
```php
     $result = $this->update($modelData);
```php
3) for delete it will be a void :
```php
     $this->delete($modelData);
```php
4) for search, there are several types :
```php
     $this->findModelBy($key, $value);
     $this->findModelById($id);
     $this->findUserByUuid($user_uuid);
```php
and all return data
 

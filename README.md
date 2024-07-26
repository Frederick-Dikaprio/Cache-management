# Happynessarl Cache Management

This package lets you manage the cache with Laravel. You can choose to use Redis or the file system as your cache manager. On top of that, it contains an integrated CRUD system where the cache handles everything. All you have to do is pass the model, and you're done.

To do this, in your service class, which could be :

## First, import this ``BaseModel`` trait into all your Laravel models in order to manage all caches, as they are managed by models.
   
## Classe UserService

```php
use Happynessarl\Caching\Management\Services\BaseService;

class UserService extends BaseService
{
    // your methods her
}
```
For example:

## 1) to add data to the database, you'll use
     $result = $this->insert($modelData);

## 2) for update it will be :
     $result = $this->update($modelData);

## 3) for delete it will be a void :
    $this->delete($modelData);

## 4) for search, there are several types :
     $this->findModelBy($key, $value);
     $this->findModelById($id);
     $this->findUserByUuid($user_uuid);

and all return data

# Happynessarl Cache Management

-> This package lets you manage the cache with Laravel. You can choose to use Redis or the file system as your cache manager. On top of that, it contains an integrated CRUD system where the cache handles everything. All you have to do is pass the model, and you're done.

-> I give you this with a pagination tool too, which is very handy, for paginating data coming from the cache or data arrays

-> This package also offers you a quick and efficient way of managing relationships, but you need to specify them each time in your data responses. All you have to do is add an element to each of your models, and you're done!

First To do this, in your service class, which could be :

## I- import this ``BaseModel`` trait into all your Laravel models in order to manage all caches, as they are managed by models

## Classe UserService

```php
use Happynessarl\Caching\Management\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService extends BaseService
{ 
    private function initializeModel(): void
    {
        $this->setModel(new User());
    }

    /**
     * you need to implement it in your service to initialize Model Object
     * 
     * @inheritDoc
     */
    protected function getModelObject(): User
    {
        $this->initializeModel();
        return $this->getModel();
    }

    /**
     * To paginate, proceed as follows
     */
    public function getAllUsers(): LengthAwarePaginator
    {
        /** Call this method when you want to fetch all the data in a Table, similar to what Laravel offers: Employee::all(); instead, use this method */
        $items = $this->cacheAllRecords();

        /** Call this method and your data will be paginated, $items = collection or array, and 9 is a perPage that you want to paginate */
        $paginator = $this->paginateModelCollection($items, 9);

        return $paginator;
    }

    // your another methods here
}
```

## II- To manage relationships automatically without having to specify them on each data return, add this variable to each of your Models like this

```php

<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 

class Client extends Model
{ 
    use  BaseModel; //Same to this BaseModelTrait

    protected $fillable = ['user_id', 'address', 'phone'];
    
    /** Here's the this to add to all your models, specifying the relationships inside.  */
    protected $cacheableRelations = ['user', 'orders'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

```
For example:

## 1) to add data to the database, you'll use
     $result = $this->insert($modelData);

## 2) for update it will be :
     $result = $this->update($modelData);

## 3) for delete it will be a void :
    $this->delete($modelData);

## 4) for search, there are several types:
    $result = $this->findModelBy($key, $value); return Model
    $result = $this->findModelById($id); return Model
    $result = $this->findUserByUuid($user_uuid); return Model
    $result = $this->getModelCollection($key, $value); return COllection

and all return model data

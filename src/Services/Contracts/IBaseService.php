<?php

namespace Happynessarl\Caching\Management\Services\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface IBaseService
{
    /**
     * @return Model
     * @throws ModelNotFoundException
     */
    public function getModel(): Model;

    /**
     * @param string $key
     * @param mixed $value
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findModelBy(string $key, $value);

    /**
     * @param string $key
     * @param mixed $value
     * @return Collection
     * @throws ModelNotFoundException
     */
    public function getCollection(string $key, $value): Collection;

    /**
     * @param int $id
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findModelById(int $id);

    /**
     * @param string $uuid
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findUserByUuid($uuid);
}

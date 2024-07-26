<?php

namespace Happynessarl\Caching\Management\Models;

trait BaseModel
{
    public function getCacheKey()
    {
        $table = strtolower($this->getTable());
        return $table . ":" . $this->id;
    }
}

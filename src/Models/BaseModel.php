<?php

namespace CheckDate\PinModule\Models;

trait BaseModel
{
    public function getCacheKey()
    {
        $table = strtolower($this->getTable());
        return $table . ":" . $this->id;
    }
}

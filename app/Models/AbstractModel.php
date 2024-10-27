<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class AbstractModel extends Model
{
    protected $guarded = ['id'];
    public $timestamps = true;

    /**
     * @param $filters
     *
     * @return null
     */
    protected function filter($filters)
    {
        return null;
    }

    /**
     * @param        $builder
     * @param array  $filters
     *
     * @return mixed
     */
    public function scopeFilter($builder, array $filters = []): mixed
    {
        if (empty($filters)) {
            return $builder;
        }

        $filter = $this->filter($filters);
        return $filter ? $filter->apply($builder, $filters) : $builder;
    }
}

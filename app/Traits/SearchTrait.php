<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SearchTrait
{
    /**
     * Scope a query to only include records that match the given search term.
     *
     * @param Builder $query
     * @param string $column
     * @param string $value
     *
     * @return Builder
     */
    public function scopeSearch(Builder $query, string $column, string $value): Builder
    {
        return $query->where($column, 'like', '%' . $value . '%');
    }

    /**
     * Scope a query to only include records that match the given search term in relation.
     *
     * @param Builder $query
     * @param string $relation
     * @param string $column
     * @param string $value
     *
     * @return Builder
     */

    public function scopeSearchRelation(Builder $query, string $relation, string $column, string $value): Builder
    {
        return $query->whereRelation($relation, $column, 'like', '%' . $value . '%');
    }


}

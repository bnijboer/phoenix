<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class PublishedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder  $builder
     * @param  Model  $model
     * @return Builder The scoped query.
     */
    public function apply(Builder $builder, Model $model)
    {
        if (Auth::check()) {
            $builder->when(Auth::user()->isOwner(), function ($query) {
                return $query;
            }, function ($query) {
                return $query->whereIsPublished(true);
            });
        } else {
            return $builder->whereIsPublished(true);
        }
    }
}

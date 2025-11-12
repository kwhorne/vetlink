<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrganisationScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = auth()->user();
        
        // Skip scope for superadmin users (no organisation)
        if ($user && $user->organisation_id === null) {
            return;
        }
        
        if ($user && $user->organisation_id) {
            $builder->where($builder->getModel()->qualifyColumn('organisation_id'), $user->organisation_id);
        }
    }
}

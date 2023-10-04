<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface TodoRepositoryInterface
{
    /**
     * @return Builder
     */
    public function newQuery(): Builder;
}

<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\GarageRepositoryInterface;
use App\Models\Garage;

class GarageRepository extends Repository implements GarageRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Garage::class;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GarageRepositoryInterface as GarageRepository;

class GarageController extends Controller
{
    protected $garageRepository;

    public function __construct(GarageRepository $repository)
    {
        $this->garageRepository = $repository;
    }

    public function index()
    {
        $garages = $this->garageRepository->all();

        return view('admins.layouts.index');
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepositoryInterface\apiRepositoryInterface;

class CategoryController extends Controller
{
    private $apiRepository;

    public function __construct(apiRepositoryInterface $apiRepository) {
        $this->apiRepository = $apiRepository;
    }

    public function category()
    {
        return  $this->apiRepository->category();
    }
}

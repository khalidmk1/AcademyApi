<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RepositoryInterface\UsersRepositoryInterface;

class RolePermissionController extends Controller
{

    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store_role_permission(String $role , String $permission)
    {
        
        $role_permission =  $this->userRepository->store_role_permission($role , $permission);


        return response()->json([$role_permission ] );
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RepositoryInterface\UsersRepositoryInterface;

class PermissionController extends Controller
{

    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function create_permission(){

        return view('Component.Profile.create.permission');
    }

    public function store_permission(Request $request){
        
        $this->userRepository->store_permission($request);

        return redirect()->back()->with('status' , 'permission created');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\RepositoryInterface\UsersRepositoryInterface;

class RolesController extends Controller
{

    private $userRepository;


    public function __construct(UsersRepositoryInterface  $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){

        $role_permissions = $this->userRepository->create_role();

        $user = Auth::user();
        $user_role = $user->userRole->role_id;

        if($role_permissions['rolePermissionExists'] || $user_role == 1){

            return view('Component.Profile.create.role')->with('role_permissions' , $role_permissions);

        }else{
            abort(403, 'Unauthorized action.');
        }

        
    }


    public function store(Request $request){

        $this->userRepository->store_role($request);
        
        return redirect()->back()->with('status', 'Vous avez créé un rôle avec succès');

    }


    public function search_role( Request $request)
    {
        return  $this->userRepository->search_role($request);
    }


}

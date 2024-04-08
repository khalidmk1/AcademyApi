<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;

class AdminController extends Controller
{

    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function view_admin()
    {
        $admins =  $this->userRepository->view_admin();

        return view('Component.Profile.view.admin')->with('admins' , $admins);
    }


    public function create_admin(){

        return view('Component.Profile.create.admin');
    }

    public function store_admin(Request $request){

        $this->userRepository->store_admin($request);

        return redirect()->back()->with('status' , 'Vous Crée un Admin');

    }


    public function delete_admin(Request $request , String $id)
    {
        $this->userRepository->delet_profile($request, $id);

        if(Hash::check( $request->password, Auth::user()->password ) ){
            return redirect()->back()->with('status' , 'Vous Avez suprimer Admin');
        }else{
            return redirect()->back()->with('faild' , 'Vous Mots de passe est incorrect');
        }

    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;


class PorfileEditeController extends Controller
{

    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }
    

    public function edit_profile($id){
        $user = $this->userRepository->edit_profile($id);
        
        return view('Component.Profile.update.profile')->with('user' , $user);
    }

    public function update_profile(Request $request , string $id ){
       
    $this->userRepository->update_profile($request , $id);

    return redirect()->back();

    }

    public function password_update(Request $request ){

        $this->userRepository->password_update($request );

        return redirect()->back()->with('status' , 'Vous avez modifier mots de passe');
    }


    public function password_change(Request $request)
    {
        $this->userRepository->password_update($request);

        return redirect()->route('dashboard.index')->with('status' , 'Vous avez modifier mots de passe');
    }


    public function edit_password(){

        return view('Component.Profile.update.password');
        
    }

    public function delet_profile(Request $request ,String $id)
    {
        $this->userRepository->delet_profile($request, $id);

        if(Hash::check( $request->password, Auth::user()->password ) ){
            return redirect()->back()->with('status' , 'Vous Avez suprimer Admin');
        }else{
            return redirect()->back()->with('faild' , 'Vous Mots de passe est incorrect');
        }

        

    }


    public function search_profile(Request $request )
    {
        return $this->userRepository->search_profile($request);
    }


}

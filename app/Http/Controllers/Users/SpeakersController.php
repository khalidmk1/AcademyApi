<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;


class SpeakersController extends Controller 
{
    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function view_speakers()
    {
        $speakers = $this->userRepository->view_speaker();

        /* dd($speakers); */

        return view('Component.Profile.view.spearkers')->with('speakers' , $speakers);
    }

    public function create_speakers(){

        $SpeakerPolicy = $this->userRepository->create_speakers();


        if($SpeakerPolicy['rolePermissionExists']){
            return view('Component.Profile.create.speakers');
        }else{
            abort(403, 'Unauthorized action.');
        }

    }

    public function store_speaker(Request $request)
    {

        $speaker = $this->userRepository->store_speaker($request);

        return redirect()->back()->with('status' , 'Vous avez Crée Speaker');

    }

    public function delete_speaker(Request $request ,String $id)
    {

        $this->userRepository->delete_speaker($request, $id);


        if(Hash::check( $request->password, Auth::user()->password ) ){
            return redirect()->back()->with('status' , 'Vous Avez suprimer Speaker');
        }else{
            return redirect()->back()->with('faild' , 'Vous Mots de passe est incorrect');
        }
    }

}

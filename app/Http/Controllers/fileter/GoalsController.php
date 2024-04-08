<?php

namespace App\Http\Controllers\Fileter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;

class GoalsController extends Controller
{


    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }


    public function create_goals()
    {

        $goals =  $this->userRepository->create_goals();

        return view('filtering.create.goals')->with('goals' , $goals);

    }

    public function store_goals(Request $request)
    {
        $this->userRepository->store_goals($request);

        return redirect()->back()->with('status' , 'Vous Avez Crée un Objectif');
    }


    public function update_goals(Request $request , String $id)
    {
        $this->userRepository->update_goals($request , $id);

        return redirect()->back()->with('status' , 'Vous Avez Modifier Votre Objectif');
    }

    public function delete_goals(Request $request , String $id)
    {
        $this->userRepository->delete_goals($request , $id);

        if(Hash::check( $request->password, Auth::user()->password ) ){

            return redirect()->back()->with('status' , 'Vous Avez Suprimer un Objectif');

        }else{

            return redirect()->back()->with('faild' , 'Vous Mots de passe est incorrect');
        }

       
    }

    public function search_goals(Request $request)
    {
        return $this->userRepository->search_filtter($request);
    }


}

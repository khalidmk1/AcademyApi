<?php

namespace App\Http\Controllers\Fileter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;

class ProgramController extends Controller
{
    
    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function create_program()
    {
        $categories_programs =  $this->userRepository->create_program();

       /*  dd($categories_programs); */

        return view('filtering.create.program')->with('categories_programs' , $categories_programs);
    }

    public function store_program(Request $request )
    {
        $program =  $this->userRepository->store_program( $request);

        return redirect()->back()->with('status' , 'Vous Avez Crée une Programme');
    }

    public function update_program(Request $request , String $id)
    {

        $program = $this->userRepository->update_program( $request , $id);

        return redirect()->back()->with('status' , 'Vous Modifier le Programme');
    }

    public function delete_program(Request $request , String $id)
    {
        $program = $this->userRepository->delete_program($request  ,$id);

        if(Hash::check( $request->password, Auth::user()->password ) ){
            return redirect()->back()->with('status' , 'Vous Avez Suprimer le Program');
        }else{
            return redirect()->back()->with('faild' , 'Vous Mots de passe est incorrect');
        }

    }


}

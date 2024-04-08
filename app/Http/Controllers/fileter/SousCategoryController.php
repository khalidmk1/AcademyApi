<?php

namespace App\Http\Controllers\Fileter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\UsersRepositoryInterface;

class SousCategoryController extends Controller
{
      
    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function create_souscategory()
    {
        $souscategories = $this->userRepository->create_souscategory();

        return view('filtering.create.sous_categorie')->with('souscategories' , $souscategories);
    }

    public function store_souscategorie(Request $request)
    {
        $categorie = $this->userRepository->store_souscategory($request);

        return redirect()->back()->with('status' , 'Vous avez Crée une SousCtagorie');
    }

    public function update_souscategory(Request $request,String $id)
    {
        $souscategory = $this->userRepository->update_souscategory($request , $id);

        return redirect()->back()->with('status' , 'Vous Avez Modifier le Categorie');
    }

    public function delete_souscategoty(Request $request ,String $id)
    {
        $this->userRepository->delete_souscategoty($request,$id);

        if(Hash::check( $request->password, Auth::user()->password ) ){
            return redirect()->back()->with('status' , 'Vous Avez Suprimer le SousCategorie');
        }else{
            return redirect()->back()->with('faild' , 'Vous Mots de passe est incorrect');
        }

       
    }

    public function search_souscategory(Request $request)
    {
        return $this->userRepository->search_filtter($request);
    }


}

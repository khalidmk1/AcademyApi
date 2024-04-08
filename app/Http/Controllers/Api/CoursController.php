<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepositoryInterface\apiRepositoryInterface;

class CoursController extends Controller
{
    private $apiRepository;

    public function __construct(apiRepositoryInterface $apiRepository) {
        $this->apiRepository = $apiRepository;
    }

    public function coming_cours(){
        return  $this->apiRepository->coming_cours();
    }

    public function Cour_Conference()
    {
        return  $this->apiRepository->Cour_Conference();
    }
    public function Cour_Podcast()
    {
        return  $this->apiRepository->Cour_Podcast();
    }

    public function Cour_Formation()
    {
        return  $this->apiRepository->Cour_Formation();
    }
    
    //Qsm formation
    public function Cour_Fourmation_Qsm(String $id)
    {
        return  $this->apiRepository->Cour_Fourmation_Qsm($id);
    }

    //tree cours get

    public function treeCoursFormation(){
        return  $this->apiRepository->treeCoursFormation();
    }
    
   

    public function Cour_Formation_detail(String $id)
    {
        return  $this->apiRepository->Cour_Formation_detail($id);
    }

    // cour Favoris
    public function Cour_Favoris(String $id , String $cour){
        return  $this->apiRepository->Cour_Favoris($id , $cour);
    }
    //all favoris
    public function AllFavoris(String $id){
        return  $this->apiRepository->AllFavoris($id);
    }

     //Cours Comment
     public function CoursComment(String $id , String $cours , Request $request){
        return  $this->apiRepository->CoursComment($id , $cours , $request);
     }

     //get Comment
     public function getComment(String $cours)
     {
        return $this->apiRepository->getComment($cours);
     }
}

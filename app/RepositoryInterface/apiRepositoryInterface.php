<?php

namespace App\RepositoryInterface;

use Illuminate\Http\Request;

interface apiRepositoryInterface {


    // get client by id
    public function getClientById(String $id);
    //update client
    public function update_client(Request $request , String $id); 
    //get populaire speaker
    public function populaire_speaker(); 

    //coming soon cours
    public function coming_cours();

    //category
    public function category();

    //program
    public function program();
    
    //cours
    public function Cour_Conference();
    public function Cour_Podcast();

    public function Cour_Formation();
    //Qsm formation
    public function Cour_Fourmation_Qsm(String $id); 

    
    //tree Cours first
    public function treeCoursFormation();


    public function Cour_Formation_detail(String $id);

    //Cour Favoris
    public function Cour_Favoris(String $id , String $cour);
    //all favoris
    public function AllFavoris(String $id);

    //Cours Comment
    public function CoursComment(String $id , String $cours , Request $request);

    //get Comment
    public function getComment(String $cours);



}
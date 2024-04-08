<?php

namespace App\RepositoryInterface;

use Illuminate\Http\Request;


interface UsersRepositoryInterface{


    //report dashboard
    public function reportindex();
    public function ReportCount();
    public function FilterCount(Request $request);

    //search functionality
    public function search_profile(Request $request );
    public function search_role(Request $request);
    public function search_filtter(Request $request);
    
    //crud profile
    public function edit_profile(String $id); 
    public function update_profile(Request $request , String $id);
    public function password_update(Request $request);
    public function delet_profile(Request $request ,String $id);
   

    //crud permission
    public function store_permission(Request $request);

    //crud role
    public function store_role(Request $request);
    

    //crud role_permission
    public function store_role_permission(String $role , String $permission);

    //crud managers
    public function view_manager();
    public function create_manger();
    public function store_manager(Request $request);


    //crud speakers
    public function view_speaker();
    public function create_speakers();
    public function store_speaker(Request $request);
    public function delete_speaker(Request $request ,String $id);


    //crud admin
    public function view_admin();
    public function store_admin(Request $request);
   

    //crud categorie
    public function create_category();
    public function store_category(Request $request);
    public function update_category(Request $request , String $id);
    public function delete_categoty(Request $request , String $id);

    //crud SousCategory
    public function create_souscategory();
    public function store_souscategory(Request $request);
    public function update_souscategory(Request $request , String $id);
    public function delete_souscategoty(Request $request ,String $id);

    //crud Program
    public function create_program();
    public function store_program(Request $request);
    public function update_program(Request $request , String $id);
    public function delete_program(Request $request,String $id);


    //crud objectifs
    public function create_goals();
    public function store_goals(Request $request);
    public function update_goals(Request $request , String $id);
    public function delete_goals(Request $request , String $id);


    //crud cours
    public function index_cours();
    public function show_cour(String $id);
    public function create_cours();
    public function getGoalsBySousCategorie(String $id);
    public function store_cours(Request $request);

    //conference cours
    public function getCoursVideo(String $id);
    public function store_video(Request $request );
    public function update_conference(Request $request);
    public function update_video_conference(String $id , Request $request);

    //delete conference video 
    public function delete_video(String $id);
    public function delete_video_update(String $id , Request $request);

    //podcast cours 
    public function getPodcastVideo(String $id);
    public function store_videoPodacast(Request $request );
    public function update_podcast(String $id , Request $request);
    public function update_video_podcast(String $id , Request $request);

    //delete Podcast video
    public function delete_video_podcast(String $id);
    //delete podcast update video 
    public function deleteVidoe_podcast_update(String $id , Request $request);
    
    //formation cours
    public function getvideoformation(String $id);
    public function create_video_formation(String $id);

    public function store_video_formation(Request $request);

    //update video formation
    public function update_video_formation(String $id,Request $request);

    // delete video formation
    public function delete_video_formation(String $id);

    //delete updated video formation
    public function delete_update_video_formation(String $id , Request $request);


    public function create_quiz_formation(String $id );
    public function store_quiz_formation(Request $request );
    public function store_quiz_qustion(Request $request);

    //update Qsm formation
    public function update_quiz_formation(String $id , Request $request);

    //update Question formation
    public function update_Question_formation(String $id , Request $request);
    

    //update formation
    public function update_formation(String $id , Request $request);

    
    //delete QSM
    public function delete_Qsm_formation(String $id);

    // delete updated Qsm Formation
    public function delete_Qsm_updated_formation(String $id , Request $request);

    //delete Questionnaire
    public function delete_Qustion_farmation(String $id);

    // delete updated Questionnair Formation
    public function delete_Question_updated_formation(String $id , Request $request);

      //crud tickets
      public function create_tickets();
      public function store_ticket(Request $request);
      public function update_ticket(String $id , Request $request);
      public function store_ticketComment(String $id , Request $request);

      //FAQ
      public function FAQ_edite();
      public function FAQ_store(Request $request);
      public function FAQ_update(Request $request , String $id);

      //crud email
      public function Create_email();
      public function send_emails(Request $request);
}
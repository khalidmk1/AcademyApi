<?php

namespace App\Http\Controllers\Cours;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\RepositoryInterface\UsersRepositoryInterface;

class CoursController extends Controller
{

    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function index_cours()
    {
        return $this->userRepository->index_cours();
    }

    public function show_cour(String $id)
    {
        return $this->userRepository->show_cour($id);
    }

    // cours function
    public function create_cours()
    {

        $CoursInfo =  $this->userRepository->create_cours();

        return view('Cours.create.cours')->with('CoursInfo' , $CoursInfo);
    }


     // store cours function
     public function store_cours(Request $request)
     {
         return $this->userRepository->store_cours($request);
 
     }


    //goals function
    public function getGoalsBySousCategorie(String $id)
    {
        return  $this->userRepository->getGoalsBySousCategorie($id);
    }


    // view of cours conferencier
    public function getCoursVideo(String $id)
    {

        $confrenceInfo =  $this->userRepository->getCoursVideo($id);

        return view('Cours.create.conference.coursvideo')->with('confrenceInfo' , $confrenceInfo);
    }

    // store videos of conferencier
    public function store_video(Request $request )
    {
        return $this->userRepository->store_video($request);
    }

    //upadte conference cours
    public function update_conference(Request $request)
    {
        return $this->userRepository->update_conference($request);
    }

    public function update_video_conference(String $id , Request $request){
        return $this->userRepository->update_video_conference($id ,$request);
    }


    //delete conference videos
    public function delete_video(String $id)
    {
        return $this->userRepository->delete_video($id);

    }
    public function delete_video_update(String $id , Request $request)
    {
        return $this->userRepository->delete_video_update($id , $request);

    }

    // view of padcast video
    public function getPodcastVideo(String $id)
    {
        $podacastInfo = $this->userRepository->getPodcastVideo($id);

        return view('Cours.create.podcast.coursvideo')->with('podacastInfo' , $podacastInfo);
    }

    // store podcast video
    public function store_videoPodacast(Request $request )
    {
        return $this->userRepository->store_videoPodacast($request);
    }

    //update podcast
    public function update_podcast(String $id , Request $request)
    {
        return $this->userRepository->update_podcast($id , $request);
    }

    //update podcast video 
    public function update_video_podcast(String $id , Request $request)
    {
        return $this->userRepository->update_video_podcast($id , $request);
    }

    //delete podcast video updated
    public function deleteVidoe_podcast_update(String $id , Request $request)
    {
        return $this->userRepository->deleteVidoe_podcast_update($id , $request);
    }

    // delete padcast videos
    public function delete_video_podcast(String $id)
    {
        return $this->userRepository->delete_video_podcast($id);
    }


    public function getvideoformation(String $id)
    {
        $fomationInfo = $this->userRepository->getvideoformation($id);

        return view('Cours.create.fomation.formationvideo')->with('fomationInfo' , $fomationInfo);
    }

    public function create_video_formation(String $id)
    {
        return $this->userRepository->create_video_formation($id);
    }

    //update formation
    public function update_formation(String $id , Request $request)
    {
        return $this->userRepository->update_formation($id , $request);
    }



    public function store_video_formation(Request $request)
    {
        return $this->userRepository->store_video_formation($request);
    }


    public function update_video_formation(String $id,Request $request){
        return $this->userRepository->update_video_formation($id , $request);
    }


    //delete updated video formation
    public function delete_update_video_formation(String $id , Request $request)
    {
        return $this->userRepository->delete_update_video_formation($id , $request);
    }

    // delete video formation
    public function delete_video_formation(String $id){
        
        return $this->userRepository->delete_video_formation($id);
    }

    public function create_quiz_formation(String $id){
        return $this->userRepository->create_quiz_formation( $id);
    }

   

    public function store_quiz_formation(Request $request)
    {
        return  $this->userRepository->store_quiz_formation($request);
    }

    public function store_quiz_qustion(Request $request)
    {
        return $this->userRepository->store_quiz_qustion($request);
    }

    //update quiz formation
    public function update_quiz_formation(String $id ,Request $request)
    {
         return $this->userRepository->update_quiz_formation($id , $request);
    }

    public function update_Question_formation(String $id ,Request $request)
    {
        return $this->userRepository->update_Question_formation($id , $request);
    }


    public function delete_Qsm_formation(String $id)
    {
        return  $this->userRepository->delete_Qsm_formation($id);
    }


    // delete updated Qsm Formation
    public function delete_Qsm_updated_formation(String $id , Request $request){
        return  $this->userRepository->delete_Qsm_updated_formation($id , $request);
    }

    
    public function delete_Qustion_farmation(String $id)
    {
        return  $this->userRepository->delete_Qustion_farmation($id);
    }

     // delete updated Questionnair Formation
     public function delete_Question_updated_formation(String $id , Request $request){
        return  $this->userRepository->delete_Question_updated_formation($id , $request);
     }


}

<?php

namespace App\Services;
use App\Models\Cour;
use App\Models\User;
use App\Models\Program;
use App\Models\Category;
use App\Models\UserClient;
use App\Models\QuizSeccess;
use App\Models\CoursComment;
use App\Models\CoursFavoris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RepositoryInterface\apiRepositoryInterface;

class ApiServicesRepository  implements apiRepositoryInterface
{

    // get clinet by id
    public function getClientById(String $id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    public function update_client(Request $request , String $id){

        $user = User::findOrFail($id);


        $request->validate([
            'firstName' => [ 'string', 'max:255'],
            'lastName' => [ 'string', 'max:255'],
            'status'  => [ 'string', 'max:255'],
            'numchid' => ['integer'],
            'profission'  => [ 'string', 'max:255'],
            'email' => 'email|unique:users,email,' . $user->id,
        ]);


        $user->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'datebirt' => $request->date_birte,
            'status_matrimonial' => $request->status,
            'Numchild' => $request->numchild,
            'profission' => $request->profission
        ]);

    
        return response()->json([$user]);
    }


    public function populaire_speaker()
    {
        $speaker = User::where('is_popular' , true)->get();
        $speaker->load('userspeaker');

        return response()->json($speaker);
    }

    public function coming_cours(){

        $comingCours = Cour::where('isComing' , 1)->get();
        
        foreach ($comingCours as $coming) {
            $coming->load('category');
            //cour conference
            $coming->load('CoursConference');
            //cour podcast
            $coming->load('CoursPodcast');
        }
        
        return response()->json($comingCours);

       

    }

    public function category(){
        $category = Category::all();
        $category->load('cours');

        return response()->json($category);
    }

    public function program()
    {
        $program = Program::all();
        $program->load(['CourFormation.cours' , 'CourFormation.CoursFormationVideo']);

        return response()->json($program);
    }

    public function Cour_Conference(){
        $courConference = Cour::where('cours_type' , 'conference')->get();

         //cour conference
        $courConference->load('category');
        $courConference->load([
        'CoursConference', 
        'CoursConference.user', 
        'CoursConference.user.userspeaker', 
        'CoursConference.ConferenceVideo', 
        'CoursConference.ConferenceVideo.guestvideo.user.conferenceGuests']);

        return response()->json(['contentConference' => $courConference]);

    }
    public function Cour_Podcast(){
        $courPodcast = Cour::where('cours_type' , 'podcast')->get();

        //cour Podcast
        
        $courPodcast->load('category');
        $courPodcast->load(['CoursPodcast' , 
        'CoursPodcast.user' , 
        'CoursPodcast.user.userspeaker',
        'CoursPodcast.videopodcast',
        'CoursPodcast.videopodcast.guestvideo.user'
    ]);

        return response()->json(['contentPodcast' => $courPodcast]);

    }

    public function Cour_Formation(){
        $courFormation = Cour::where('cours_type' , 'formation')->get();

         //cour formation
        $courFormation->load('category');

        $courFormation->load(['CoursFormation' , 
        'CoursFormation.user' , 'CoursFormation.user.userspeaker',
        'CoursFormation.CoursFormationVideo']);
       

        return response()->json(['contentFormation' => $courFormation]);

    }

    public function Cour_Fourmation_Qsm(String $id)
    {
        $Cour =  Cour::findOrFail($id);

        $Cour_Qsm = QuizSeccess::where('cours_id' , $Cour->id)->get();

        $Cour_Qsm->load('Question' ,'Answer' , 'Question.Answers');

        return response()->json(['Cour_Qsm' => $Cour_Qsm]);

    }

    // get tree Cours 


    public function treeCoursFormation()
    {
        $TreecourFormation = Cour::where('cours_type' , 'formation')->get()->take(20);
         // cour formation tree
         $TreecourFormation->load('category');

       
        $TreecourFormation->load(['CoursFormation' , 
        'CoursFormation.user' , 'CoursFormation.user.userspeaker',
        'CoursFormation.CoursFormationVideo']);

        return response()->json(['TreecourFormation' => $TreecourFormation]);
    }



    public function Cour_Formation_detail(String $id){
        $cours = Cour::findOrFail($id);

         //cour conference
        $cours->load('category');
        $cours->load(['CoursFormation' , 'CoursFormation.user' ,
        'CoursFormation.CoursFormationVideo' , 
        'CoursFormation.CoursFormationVideo.guestvideo.user' , 

    ]);

        return response()->json(['contentFormationDetail' => $cours]);

    }

    // favoris Cours
    public function Cour_Favoris(String $id , String $cour){

        $Cour = Cour::findOrFail($cour);
        $user = User::findOrFail($id);

       
        $folow_false = CoursFavoris::where('user_id', $user->id)
            ->where('cours_id', $Cour->id)
            ->where('state', 0)
            ->first();
        
        $folow_true = CoursFavoris::where('user_id', $user->id)
            ->where('cours_id', $Cour->id)
            ->where('state', 1)
            ->first();

        if ($folow_false) {
            $message = 'folow true';
            $folow_false->update([
                'state' => 1,
            ]);
            return response()->json($message);
        } elseif ($folow_true) {
            $message = 'folow false';
            $folow_true->update([
                'state' => 0,
            ]);
            return response()->json($message);
        } else {
            $message = 'folow created';
            $newfolow = CoursFavoris::create([
                'user_id' => $user->id,
                'cours_id' => $Cour->id,
                'state' => 1,
            ]);
            return response()->json($message);
        }
    }

    //all favoris 

    public function AllFavoris(String $id)
    {

        $user = User::findOrFail($id);
        
        $favoris = CoursFavoris::where(['user_id' => $user->id , 'state' => 1])->get();
        $favoris->load('cours');
        //formation
        $favoris->load(['cours.CoursFormation' ,'cours.CoursFormation.user' ,
        'cours.CoursPodcast' , 'cours.CoursPodcast.user' , 'cours.CoursConference' ,
        'cours.CoursConference.user' ]);

        return response()->json($favoris);
    }

    //Cours Comment

    public function CoursComment(String $id , String $cours , Request $request){
        
        $user = User::findOrFail($id);
        $cour = Cour::findOrFail($cours);

        $CoursCommentExiste = CoursComment::where(['cours_id' => $cour->id , 'user_id' => $user->id])->exists();

        $deleteCoursComments = CoursComment::where(['cours_id' => $cour->id , 'user_id' => $user->id])->first();

        if($CoursCommentExiste){
            $deleteCoursComments->delete();
        }
       
        $comment = CoursComment::create([
            'cours_id' => $cour->id,
            'user_id' => $user->id,
            'Comment' => $request->comment
        ]);

        $comment->load('user');

        return response()->json($comment);

    }

    public function getComment(String $cours)
    {
        $cours = Cour::findOrFail($cours);

        $comments = CoursComment::where('cours_id' ,$cours->id)->get();

        $comments->load('user');

        return response()->json($comments);

    }
   


}
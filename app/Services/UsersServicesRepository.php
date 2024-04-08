<?php

namespace App\Services;

use App\Models\FAQ;
use App\Models\Cour;
use App\Models\Goal;
use App\Models\Role;
use App\Models\User;
use App\Models\Answer;
use App\Models\Domain;
use App\Models\Ticket;
use App\Mail\sendemail;
use App\Models\Profile;
use App\Models\Program;
use App\Models\Category;
use App\Models\Question;
use App\Models\UserRole;
use App\Mail\SendInfoUser;
use App\Models\Permission;
use App\Models\QuizSeccess;
use Illuminate\Support\Str;
use App\Models\CoursPodcast;
use App\Models\QuizQuestion;
use App\Models\SousCategory;
use App\Models\UserSpeakers;
use Illuminate\Http\Request;
use App\Models\CommentTicket;
use App\Models\CoursFormation;
use App\Models\RolePermission;
use App\Models\CoursConference;
use Illuminate\Validation\Rules;
use App\Models\CoursPadcastGuest;
use App\Models\CoursPadcastVideo;
use App\Models\CoursFormationVideo;
use App\Models\CoursConferenceGuest;
use App\Models\CoursConferenceVideo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\RepositoryInterface\UsersRepositoryInterface;


class UsersServicesRepository  implements UsersRepositoryInterface
{

    

    //report of dashboard

    public function reportindex()
    {

        $category = Category::all();
        return view('Component.dashboard.reporting.report')->with('category' , $category);
    }

    public function ReportCount()
    {
        $RoleUser = UserRole::where('role_id' , 4)->get();

        $AuthUserCount = User::whereIn('id', $RoleUser->pluck('id'))->where('is_login', 1)->count() ;
        
        $NotAuthUserCount = User::whereIn('id', $RoleUser->pluck('id'))->where('is_login', 0)->count() ;


        return response()->json(['AuthUserCount' => $AuthUserCount , 
        'NotAuthUserCount' => $NotAuthUserCount]);
    }


    public function FilterCount(Request $request)
    {
        if($request->has('CategoryCours')){
            $CountCours = Cour::where('category_id' , $request->CategoryCours)->count();
            return response()->json($CountCours);
        }

        if($request->has('CategorySpeaker')){
            $CountSpeaker = Cour::where('category_id' , $request->CategorySpeaker)->get();
            return response()->json($CountSpeaker->count());
            
        }

        
    }


    // serch functionality
    public function search_filtter(Request $request)
    {
        $output = "";

        if($request->has('category')){
            $category = $request->input('category');

            $categorys = Category::where('category_name', 'like', '%'.$category.'%')->get();

            $output .= view('filtering.search.category')->with('categorys' , $categorys)->render();

            
        }

        if($request->has('goal')){
            $goal = $request->input('goal');

            $goals = Goal::where('goals', 'like', '%'.$goal.'%')->get();

            $output .=view('filtering.search.goals')->with('goals' , $goals)->render();
        }


        if($request->has('souscategory')){
            $couscategory = $request->input('souscategory');

            $soucategorys =  SousCategory::where('souscategory_name', 'like', '%'.$couscategory.'%')->get();

            $output .=view('filtering.search.sousCategory')->with('soucategorys' , $soucategorys)->render();
        }




        return response()->json($output);
    }


    public function search_profile(Request $request )
    {
    
        $output = "";
    
        if($request->has('admin')){
            $admins = $request->input('admin');
            $admins = User::where('firstName', 'like', '%'.$admins.'%')->get();
    
            foreach ($admins as $key => $admin) {
                $rolesUser = UserRole::where(['user_id' => $admin->id , 'role_id' => 2])->get();
                $output .= view('Component.Profile.search.admin')->with('rolesUser' , $rolesUser)->render();
            }
    
        }
    
        if($request->has('manager')){
            
            $managers = $request->input('manager');
            
            $managers = User::where('firstName', 'like', '%'.$managers.'%')->get();
            
            foreach ($managers as $key => $manager) {
                
                $rolesUser = UserRole::whereNotIn('role_id', [1, 2, 3, 4])
                         ->where('user_id', $manager->id)
                         ->get();
                $output .= view('Component.Profile.search.manager')->with('rolesUser' , $rolesUser)->render();
            }
        
        }
    
        if($request->has('speaker')){
            $speakers = $request->input('speaker');
            
            $speakers = User::where('firstName', 'like', '%'.$speakers.'%')->get();
            
            foreach ($speakers as $key => $speaker) {
                
                $rolesUser = UserRole::where(['user_id' => $speaker->id , 'role_id' => 3])->get();
                $output .= view('Component.Profile.search.speaker')->with('rolesUser' , $rolesUser)->render();
            }
        }
    
    
        return response()->json($output);
    }


    public function search_role(Request $request)
    {
        $query = $request->input('role');

        $output = "";

        $permissions = Permission::all();

        $roleId = [3 , 4];
        $roles = Role::whereNotIn('id' , $roleId)->get();
        
        $RolePermissioncheck = RolePermission::whereIn('permission_id', $permissions->pluck('id'))
        ->where('confirmed', 1)
        ->whereIn('role_id', $roles->pluck('id'))
        ->get()
        ->groupBy('role_id');

        $filteredRoles = Role::where('role_name', 'like', '%'.$query.'%')->get();


        $output .= view('Component.Profile.search.role')->with(['filteredRoles' =>$filteredRoles , 
        'permissions'=> $permissions ,'roles' => $roles ,
        'RolePermissioncheck' => $RolePermissioncheck])->render();


    
        return response()->json(['output' => $output]);
    }


    //crud profile

    public function edit_profile(String $id){
        return User::findOrFail(Crypt::decrypt($id));
    }


    public function update_profile(Request $request , $id){


        $profile = User::findOrFail(Crypt::decrypt($id));
        $userSpeaker = UserSpeakers::where('user_id' , $profile->id)->first();
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => 'required|email|unique:users,email,' . $profile->id,
                'biographie' => ['required', 'string', 'max:255']
            ]);

          
            
            $profile->firstName = $request->firstName;
            $profile->lastName = $request->lastName;
            $profile->email = $request->email;
            $userSpeaker->biographie = $request->biographie;
            
            $profile->save();

        

    }


    public function delet_profile(Request $request ,String $id)
    {
        $user = User::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'password' => ['required']
        ]);
       

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $user->userRole()->delete();
    
            $user->delete();
           
        }

    }




    public function password_update(Request $request )
    {

        $validate = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password_change' => 1,
            'password' => Hash::make($validate['password']),
        ]);

        

    }






    //crud permission

    public function store_permission(Request $request )
    {

        /* $domain = Domain::create([
            'domain' => $request->domain,
        ]); */

        $permission =  Permission::create([
            'permission_name' => $request->permission_name,
        ]);
        

    }


    //crud role

    public function create_role(){
        $permissions = Permission::all();

        $permission = Permission::findOrFail(7);
        $user_role = auth()->user()->userRole->role_id;

        $rolePermissionExists = RolePermission::where([
            'role_id' => $user_role,
            'permission_id' => $permission->id,
            'confirmed' => '1',
        ])->exists();

        $roleId = [3 , 4];
        $roles = Role::whereNotIn('id' , $roleId)->get();
        
        $RolePermissioncheck = RolePermission::whereIn('permission_id', $permissions->pluck('id'))
        ->where('confirmed', 1)
        ->whereIn('role_id', $roles->pluck('id'))
        ->get()
        ->groupBy('role_id');

        return ['rolePermissionExists' => $rolePermissionExists, 'permissions'=> $permissions ,'roles' => $roles ,'RolePermissioncheck' => $RolePermissioncheck]; 
    }

    public function store_role(Request $request){
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $role = Role::create([
            'role_name' => $request->title,
            'description' => $request->description
        ]);


    }



    //crud role_permission

    public function store_role_permission(String $role , String $permission)
    {
        $RolePermissionNotExiste = RolePermission::where(['role_id' => $role , 'permission_id' => $permission])->exists();
        $HasNotPermission = RolePermission::where(['role_id' => $role , 'permission_id' => $permission , 'confirmed' => 0])->exists();
        $changepermission = RolePermission::where(['role_id' => $role , 'permission_id' => $permission])->first();
        

        if(!$RolePermissionNotExiste){
            $RolePermission = RolePermission::create([
                'role_id' => $role,
                'permission_id' => $permission,
                'confirmed' => true
            ]);
        }else if($HasNotPermission){
            $changepermission->update([
                'confirmed' => true
            ]);
        } else{
            $changepermission->update([
                'confirmed' => false
            ]);
        }

        return ['RolePermissionExiste'=>$RolePermissionNotExiste ];

    }


    //crud manager

    public function view_manager()
    {

        $excludedRoleIds = [1, 2, 3 , 4];

        $managers = UserRole::whereNotIn('role_id', $excludedRoleIds)->paginate(10);
        
        return $managers;

    }

    public function create_manger(){
        $roles = Role::whereNotIn('id', [1, 2 , 3 , 4])->get();

        return ['roles'=>$roles] ;
    }


    public function store_manager(Request $request){

        $password = $request->password;

        if($password == null){

            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'role_id' => ['required'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            ]);

            $password  = Str::random(10);

            $request->password_confirmation = $password;
           
            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

            $user_role = UserRole::create([
                'user_id' => $user->id,
                'role_id' => $request->role_id
            ]) ;

        }else{

            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'role_id' => ['required'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);


            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

            $user_role = UserRole::create([
                'user_id' => $user->id,
                'role_id' => $request->role_id
            ]) ;


        }

        Mail::to($user->email)->send(new SendInfoUser($user , $password));
        
    }


    //crud speakers

    public function view_speaker()
    {
        $role = Role::where('role_name' , 'Speaker')->first();

        $speakers = UserRole::where('role_id' , $role->id)->paginate(10);

        return $speakers;
    }


    public function create_speakers()
    {
        $permission = Permission::findOrFail(6);
        $user_role = auth()->user()->userRole->role_id;

        $rolePermissionExists = RolePermission::where([
            'role_id' => $user_role,
            'permission_id' => $permission->id,
            'confirmed' => '1',
        ])->exists();


        return ['rolePermissionExists' => $rolePermissionExists];
    }


    public function store_speaker(Request $request){

        
        $role_admin = Role::where('role_name' , 'Speaker')->first();

        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'type_speaker' => ['required' , 'string' , 'max:255'],
            'biographie' => ['required' , 'string' , 'max:300'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $password  = Str::random(10);

        $request->password_confirmation = $password;

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'password_change' => 1,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        $user_role = UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role_admin->id
        ]);

        

        $speaker = UserSpeakers::create([
            'user_id' => $user->id,
            'type_speaker' => $request->type_speaker,
            'biographie' => $request->biographie
        ]);      

    }


    public function delete_speaker(Request $request ,String $id)
    {
        $user = User::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'password' => ['required']
        ]);
       

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $user->userRole()->delete();

            $user->userspeaker->delete();
    
            $user->delete();
           
        }
    }


    //crud admin

    

    public function view_admin()
    {
        $role = Role::where('role_name' , 'Admin')->first();

        $admins = UserRole::where('role_id' , $role->id)->paginate(10);

        return $admins;
    }

    public function store_admin(Request $request){

         $password = $request->password;

         $role_admin = Role::where('role_name' , 'Admin')->first();

        if($password == null){

            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            ]);

            $password  = Str::random(10);

            $request->password_confirmation = $password;
           
            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

            $user_role = UserRole::create([
                'user_id' => $user->id,
                'role_id' => $role_admin->id
            ]);

        }else{

            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required','confirmed', Rules\Password::defaults()],
            ]);


            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

            $user_role = UserRole::create([
                'user_id' => $user->id,
                'role_id' => $role_admin->id
            ]);
        }

       

        Mail::to($user->email)->send(new SendInfoUser($user , $password));
        

    }


    


    //crud category

    public function create_category()
    {
        $categories = Category::paginate(10);

        $domains = Domain::all();

    
        return ['categories' => $categories , 'domains' => $domains ];
    }

    public function store_category(Request $request)
    {
        $request->validate([
            'domains' =>  ['required', 'string', 'max:255'],
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        $categorie = Category::create([
            'domain_id' => $request->domains,
            'category_name' => $request->category_name,
        ]);

    }

    public function update_category(Request $request , String $id)
    {
        $category = Category::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        /* dd($profile); */
        
        $category->category_name = $request->category_name;
       
        
        $category->save();
    }


    public function delete_categoty(Request $request ,String $id)
    {
        $category =  Category::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'password' => ['required'],
        ]);

        if(Hash::check( $request->password, Auth::user()->password )){
            foreach ($category->souscategories as $souscategory) {
                $souscategory->delete();
            }
    
            $category->delete();
        }

      

        
    }


    


    //crud souscategorie

    public function create_souscategory()
    {
        $souscategories = SousCategory::paginate(10);
        $categories = Category::all();

        return ['souscategories'=>$souscategories , 'categories' => $categories];
    }

    public function store_souscategory(Request $request)
    {
        $request->validate([
            'souscategory_name' => ['required', 'string', 'max:255'],
        ]);

        $categorie = SousCategory::create([
            'category_id' => $request->category,
            'souscategory_name' => $request->souscategory_name,
        ]);
    }

    public function update_souscategory(Request $request , String $id)
    {
        $souscategorie = SousCategory::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'souscategory_name' => ['required', 'string', 'max:255'],
        ]);
        

        $souscategorie->category_id = $request->category;
        $souscategorie->souscategory_name = $request->souscategory_name;
       
        $souscategorie->save();
    }


    public function delete_souscategoty(Request $request ,String $id)
    {
        $souscategory =  SousCategory::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'password' => ['required']
        ]);
       

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $souscategory->delete();
        }

       

        
    }





    //crud Program

    public function create_program(){
        $categories = Category::all();

        $programs = Program::all();

      
        return [ 'categories' => $categories , 'programs' => $programs];
    }

    public function store_program(Request $request)
    {

     
        $request->validate([
            'title'=> ['required', 'string', 'max:255'],
            'Description'=> ['required', 'string', 'max:600'],
            'tags'=> ['required', 'array'],
            'categories'=> ['required', 'array']
        ]);

        foreach ($request->tags as $key => $tag) {
            $tags[] = $tag; 
        }

        foreach ($request->categories as $key => $category) {
            $categories[] = $category ;
        }

        $program = Program::create([
            'title' => $request->title,
            'Description' => $request->Description,
            'tags' => $tags,
            'categories' => $categories
        ]);
       

    }

    public function update_program(Request $request , String $id)
    {
        $program = Program::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'title'=> ['required', 'string', 'max:255'],
            'Description'=> ['required', 'string', 'max:600'],
            'tags'=> ['required', 'array'],
            'categories'=> ['required', 'array']
        ]);

        foreach ($request->tags as $key => $tag) {
            $tags[] = $tag; 
        }

        foreach ($request->categories as $key => $category) {
            $categories[] = $category ;
        }

        $program->title = $request->title;
        $program->Description = $request->Description;
        $program->tags = $tags;
        $program->categories = $categories;

        $program->save();



    }

    public function delete_program(Request $request,String $ig)
    {
        $program = Program::findOrFail(Crypt::decrypt($id));

        
        $request->validate([
            'password' => ['required']
        ]);
       

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $program->delete();
        }
      
    }


    //crud goals

    public function create_goals()
    {
        $goals = Goal::paginate(10);

        $souscategory = SousCategory::all();

        return ['goals' =>  $goals , 'souscategory' => $souscategory];
    }


    public function store_goals(Request $request)
    {
        $request->validate([
            'goals' =>  ['required', 'string', 'max:255'],
        ]);

        foreach ($request->souscatgory as $key => $souscatgory) {
            $goal = Goal::create([
                'souscategory_id' => $souscatgory,
                'goals' => $request->goals,
    
            ]);
    
        }

        

       
    }


    public function delete_goals(Request $request , String $id)
    {
        $goal = Goal::findOrFail(Crypt::decrypt($id));

        $goalsDelete = Goal::where('goals' , $goal->goals)->get();

        
        $request->validate([
            'password' => ['required']
        ]);
       

        if(Hash::check( $request->password, Auth::user()->password ))
        {

            foreach ($goalsDelete as $key => $goals) {
                $goals->delete();
            } 
           
        }
    }


    public function update_goals(Request $request , String $id)
    {
        $goal = Goal::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'goals' => ['required', 'string', 'max:255'],
        ]);


        $goal->souscategory_id = $request->souscatgory;
        $goal->goals = $request->goals;

        $goal->save();

    }


    //crud cours 

    public function index_cours()
    {
        $cours = Cour::paginate(6);

        return view('Cours.show.Cours')->with('cours' , $cours);
    }


    public function show_cour(String $id)
    {
        $Cour = Cour::findOrFail(Crypt::decrypt($id));


        $souscategory = SousCategory::distinct()->get(['category_id']);

        $GoalIds[] = $Cour->gaols_id;
            
            foreach ($GoalIds as $key => $GoalId) {
                $CoursGols = Goal::where('id' , $GoalId)->get();  
            }

       


        if($Cour->cours_type == 'conference'){
            
            //cours Conference
            $coursCoference = CoursConference::where('cours_id' , $Cour->id)->first();
            
            $ConfrenceGuest = CoursConferenceGuest::whereIn('coursconferencevideo_id' , $coursCoference->ConferenceVideo->pluck('id'))
            ->get();

            
            
            $HostConfrence = UserSpeakers::where('type_speaker' , 'Modérateur')->get();
            $GuestConfrence = UserSpeakers::where('type_speaker' , 'Conférencier')->get();
            
            
            
            return view('Cours.detail.conference')->with(['Cour' => $Cour , 
            'coursCoference' =>$coursCoference , 'ConfrenceGuest' => $ConfrenceGuest , 
            'souscategory' => $souscategory , 'CoursGols' =>$CoursGols ,
            'HostConfrence' => $HostConfrence , 'GuestConfrence' => $GuestConfrence]);

        }elseif ($Cour->cours_type == 'podcast') {
            
            //Cours Podcast
            
            $coursPodcast = CoursPodcast::where('cours_id' , $Cour->id)->first();

            $podcastVideoId = $coursPodcast->videopodcast->pluck('id');

            
            $PodcastGuest = CoursPadcastGuest::whereIn('podcastvideo_id' , $podcastVideoId)
            ->get();

            $HostPodcast = UserSpeakers::where('type_speaker' , 'Animateur')->get();
            $GuestPodcastAll = UserSpeakers::where('type_speaker' , 'Invité')->get();


            return view('Cours.detail.podcast')->with(['Cour' => $Cour , 
            'coursPodcast' =>$coursPodcast , 'PodcastGuest' => $PodcastGuest , 
            'souscategory' => $souscategory , 'CoursGols' => $CoursGols , 
            'HostPodcast' => $HostPodcast , 'GuestPodcastAll' => $GuestPodcastAll]);
        
        }elseif ($Cour->cours_type == 'formation') {

             //Cours Formation
             $coursFormation = CoursFormation::where('cours_id' , $Cour->id)->first();
             $programs = Program::all();
             $HostFromateur = UserSpeakers::where('type_speaker' , 'Formateur')->get();
             //Qsm
             $Qsm = QuizSeccess::where('cours_id' , $Cour->id)->get();
             //Questionnaire
             $Questions = QuizQuestion::where('cours_id' , $Cour->id)->get();


            return view('Cours.detail.formation')->with(['Cour' => $Cour , 
            'coursFormation' =>$coursFormation ,'Qsm' => $Qsm , 'programs' => $programs,
            'CoursGols' => $CoursGols ,  'souscategory' => $souscategory ,
            'HostFromateur' => $HostFromateur , 'Questions' => $Questions
        ]);

        } 

    }

    public function create_cours()
    {
        $souscategory = SousCategory::distinct()->get(['category_id']);

        $HostConfrence = UserSpeakers::where('type_speaker' , 'Modérateur')->get();

        $HostPodcast = UserSpeakers::where('type_speaker' , 'Animateur')->get();

        $HostFormation = UserSpeakers::where('type_speaker' , 'Formateur')->get();

        $Programs = Program::all();


        return ['souscategory' =>$souscategory , 'HostConfrence' => $HostConfrence , 'HostPodcast' => $HostPodcast 
        , 'HostFormateur' => $HostFormation , 'Programs' => $Programs] ;
    }

    public function getGoalsBySousCategorie(String $id)
    {
        $goals = Goal::where('souscategory_id', $id)->get();

        return response()->json(['goals' => $goals]);
    }



    //store cours
    public function store_cours(Request $request)
    {

        if($request->coursType == 'conference'){

            $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:300'],
                'cotegoryId' =>  ['required', 'string', 'max:255'],
                'gaols_id' => ['required'],
                'tags' => ['required'],
                'coursType' => ['required', 'string', 'max:255'],
                'hostConference' => ['required'],
                'descriptionConference' => ['required', 'string', 'max:600'],
            ]);

            if ($request->iscoming == 'on') {
                $iscoming = true;
             }else{
                 $iscoming = false;
             }
    
     
             if ($request->isActive == 'on') {
                 $isActive = true;
             }else{
                 $isActive = false;
             }


            
             foreach ($request->gaols_id as $key => $goal) {
                $goals[] = $goal;
            }

           $StringTag = $request->tags[0];

           $tags = explode(',', $StringTag);

           $tags = array_map('trim', $tags);

           
            $cours = Cour::create([
                'title' => $request->title,
                'isComing' => $iscoming,
                'isActive' => $isActive,
                'description' => $request->description,
                'category_id' => $request->cotegoryId,
                'gaols_id' => $goals,
                'tags' => $tags,
                'cours_type' => $request->coursType,
            ]);

            
    
            $coursCoference = CoursConference::create([
                'cours_id' => $cours->id,
                'host_id' => $request->hostConference,
                'duration' => $request->coursDuration,
                'description' => $request->descriptionConference
            ]);
    
    
            return redirect()->route('dashboard.create.video', Crypt::encrypt($coursCoference->id) );

        }elseif ($request->coursType == 'podcast') {
           
            $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:300'],
                'cotegoryId' =>  ['required', 'string', 'max:255'],
                'gaols_id' => ['required', 'array'],
                'tags' => ['required', 'array'],
                'coursType' => ['required', 'string', 'max:255'],
                'hostPodcast' => ['required'],
                'slugAcroche' => ['required', 'string', 'max:255'],
                'descriptionPodcast' => ['required', 'string', 'max:600'],
            ]);


            if ($request->iscoming == 'on') {
                $iscoming = true;
             }else{
                 $iscoming = false;
             }
    
     
             if ($request->isActive == 'on') {
                 $isActive = true;
             }else{
                 $isActive = false;
             }
    
             foreach ($request->gaols_id as $key => $goal) {
                $goals[] = $goal;
            }
        
    
            $StringTag = $request->tags[0];

            $tags = explode(',', $StringTag);
 
            $tags = array_map('trim', $tags);

           

            $cours = Cour::create([
                'title' => $request->title,
                'isComing' => $iscoming,
                'isActive' => $isActive,
                'description' => $request->description,
                'category_id' => $request->cotegoryId,
                'gaols_id' => $goals,
                'tags' => $tags,
                'cours_type' => $request->coursType,
            ]);

            $coursPodcast = CoursPodcast::create([
                'cours_id' => $cours->id,
                'host_id' => $request->hostPodcast,
                'duration' => $request->DurationPdcast,
                'description' => $request->descriptionPodcast,
                'slug' => $request->slugAcroche
            ]);


            return redirect()->route('dashboard.podacast.video', Crypt::encrypt($coursPodcast->id) );
 
        }elseif($request->coursType == 'formation'){
           
            $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:300'],
                'cotegoryId' =>  ['required', 'string', 'max:255'],
                'tags' => ['required', 'array'],
                'gaols_id' => ['required', 'array'],
                'coursType' => ['required', 'string', 'max:255'],
                'hostFormation' => ['required'],
                'programId' => ['required'],
                'conditionformation' => ['required', 'string', 'max:600'],
            ]);


            if ($request->iscoming == 'on') {
                $iscoming = true;
             }else{
                 $iscoming = false;
             }
    
     
             if ($request->isActive == 'on') {
                 $isActive = true;
             }else{
                 $isActive = false;
             }
    
             foreach ($request->gaols_id as $key => $goal) {
                $goals[] = $goal;
            }

    
             if($request->iscertify == 'on'){
                $iscertify = true;
             }else{
                $iscertify = false;
             }
    
             $StringTag = $request->tags[0];

             $tags = explode(',', $StringTag);
  
             $tags = array_map('trim', $tags);

            $cours = Cour::create([
                'title' => $request->title,
                'isComing' => $iscoming,
                'isActive' => $isActive,
                'description' => $request->description,
                'category_id' => $request->cotegoryId,
                'gaols_id' => $goals,
                'tags' => $tags,
                'cours_type' => $request->coursType,
            ]);

            $coursFormation = CoursFormation::create([
                'cours_id' => $cours->id,
                'host_id' => $request->hostFormation,
                'program_id' => $request->programId,
                'condition' => $request->conditionformation,
                'isCertify' => $iscertify
            ]);


           
            if($iscertify == false){
                return redirect()->route('dashboard.create.video.fomation', Crypt::encrypt($coursFormation->id) );
            }else{
                return redirect()->route('dashboard.create.formation.quiz', Crypt::encrypt($cours->id) )
               ;
            }


        }


    }


    //conference cours


    public function getCoursVideo(String $id){

        $conferenceId = Crypt::decrypt($id);

        $Guest = UserSpeakers::where('type_speaker' , 'Conférencier')->get();

        return ['conferenceId' => $conferenceId  , 'Guest' => $Guest ];
    }


    public function update_conference(Request $request)
    {

        $Cour = Cour::find($request->CoursId);
        $coursCoference = CoursConference::where('cours_id', $request->CoursId)->first();


        $request->validate([
            'title' => ['required' , 'string' , 'max:100'],
            'description' => ['required' , 'string' , 'max:300'],
            'tags' => ['required' , 'array'],
            'descriptionConference' => ['required' , 'string' , 'max:600'],
            'cotegoryId' => ['required'],
            'gaols_id' => ['required'],
            'hostConference' => ['required']
        ]);

        $Cour->title = $request->title;

        if ($request->iscoming == 'on') {
            $iscoming = true;
         }else{
             $iscoming = false;
         }


         if ($request->isActive == 'on') {
            $isActive = true;
        }else{
            $isActive = false;
        }

        $Cour->isComing = $iscoming;
        $Cour->isActive = $isActive;


        $Cour->description = $request->description;

        $StringTag = $request->tags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $Cour->tags = $tags;

        $Cour->category_id = $request->cotegoryId;

        foreach ($request->gaols_id as $key => $goal) {
            $goals[] = $goal;
        }

        $Cour->gaols_id = $goals;


        $coursCoference->cours_id = $request->CoursId;
        $coursCoference->host_id = $request->hostConference;
        $coursCoference->description = $request->descriptionConference;
        $coursCoference->duration = $request->coursDuration;


        $Cour->save();
        $coursCoference->save();


        return redirect()->back()->with('status' , 'u have update ');


    }


    public function update_video_conference(String $id , Request $request)
    {
        $video = CoursConferenceVideo::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'titleVideo' => ['required' , 'string' , 'max:100'],
            'descriptionVideo' => ['required' , 'string' , 'max:100'],
            'guestIds' => ['required'],
            'videoTags' => ['required'],
            'videoduration' => ['required']
        ]);

        $StringTag = $request->videoTags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);


        $video->coursconference_id = $request->confrenceId;
        $video->title = $request->titleVideo;
        $video->description = $request->descriptionVideo;
        $video->tags = $tags;
        $video->duration = $request->videoduration;
        
        $video->guestvideo()->forceDelete();
        
        foreach ($request->guestIds as $guestId) {
            $video->guestvideo()->create(['guest_id' => $guestId]);
        
        }
        $video->save();

        return redirect()->back()->with('status' , 'u have update video');

    }
    


    public function store_video(Request $request){

       
        $request->validate([
            'titleVideo' => ['required', 'string', 'max:255'],
            'descriptionVideo'  => ['required', 'string', 'max:100'],
            'videoTags' => ['required', 'array'],
            'guestIds' => ['required']
        ]);
        
        
        $StringTag = $request->videoTags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);


        $conferenceVideos = CoursConferenceVideo::create([
            'coursconference_id' => $request->confrenceId,
            'title' => $request->titleVideo,
            'description' => $request->descriptionVideo,
            'tags' => $tags,
            'duration' => $request->videoduration
        ]);

        foreach ($request->guestIds as $key => $guest) {
            $guestVideo = CoursConferenceGuest::create([
                'coursconferencevideo_id' => $conferenceVideos->id,
                'guest_id' => $guest
            ]);
        }

        $output = '';

        $getConferenceVideos = CoursConferenceVideo::where('coursconference_id' , $request->confrenceId)->get();

        foreach ($getConferenceVideos as $key => $video) {

            $output .= view('Cours.create.conference.videoCrad')->with(['video' => $video , 'guestVideo' => $guestVideo ])->render();
        }
       

        return response()->json(['output' => $output]);

    }


    public function delete_video(String $id){

        $video = CoursConferenceVideo::findOrFail(Crypt::decrypt($id));

        $guests = CoursConferenceGuest::where('coursconferencevideo_id', $video->id)->get();

        foreach ($guests as $key => $guest) {
            $guest->delete();
        }
       
        $video->delete();

        return response()->json(['message' => 'CoursConferenceVideo and associated records deleted successfully']);

    }

    public function delete_video_update(String $id , Request $request){

        $video = CoursConferenceVideo::findOrFail(Crypt::decrypt($id));


    
        if(Hash::check( $request->password, Auth::user()->password )){
            $video->delete();

            $video->guestvideo()->Delete();
    
            return redirect()->back()->with('status' , 'u have deleted video');
        }else{
            return redirect()->back()->with('status' , 'u password is incorrect');
        }

      

    }
    




    // podcast cours

    public function getPodcastVideo(String $id)
    {
        $podcastId = Crypt::decrypt($id);

        $GuestPodcast = UserSpeakers::where('type_speaker' , 'Invité')->get();

        return ['podcastId' => $podcastId   , 'GuestPodcast' => $GuestPodcast];

    }

    public function update_podcast(String $id , Request $request)
    {
        $Cour = Cour::findOrFail(Crypt::decrypt($id));
        $CourPodcast = CoursPodcast::where('cours_id' , $Cour->id)->first();
        

        $request->validate([
            'title' => ['required' , 'string' , 'max:100'],
            'description' => ['required' , 'string' , 'max:300'],
            'tags' => ['required' , 'array'],
            'cotegoryId' => ['required' , 'string'],
            'gaols_id' => ['required' , 'array'],
            'slugAcroche' => ['required' , 'string' , 'max:100'],
            'descriptionPodcast' => ['required' , 'string' , 'max:600'],
        ]);

        $Cour->title = $request->title;

        if ($request->iscoming == 'on') {
            $iscoming = true;
         }else{
             $iscoming = false;
         }


         if ($request->isActive == 'on') {
            $isActive = true;
        }else{
            $isActive = false;
        }

        $Cour->isComing = $iscoming;
        $Cour->isActive = $isActive;

        $Cour->description = $request->description;

        $StringTag = $request->tags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $Cour->tags = $tags;
        $Cour->category_id = $request->cotegoryId;

        foreach ($request->gaols_id as $key => $goal) {
            $goals[] = $goal;
        }


        $Cour->gaols_id = $goals;
        $CourPodcast->host_id = $request->hostPodcast;
        $CourPodcast->slug = $request->slugAcroche;
        $CourPodcast->description = $request->descriptionPodcast;
        $CourPodcast->duration = $request->duration;

        $Cour->save();
        $CourPodcast->save();

        return redirect()->back()->with('status' , 'u have update');



    }


    public function store_videoPodacast(Request $request){

       
        $request->validate([
            'titleVideo' => ['required', 'string', 'max:255'],
            'descriptionVideo'  => ['required', 'string', 'max:100'],
            'videoTags' => ['required', 'array'],
            'guestIds' => ['required']
        ]);

        foreach ($request->videoTags as $key => $videoTag) {
            $videoTags[] = $videoTag;
        }


        $conferenceVideos = CoursPadcastVideo::create([
            'podacast_id' => $request->podcastId,
            'title' => $request->titleVideo,
            'description' => $request->descriptionVideo,
            'tags' => $videoTags,
            'duration' => $request->videoduration
        ]);

        foreach ($request->guestIds as $key => $guest) {
            $guestVideo = CoursPadcastGuest::create([
                'podcastvideo_id' => $conferenceVideos->id,
                'guest_id' => $guest
            ]);
        }

        $output = '';

        $getPodcastVideos = CoursPadcastVideo::where('podacast_id' , $request->podcastId)->get();

        foreach ($getPodcastVideos as $key => $video) {

            $output .= view('Cours.create.podcast.videoCard')->with(['video' => $video , 'guestVideo' => $guestVideo ])->render();
        }
       

        return response()->json(['output' => $output]);

    }


    public function update_video_podcast(String $id , Request $request)
    {
        $videoPodcast = CoursPadcastVideo::findOrFail(Crypt::decrypt($id));


        $request->validate([
            'titleVideo' => ['required' , 'string' , 'max:100'],
            'descriptionVideo' => ['required' , 'string' , 'max:100'],
            'videoTags' => ['required' , 'array'],

        ]);


        $StringTag = $request->videoTags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $videoPodcast->title = $request->titleVideo;
        $videoPodcast->description = $request->descriptionVideo;
        $videoPodcast->tags = $tags;

        
        
        $videoPodcast->guestvideo()->forceDelete();

        foreach ($request->guestIds as $guestId) {
            $videoPodcast->guestvideo()->create(['guest_id' => $guestId]);
        
        }

        $videoPodcast->save();


        return redirect()->back()->with('status' , 'u have updated podcast');


    }


    public function delete_video_podcast(String $id){

        $video = CoursPadcastVideo::findOrFail(Crypt::decrypt($id));

        // Delete associated guest videos first
        $guests = CoursPadcastGuest::where('podcastvideo_id', $video->id)->get();

        foreach ($guests as $key => $guest) {
            $guest->forceDelete();
        }
    
        // Now delete the CoursConferenceVideo instance
        $video->forceDelete();

        return response()->json(['message' => 'CoursPodcastVideo and associated records deleted successfully']);

    }


    public function deleteVidoe_podcast_update(String $id , Request $request){

        $video = CoursPadcastVideo::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password )){
            $video->delete();

            foreach ($$video->guestvideo() as $key => $guest) {
                $guest->Delete();
            }

            
    
            return redirect()->back()->with('status' , 'u have deleted video');
        }else{
            return redirect()->back()->with('status' , 'u password is incorrect');
        }

    }


    // cours fomation

    public function update_formation(String $id , Request $request)
    {
        $Cour = Cour::findOrFail(Crypt::decrypt($id));

        $coursFormation = CoursFormation::where('cours_id' , $Cour->id)->first();

        $request->validate([
            'title' => ['required' , 'string' , 'max:100'],
            'description' => ['required' , 'string' , 'max:300'],
            'tags' => ['required' , 'array'],
            'cotegoryId' => ['required' , 'string'],
            'gaols_id' => ['required' , 'array'],
            'conditionformation' => ['required' , 'string' , 'max:600'],
        ]);


        $Cour->title = $request->title;

        if ($request->iscoming == 'on') {
            $iscoming = true;
         }else{
             $iscoming = false;
         }


         if ($request->isActive == 'on') {
            $isActive = true;
        }else{
            $isActive = false;
        }

        $Cour->isComing = $iscoming;
        $Cour->isActive = $isActive;

        $Cour->description = $request->description;

        $StringTag = $request->tags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $Cour->tags = $tags;
        $Cour->category_id = $request->cotegoryId;

        foreach ($request->gaols_id as $key => $goal) {
            $goals[] = $goal;
        }


        $Cour->gaols_id = $goals;

        $coursFormation->condition = $request->conditionformation;
        $coursFormation->host_id = $request->hostPodcast;
        $coursFormation->program_id = $request->programId;
        

        $Cour->save();
        $coursFormation->save();
        

        return redirect()->back()->with('status' , 'u have updated formation');


    }


    public function getvideoformation(String $id)
    {
        $formationId = Crypt::decrypt($id);

        return ['formationId' => $formationId];
    }

    public function create_video_formation(String $id)
    {
        $courId = Cour::findOrFail(Crypt::decrypt($id));

        return view('Cours.create.fomation.formationvideo')->with('courId' , $courId);
    }


    //update video formation
    public function update_video_formation(String $id,Request $request){

        $videoforamtion = CoursFormationVideo::findOrFail(Crypt::decrypt($id));
        
        
        $request->validate([
            'titleVideo' => ['required' , 'string' , 'max:100'],
            'descriptionVideo' => ['required' , 'string' , 'max:100'],
            'videoTags' => ['required' , 'array'],

        ]);


        $StringTag = $request->videoTags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $videoforamtion->title = $request->titleVideo;
        $videoforamtion->description = $request->descriptionVideo;
        $videoforamtion->tags = $tags;

        $videoforamtion->save();


        return redirect()->back()->with('status' , 'u have updated video formation');

    }


    public function store_video_formation(Request $request)
    {

        $courFormationId = $request->courFormationId;

        $request->validate([
            'titleVideo' => ['required' , 'string' , 'max:100'],
            'descriptionVideo' => ['required' , 'string' , 'max:100'],
            'videoTags' => ['required' , 'array'],
        ]);


        $StringTag = $request->videoTags[0];

        $tags = explode(',', $StringTag);
 
        $tags = array_map('trim', $tags);

        $video = CoursFormationVideo::create([
        'CourFormation_id' => $courFormationId,
        'title' => $request->titleVideo,
        'description' => $request->descriptionVideo,
        'tags'=> $tags
        ]);

        $output = '';

        $getFormationtVideos = CoursFormationVideo::where('CourFormation_id' , $courFormationId)->get();

        foreach ($getFormationtVideos as $key => $video) {

            $output .= view('Cours.create.fomation.CardVideo')->with(['video' => $video ])->render();
        }
       

        return response()->json(['output' => $output]);
        
        
    }

    //delete video formation

    public function delete_video_formation(String $id)
    {
        $video = CoursFormationVideo::findOrFail(Crypt::decrypt($id));

        $video->forceDelete();

        return response()->json(['message' => 'Cours Formation Video has been deleted']);

    }

    //delete updated video formation

    public function delete_update_video_formation(String $id , Request $request){
        $video = CoursFormationVideo::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password )){
            
            $video->delete();
    
            return redirect()->back()->with('status' , 'u have deleted video formation');
        }else{
            return redirect()->back()->with('status' , 'u password is incorrect');
        }
    }

    public function update_quiz_formation(String $id , Request $request)
    {
        $Qsm = QuizSeccess::findOrFail(Crypt::decrypt($id));

        $Question = Question::where('id' , $Qsm->question_id)->first();
        $RightAnswer = Answer::where('id' , $Qsm->answer_id)->first();

        $request->validate([
                'Question' => ['required' , 'string' , 'max:200'],
                'RightAwnser' => ['required' , 'string' , 'max:200'],
                'Rate' => ['required' , 'integer' ],
                'count' => ['required' , 'integer'],
                'awnser' => ['required']
            ]);


            $Question->question = $request->Question;
            $RightAnswer->Answer = $request->RightAwnser;
            $Qsm->rateSeccess = $request->Rate;
            $Qsm->Answercount = $request->count;
            
            $answersData = $request->input('awnser', []);
            
            foreach ($Qsm->Question->Answers as $index => $Answer) {
                if (isset($answersData[$index])) {
                    $Answer->answer = $answersData[$index];
                    $Answer->save();
                }
            }
            

            $RightAnswer->save();
            $Question->save();
            $Qsm->save();

            return redirect()->back()->with('status' , 'u have updated quiz');


    }


    // update Question Formation

    public function update_Question_formation(String $id ,Request $request)
    {

        $Questionnair = QuizQuestion::findOrFail(Crypt::decrypt($id));
        $request->validate([
            'Question' => ['required' , 'string' , 'max:200'],
        ]);


        $Questionnair->Question = $request->Question;

        $Questionnair->save();
        
        return redirect()->back()->with('status' , 'updated Questionnair');
    }


    public function create_quiz_formation( String $id){
        $courId = Crypt::decrypt($id);
        $coursFormationId = CoursFormation::where('cours_id' , $courId)->first();

       
        return view('Cours.create.fomation.quiz')->with(['courId' => $courId ,
        'coursFormationId' => $coursFormationId]);
    }

    public function store_quiz_formation(Request $request)
    {
        $courId = $request->courId;

        $request->validate([
            'Question' => ['required' , 'string' , 'max:200'],
            'RightAwnser' => ['required' , 'string' , 'max:200'],
            'Rate' => ['required' , 'integer'],
            'count' => ['required' , 'integer']
        ]);

        if($request->Rate < $request->count){
    
            $Question = Question::create([
                'question' => $request->Question
            ]);
    
            $RightAnswer = Answer::create([
                'Question_id' => $Question->id,
                'Answer' => $request->RightAwnser
            ]);
    
            $allAnswers = $request->awnser;
    
            foreach ($allAnswers as $key => $Answer) {
                $Answers =  Answer::create([
                    'Question_id' => $Question->id,
                    'Answer' => $Answer
                ]);
            }
    
            $QuizSeccess = QuizSeccess::create([
                'cours_id' => $courId,
                'question_id' => $Question->id,
                'answer_id' => $RightAnswer->id,
                'rateSeccess' => $request->Rate,
                'Answercount' => $request->count
            ]);
    
    
            $output = "";
            
            $output .=view('Cours.create.fomation.cardQuiz')->with(['Question' => $Question])->render();
    
            return response()->json([$output]);

        }else{
            return response()->json(['message' => 'Erreur']);
        }

        
    }

    public function store_quiz_qustion(Request $request){
        $courId = $request->courId;



        $request->validate([
            'Question' => ['required']
        ]);

        $Questions = $request->Question;

        

        foreach ($Questions as $key => $Question) {
          
            $createdQuestion = QuizQuestion::create([
                'cours_id' => $courId,
                'Question' => $Question
            ]);
    
        }

        $getCreatedQuestion = QuizQuestion::where('cours_id' , $request->courId)->get();
        $output = '';

        $output = view('Cours.create.fomation.cardQuestion', ['questions' => $getCreatedQuestion])->render();

        return response()->json([$output]);

       
    }



    public function delete_Qsm_formation(String $id)
    {
        $question = Question::findOrFail(Crypt::decrypt($id));

        $question->Answers()->forceDelete(); 
        $question->QuizSeccess()->forceDelete();

        $question->forceDelete();

        return response()->json(['message' => 'Answer deleted successfully'], 200);
    }


    //delete updated Qsm
    public function delete_Qsm_updated_formation(String $id , Request $request)
    {

        $Qsm = Question::findOrFail(Crypt::decrypt($id));

       

        if(Hash::check( $request->password, Auth::user()->password )){

            $Qsm->Answers()->delete(); 
            $Qsm->QuizSeccess()->delete();
    
            $Qsm->delete();
    
            return redirect()->back()->with('status' , 'u have deleted video');
        }else{
            return redirect()->back()->with('status' , 'u password is incorrect');
        }
    }


    public function delete_Qustion_farmation(String $id)
    {
        $Question = QuizQuestion::findOrFail(Crypt::decrypt($id));


        $Question->forceDelete();

        return response()->json(['message' => 'Question deleted successfully'], 200);
    }

    //delete Questionnair Formation
    public function delete_Question_updated_formation(String $id , Request $request)
    {

        $Question = QuizQuestion::findOrFail(Crypt::decrypt($id));
       
        if(Hash::check( $request->password, Auth::user()->password )){

            $Question->delete(); 
    
            return redirect()->back()->with('status' , 'u have deleted Question');

        }else{

            return redirect()->back()->with('status' , 'u password is incorrect');

        }
    }


    //crud tickets
    public function create_tickets()
    {
        $users = UserRole::where('role_id' , 4)->get();
        $tickets = Ticket::all();

        return view('Tickets.create')->with(['users' => $users , 'tickets' => $tickets]);
    }

    public function store_ticket(Request $request)
    {
        $request->validate([
            'type_ticket' => ['required' , 'string' , 'max:100'],
            'user' => ['required'],
            'detail' => ['required' , 'string' , 'max:500']
        ]);

        $ticket = Ticket::create([
            'user_id' => $request->user,
            'manager_id' => Auth::user()->id,
            'Type_Ticket' => $request->type_ticket,
            'status' => false,
            'detail' => $request->detail,
        ]);

        return redirect()->back()->with('status' , 'Vous avez Crée Ticket');
    }

    public function edite_ticket(String $id)
    {
        $ticket = Ticket::findOrFail(Crypt::decrypt($id));

        $personnaleTicket = CommentTicket::where(['user_id' => Auth::user()->id , 'ticket_id' => $ticket->id])->first(); 

        $outhertickets = CommentTicket::whereNot('id' , $personnaleTicket->id)->get();

        $userclients = UserRole::where('role_id' , 4)->get();


        return view('Tickets.edite')->with(['ticket' => $ticket , 
        'userclients' => $userclients , 'personnaleTicket' => $personnaleTicket ,   'outhertickets' => $outhertickets]);
    }

    public function update_ticket(String $id , Request $request)
    {
        
        $ticket = Ticket::findOrFail(Crypt::decrypt($id));
        
        $personnaleTicket = CommentTicket::where(['user_id' => Auth::user()->id , 'ticket_id' => $ticket->id])->first(); 
        $request->validate([
            'type' => ['required' , 'string' , 'max:100'],
            'userClient' => ['required'],
            'status' => ['required' , 'boolean' ],
            'detail' => ['required' , 'string' , 'max:500'],
        ]);


    
        $ticket->Type_Ticket = $request->type;
        $ticket->manager_id = Auth::user()->id;
        $ticket->status = $request->status;
        $ticket->detail = $request->detail;
        $personnaleTicket->comment = $request->comment;

        $ticket->save();
        $personnaleTicket->save();

        return redirect()->back()->with('status' , 'Vous Modifier Votre Ticket');

    }

    public function store_ticketComment(String $id , Request $request)
    {


        $ticket = Ticket::findOrFail(Crypt::decrypt($id));
        
        $personnaleTicketupdate = CommentTicket::where(['user_id' => Auth::user()->id , 'ticket_id' => $ticket->id])->first();
        $personnaleTicket = CommentTicket::where(['user_id' => Auth::user()->id , 'ticket_id' => $ticket->id])->exists();
        


        if($personnaleTicket){
            $personnaleTicketupdate->update([
                'comment' => $request->comment
            ]);
        }else{
            $ticketComment = CommentTicket::create([
                'user_id' => Auth::user()->id,
                'ticket_id' => $ticket->id,
                'comment' => $request->comment
            ]);
        }

       

        return redirect()->back();

    }


    //FAQ

    public function FAQ_edite()
    {

        $FAQs = FAQ::all();

        return view('FAQ.faq')->with('FAQs' , $FAQs);
    }

    public function FAQ_store(Request $request)
    {
        $request->validate([
            'Question' => ['required' , 'string' , 'max:255'],
            'answer' => ['required' , 'string' , 'max:500']
        ]);

        $FAQ = FAQ::create([
            'question' => $request->Question,
            'answer' => $request->answer
        ]);


        return redirect()->back()->with('status' , 'Vous Avez Crée FAQ');
    }

    public function FAQ_update(Request $request , String $id)
    {
        $FAQ = FAQ::findOrFail(Crypt::decrypt($id));

        $FAQ->update([
            'question' => $request->Question,
            'answer' => $request->answer
        ]);

        return redirect()->back()->with('status' , 'Vous Avez Modifier FAQ');
    }


    //emails

    public function Create_email()
    {
        return view('SendEmail.email');
    }

    public function send_emails(Request $request)
    {

        $requestemail = $request->all();

        foreach ($variable as $key => $value) {
            # code...
        }
       
       Mail::To($requestemail['users'])->send(new sendemail($requestemail));

       return redirect()->back()->with('status', 'Vous avez Envoyer l\'Email');

    }





}
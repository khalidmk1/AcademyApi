<?php


use Illuminate\Support\Facades\Route;

/* use App\Http\Controllers\Auth\EmailVerificationPromptController; */
use App\Http\Controllers\FAQController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Cours\CoursController;
use App\Http\Controllers\Users\AdminController;

use App\Http\Controllers\PorfileEditeController;
use App\Http\Controllers\Fileter\GoalsController;
use App\Http\Controllers\Users\ManagerController;

use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\Users\SpeakersController;
use App\Http\Controllers\Fileter\ProgramController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Fileter\CategoriesController;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Fileter\SousCategoryController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('Component.Auth.login');
}); */

Route::post('roles/create', [RolesController::class, 'store'])->name('roles.store');

Route::middleware(['auth' ])->group(function () {
    //change password
    Route::get('/password-change', [PorfileEditeController::class, 'edit_password'])->name('password.change');
    Route::patch('password/change', [PorfileEditeController::class, 'password_change'])->name('password-change.update');
});

Route::get('verify/email', [AuthenticatedSessionController::class, 'email_verify'])
->middleware('isSpeaker')
->name('email.verify');

Route::middleware('auth'  , 'verified' ,'passwordChange' , 'isSpeaker' )->name('dashboard.')->prefix('/backoffice')->group(function () {
   Route::get('/authCount', [ReportController::class, 'authCount'])->name('auth.count');
   Route::get('/FilterCount', [ReportController::class, 'FilterCount'])->name('filter.count');

   //report analyse
   Route::get('', [ReportController::class, 'index'])->name('index');

   //search functionality
   Route::get('search/pofile', [PorfileEditeController::class, 'search_profile'])->name('search.profile');
   Route::get('search/role', [RolesController::class, 'search_role'])->name('search.role');
   Route::get('search/category', [CategoriesController::class, 'search_categorie'])->name('search.categorie');
   Route::get('search/goals', [GoalsController::class, 'search_goals'])->name('search.goals');
   Route::get('search/soucategory', [SousCategoryController::class, 'search_souscategory'])->name('search.goals');
   

   //crud of profile of admin
   Route::get('edit/{id}', [PorfileEditeController::class, 'edit_profile'])->name('profile.edit');
   Route::patch('update/{id}', [PorfileEditeController::class, 'update_profile'])->name('profile.update');
   Route::patch('password/update', [PorfileEditeController::class, 'password_update'])->name('password.update');
   
   /* Route::post('profile/delete/{id}', [PorfileEditeController::class, 'delet_profile'])->name('profile.delete'); */

   //crud of roles
   Route::get('roles', [RolesController::class, 'index'])->name('roles.index');
   Route::post('roles/create', [RolesController::class, 'store'])->name('roles.store');
   
   
   //crud permission
   Route::get('permission', [PermissionController::class, 'create_permission'])->name('premission.create');
   Route::post('permission/store', [PermissionController::class, 'store_permission'])->name('premission.store');
   
   //crud manager
   Route::get('manager', [ManagerController::class, 'create_manager'])->name('manager.create'); 
   Route::post('manager/store', [ManagerController::class, 'store_manager'])->name('manager.store'); 
   Route::get('view/managers', [ManagerController::class, 'view_manager'])->name('manager.view');
   Route::delete('delete/manager/{id}', [ManagerController::class, 'delete_manager'])->name('manager.delete');

   //crud spearkers
   Route::get('speaker', [SpeakersController::class, 'create_speakers'])->name('speaker.create');
   Route::post('speaker/store', [SpeakersController::class, 'store_speaker'])->name('speaker.store');
   Route::get('view/speaker', [SpeakersController::class, 'view_speakers'])->name('speaker.view');
   Route::post('speaker/delete/{id}', [SpeakersController::class, 'delete_speaker'])->name('delete.speaker');

   //crud admin
   Route::get('admin', [AdminController::class, 'create_admin'])->name('admin.create');
   Route::post('admin/store', [AdminController::class, 'store_admin'])->name('admin.store');
   Route::get('admin/view', [AdminController::class, 'view_admin'])->name('view.admin');
   Route::delete('delete/admin/{id}', [AdminController::class, 'delete_admin'])->name('delete.admin');

   // store and update role permission
   Route::post('role-permission/{role}/{permission}', [RolePermissionController::class, 'store_role_permission'])->name('manage.role_permission');
   
   //crud category
   Route::get('category', [CategoriesController::class, 'create_category'])->name('category.create');
   Route::post('category/store', [CategoriesController::class, 'store_category'])->name('category.store');
   Route::patch('category/update/{id}', [CategoriesController::class, 'update_category'])->name('category.update');
   Route::post('category/delete/{id}', [CategoriesController::class, 'delete_category'])->name('category.delete');

   //crud souscategorie
   Route::get('souscategory', [SousCategoryController::class, 'create_souscategory'])->name('souscategorie.create');
   Route::post('souscategory/store', [SousCategoryController::class, 'store_souscategorie'])->name('souscategorie.store');
   Route::patch('souscategory/update/{id}', [SousCategoryController::class, 'update_souscategory'])->name('souscategory.update');
   Route::post('souscategorie/delete/{id}', [SousCategoryController::class, 'delete_souscategoty'])->name('souscategorie.delete');


   //crud Program
   Route::get('program', [ProgramController::class, 'create_program'])->name('program.create');
   Route::post('program/store', [ProgramController::class, 'store_program'])->name('program.store');
   Route::patch('program/update/{id}', [ProgramController::class, 'update_program'])->name('program.update');

   //crud goals
   Route::get('goals', [GoalsController::class, 'create_goals'])->name('goals.create');
   Route::post('goals/create', [GoalsController::class, 'store_goals'])->name('goals.store');
   Route::patch('goals/update/{id}', [GoalsController::class, 'update_goals'])->name('goals.update');
   Route::post('goals/delete/{id}', [GoalsController::class, 'delete_goals'])->name('goals.delete');

   //crud cours
   Route::get('Cours', [CoursController::class, 'index_cours'])->name('cours.index');
   Route::get('Cours/{id}', [CoursController::class, 'show_cour'])->name('cours.show');
   Route::get('cours/create', [CoursController::class, 'create_cours'])->name('cours.create');
   Route::get('goals-bySouscategory/{id}', [CoursController::class, 'getGoalsBySousCategorie'])->name('goals.Souscategory');
   Route::post('cours/store', [CoursController::class, 'store_cours'])->name('cours.store');

   //Conference video
   Route::get('video/{id}', [CoursController::class, 'getCoursVideo'])->name('create.video');
   Route::post('video/store', [CoursController::class, 'store_video'])->name('store.video');
   Route::patch('vidoe/update/{id}', [CoursController::class, 'update_video_conference'])->name('update.video');
   //update Conference 
   Route::patch('cours/conference', [CoursController::class, 'update_conference'])->name('update.conference');

   //delete video conference
   Route::post('delete/video/{id}', [CoursController::class, 'delete_video'])->name('delete.video');
   Route::delete('delete/update/{id}', [CoursController::class, 'delete_video_update'])->name('delete.updated.video');

   //Podcast video
   Route::get('video/podcast/{id}', [CoursController::class, 'getPodcastVideo'])->name('podacast.video');
   Route::post('podcast/video/store', [CoursController::class, 'store_videoPodacast'])->name('store.video.podcast');

   //update Podcast
   Route::patch('update/podcast/{id}', [CoursController::class, 'update_podcast'])->name('update.podcast');
   //update podcast video
   Route::patch('podcast/video/update/{id}', [CoursController::class, 'update_video_podcast'])->name('update.podcast.video');

   //delete video podcast
   Route::post('delete/podcast/{id}', [CoursController::class, 'delete_video_podcast'])->name('delete.podcast');
   //delete updated podcast
   Route::delete('delete/update/podcast/{id}', [CoursController::class, 'deleteVidoe_podcast_update'])->name('delete.updated.podcast');

   //update formation 
   Route::Patch('update/formation/{id}', [CoursController::class, 'update_formation'])->name('update.formation');

   //formation video
   Route::get('video/fomation/{id}', [CoursController::class, 'getvideoformation'])->name('formation.video');
   Route::get('formation/video/{id}', [CoursController::class, 'create_video_formation'])->name('create.video.fomation');
   Route::post('store/formation/video', [CoursController::class, 'store_video_formation'])->name('store.video.fomation');

   //update video formation
   Route::patch('update/video/formation/{id}', [CoursController::class, 'update_video_formation'])->name('update.video.formation');
   
   //delete updated video formation
   Route::delete('delete/update/video/formation/{id}', [CoursController::class, 'delete_update_video_formation'])->name('delete.update.video.formation');

   //delete video formation
   Route::post('delete/video/formation/{id}', [CoursController::class, 'delete_video_formation'])->name('delete.video.fomation');
   Route::get('fomation/quiz/{id}', [CoursController::class, 'create_quiz_formation'])->name('create.formation.quiz');
   Route::post('fomation/store/quiz', [CoursController::class, 'store_quiz_formation'])->name('store.formation.quiz');
   //update Qsm quiz formation 
   Route::patch('update/quiz/{id}', [CoursController::class, 'update_quiz_formation'])->name('update.Qsm');

   //update Question quiz formation
   Route::patch('update/Question/{id}', [CoursController::class, 'update_Question_formation'])->name('update.Question');

   Route::post('fomation/store/questionnaire', [CoursController::class, 'store_quiz_qustion'])->name('store.formation.question');

   //delete formation Qsm
   Route::post('delete/Qsm/{id}', [CoursController::class, 'delete_Qsm_formation'])->name('delete.Qsm');

   // delete updated Qsm Formation
   Route::delete('delete/update/Qsm/{id}', [CoursController::class, 'delete_Qsm_updated_formation'])->name('delete.update.Qsm');

   //delete formation Question
   Route::post('delete/Question/{id}', [CoursController::class, 'delete_Qustion_farmation'])->name('delete.Question');
   
   // delete updated Qsm Formation
   Route::delete('delete/update/Qestion/{id}', [CoursController::class, 'delete_Question_updated_formation'])->name('delete.update.Qestion');

   //crud tickets
   Route::get('tickets', [TicketController::class, 'create_tickets'])->name('tickets.create');
   Route::post('tickets/store', [TicketController::class, 'store_ticket'])->name('tickets.store');
   Route::get('tickets/edite/{id}', [TicketController::class, 'edite_ticket'])->name('tickets.edite');
   Route::patch('tickets/update/{id}', [TicketController::class, 'update_ticket'])->name('tickets.update');
   Route::post('comment/ticket/store/{id}', [TicketController::class, 'store_ticketComment'])->name('comment.ticket.store');

   //crud FAQ
   Route::get('FAQ', [FAQController::class, 'FAQ_edite'])->name('FAQ.edite');
   Route::post('FAQ/store', [FAQController::class, 'FAQ_store'])->name('FAQ.store');
   Route::patch('FAQ/update/{id}', [FAQController::class, 'FAQ_update'])->name('FAQ.update');

   //crud email
   Route::get('email', [EmailController::class, 'Create_email'])->name('create.email');
   Route::post('email/send', [EmailController::class, 'send_emails'])->name('email.send');
});





Route::middleware('guest')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login.create');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('user.create');
});







require __DIR__.'/auth.php';

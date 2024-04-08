<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RepositoryInterface\UsersRepositoryInterface;

class FAQController extends Controller
{
    private $userRepository;


    public function __construct(UsersRepositoryInterface  $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function FAQ_edite(){
        return  $this->userRepository->FAQ_edite();
    }

    public function FAQ_store(Request $request)
    {
        return  $this->userRepository->FAQ_store($request);
    }

    public function FAQ_update(Request $request , String $id){
        return  $this->userRepository->FAQ_update($request , $id);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RepositoryInterface\UsersRepositoryInterface;

class EmailController extends Controller
{
    private $userRepository;


    public function __construct(UsersRepositoryInterface  $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function Create_email(){
        return $this->userRepository->Create_email();
    }
    public function send_emails(Request $request){
        return $this->userRepository->send_emails($request);
    }
}

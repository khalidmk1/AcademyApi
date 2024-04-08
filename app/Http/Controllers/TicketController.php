<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RepositoryInterface\UsersRepositoryInterface;

class TicketController extends Controller
{
    private $userRepository;


    public function __construct(UsersRepositoryInterface  $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create_tickets(){
        return $this->userRepository->create_tickets();
    }

    public function store_ticket(Request $request){
        return $this->userRepository->store_ticket($request);
    }

    public function edite_ticket(String $id){
        return $this->userRepository->edite_ticket($id);
    }

    public function update_ticket(String $id , Request $request)
    {
        return $this->userRepository->update_ticket($id ,$request);
    }

    public function store_ticketComment(String $id , Request $request){
        return $this->userRepository->store_ticketComment($id ,$request);
    }
}

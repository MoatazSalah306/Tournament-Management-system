<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventSubscribtion;
use App\Models\Score;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $UserRole = Auth()->user()->role;
            $currentUserId = Auth()->user()->id;
            $usersWithAdmins = User::where("role" , "!=" , "superadmin")->get();
            $users = User::where("role","user")->get();
            $tournaments = Tournament::all();
            $categories = Category::all();
            $events = Event::all();
            $event_subscribtions = EventSubscribtion::all();
            $scores = Score::all();

            return view(
            "dashboard",
            [
                "role"=>$UserRole,
                "userswithadmins" => $usersWithAdmins,
                "users"=>$users,
                "tournaments"=>$tournaments,
                "categories"=>$categories,
                "events"=>$events,
                "event_subscribtions"=>$event_subscribtions,
                "scores"=>$scores,
                "id"=>$currentUserId
            ]
            );  
        }
    }


}

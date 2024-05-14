<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Tournament;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GreaterThanFive implements Rule
{
    public function passes($attribute, $value)
    {
        return intval($value) >= 5;
    }

    public function message()
    {
        return 'The :attribute must be greater than or equal 5.';
    }
}

class Tournamentcontroller extends Controller
{
    public function create(){
        
           try {
            
            $categories = Category::all();
            return view("tournaments.create",["categories"=>$categories]);
        
           } catch (\Throwable $th) {
            return response("there'e a problem,please try again");
           }
    }

    public function enroll($tournament_id){
        $user_enroll_as = Auth()->user()->enroll_as;
        $events = Event::all();
        try {
            return view("tournaments.enrollment",["user_enroll_as"=>$user_enroll_as,"events"=>$events,"tournament_id"=>$tournament_id]);
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    public function store(Request $request){
        $request->validate([
            "name"=>"required|string|max:255|regex:/^\S*$/u",
            "description"=>"required|regex:/^\S*$/u",
            "events_number"=>["required",new GreaterThanFive]
        ],[
            'name.regex' => 'The name must not contain white spaces.',
            'description.regex' => 'The description must not contain white spaces.'
        ]);
            try {
                Tournament::create([
                    "name" => request()->name,
                    "description" => request()->description,
                    "events_number" => request()->events_number,
                    "category_id" => request()->category
                ]);
                return to_route("home");
            } catch (\Throwable $th) {
                return response("there's a problem,please try again");
            }
    }

    public function destroy($id){
        try {
            Tournament::destroy($id);
            return to_route("home");
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    public function edit($id){
        try {
            $tournament = Tournament::findorfail($id);
            $tournamentCategory = Category::where("id",$tournament->category_id)->get("name");
            $categories = Category::all();
            return view("tournaments.edit",["tournament" => $tournament,"categories" => $categories,"tournament_category"=>$tournamentCategory[0]->name]);
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    public function update($id){
        try {
            $categoryFromDB = Category::where("name",request()->category)->get("id");
            Tournament::findorfail($id)->update([
                "name" => request()->name,
                "description" => request()->description,
                "events_number" => request()->events_number,
                "category_id" => +$categoryFromDB[0]->id
            ]);
            return to_route("home");
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }
}

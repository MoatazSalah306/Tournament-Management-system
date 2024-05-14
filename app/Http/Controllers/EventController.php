<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tournament;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;



class EventController extends Controller
{
    public function create(){
        try {
            $tournaments = Tournament::all();
            return view("events.create",["tournaments"=>$tournaments]);
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    public function store(Request $request){
        $request->validate([
            "name"=>"required|string|max:255|regex:/^\S*$/u",
            "seats_number"=>["required"],
            "seats_available"=>["required"]
        ],[
            'name.regex' => 'The name must not contain white spaces.',
        ]);
        $events_in_this_tournament = 0;
        foreach (Event::all() as $key => $value) {
            if($value->tournament_id == request()->tournament){
                $events_in_this_tournament +=1;
            }
            
        }
        if ($events_in_this_tournament < Tournament::findorfail(request()->tournament)->events_number) {
                try {
                Event::create([
                    "name" => request()->name,
                    "type" => request()->type,
                    "seats_number" => request()->seats_number,
                    "seats_available" => request()->seats_available,
                    "tournament_id" => request()->tournament
                ]);
                return to_route("home");
            } catch (\Throwable $th) {
                return response("there's a problem,please try again");
            }
        } else {
            $message = "This Tournament is full.";
            return redirect()->back()->with("limit",$message);
        }
        
       
    }

    public function destroy($id){
        try {
            Event::destroy($id);
            return to_route("home");
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    public function edit($id){
        try {
            $event = Event::findorfail($id);
            $eventTournament = Tournament::where("id",$event->tournament_id)->get("name");
            $tournaments = Tournament::all();
            return view("events.edit",["event" => $event,"tournaments" => $tournaments,"event_tournament"=>$eventTournament[0]->name]);
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    public function update($id){
        try {
            $TournamentFromDB = Tournament::where("name",request()->tournament)->get("id");
            Event::findorfail($id)->update([
                "name" => request()->name,
                "type" => request()->type,
                "seats_number" => request()->seats_number,
                "seats_available" => request()->seats_available,
                "tournament_id" => +$TournamentFromDB[0]->id
            ]);
            return to_route("home");
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }
}

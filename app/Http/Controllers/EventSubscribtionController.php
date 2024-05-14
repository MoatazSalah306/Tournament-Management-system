<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventSubscribtion;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;



class EventSubscribtionController extends Controller
{
    public function store(Request $request){

            // controller logic
            $numofevents = 0 ;
            $events_ids = [];
            foreach ($request->all() as $key => $value) {
                if ($value == "on") {
                    $numofevents+=1;
                }
            }
            if ($numofevents < 5) {
                $message = "You must choose at least 5 events";
                return redirect()->back()->with("less_events", $message);
            }
            // continue your logic
            foreach ($request->all() as $key => $value) {
                if ($value == "on") {
                    $events_ids[] = $key;
                }
            }
            $fullfilledEvents = [];
            $alldone = [];
            foreach ($events_ids as $value) {
                if (Event::findorfail($value)->seats_available  > 0) {
                    $alldone[$value] = "yes";
                }
                else{
                    $fullfilledEvents[] = Event::findorfail($value)->name;
                    $alldone[$value] = "no";
                }
            }
            if ($fullfilledEvents) {
                return redirect()->back()->with("fullfilledEvents", $fullfilledEvents);
            }
        
        // individual seperation
        if (Auth()->user()->enroll_as == "individual") {
            if (!in_array("no",$alldone)) {
                foreach ($alldone as $event_id => $value) {
                    EventSubscribtion::create([
                        "team_ids" => "individual",
                        "user_id" => Auth()->user()->id,
                        "event_id" => $event_id
                    ]);
                    Event::findorfail($event_id)->decrement("seats_available");
                }
                Score::create([
                    "team_ids" => "individual",
                    "user_id" => Auth()->user()->id,
                    "score" => 50
                ]);
            }
            return to_route("score.index",Auth()->user()->id);
        // team seperation
        }elseif(Auth()->user()->enroll_as == "team"){
            $validator = FacadesValidator::make($request->all(), [
                'email1' => 'required|email|exists:users,email',
                'email2' => 'required|email|different:email1|exists:users,email',
                'email3' => 'required|email|different:email1,email2|exists:users,email',
                'email4' => 'required|email|different:email1,email2,email3|exists:users,email',
            ],
            [
                'email1.different' => 'email must be different from others',
                'email2.different' => 'email must be different from others',
                'email3.different' => 'email must be different from others',
                'email4.different' => 'email must be different from others',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // All emails are valid and different from each other
            // Further processing can be done here
            $team_ids = "";
            $team_ids .= Auth()->user()->id;
            $team_ids .= ",";
            $team_ids .= User::where("email",request()->email1)->get("id")[0]->id;
            $team_ids .= ",";
            $team_ids .= User::where("email",request()->email2)->get("id")[0]->id;
            $team_ids .= ",";
            $team_ids .= User::where("email",request()->email3)->get("id")[0]->id;
            $team_ids .= ",";
            $team_ids .= User::where("email",request()->email4)->get("id")[0]->id;
            
            // return $team_ids;
            if (!in_array("no",$alldone)) {
                foreach ($alldone as $event_id => $value) {
                    EventSubscribtion::create([
                        "team_ids" => $team_ids,
                        "user_id" => Auth()->user()->id,
                        "event_id" => $event_id
                    ]);
                    Event::findorfail($event_id)->decrement("seats_available");
                }

                Score::create([
                    "team_ids" => $team_ids,
                    "user_id" => Auth()->user()->id,
                    "score" => 80
                ]);
            }
            return to_route("score.index",Auth()->user()->id);
        }
    }
}

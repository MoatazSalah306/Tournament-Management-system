<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index($id){
            $score = Score::where("user_id",$id)->get();
            return view("score",["score"=>$score]);
    }
}

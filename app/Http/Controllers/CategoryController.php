<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
        try {
            return view("categories.create");
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    // in category controller
    public function store(Request $request){
        $request->validate([
            "name"=>"required|string|max:255|regex:/^\S*$/u",
        ],[
            'name.regex' => 'The name must not contain white spaces.',
        ]);
        try {
            Category::create([
                "name"=>request()->name
            ]);
            return to_route("home");
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    public function destroy($id){

        try {
            Category::destroy($id);
            return to_route("home");
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    public function edit($id){
        try {
            $category = Category::findorfail($id);
            return view("categories.edit",["category" => $category]);
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    public function update($id){
        try {
            Category::findorfail($id)->update([
                "name" => request()->name
            ]);
            return to_route("home");
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }
}

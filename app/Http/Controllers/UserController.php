<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminOrSuperAdmin;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;

class UserController extends Controller
{

    public function enroll_as($tournament_id){
        try {
            $curr_user_id = Auth()->user()->id;
            User::findorfail($curr_user_id)->update([
                "enroll_as" => request()->enroll_as
            ]);
            return to_route("tournaments.enroll",$tournament_id);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }
    
    public function create(){
        $UserRole = Auth()->user()->role;
        try {
            return view("users.create",["role" =>$UserRole]);
        } catch (\Throwable $th) {
            return response("there's a problem,please try again");
        }
    }

    public function store(Request $request){
        $request->validate([
            "name"=>"required|string|max:255|regex:/^\S*$/u",
            "email"=>"required|email|unique:users,email|regex:/^\S*$/u",
            "password"=>"required|string|min:8|regex:/^\S*$/u"
        ],[
            'name.regex' => 'The name must not contain white spaces.',
            'email.regex' => 'The email must not contain white spaces.',
            'password.regex' => 'The password must not contain white spaces.'
        ]);
        $currUserRole = Auth()->user()->role;
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
        if ($role =="admin") {
            if ($currUserRole == "superadmin") {
                try {
                    User::create([
                        "name"=>$name,
                        "email"=>$email,
                        "password"=>bcrypt($password),
                        "role"=>$role,
                    ]);
                    return to_route("home");
                } catch (\Throwable $th) {
                    return response("there's a problem,please try again");
                }
            }else{
                abort(401);
            }
        }elseif (!$role || $role == "user") {
            if ($currUserRole == "admin" || $currUserRole == "superadmin") {
                try {
                    User::create([
                        "name"=>$name,
                        "email"=>$email,
                        "password"=>bcrypt($password),
                        "role"=>"user",
                    ]);
                    return to_route("home");
                } catch (\Throwable $th) {
                    return response("there's a problem,please try again");
                }
            }else{
                abort(401);
            }
        }

    }

    public function edit($id){
        $user = User::findorfail($id);
        if ($user->role == "admin") {
            if (Auth()->user()->role == "superadmin") {
                return view("users.edit",["user"=>$user]);
            } else {
                abort(401);
            } 
        }
        elseif ($user->role == "user") {
            if (Auth()->user()->role == "superadmin" || Auth()->user()->role == "admin") {
                return view("users.edit",["user"=>$user]);
            } else {
                abort(401);
            } 
        }elseif ($user->role == "superadmin") {
            abort(500);
        }
    }

    public function update($id){
        $user = User::findorfail($id);
        if ($user->role == "admin") {
            if (Auth()->user()->role == "superadmin") {
                try {
                    User::findorfail($id)->update([
                        "name" => request()->name,
                        "email" => request()->email
                    ]);
                    return to_route("home");
                } catch (\Throwable $th) {
                    return response("there's a problem , please try again");
                }
            } else {
                abort(401);
            } 
        }
        elseif ($user->role == "user") {
            if (Auth()->user()->role == "superadmin" || Auth()->user()->role == "admin") {
                try {
                    User::findorfail($id)->update([
                        "name" => request()->name,
                        "email" => request()->email
                    ]);
                    return to_route("home");
                } catch (\Throwable $th) {
                    return response("there's a problem , please try again");
                }
            } else {
                abort(401);
            } 
        }elseif ($user->role == "superadmin") {
            abort(500);
        }
    }

    public function destroy($id){
        
        $user = User::findorfail($id);
        if ($user->role == "admin") {
            if (Auth()->user()->role == "superadmin") {
                try {
                    User::destroy($id);
                    return to_route("home");
                } catch (\Throwable $th) {
                    return response("there's a problem please try again");
                } 
            } else {
                abort(401);
            } 
        }
        elseif ($user->role == "user") {
            if (Auth()->user()->role == "superadmin" || Auth()->user()->role == "admin") {
                try {
                    User::destroy($id);
                    return to_route("home");
                } catch (\Throwable $th) {
                    return response("there's a problem please try again");
                } 
            } else {
                abort(401);
            } 
        }elseif ($user->role == "superadmin") {
            abort(500);
        }
    }

}


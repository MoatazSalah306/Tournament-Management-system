<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventSubscribtionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\Tournamentcontroller;
use App\Http\Controllers\UserController;
use App\Models\Tournament;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// welcome page
Route::get('/', function () {
    return view('welcome');
});


// home
Route::get("/home",[HomeController::class,"index"])->middleware("auth")->name("home");

// users & tours & categories & events
Route::middleware("auth")->group(function(){

        //users
        Route::controller(UserController::class)->group(function(){
            Route::put("/users/{tournament}/enroll_as","enroll_as")->name("users.enroll_as");
            Route::get("/users/create","create")->name("users.create")->middleware("adminorsuperadmin");
            Route::post("/users","store")->name("users.store");
            Route::get("/users/{user}/edit","edit")->name("users.edit");
            Route::put("/users/{user}","update")->name("users.update");
            Route::delete("/users/{user}","destroy")->name("users.destroy");
        });

        //score
        Route::get("/score/{id}",[ScoreController::class,"index"])->name("score.index");


        // tournaments
        Route::get("/tournamnets/{tournament}/enroll",[Tournamentcontroller::class,"enroll"])->name("tournaments.enroll");
        Route::controller(Tournamentcontroller::class)->middleware("adminorsuperadmin")->group(function(){
            Route::get("/tournaments/create","create")->name("tournaments.create");
            Route::post("/tournaments","store")->name("tournaments.store");
            Route::delete("/tournaments/{tournament}","destroy")->name("tournaments.destroy");
            Route::get("/tournaments/{tournament}/edit","edit")->name("tournaments.edit");
            Route::put("/tournaments/{tournament}","update")->name("tournaments.update"); 
        });

        // categories
        Route::controller(CategoryController::class)->middleware("adminorsuperadmin")->group(function(){
            Route::get("/categories/create","create")->name("categories.create");
            Route::post("/categories","store")->name("categories.store");
            Route::delete("/categories/{category}","destroy")->name("categories.destroy");
            Route::get("/categories/{category}/edit","edit")->name("categories.edit");
            Route::put("/categories/{category}","update")->name("categories.update");    
        });

        // events
        Route::controller(EventController::class)->middleware("adminorsuperadmin")->group(function(){
            Route::get("/events/create","create")->name("events.create");
            Route::post("/events","store")->name("events.store");
            Route::delete("/events/{event}","destroy")->name("events.destroy");
            Route::get("/events/{event}/edit","edit")->name("events.edit");
            Route::put("/events/{event}","update")->name("events.update");    
        });

        // enrollment post
        Route::post("/enrollment",[EventSubscribtionController::class,"store"])->name("enrollment");
});

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';



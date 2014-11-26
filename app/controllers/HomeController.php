<?php

class HomeController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
     */

    public function showWelcome()
    {
        return View::make('hello');
    }

    public function loginScreen()
    {
        return View::make('login');
    } 

    public function login()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        if (Auth::attempt(array('email' => $email, 'password' => $password)))
        {
            if(Auth::user()->admin == 1){
                return Redirect::to('admin');
            }
            else{
                return Redirect::to('/');    
            }
        }
    }

    public function logout()
    {
        Auth::logout();
    }

}

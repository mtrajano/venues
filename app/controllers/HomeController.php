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

    public function index()
    {
        return View::make('index');
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
                return Redirect::intended('admin');
            }
            else{
                return Redirect::intended('users'); 
            }
        }
    }

    public function signup()
    {
        $email = Input::get('email');
        $name = Input::get('firstname');
        $surname = Input::get('lastname');
        $password = Input::get('passwd');

        $user = User::create([
            'email' => $email,
            'f_name' => $name,
            'l_name' => $surname
        ]);
        $user->password = Hash::make($password);
        $user->save();

        return Redirect::to('login')->withSuccess("Thank you for signing up!");
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }

}

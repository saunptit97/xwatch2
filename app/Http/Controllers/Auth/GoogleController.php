<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
class GoogleController extends Controller

{



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function redirectToGoogle()

    {

        return Socialite::driver('google')->redirect();

    }



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleGoogleCallback()

    {

        try {

            $user = Socialite::driver('google')->user();

            $create['name'] = $user->getName();

            $create['email'] = $user->getEmail();

            $create['google_id'] = $user->getId();



            // $userModel = new User;

            // $createdUser = $userModel->addNew($create);

            // Auth::loginUsingId($createdUser->id);



            return  $create['name'];



        } catch (Exception $e) {



            return redirect('auth/google');



        }

    }

}
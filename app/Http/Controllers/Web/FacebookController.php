<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Socialite;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // check if exist
        $u = \App\User::where('socialite_uuid', '=', $user->getId())->first();
        if (!$u) {
        	$u = new \App\User;
        	$u->socialite_uuid = $user->getId();
        	$u->name = $user->getName();
        	$u->email = $user->getEmail();
        	$u->password = bcrypt(time());
        	$u->business = '1';
        	$u->active = '1';
        	$u->save();

        	$b = new \App\Business;
        	$b->id_user = $u->id;
        	$b->businessname = $user->getName();
        	$b->id_created_by = 1;
        	$b->save();
        }

        auth()->login($u);
        return redirect()->action('Web\HomepageController@index');
        // $user->token;
    }
}
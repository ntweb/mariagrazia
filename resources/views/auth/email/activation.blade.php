<?php 
	// $url = action('\App\Http\Controllers\Auth\RegisterController@verify', array($user->verify_token)).'?email='.e($user->email);
	$url = env('APP_URL_VERIFICATION_ACCOUNT').$user->verify_token.'?email='.e($user->email);
?>

@component('mail::message')

Gentile utente,
per attivare l'acocunt clicchi sul seguente link: <a href="{{$url}}">{{$url}}</a> 

@component('mail::button', ['url' => $url])
Verifica
@endcomponent

@endcomponent
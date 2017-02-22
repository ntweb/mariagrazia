<?php 
	$url = action('\App\Http\Controllers\Auth\RegisterController@verify', array($user->verify_token)).'?email='.e($user->email);
?>

@component('mail::message')

Gentile utente,
per attivare l'acocunt clicchi sul seguente link: <a href="{{$url}}">{{$url}}</a> 

@component('mail::button', ['url' => $url])
Verify
@endcomponent

@component('mail::panel')
This is the panel content.
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

@endcomponent

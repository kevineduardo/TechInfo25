<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Socialite;
use App\User;
use App\Picture;
use App\Student;
use App\NewStudent;
use App\ClasseAttr;
use Auth;

class OAuthController extends Controller
{
    /**
     * Redirect the user to the authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        //dd($user);
        $usuario = User::where('email', $user->email)->first();
        if($usuario) {
        	if (Auth::login($usuario, true)) {
            // Autenticado
            redirect()->route('portal_inicio');
        	}
        } else {
            $alauth = NewStudent::where('email', $user->email)->first();
            if(!$alauth) {
                return view('semconvite');
            }
	        $cad = User::create([
	            'name' => $user->getName(),
	            'email' => $user->getEmail(),
	            'password' => bcrypt($user->token),
	            'oauth' => true,
	            'oauth_id' => $user->id,
	            'oauth_provider' => 'facebook',
	        ]);
	        Picture::create([
	        	'title' => 'User: ' . $user->id,
	        	'description' => 'User picture',
	        	'ext_path' => str_replace('normal','large', $user->avatar),
	        	'type' => 1,
	        	'author_id' => $cad->id,
	        	]);
            Student::create([
                'user_id' => $cad->id,
                ]);
            ClasseAttr::create([
                'student_id' => Student::where('user_id', $cad->id)->first()->id,
                'class_id' => $alauth->class_id,
                ]);
	        if (Auth::login($cad, true)) {
            $alauth->delete();
            return redirect()->route('portal_inicio');
        	}
	    }
	    return redirect()->route('portal_inicio');
    }
}

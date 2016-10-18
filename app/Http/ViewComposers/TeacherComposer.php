<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;
use App\Teacher;

class TeacherComposer 
{
	public function compose(View $view) {
		if(Auth::check()){
		$user = Auth::user();
        $professor = Teacher::where('user_id', $user->id)->first();
		$view->with(['professor' => $professor,]);
		}
	}
}
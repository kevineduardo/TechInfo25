<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class TesteComposer 
{
	public function compose(View $view) {
		$view->with('vrau', random_int(0,10));
	}
}
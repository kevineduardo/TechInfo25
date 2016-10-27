<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Classe;

class ClassesComposer 
{
	public function compose(View $view) {
		$classes = Classe::all();
		$view->with(['classes' => $classes,]);
	}
}
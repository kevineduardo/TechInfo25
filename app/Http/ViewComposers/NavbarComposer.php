<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Categorie;

class NavbarComposer 
{
	public function compose(View $view) {
		$categories = Categorie::with('pages')->get();
		$view->with('categories', $categories);
	}
}
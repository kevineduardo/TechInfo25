<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

use App\Categorie;

class NavbarComposer 
{
	public function compose(View $view) {
		$ctg = null;
        if ($ctg != null) {
            $view->with('categories', $ctg);
        } else {
		$categories = Categorie::with('pages')->get();
		$view->with('categories', $categories);
		}
	}
}
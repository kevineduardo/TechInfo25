<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Setting;

class SettingComposer 
{
	public function compose(View $view) {
		$site_name = Setting::where('name', 'site_name')->first();
		$maintenance = Setting::where('name', 'maintenance')->first();
		$facebook_page_url = Setting::where('name', 'facebook_page_url')->first();
		$portal_activated = Setting::where('name', 'portal_activated')->first();
		$footer = Setting::where('name', 'footer')->first();
		$settings = [
			'site_name' => $site_name['value'],
			'maintenance' => $maintenance['value'],
			'facebook_page_url' => $facebook_page_url['value'],
			'portal_activated' => $portal_activated['value'],
			'footer' => $footer['value'],
		];
		$view->with('settings', $settings);
	}
}
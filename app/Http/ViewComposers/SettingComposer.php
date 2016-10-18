<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Setting;

class SettingComposer 
{
	public function compose(View $view) {

		$settings = Cache::tags('settings')->get('settings');
        if ($settings != null) {
        	$site_name = $settings->where('name', 'site_name')->first();
			$maintenance = $settings->where('name', 'maintenance')->first();
			$facebook_page_url = $settings->where('name', 'facebook_page_url')->first();
			$portal_activated = $settings->where('name', 'portal_activated')->first();
			$footer = $settings->where('name', 'footer')->first();
			$settings = [
				'site_name' => $site_name['value'],
				'maintenance' => $maintenance['value'],
				'facebook_page_url' => $facebook_page_url['value'],
				'portal_activated' => $portal_activated['value'],
				'footer' => $footer['value'],
			];
            $view->with('settings', $settings);
        } else {
	        unset($settings);

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
}
<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider; 
use Illuminate\Support\Facades\App;

class LoyalityPosApiServiceProvider extends ServiceProvider
{

	public function boot()
		{
		}


	public function register()
		{
		$this->app_>bind('LoyalityPosApi', function () 
			{
			return new pneves001\loyalityposapi\LoyalityPosApi; 
			});
		}
}


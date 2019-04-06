<?php


namespace pneves001\LoyalityPosApi;

use Illuminate\Support\ServiceProvider; 


class LoyalityPosApiServiceProvider extends ServiceProvider
{

	public function boot()
		{
		}


	public function register()
		{
		$this->app->singleton('LoyalityPosApi', function () 
			{
			return new pneves001\loyalityposapi\LoyalityPosApi; 
			});
		}
}


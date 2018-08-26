<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionMacroServiceProvider extends ServiceProvider 
{
 	public function boot()
 	{
 		Collection::macro('uppercase', function () {
            return collect($this->items)->map(function ($item) {
                return strtoupper($item);
            });
        });

        Collection::macro('ac', function() {
        	return collect($this->items)->map(function ($item) {
        		return 'ac_' . $item;
        	});
        });
 	}
}
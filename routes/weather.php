<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', 'WeatherController@show')->name('weather');
Route::get('{location}', 'WeatherController@location')->name('weather.location');

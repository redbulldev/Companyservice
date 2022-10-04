<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use Companyservice\Http\Controllers\Admin\ServiceController;


Route::group(['prefix' => 'admin', 'middleware' => ['web', 'CheckLogedOut']], function(){
    Route::Resource('/service', ServiceController::class);
});

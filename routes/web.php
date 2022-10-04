<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use Companyservice\Http\Controllers\Frontend\ServiceController;

Route::get('/services', [ServiceController::class, 'index'])->name('services');

Route::get('/service-detail/{id}/{slug}', [ServiceController::class, 'detail'])->name('service.detail');

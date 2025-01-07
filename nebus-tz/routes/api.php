<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('organizations/building/{buildingId}', [OrganizationController::class, 'getOrganizationsByBuilding'])
    ->middleware(\App\Http\Middleware\ApiKeyMiddleware::class);

Route::get('organizations/activity/{activityId}', [OrganizationController::class, 'getOrganizationsByActivity'])
    ->middleware(\App\Http\Middleware\ApiKeyMiddleware::class);

Route::get('organizations/activity-name', [OrganizationController::class, 'getOrganizationsByActivityName'])
    ->middleware(\App\Http\Middleware\ApiKeyMiddleware::class);

Route::get('organization/{id}', [OrganizationController::class, 'getOrganization'])
    ->middleware(\App\Http\Middleware\ApiKeyMiddleware::class);

Route::get('organizations/search/{name}', [OrganizationController::class, 'searchOrganizationsByName'])
    ->middleware(\App\Http\Middleware\ApiKeyMiddleware::class);

Route::get('organizations/near', [OrganizationController::class, 'getOrganizationsInRadius'])
    ->middleware(\App\Http\Middleware\ApiKeyMiddleware::class);


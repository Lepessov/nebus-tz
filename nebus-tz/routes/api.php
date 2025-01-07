<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware([ \App\Http\Middleware\ApiKeyMiddleware::class])->group(function () {

    Route::get('organizations/building/{buildingId}', [OrganizationController::class, 'getOrganizationsByBuilding']);

    Route::get('organizations/activity/{activityId}', [OrganizationController::class, 'getOrganizationsByActivity']);

    Route::get('organizations/activity-name', [OrganizationController::class, 'getOrganizationsByActivityName']);

    Route::get('organization/{id}', [OrganizationController::class, 'getOrganization']);

    Route::get('organizations/search/{name}', [OrganizationController::class, 'searchOrganizationsByName']);

    Route::get('organizations/near', [OrganizationController::class, 'getOrganizationsInRadius']);

});

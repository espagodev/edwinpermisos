<?php

use Illuminate\Support\Facades\Route;

use Edwin\Edwinpermisos\Http\Controllers\RoleController;
use Edwin\Edwinpermisos\Http\Controllers\UserController;


Route::resource(config('Edwinpermisos.RouteRole'), RoleController::class)->names('role')->middleware(['web']);

Route::resource(config('Edwinpermisos.RouteUser'), UserController::class)->names('user')->middleware(['web']);
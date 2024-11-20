<?php

    use App\Http\Controllers\Api\V1\Admin\AdminController;
    use App\Http\Controllers\Api\V1\Auth\AuthController;
    use App\Http\Controllers\Api\V1\Category\CategoryController;
    use App\Http\Controllers\Api\V1\Client\ClientController;
    use App\Http\Controllers\Api\v1\Manager\ManagerController;
    use Illuminate\Support\Facades\Route;

    //auth actions routes
    Route::controller(AuthController::class)->group(function(){
        Route::post('login', 'login');
        Route::post('logout', 'logout');
    });

    //routes for admin manipulations
    Route::controller(AdminController::class)->group(function(){
        Route::post('admins', 'store');
        Route::put('admins/{id}', 'update');
        Route::get('admins/{id}', 'show');
        Route::get('admins', 'index');
        Route::delete('admins/{id}', 'destroy');
    });

    //routes for manager manipulations
    Route::controller(ManagerController::class)->group(function(){
        Route::post('managers', 'store');
        Route::put('managers/{id}', 'update');
        Route::get('managers/{id}', 'show');
        Route::get('managers', 'index');
        Route::delete('managers/{id}', 'destroy');
    });

    //routes for client manipulations
    Route::controller(ClientController::class)->group(function(){
        Route::post('clients', 'store');
        Route::put('clients/{id}', 'update');
        Route::get('clients/{id}', 'show');
        Route::get('clients', 'index');
        Route::delete('clients/{id}', 'destroy');
    });

    //routes for categpory manipulations
    Route::controller(CategoryController::class)->group(function(){
        Route::post('categories', 'store');
        Route::put('categories/{id}','update');
        Route::get('categories/{id}', 'show');
        Route::get('categories', 'index');
        Route::delete('categories/{id}', 'destroy');
    });



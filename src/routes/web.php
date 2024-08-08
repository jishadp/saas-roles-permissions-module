<?php

use Illuminate\Support\Facades\Route;
use Jishadp\SaasRolesPermissions\Controllers\RoleController;

Route::controller(RoleController::class)->middleware(['web','auth','setdb_middleware'])->name('saas.roles.')->prefix('roles')->group(function(){
    Route::get('list', 'list')->name('list');
    Route::post('save', 'save')->name('save');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('update', 'update')->name('update');
    Route::get('delete/{id}', 'delete')->name('delete');
    Route::post('permission-add', 'permissionAdd')->name('permission.add');
    Route::get('permissions/{id}', 'getRolePermissions')->name('permissions');

    Route::post('permission-add', 'permissionAdd')->name('permission.add');
    Route::get('permissions/{id}', 'getRolePermissions')->name('permissions');
});


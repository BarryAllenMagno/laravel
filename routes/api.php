<?php

use App\Http\Controllers\crudController;
use App\Http\Controllers\MembersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('getAllMembers', [MembersController::class, 'getAllMembers']);
Route::post('saveMember', [MembersController::class, 'saveMember']);
Route::get('getMemberDetails', [MembersController::class, 'getMemberDetails']);
Route::post('updateMember', [MembersController::class, 'updateMember']);
Route::delete('deleteMember', [MembersController::class, 'deleteMember']);

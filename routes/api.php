<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'student.', 'controller' => StudentController::class], function(){
    Route::get('/student', 'show')->name('show');
    Route::get('/student/{id}', 'view')->name('view');
    Route::post('/student/create', 'store')->name('store');
    Route::post('/student/{id}/update', 'update')->name('update');
    Route::post('/student/{id}/delete', 'delete')->name('delete');
});

Route::group(['as' => 'speciality.', 'controller' => SpecialityController::class], function(){
    Route::post('/speciality', 'show')->name('show');
    Route::get('/speciality/{id}', 'view')->name('view');
    Route::post('/speciality/create', 'store')->name('store');
    Route::post('/speciality/{id}/update', 'update')->name('update');
    Route::post('/speciality/{id}/delete', 'delete')->name('delete');
});
Route::group(['as' => 'grade.', 'controller' => GradeController::class], function(){
    Route::post('/grade', 'show')->name('show');
    Route::get('/grade/{id}', 'view')->name('view');
    Route::post('/grade/create', 'store')->name('store');
    Route::post('/grade/{id}/update', 'update')->name('update');
    Route::post('/grade/{id}/delete', 'delete')->name('delete');
});
Route::group(['as' => 'subject.', 'controller' => SubjectController::class], function(){
    Route::post('/subject', 'show')->name('show');
    Route::get('/subject/{id}', 'view')->name('view');
    Route::post('/subject/create', 'store')->name('store');
    Route::post('/subject/{id}/update', 'update')->name('update');
    Route::post('/subject/{id}/delete', 'delete')->name('delete');
});
